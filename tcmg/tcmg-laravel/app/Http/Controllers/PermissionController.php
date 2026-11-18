<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    private const COUNTRIES = ['مصر', 'السعودية', 'البحرين', 'قطر', 'عمان', 'الإمارات', 'الكويت'];

    private const ROLES = ['موظف', 'محامي', 'مدير', 'محاسب', 'سكرتير', 'أخرى'];

    private const MODULES = [
        'الصفحة الرئيسية',
        'الاتصال',
        'العملاء',
        'القضايا',
        'المحكمة',
        'المهام و الأعمال',
        'الموارد البشرية',
        'الإجازات',
        'صلاحيات الدخول',
        'الاستشارات القانونية',
        'النظام',
    ];

    private const MODULE_ICONS = [
        'الصفحة الرئيسية' => 'fa-house',
        'الاتصال' => 'fa-phone',
        'العملاء' => 'fa-users',
        'القضايا' => 'fa-file-lines',
        'المحكمة' => 'fa-scale-balanced',
        'المهام و الأعمال' => 'fa-check',
        'الموارد البشرية' => 'fa-user-group',
        'الإجازات' => 'fa-clock',
        'صلاحيات الدخول' => 'fa-lock',
        'الاستشارات القانونية' => 'fa-gavel',
        'النظام' => 'fa-gear',
    ];

    public function index(Request $request)
    {
        $employees = DB::table('employee_models')
            ->whereIn('employee_models.id', DB::table('permissions')->select('employee_id')->distinct())
            ->when($request->filled('q'), function ($query) use ($request): void {
                $search = $request->string('q')->trim()->toString();
                $query->where(function ($query) use ($search): void {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('country', 'like', "%{$search}%")
                        ->orWhere('job_title', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('employee_models.id')
            ->paginate(8)
            ->withQueryString();

        $enabledModules = DB::table('permissions')
            ->whereIn('employee_id', $employees->pluck('id'))
            ->where('can_view', true)
            ->orderBy('module_name')
            ->get(['employee_id', 'module_name'])
            ->groupBy('employee_id')
            ->map(fn ($rows) => $rows->pluck('module_name')->all());

        return view('permissions.index', [
            'employees' => $employees,
            'enabledModules' => $enabledModules,
        ]);
    }

    public function create()
    {
        return view('permissions.form', $this->formData(null));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());
        $now = now();

        $employeeId = DB::transaction(function () use ($validated, $now): int {
            $employeeId = DB::table('employee_models')->insertGetId([
                'name' => $validated['name'],
                'age' => $validated['age'] ?? null,
                'email' => $validated['email'] ?? null,
                'phone' => $validated['phone'],
                'job_title' => $validated['job_title'],
                'country' => $validated['country'],
                'hire_date' => $validated['hire_date'],
                'salary' => null,
                'salary_type' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $this->syncPermissions($employeeId, $validated['modules'] ?? [], $now);

            return $employeeId;
        });

        return redirect()->route('permissions.index')->with('success', 'تم إضافة الموظف وصلاحياته بنجاح.');
    }

    public function edit(int $employee)
    {
        $record = DB::table('employee_models')->find($employee);
        abort_if($record === null, 404);
        abort_unless(DB::table('permissions')->where('employee_id', $employee)->exists(), 404);

        return view('permissions.form', $this->formData($record));
    }

    public function update(Request $request, int $employee)
    {
        abort_unless(DB::table('employee_models')->where('id', $employee)->exists(), 404);
        $validated = $request->validate($this->rules());
        $now = now();

        DB::transaction(function () use ($validated, $employee, $now): void {
            DB::table('employee_models')->where('id', $employee)->update([
                'name' => $validated['name'],
                'age' => $validated['age'] ?? null,
                'email' => $validated['email'] ?? null,
                'phone' => $validated['phone'],
                'job_title' => $validated['job_title'],
                'country' => $validated['country'],
                'hire_date' => $validated['hire_date'],
                'updated_at' => $now,
            ]);

            $this->syncPermissions($employee, $validated['modules'] ?? [], $now);
        });

        return redirect()->route('permissions.index')->with('success', 'تم تحديث بيانات الموظف وصلاحياته.');
    }

    public function destroy(int $employee)
    {
        abort_unless(DB::table('permissions')->where('employee_id', $employee)->exists(), 404);
        DB::table('permissions')->where('employee_id', $employee)->delete();

        return redirect()->route('permissions.index')->with('success', 'تم إلغاء الصلاحيات مع الاحتفاظ بملف الموظف.');
    }

    public function destroyMany(Request $request)
    {
        $ids = $request->validate([
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['integer', 'distinct', Rule::exists('permissions', 'employee_id')],
        ])['ids'];

        DB::table('permissions')->whereIn('employee_id', $ids)->delete();

        return redirect()->route('permissions.index')->with('success', 'تم إلغاء صلاحيات الموظفين المحددين.');
    }

    private function formData(?object $employee): array
    {
        $enabledModules = $employee === null
            ? []
            : DB::table('permissions')
                ->where('employee_id', $employee->id)
                ->where('can_view', true)
                ->pluck('module_name')
                ->all();

        return [
            'employeeRecord' => $employee,
            'countries' => self::COUNTRIES,
            'roles' => self::ROLES,
            'modules' => self::MODULES,
            'moduleIcons' => self::MODULE_ICONS,
            'enabledModules' => $enabledModules,
        ];
    }

    private function syncPermissions(int $employeeId, array $enabledModules, $now): void
    {
        DB::table('permissions')->where('employee_id', $employeeId)->delete();
        $enabledModules = array_fill_keys($enabledModules, true);
        $rows = [];

        foreach (self::MODULES as $module) {
            $enabled = isset($enabledModules[$module]);
            $rows[] = [
                'employee_id' => $employeeId,
                'module_name' => $module,
                'can_view' => $enabled,
                'can_add' => $enabled,
                'can_edit' => $enabled,
                'can_delete' => $enabled,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('permissions')->insert($rows);
    }

    private function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'age' => ['nullable', 'integer', 'min:15', 'max:100'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'job_title' => ['required', 'string', Rule::in(self::ROLES)],
            'country' => ['required', 'string', Rule::in(self::COUNTRIES)],
            'hire_date' => ['required', 'date'],
            'modules' => ['nullable', 'array'],
            'modules.*' => ['string', 'distinct', Rule::in(self::MODULES)],
        ];
    }
}
