<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\clintcontroller;
use App\Http\Controllers\casecontroller;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\Taskcontroller;
use App\Http\Controllers\employeecontroller;
use App\Http\Controllers\VacationController;
use App\Http\Controllers\SystemSettingController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

Route::get('/clients', [clintcontroller::class, 'index'])->name('clients.index');
Route::get('/clients/create', [clintcontroller::class, 'create'])->name('clients.create');
Route::post('/clients', [clintcontroller::class, 'store'])->name('clients.store');
Route::delete('/clients', [clintcontroller::class, 'destroyMany'])->name('clients.bulk-destroy');
Route::put('/clients/{client}', [clintcontroller::class, 'update'])->name('clients.update');
Route::delete('/clients/{client}', [clintcontroller::class, 'destroy'])->name('clients.delete');

Route::get('/cases', [casecontroller::class, 'index'])->name('cases.index');
Route::get('/cases/create', [casecontroller::class, 'create'])->name('cases.create');
Route::post('/cases', [casecontroller::class, 'store'])->name('cases.store');
Route::delete('/cases', [casecontroller::class, 'destroyMany'])->name('cases.bulk-destroy');
Route::get('/cases/{case}/edit', [casecontroller::class, 'edit'])->name('cases.edit');
Route::put('/cases/{case}', [casecontroller::class, 'update'])->name('cases.update');
Route::delete('/cases/{case}', [casecontroller::class, 'destroy'])->name('cases.destroy');

Route::get('/court', [CourtController::class, 'index'])->name('court.index');
Route::get('/court/create', [CourtController::class, 'create'])->name('court.create');
Route::post('/court', [CourtController::class, 'store'])->name('court.store');
Route::delete('/court', [CourtController::class, 'destroyMany'])->name('court.bulk-destroy');
Route::get('/court/{court}/edit', [CourtController::class, 'edit'])->name('court.edit');
Route::put('/court/{court}', [CourtController::class, 'update'])->name('court.update');
Route::delete('/court/{court}', [CourtController::class, 'destroy'])->name('court.delete');

