<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class clintcontroller extends Controller
{
    private const COUNTRIES = ['مصر', 'السعودية', 'البحرين', 'قطر', 'عمان', 'الإمارات', 'الكويت'];

    private const TYPES = ['عميل', 'شركة ومؤسسة'];

    public function index(Request $request)
    {
        $clients = DB::table('clints')
            ->when($request->filled('q'), function ($query) use ($request): void {
                $search = $request->string('q')->trim()->toString();
                $query->where(function ($query) use ($search): void {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('nationality', 'like', "%{$search}%");
                });
            })
            ->when($request->input('type') === 'عميل', fn ($query) => $query->whereIn('type', ['عميل', 'فرد']))
            ->when($request->input('type') === 'شركة ومؤسسة', fn ($query) => $query->where('type', 'شركة ومؤسسة'))
            ->orderByDesc('id')
            ->paginate(8)
            ->withQueryString();

        $to = now();
        $from = $to->copy()->subDays(9)->startOfDay();
        $days = collect(range(0, 9))->map(fn (int $offset) => $from->copy()->addDays($offset));
        $dailyRows = DB::table('clints')
            ->selectRaw('DATE(created_at) as day, type, COUNT(*) as total')
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('day', 'type')
            ->get();
        $nationalityRows = DB::table('clints')
            ->select('nationality')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('nationality')
            ->orderBy('nationality')
            ->get();

        $charts = [
            'labels' => $days->map(fn ($day) => $day->format('j/n'))->all(),
            'companies' => $days->map(fn ($day) => (int) $dailyRows
                ->where('day', $day->toDateString())
                ->where('type', 'شركة ومؤسسة')
                ->sum('total'))->all(),
            'individuals' => $days->map(fn ($day) => (int) $dailyRows
                ->filter(fn ($row) => $row->day === $day->toDateString()
                    && in_array($row->type, ['عميل', 'فرد'], true))
                ->sum('total'))->all(),
            'nationalities' => [
                'labels' => $nationalityRows->isEmpty()
                    ? ['لا توجد بيانات']
                    : $nationalityRows->map(fn ($row) => $row->nationality ?: 'غير محدد')->all(),
                'values' => $nationalityRows->isEmpty()
                    ? [0]
                    : $nationalityRows->pluck('total')->map(fn ($total) => (int) $total)->all(),
            ],
        ];

        return view('clients.index', [
            'clients' => $clients,
            'charts' => $charts,
            'countries' => self::COUNTRIES,
            'types' => self::TYPES,
        ]);
    }

    public function create()
    {
        return view('clients.create', [
            'countries' => self::COUNTRIES,
            'types' => self::TYPES,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        DB::table('clints')->insert($validated + [
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('clients.index')->with('success', 'تم حفظ العميل بنجاح.');
    }

    public function update(Request $request, int $client)
    {
        abort_unless(DB::table('clints')->where('id', $client)->exists(), 404);

        DB::table('clints')->where('id', $client)->update(
            $request->validate($this->rules()) + ['updated_at' => now()]
        );

        return redirect()->route('clients.index')->with('success', 'تم تحديث بيانات العميل بنجاح.');
    }

    public function destroy(int $client)
    {
        abort_unless(DB::table('clints')->where('id', $client)->exists(), 404);

        DB::table('clints')->where('id', $client)->delete();

        return redirect()->route('clients.index')->with('success', 'تم حذف العميل.');
    }

    public function destroyMany(Request $request)
    {
        $ids = $request->validate([
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['integer', 'distinct', Rule::exists('clints', 'id')],
        ])['ids'];

        DB::table('clints')->whereIn('id', $ids)->delete();

        return redirect()->route('clients.index')->with('success', 'تم حذف العملاء المحددين.');
    }

    private function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'nationality' => ['required', 'string', Rule::in(self::COUNTRIES)],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'type' => ['required', 'string', Rule::in(self::TYPES)],
        ];
    }
}
