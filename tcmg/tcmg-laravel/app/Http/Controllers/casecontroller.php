<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class casecontroller extends Controller
{
    private const COUNTRIES = ['مصر', 'السعودية', 'البحرين', 'قطر', 'عمان', 'الإمارات', 'الكويت'];

    private const CASE_TYPES = ['مدنية', 'تجارية', 'إدارية', 'جنائية'];

    private const STATUSES = ['نشطة', 'مغلقة', 'قيد المراجعة'];

    public function index(Request $request)
    {
        $cases = DB::table('casemodels')
            ->leftJoin('clints as client_one', 'casemodels.clint_id', '=', 'client_one.id')
            ->leftJoin('clints as client_two', 'casemodels.client2_id', '=', 'client_two.id')
            ->when($request->filled('q'), function ($query) use ($request): void {
                $search = $request->string('q')->trim()->toString();
                $query->where(function ($query) use ($search): void {
                    $query->where('casemodels.case_number', 'like', "%{$search}%")
                        ->orWhere('casemodels.case_type', 'like', "%{$search}%")
                        ->orWhere('casemodels.court_name', 'like', "%{$search}%")
                        ->orWhere('casemodels.lawyer1_name', 'like', "%{$search}%")
                        ->orWhere('casemodels.lawyer2_name', 'like', "%{$search}%")
                        ->orWhere('client_one.name', 'like', "%{$search}%")
                        ->orWhere('client_two.name', 'like', "%{$search}%");
                });
            })
            ->when(
                in_array($request->input('status'), self::STATUSES, true),
                fn ($query) => $query->where('casemodels.status', $request->input('status'))
            )
            ->select('casemodels.*', 'client_one.name as client_name', 'client_two.name as client2_name')
            ->orderByDesc('casemodels.id')
            ->paginate(8)
            ->withQueryString();

        $to = now();
        $from = $to->copy()->subDays(9)->startOfDay();
        $days = collect(range(0, 9))->map(fn (int $offset) => $from->copy()->addDays($offset));
        $dailyRows = DB::table('casemodels')
            ->selectRaw('DATE(created_at) as day, status, COUNT(*) as total')
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('day', 'status')
            ->get();
        $sessionRows = DB::table('casemodels')
            ->selectRaw('session_date as day, COUNT(*) as total')
            ->whereBetween('session_date', [$from->toDateString(), $to->toDateString()])
            ->groupBy('session_date')
            ->get();
        $caseTypeRows = DB::table('casemodels')
            ->select('case_type')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('case_type')
            ->orderBy('case_type')
            ->get();
        $totalCases = DB::table('casemodels')->count();
        $closedCases = DB::table('casemodels')->where('status', 'مغلقة')->count();

        $charts = [
            'labels' => $days->map(fn ($day) => $day->format('j/n'))->all(),
            'active' => $days->map(fn ($day) => (int) $dailyRows
                ->filter(fn ($row) => $row->day === $day->toDateString()
                    && $row->status !== 'مغلقة')
                ->sum('total'))->all(),
            'closed' => $days->map(fn ($day) => (int) $dailyRows
                ->where('day', $day->toDateString())
                ->where('status', 'مغلقة')
                ->sum('total'))->all(),
            'sessions' => $days->map(fn ($day) => (int) $sessionRows
                ->where('day', $day->toDateString())
                ->sum('total'))->all(),
            'types' => [
                'labels' => $caseTypeRows->isEmpty()
                    ? ['لا توجد بيانات']
                    : $caseTypeRows->map(fn ($row) => $row->case_type ?: 'غير محدد')->all(),
                'values' => $caseTypeRows->isEmpty()
                    ? [0]
                    : $caseTypeRows->pluck('total')->map(fn ($total) => (int) $total)->all(),
            ],
            'closureRate' => $totalCases === 0 ? 0 : (int) round(($closedCases / $totalCases) * 100),
        ];

        return view('cases.index', [
            'cases' => $cases,
            'charts' => $charts,
            'statuses' => self::STATUSES,
        ]);
    }

    public function create()
    {
        return view('cases.form', $this->formData(null));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());
        $caseNumber = $validated['case_number'] ?? null;
        unset($validated['case_number']);
        $now = now();

        $id = DB::transaction(function () use ($validated, $caseNumber, $now): int {
            $id = DB::table('casemodels')->insertGetId($validated + [
                'case_number' => $caseNumber ?: 'TEMP',
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            if ($caseNumber === null || $caseNumber === '') {
                DB::table('casemodels')->where('id', $id)->update([
                    'case_number' => (string) $id,
                    'updated_at' => $now,
                ]);
            }

            return $id;
        });

        return redirect()->route('cases.index')->with('success', "تم حفظ القضية رقم {$id} بنجاح.");
    }

    public function edit(int $case)
    {
        $record = DB::table('casemodels')->find($case);
        abort_if($record === null, 404);

        return view('cases.form', $this->formData($record));
    }

    public function update(Request $request, int $case)
    {
        $record = DB::table('casemodels')->find($case);
        abort_if($record === null, 404);

        $validated = $request->validate($this->rules($case));
        if (empty($validated['case_number'])) {
            $validated['case_number'] = $record->case_number;
        }

        DB::table('casemodels')->where('id', $case)->update($validated + [
            'updated_at' => now(),
        ]);

        return redirect()->route('cases.index')->with('success', 'تم تحديث بيانات القضية بنجاح.');
    }

    public function destroy(int $case)
    {
        abort_unless(DB::table('casemodels')->where('id', $case)->exists(), 404);

        DB::table('casemodels')->where('id', $case)->delete();

        return redirect()->route('cases.index')->with('success', 'تم حذف القضية.');
    }

    public function destroyMany(Request $request)
    {
        $ids = $request->validate([
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['integer', 'distinct', Rule::exists('casemodels', 'id')],
        ])['ids'];

        DB::table('casemodels')->whereIn('id', $ids)->delete();

        return redirect()->route('cases.index')->with('success', 'تم حذف القضايا المحددة.');
    }

    private function formData(?object $case): array
    {
        return [
            'caseRecord' => $case,
            'clients' => DB::table('clints')->orderBy('name')->get(),
            'countries' => self::COUNTRIES,
            'caseTypes' => self::CASE_TYPES,
            'statuses' => self::STATUSES,
        ];
    }

    private function rules(?int $case = null): array
    {
        return [
            'case_number' => ['nullable', 'string', 'max:100', Rule::unique('casemodels', 'case_number')->ignore($case)],
            'clint_id' => ['required', 'integer', Rule::exists('clints', 'id')],
            'client2_id' => ['nullable', 'integer', 'different:clint_id', Rule::exists('clints', 'id')],
            'country' => ['required', 'string', Rule::in(self::COUNTRIES)],
            'case_type' => ['required', 'string', Rule::in(self::CASE_TYPES)],
            'lawyer1_name' => ['nullable', 'string', 'max:255'],
            'lawyer2_name' => ['nullable', 'string', 'max:255'],
            'first_session_date' => ['nullable', 'date'],
            'session_date' => ['nullable', 'date'],
            'judgment_date' => ['nullable', 'date'],
            'judgment' => ['nullable', 'string', 'max:255'],
            'court_name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', Rule::in(self::STATUSES)],
            'fee' => ['nullable', 'numeric', 'min:0'],
            'tasks' => ['nullable', 'string'],
            'report' => ['nullable', 'string'],
        ];
    }
}
