<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class VacationController extends Controller
{
    private const LEAVE_TYPES = ['سنوية', 'عارضة', 'مرضية', 'بدون أجر', 'أخرى'];

    private const STATUSES = ['معلقة', 'مقبولة', 'مرفوضة'];

    private const DURATIONS = [
        1 => 'يوم واحد',
        2 => 'يومان',
        3 => '3 أيام',
        7 => 'أسبوع',
        14 => 'أسبوعان',
        30 => 'شهر',
    ];

    public function index(Request $request)
    {
        $vacations = DB::table('vacations')
            ->leftJoin('employee_models', 'vacations.employee_id', '=', 'employee_models.id')
            ->when($request->filled('q'), function ($query) use ($request): void {
                $search = $request->string('q')->trim()->toString();
                $query->where(function ($query) use ($search): void {
                    $query->where('employee_models.name', 'like', "%{$search}%")
                        ->orWhere('employee_models.country', 'like', "%{$search}%")
                        ->orWhere('employee_models.job_title', 'like', "%{$search}%")
                        ->orWhere('vacations.leave_type', 'like', "%{$search}%")
                        ->orWhere('vacations.reason', 'like', "%{$search}%");
                });
            })
            ->when(
                in_array($request->input('status'), self::STATUSES, true),
                fn ($query) => $query->where('vacations.status', $request->input('status'))
            )
            ->select(
                'vacations.*',
                'employee_models.name as employee_name',
                'employee_models.country',
                'employee_models.job_title'
            )
            ->orderByDesc('vacations.id')
            ->paginate(8)
            ->withQueryString();

        return view('vacations.index', [
            'vacations' => $vacations,
            'statuses' => self::STATUSES,
        ]);
    }

    public function create()
    {
        return view('vacations.form', $this->formData(null));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());
        $duration = (int) $validated['duration_days'];
        unset($validated['duration_days']);
        $validated['end_date'] = Carbon::parse($validated['start_date'])
            ->addDays($duration - 1)
            ->toDateString();

        DB::table('vacations')->insert($validated + [
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('vacations.index')->with('success', 'تم حفظ طلب الإجازة بنجاح.');
    }

    public function edit(int $vacation)
    {
        $record = DB::table('vacations')->find($vacation);
        abort_if($record === null, 404);

        return view('vacations.form', $this->formData($record));
    }

    public function update(Request $request, int $vacation)
    {
        abort_unless(DB::table('vacations')->where('id', $vacation)->exists(), 404);
        $validated = $request->validate($this->rules());
        $duration = (int) $validated['duration_days'];
        unset($validated['duration_days']);
        $validated['end_date'] = Carbon::parse($validated['start_date'])
            ->addDays($duration - 1)
            ->toDateString();

        DB::table('vacations')->where('id', $vacation)->update($validated + [
            'updated_at' => now(),
        ]);

        return redirect()->route('vacations.index')->with('success', 'تم تحديث طلب الإجازة بنجاح.');
    }

    public function destroy(int $vacation)
    {
        abort_unless(DB::table('vacations')->where('id', $vacation)->exists(), 404);
        DB::table('vacations')->where('id', $vacation)->delete();

        return redirect()->route('vacations.index')->with('success', 'تم حذف طلب الإجازة.');
    }

    public function destroyMany(Request $request)
    {
        $ids = $request->validate([
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['integer', 'distinct', Rule::exists('vacations', 'id')],
        ])['ids'];

        DB::table('vacations')->whereIn('id', $ids)->delete();

        return redirect()->route('vacations.index')->with('success', 'تم حذف طلبات الإجازة المحددة.');
    }

    private function formData(?object $vacation): array
    {
        $durationDays = $vacation === null
            ? 1
            : max(1, (int) Carbon::parse($vacation->start_date)->diffInDays(Carbon::parse($vacation->end_date)) + 1);

        return [
            'vacationRecord' => $vacation,
            'durationDays' => $durationDays,
            'employeeOptions' => DB::table('employee_models')->select('id', 'name', 'country', 'job_title')->orderBy('name')->get(),
            'leaveTypes' => self::LEAVE_TYPES,
            'statuses' => self::STATUSES,
            'durations' => self::DURATIONS,
        ];
    }

    private function rules(): array
    {
        return [
            'employee_id' => ['required', 'integer', Rule::exists('employee_models', 'id')],
            'leave_type' => ['required', 'string', Rule::in(self::LEAVE_TYPES)],
            'duration_days' => ['required', 'integer', Rule::in(array_keys(self::DURATIONS))],
            'start_date' => ['required', 'date'],
            'reason' => ['nullable', 'string', 'max:5000'],
            'status' => ['required', 'string', Rule::in(self::STATUSES)],
        ];
    }
}