Route::get('/tasks', [Taskcontroller::class, 'index'])->name('tasks.index');
Route::get('/tasks/create', [Taskcontroller::class, 'create'])->name('tasks.create');
Route::post('/tasks', [Taskcontroller::class, 'store'])->name('tasks.store');
Route::delete('/tasks', [Taskcontroller::class, 'destroyMany'])->name('tasks.bulk-destroy');
Route::get('/tasks/{task}/edit', [Taskcontroller::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}', [Taskcontroller::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [Taskcontroller::class, 'destroy'])->name('tasks.destroy');

Route::get('/employees', [employeecontroller::class, 'index'])->name('employees.index');
Route::get('/employees/create', [employeecontroller::class, 'create'])->name('employees.create');
Route::post('/employees', [employeecontroller::class, 'store'])->name('employees.store');
Route::delete('/employees', [employeecontroller::class, 'destroyMany'])->name('employees.bulk-destroy');
Route::get('/employees/{employee}/edit', [employeecontroller::class, 'edit'])->name('employees.edit');
Route::put('/employees/{employee}', [employeecontroller::class, 'update'])->name('employees.update');
Route::delete('/employees/{employee}', [employeecontroller::class, 'destroy'])->name('employees.destroy');
Route::post('/employee-attendances', [employeecontroller::class, 'storeAttendance'])->name('employees.attendance.store');
Route::put('/employee-attendances/{attendance}', [employeecontroller::class, 'updateAttendance'])->name('employees.attendance.update');
Route::delete('/employee-attendances', [employeecontroller::class, 'destroyAttendances'])->name('employees.attendance.bulk-destroy');
Route::delete('/employee-attendances/{attendance}', [employeecontroller::class, 'destroyAttendance'])->name('employees.attendance.destroy');

Route::get('/vacations', [VacationController::class, 'index'])->name('vacations.index');
Route::get('/vacations/create', [VacationController::class, 'create'])->name('vacations.create');
Route::post('/vacations', [VacationController::class, 'store'])->name('vacations.store');
Route::delete('/vacations', [VacationController::class, 'destroyMany'])->name('vacations.bulk-destroy');
Route::get('/vacations/{vacation}/edit', [VacationController::class, 'edit'])->name('vacations.edit');
Route::put('/vacations/{vacation}', [VacationController::class, 'update'])->name('vacations.update');
Route::delete('/vacations/{vacation}', [VacationController::class, 'destroy'])->name('vacations.destroy');

Route::get('/settings', [SystemSettingController::class, 'index'])->name('settings.index');
Route::put('/settings', [SystemSettingController::class, 'update'])->name('settings.update');

Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
Route::delete('/permissions', [PermissionController::class, 'destroyMany'])->name('permissions.bulk-destroy');
Route::get('/permissions/{employee}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
Route::put('/permissions/{employee}', [PermissionController::class, 'update'])->name('permissions.update');
Route::delete('/permissions/{employee}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

Route::get('/consultations', [ConsultationController::class, 'index'])->name('consultations.index');
Route::get('/consultations/create', [ConsultationController::class, 'create'])->name('consultations.create');
Route::post('/consultations', [ConsultationController::class, 'store'])->name('consultations.store');
Route::delete('/consultations', [ConsultationController::class, 'destroyMany'])->name('consultations.bulk-destroy');
Route::get('/consultations/{consultation}/edit', [ConsultationController::class, 'edit'])->name('consultations.edit');
Route::put('/consultations/{consultation}', [ConsultationController::class, 'update'])->name('consultations.update');
Route::delete('/consultations/{consultation}', [ConsultationController::class, 'destroy'])->name('consultations.destroy');

Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
Route::put('/contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');
Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
Route::post('/promotion-contacts', [ContactController::class, 'storePromotion'])->name('promotions.store');
Route::put('/promotion-contacts/{promotionContact}', [ContactController::class, 'updatePromotion'])->name('promotions.update');
Route::delete('/promotion-contacts/{promotionContact}', [ContactController::class, 'destroyPromotion'])->name('promotions.destroy');
Route::delete('/promotion-contacts', [ContactController::class, 'destroyPromotions'])->name('promotions.bulk-destroy');
Route::post('/meetings', [ContactController::class, 'storeMeeting'])->name('meetings.store');
Route::put('/meetings/{meeting}', [ContactController::class, 'updateMeeting'])->name('meetings.update');
Route::delete('/meetings/{meeting}', [ContactController::class, 'destroyMeeting'])->name('meetings.destroy');
Route::delete('/meetings', [ContactController::class, 'destroyMeetings'])->name('meetings.bulk-destroy');

Route::get('/dashboard', function () {
    $countRows = static fn (string $table): int => Schema::hasTable($table)
        ? DB::table($table)->count()
        : 0;

    $to = now()->startOfDay()->locale('ar');
    $from = $to->copy()->subDays(6);
    $days = collect(range(0, 6))->map(
        fn (int $offset) => $from->copy()->addDays($offset)
    );
    $labels = $days->map(fn ($day) => $day->locale('ar')->translatedFormat('D j/n'));

    $countsByDate = static function (
        string $table,
        string $column,
        ?string $filterColumn = null,
        ?string $filterValue = null
    ) use ($from, $to): array {
        if (! Schema::hasTable($table) || ! Schema::hasColumn($table, $column)) {
            return [];
        }

        $query = DB::table($table)
            ->selectRaw("DATE({$column}) as day, COUNT(*) as total")
            ->whereBetween($column, [$from->copy()->startOfDay(), $to->copy()->endOfDay()]);

        if ($filterColumn !== null && Schema::hasColumn($table, $filterColumn)) {
            $query->where($filterColumn, $filterValue);
        }

        return $query
            ->groupBy('day')
            ->pluck('total', 'day')
            ->all();
    };

    $dailySeries = static function (array $counts) use ($days): array {
        return $days->map(
            fn ($day) => (int) ($counts[$day->toDateString()] ?? 0)
        )->all();
    };

    $caseTypes = Schema::hasTable('casemodels')
        ? DB::table('casemodels')
            ->selectRaw("COALESCE(NULLIF(case_type, ''), 'غير محدد') as label, COUNT(*) as total")
            ->groupBy('case_type')
            ->orderBy('label')
            ->get()
        : collect();

    $consultationStatuses = Schema::hasTable('consultations')
        ? DB::table('consultations')->distinct()->orderBy('status')->pluck('status')
        : collect();
    $consultationColors = ['#8b6a3a', '#fff', '#4a7fb5', '#8a1f3d', '#6fd39a', '#9aa3c7'];

    $stats = [
        ['title' => 'القضايا', 'value' => $countRows('casemodels'), 'icon' => 'file', 'class' => 'up', 'note' => 'إجمالي القضايا', 'link' => 'عرض التفاصيل'],
        ['title' => 'العملاء', 'value' => $countRows('clints'), 'icon' => 'users', 'class' => 'up', 'note' => 'إجمالي العملاء', 'link' => 'عرض التفاصيل'],
        ['title' => 'جهات الاتصال', 'value' => $countRows('contact_models'), 'icon' => 'pin', 'class' => 'up', 'note' => 'إجمالي الجهات', 'link' => 'عرض التفاصيل'],
        ['title' => 'الموظفون', 'value' => $countRows('employee_models'), 'icon' => 'user', 'class' => 'up', 'note' => 'إجمالي الموظفين', 'link' => 'عرض التفاصيل'],
        ['title' => 'المهام', 'value' => $countRows('task_models'), 'icon' => 'check', 'class' => 'up', 'note' => 'إجمالي المهام', 'link' => 'عرض التفاصيل'],
        ['title' => 'الاستشارات', 'value' => $countRows('consultations'), 'icon' => 'gavel', 'class' => 'up', 'note' => 'إجمالي الاستشارات', 'link' => 'عرض التفاصيل'],
    ];

    $charts = [
        'labels' => $labels->all(),
        'cases' => [
            'registered' => $dailySeries($countsByDate('casemodels', 'created_at')),
            'sessions' => $dailySeries($countsByDate('casemodels', 'session_date')),
        ],
        'categories' => [
            'labels' => $caseTypes->isEmpty() ? ['لا توجد بيانات'] : $caseTypes->pluck('label')->all(),
            'values' => $caseTypes->isEmpty() ? [0] : $caseTypes->pluck('total')->map(fn ($total) => (int) $total)->all(),
        ],
        'clients' => [
            'registered' => $dailySeries($countsByDate('clints', 'created_at')),
        ],
        'consultations' => [
            'statuses' => $consultationStatuses->isEmpty()
                ? [[
                    'label' => 'لا توجد بيانات',
                    'values' => array_fill(0, 7, 0),
                    'color' => $consultationColors[0],
                ]]
                : $consultationStatuses->values()->map(function ($status, $index) use ($countsByDate, $dailySeries, $consultationColors) {
                    return [
                        'label' => $status ?: 'غير محدد',
                        'values' => $dailySeries($countsByDate('consultations', 'created_at', 'status', $status)),
                        'color' => $consultationColors[$index % count($consultationColors)],
                    ];
                })->all(),
        ],
    ];

    return view('dashboard', compact('from', 'to', 'stats', 'charts'));
})->name('dashboard');