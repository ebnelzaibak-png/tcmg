<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CourtController extends Controller
{
    private const COUNTRIES = ['مصر', 'السعودية', 'البحرين', 'قطر', 'عمان', 'الإمارات', 'الكويت'];

    private const CATEGORIES = [
        'محكمة ابتدائية',
        'محكمة استئناف',
        'محكمة النقض',
        'محكمة إدارية',
        'محكمة الأسرة',
        'أخرى',
    ];

    public function index(Request $request)
    {
        $courts = DB::table('courts')
            ->when($request->filled('q'), function ($query) use ($request): void {
                $search = $request->string('q')->trim()->toString();
                $query->where(function ($query) use ($search): void {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('country', 'like', "%{$search}%")
                        ->orWhere('city', 'like', "%{$search}%")
                        ->orWhere('governorate', 'like', "%{$search}%")
                        ->orWhere('police_station', 'like', "%{$search}%")
                        ->orWhere('category', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('courts.index', compact('courts'));
    }

    public function create()
    {
        return view('courts.form', $this->formData(null));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());
        $now = now();

        $id = DB::transaction(function () use ($validated, $now): int {
            $id = DB::table('courts')->insertGetId($validated + [
                'name' => 'محكمة',
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            DB::table('courts')->where('id', $id)->update([
                'name' => "محكمة {$id}",
                'updated_at' => $now,
            ]);

            return $id;
        });

        return redirect()->route('court.index')->with('success', "تمت إضافة محكمة {$id} بنجاح.");
    }

    public function edit(int $court)
    {
        $record = DB::table('courts')->find($court);
        abort_if($record === null, 404);

        return view('courts.form', $this->formData($record));
    }

    public function update(Request $request, int $court)
    {
        abort_unless(DB::table('courts')->where('id', $court)->exists(), 404);

        DB::table('courts')->where('id', $court)->update(
            $request->validate($this->rules()) + ['updated_at' => now()]
        );

        return redirect()->route('court.index')->with('success', 'تم تحديث بيانات المحكمة.');
    }

    public function destroy(int $court)
    {
        abort_unless(DB::table('courts')->where('id', $court)->exists(), 404);

        DB::table('courts')->where('id', $court)->delete();

        return redirect()->route('court.index')->with('success', 'تم حذف المحكمة.');
    }

    public function destroyMany(Request $request)
    {
        $ids = $request->validate([
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['integer', 'distinct', Rule::exists('courts', 'id')],
        ])['ids'];

        DB::table('courts')->whereIn('id', $ids)->delete();

        return redirect()->route('court.index')->with('success', 'تم حذف المحاكم المحددة.');
    }

    private function formData(?object $court): array
    {
        return [
            'courtRecord' => $court,
            'countries' => self::COUNTRIES,
            'categories' => self::CATEGORIES,
        ];
    }

    private function rules(): array
    {
        return [
            'category' => ['required', 'string', Rule::in(self::CATEGORIES)],
            'country' => ['required', 'string', Rule::in(self::COUNTRIES)],
            'city' => ['required', 'string', 'max:255'],
            'governorate' => ['required', 'string', 'max:255'],
            'police_station' => ['required', 'string', 'max:255'],
        ];
    }
}
