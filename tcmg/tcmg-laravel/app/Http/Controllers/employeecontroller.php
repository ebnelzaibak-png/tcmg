<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class employeecontroller extends Controller
{
    private const COUNTRIES = ['مصر', 'السعودية', 'البحرين', 'قطر', 'عمان', 'الإمارات', 'الكويت'];

    private const ROLES = ['موظف', 'محامي', 'مدير', 'محاسب', 'سكرتير', 'أخرى'];

    private const SALARY_TYPES = ['شهريًا', 'سنويًا', 'سعر لكل قضية'];

    private const ATTENDANCE_STATUSES = ['حاضر', 'غائب', 'متأخر', 'إجازة'];

    public function index(Request $request)
    {
        $employeeOptions = DB::table('employee_models')
            ->select('id', 'name', 'job_title')
            ->orderBy('name')
            ->get();

        $employees = DB::table('employee_models')
            ->when($request->filled('employee_q'), function ($query) use ($request): void {
                $search = $request->string('employee_q')->trim()->toString();
                $query->where(function ($query) use ($search): void {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('job_title', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('country', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('id')
            ->paginate(8, ['*'], 'employees_page')
            ->withQueryString();

        $attendances = DB::table('employee_attendances')
            ->join('employee_models', 'employee_attendances.employee_id', '=', 'employee_models.id')
            ->when($request->filled('attendance_q'), function ($query) use ($request): void {
                $search = $request->string('attendance_q')->trim()->toString();
                $query->where(function ($query) use ($search): void {
                    $query->where('employee_models.name', 'like', "%{$search}%")
                        ->orWhere('employee_models.job_title', 'like', "%{$search}%")
                        ->orWhere('employee_models.country', 'like', "%{$search}%")
                        ->orWhere('employee_attendances.status', 'like', "%{$search}%");
                });
            })
            ->when(
                in_array($request->input('attendance_status'), self::ATTENDANCE_STATUSES, true),
                fn ($query) => $query->where('employee_attendances.status', $request->input('attendance_status'))
            )
            ->select(
                'employee_attendances.*',
                'employee_models.name as employee_name',
                'employee_models.job_title',
                'employee_models.country'
            )
            ->orderByDesc('employee_attendances.attendance_date')
            ->orderByDesc('employee_attendances.id')
            ->paginate(8, ['*'], 'attendance_page')
            ->withQueryString();

        $to = now()->toDateString();
        $from = now()->subDays(9)->toDateString();
        $days = collect(range(0, 9))->map(
            fn (int $offset) => now()->subDays(9 - $offset)->toDateString()
        );
        $dailyAttendance = DB::table('employee_attendances')
            ->selectRaw('attendance_date as day, COUNT(*) as total')
            ->whereBetween('attendance_date', [$from, $to])
            ->groupBy('attendance_date')
            ->pluck('total', 'day');

        $charts = [
            'labels' => $days->map(fn (string $day) => date('j/n', strtotime($day)))->all(),
            'attendance' => $days->map(fn (string $day) => (int) ($dailyAttendance[$day] ?? 0))->all(),
        ];

        return view('employees.index', [
            'employees' => $employees,
            'employeeOptions' => $employeeOptions,
            'attendances' => $attendances,
            'charts' => $charts,
            'countries' => self::COUNTRIES,
            'roles' => self::ROLES,
            'salaryTypes' => self::SALARY_TYPES,
            'attendanceStatuses' => self::ATTENDANCE_STATUSES,
        ]);
    }

    public function create()
    {
        return view('employees.form', $this->formData(null));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->employeeRules());

        DB::table('employee_models')->insert($validated + [
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('employees.index')->with('success', 'تم حفظ الموظف بنجاح.');
    }

    public function edit(int $employee)
    {
        $record = DB::table('employee_models')->find($employee);
        abort_if($record === null, 404);

        return view('employees.form', $this->formData($record));
    }

    public function update(Request $request, int $employee)
    {
        abort_unless(DB::table('employee_models')->where('id', $employee)->exists(), 404);
        $validated = $request->validate($this->employeeRules());

        DB::table('employee_models')->where('id', $employee)->update($validated + [
            'updated_at' => now(),
        ]);

        return redirect()->route('employees.index')->with('success', 'تم تحديث بيانات الموظف بنجاح.');
    }

    public function destroy(int $employee)
    {
        abort_unless(DB::table('employee_models')->where('id', $employee)->exists(), 404);

        DB::transaction(function () use ($employee): void {
            if (Schema::hasTable('permissions')) {
                DB::table('permissions')->where('employee_id', $employee)->delete();
            }

            DB::table('employee_models')->where('id', $employee)->delete();
        });

        return redirect()->route('employees.index')->with('success', 'تم حذف الموظف.');
    }

    public function destroyMany(Request $request)
    {
        $ids = $request->validate([
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['integer', 'distinct', Rule::exists('employee_models', 'id')],
        ])['ids'];

        DB::transaction(function () use ($ids): void {
            if (Schema::hasTable('permissions')) {
                DB::table('permissions')->whereIn('employee_id', $ids)->delete();
            }

            DB::table('employee_models')->whereIn('id', $ids)->delete();
        });

        return redirect()->route('employees.index')->with('success', 'تم حذف الموظفين المحددين.');
    }

    public function storeAttendance(Request $request)
    {
        $validated = $request->validate($this->attendanceRules());

        DB::table('employee_attendances')->insert($validated + [
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('employees.index')->with('success', 'تم تسجيل الحضور والانصراف.');
    }

    public function updateAttendance(Request $request, int $attendance)
    {
        abort_unless(DB::table('employee_attendances')->where('id', $attendance)->exists(), 404);
        $validated = $request->validate($this->attendanceRules());

        DB::table('employee_attendances')->where('id', $attendance)->update($validated + [
            'updated_at' => now(),
        ]);

        return redirect()->route('employees.index')->with('success', 'تم تحديث سجل الحضور والانصراف.');
    }

    public function destroyAttendance(int $attendance)
    {
        abort_unless(DB::table('employee_attendances')->where('id', $attendance)->exists(), 404);
        DB::table('employee_attendances')->where('id', $attendance)->delete();

        return redirect()->route('employees.index')->with('success', 'تم حذف سجل الحضور والانصراف.');
    }

    public function destroyAttendances(Request $request)
    {
        $ids = $request->validate([
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['integer', 'distinct', Rule::exists('employee_attendances', 'id')],
        ])['ids'];

        DB::table('employee_attendances')->whereIn('id', $ids)->delete();

        return redirect()->route('employees.index')->with('success', 'تم حذف سجلات الحضور المحددة.');
    }

    private function formData(?object $employee): array
    {
        return [
            'employeeRecord' => $employee,
            'countries' => self::COUNTRIES,
            'roles' => self::ROLES,
            'salaryTypes' => self::SALARY_TYPES,
        ];
    }

    private function employeeRules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'age' => ['nullable', 'integer', 'min:15', 'max:100'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'job_title' => ['required', 'string', Rule::in(self::ROLES)],
            'country' => ['required', 'string', Rule::in(self::COUNTRIES)],
            'hire_date' => ['required', 'date'],
            'salary' => ['nullable', 'numeric', 'min:0'],
            'salary_type' => ['required', 'string', Rule::in(self::SALARY_TYPES)],
        ];
    }

    private function attendanceRules(): array
    {
        return [
            'employee_id' => ['required', 'integer', Rule::exists('employee_models', 'id')],
            'attendance_date' => ['required', 'date'],
            'check_in' => ['nullable', 'date_format:H:i'],
            'check_out' => ['nullable', 'date_format:H:i'],
            'status' => ['required', 'string', Rule::in(self::ATTENDANCE_STATUSES)],
        ];
    }
}