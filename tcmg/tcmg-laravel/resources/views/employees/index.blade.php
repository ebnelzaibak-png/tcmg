<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>الموارد البشرية - TCMG</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root{--bg:#0f1530;--panel:#1a2148;--panel2:#222a58;--gold:#8b6a3a;--muted:#9aa3c7}
        *{box-sizing:border-box}
        body{margin:0;background:var(--bg);color:#fff;font-family:'Cairo',Tahoma,sans-serif;min-height:100vh}
        .sidebar{position:fixed;inset:0 0 0 auto;width:230px;background:var(--panel);padding:24px 14px;z-index:5}
        .logo{text-align:center;font-size:22px;font-weight:700;letter-spacing:4px;padding:10px 0 25px}
        .logo span{color:var(--gold)}
        .nav-link{display:flex;align-items:center;gap:12px;padding:11px 14px;margin-bottom:4px;border-radius:6px;color:#fff;text-decoration:none;font-size:14px}
        .nav-link.active{background:#fff;color:#10153a;font-weight:600}
        .nav-link:not(.active):hover{background:var(--panel2);color:#fff}
        .main{margin-right:230px;padding:18px 24px;min-height:100vh;min-width:0}
        .topbar{display:flex;align-items:center;gap:18px;margin-bottom:22px}
        .topbar-tools{display:flex;align-items:center;gap:16px;color:var(--muted);font-size:13px;white-space:nowrap}
        .avatar{width:26px;height:26px;border-radius:50%;background:var(--gold);display:inline-block}
        .search-help{flex:1;max-width:440px;margin:auto}
        .search-help input{width:100%;padding:9px 16px;border:0;border-radius:6px;font-family:inherit;font-size:13px}
        .card-dark{background:var(--panel);border:1px solid #0b1027;border-radius:6px;padding:16px}
        .chart-card{margin-bottom:14px}
        .card-title{font-size:18px;font-weight:700;margin:0}
        .sub{font-size:11px;color:var(--muted)}
        .chart-box{position:relative;height:155px;margin-top:8px}
        .hr-card{padding:0;overflow:hidden;margin-bottom:14px}
        .hr-title{padding:12px 16px;border-bottom:1px solid #8990aa;font-size:19px;font-weight:700}
        .table-tools{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:11px 14px}
        .action-buttons,.filters{display:flex;align-items:center;gap:7px}
        .action-buttons .btn{width:33px;height:31px;padding:4px}
        .action-buttons form{margin:0}
        .filter-input,.filter-select{background:#151c3d!important;color:#fff!important;border-color:#687294!important;font-family:inherit;font-size:12px!important}
        .filter-input::placeholder{color:var(--muted)}
        .hr-table{margin:0;color:#fff;--bs-table-bg:transparent;--bs-table-color:#fff;--bs-table-border-color:#30385f;--bs-table-hover-bg:#222a58}
        .hr-table th{color:#c3c9df;font-size:10px;font-weight:600;white-space:nowrap}
        .hr-table td{font-size:11px;vertical-align:middle;white-space:nowrap}
        .hr-table input[type=checkbox]{accent-color:#5375ff}
        .row-action{border:1px solid #9aa3c7;color:#fff;background:transparent;width:27px;height:25px;border-radius:4px}
        .row-action:hover{background:#fff;color:#10153a}
        .pager{display:flex;align-items:center;justify-content:space-between;padding:11px 15px;color:var(--muted);font-size:11px}
        .pager .pagination{margin:0}
        .pagination .page-link{background:transparent;color:#c3c9df;border-color:#30385f;font-size:10px}
        .pagination .active .page-link{background:#5375ff;border-color:#5375ff;color:#fff}
        .modal-content{background:var(--panel);color:#fff;border:1px solid #30385f}
        .modal .form-label{color:#c3c9df;font-size:12px}
        .modal .form-control,.modal .form-select{font-family:inherit;font-size:13px}
        .modal .form-control,.modal .form-select{background:#fff;color:#222}
        @media(max-width:1050px){.main{padding:16px}}
        @media(max-width:760px){.sidebar{display:none}.main{margin-right:0}}
        @media(max-width:650px){.main{padding:12px}.topbar-tools:nth-child(2){display:none}.table-tools{align-items:stretch;flex-direction:column}.filters,.filters form{width:100%}.filters form{flex-wrap:wrap}.filter-input{width:100%!important}.hr-table{min-width:850px}.table-responsive{overflow-x:auto}.pager{gap:12px;flex-wrap:wrap}}
        @media print{body{background:#fff;color:#000}.sidebar,.topbar,.chart-card,.table-tools,.no-print{display:none!important}.main{margin:0;padding:0}.hr-card{border:0;background:#fff;break-inside:avoid}.hr-table{color:#000!important;--bs-table-color:#000;--bs-table-border-color:#888}.hr-title{color:#000;border-color:#888}}
    </style>
</head>
<body>
<aside class="sidebar">
    <div class="logo">✦ <span>TCMG</span></div>
    <nav>
        <a class="nav-link" href="{{ route('dashboard') }}"><i class="fa-solid fa-house"></i> الصفحة الرئيسية</a>
        <a class="nav-link" href="{{ route('contacts.index') }}"><i class="fa-solid fa-phone"></i> الاتصال</a>
        <a class="nav-link" href="{{ route('clients.index') }}"><i class="fa-solid fa-users"></i> العملاء</a>
        <a class="nav-link" href="{{ route('cases.index') }}"><i class="fa-regular fa-file-lines"></i> القضايا</a>
        <a class="nav-link" href="{{ route('court.index') }}"><i class="fa-solid fa-scale-balanced"></i> المحكمة</a>
        <a class="nav-link" href="{{ route('tasks.index') }}"><i class="fa-solid fa-check"></i> المهام و الأعمال</a>
        <a class="nav-link active" href="{{ route('employees.index') }}"><i class="fa-solid fa-users"></i> الموارد البشرية</a>
        <a class="nav-link" href="/vacations"><i class="fa-regular fa-clock"></i> الإجازات</a>
        <a class="nav-link" href="/permissions"><i class="fa-solid fa-lock"></i> صلاحيات الدخول</a>
        <a class="nav-link" href="/consultations"><i class="fa-solid fa-gavel"></i> الاستشارات القانونية</a>
        <a class="nav-link" href="/settings"><i class="fa-solid fa-gear"></i> النظام</a>
    </nav>
</aside>

<main class="main">
    <header class="topbar">
        <div class="topbar-tools"><span class="avatar"></span> Admin ▾</div>
        <div class="topbar-tools"><span>💬</span><span>🔔</span><span>🇪🇬 ▾</span></div>
        <div class="search-help"><input type="search" placeholder="كيف يمكنني مساعدتك؟" aria-label="كيف يمكنني مساعدتك؟"></div>
    </header>

    @if(session('success'))
        <div class="alert alert-success text-end">{{ session('success') }}</div>
    @endif

    <section class="card-dark chart-card">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h1 class="card-title">متابعة الموارد البشرية</h1>
                <div class="sub">عدد سجلات الحضور خلال آخر 10 أيام</div>
            </div>
            <div class="sub">الحضور والانصراف</div>
        </div>
        <div class="chart-box"><canvas id="attendanceChart"></canvas></div>
    </section>

    <section class="card-dark hr-card">
        <div class="hr-title d-flex justify-content-between align-items-center gap-2">
            <span>تسجيل الحضور والانصراف</span>
            <div class="d-flex gap-2 no-print">
                <button class="btn btn-sm btn-outline-light" type="button" onclick="window.print()">طباعة</button>
                <button class="btn btn-sm btn-outline-light" type="button" onclick="window.print()">تحميل PDF</button>
            </div>
        </div>
        <div class="table-tools">
            <div class="action-buttons">
                <button class="btn btn-sm btn-outline-light" id="addAttendance" type="button" title="{{ $employeeOptions->isEmpty() ? 'أضف موظفًا أولًا' : 'إضافة سجل حضور' }}" aria-label="إضافة سجل حضور" @disabled($employeeOptions->isEmpty())><i class="fa-solid fa-plus"></i></button>
                <button class="btn btn-sm btn-outline-light" id="editAttendanceSelected" type="button" title="تعديل المحدد" aria-label="تعديل سجل الحضور المحدد" disabled><i class="fa-solid fa-pen"></i></button>
                <form id="attendanceBulkDeleteForm" action="{{ route('employees.attendance.bulk-destroy') }}" method="POST" onsubmit="return confirm('هل تريد حذف سجلات الحضور المحددة؟')">
                    @csrf
                    @method('DELETE')
                    <div id="selectedAttendanceInputs"></div>
                    <button class="btn btn-sm btn-outline-light" id="deleteAttendanceSelected" type="submit" title="حذف المحدد" aria-label="حذف سجلات الحضور المحددة" disabled><i class="fa-solid fa-trash"></i></button>
                </form>
            </div>
            <div class="filters">
                <form action="{{ route('employees.index') }}" method="GET" class="d-flex gap-2">
                    <select class="form-select form-select-sm filter-select" name="attendance_status" aria-label="تصفية الحضور حسب الحالة">
                        <option value="">كل الحالات</option>
                        @foreach($attendanceStatuses as $status)
                            <option value="{{ $status }}" @selected(request('attendance_status') === $status)>{{ $status }}</option>
                        @endforeach
                    </select>
                    <div class="input-group">
                        <input class="form-control form-control-sm filter-input" type="search" name="attendance_q" value="{{ request('attendance_q') }}" placeholder="بحث..." aria-label="بحث في سجل الحضور">
                        <button class="btn btn-sm btn-outline-secondary" type="submit" aria-label="بحث"><i class="fa-solid fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover hr-table text-center align-middle">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAllAttendance" aria-label="تحديد كل سجلات الحضور"></th>
                        <th>الموظف/محامي</th>
                        <th>البلد</th>
                        <th>الدور</th>
                        <th>اليوم</th>
                        <th>وقت الحضور</th>
                        <th>وقت الانصراف</th>
                        <th>الحالة</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendances as $attendance)
                        <tr>
                            <td>
                                <input class="attendance-select" type="checkbox" value="{{ $attendance->id }}"
                                    data-update-url="{{ route('employees.attendance.update', $attendance->id) }}"
                                    data-employee-id="{{ $attendance->employee_id }}"
                                    data-date="{{ $attendance->attendance_date }}"
                                    data-check-in="{{ $attendance->check_in }}"
                                    data-check-out="{{ $attendance->check_out }}"
                                    data-status="{{ $attendance->status }}" aria-label="تحديد سجل {{ $attendance->employee_name }}">
                            </td>
                            <td>{{ $attendance->employee_name }}</td>
                            <td>{{ $attendance->country ?: '-' }}</td>
                            <td>{{ $attendance->job_title ?: '-' }}</td>
                            <td>{{ \Illuminate\Support\Carbon::parse($attendance->attendance_date)->format('d/m/Y') }}</td>
                            <td>{{ $attendance->check_in ? substr($attendance->check_in, 0, 5) : 'N/A' }}</td>
                            <td>{{ $attendance->check_out ? substr($attendance->check_out, 0, 5) : 'N/A' }}</td>
                            <td><span class="badge {{ $attendance->status === 'حاضر' ? 'bg-success' : ($attendance->status === 'غائب' ? 'bg-danger' : 'bg-warning text-dark') }}">{{ $attendance->status }}</span></td>
                            <td><button class="row-action attendance-edit" type="button" data-id="{{ $attendance->id }}" data-employee-id="{{ $attendance->employee_id }}" data-date="{{ $attendance->attendance_date }}" data-check-in="{{ $attendance->check_in }}" data-check-out="{{ $attendance->check_out }}" data-status="{{ $attendance->status }}" data-update-url="{{ route('employees.attendance.update', $attendance->id) }}" aria-label="تعديل حضور {{ $attendance->employee_name }}"><i class="fa-solid fa-pen"></i></button></td>
                            <td>
                                <form action="{{ route('employees.attendance.destroy', $attendance->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف سجل الحضور؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="row-action" type="submit" aria-label="حذف حضور {{ $attendance->employee_name }}"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="10" class="py-4 text-muted">لا توجد سجلات حضور وانصراف حتى الآن.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pager">
            <span>{{ $attendances->total() }} من النتائج</span>
            {{ $attendances->links() }}
        </div>
    </section>

    <section class="card-dark hr-card">
        <div class="hr-title d-flex justify-content-between align-items-center gap-2">
            <span>قائمة الموارد البشرية</span>
            <div class="d-flex gap-2 no-print">
                <button class="btn btn-sm btn-outline-light" type="button" onclick="window.print()">طباعة</button>
                <button class="btn btn-sm btn-outline-light" type="button" onclick="window.print()">تحميل PDF</button>
            </div>
        </div>
        <div class="table-tools">
            <div class="action-buttons">
                <a class="btn btn-sm btn-outline-light" href="{{ route('employees.create') }}" title="إضافة موظف/محامي" aria-label="إضافة موظف/محامي"><i class="fa-solid fa-plus"></i></a>
                <button class="btn btn-sm btn-outline-light" id="editEmployeeSelected" type="button" title="تعديل المحدد" aria-label="تعديل الموظف المحدد" disabled><i class="fa-solid fa-pen"></i></button>
                <form id="employeeBulkDeleteForm" action="{{ route('employees.bulk-destroy') }}" method="POST" onsubmit="return confirm('هل تريد حذف الموظفين المحددين؟')">
                    @csrf
                    @method('DELETE')
                    <div id="selectedEmployeeInputs"></div>
                    <button class="btn btn-sm btn-outline-light" id="deleteEmployeeSelected" type="submit" title="حذف المحدد" aria-label="حذف الموظفين المحددين" disabled><i class="fa-solid fa-trash"></i></button>
                </form>
            </div>
            <div class="filters">
                <form action="{{ route('employees.index') }}" method="GET" class="d-flex gap-2">
                    <div class="input-group">
                        <input class="form-control form-control-sm filter-input" type="search" name="employee_q" value="{{ request('employee_q') }}" placeholder="بحث..." aria-label="بحث في الموظفين">
                        <button class="btn btn-sm btn-outline-secondary" type="submit" aria-label="بحث"><i class="fa-solid fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover hr-table text-center align-middle">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAllEmployees" aria-label="تحديد كل الموظفين"></th>
                        <th>الاسم</th>
                        <th>البلد</th>
                        <th>الدور</th>
                        <th>السن</th>
                        <th>البريد الإلكتروني</th>
                        <th>رقم التواصل</th>
                        <th>المرتب</th>
                        <th>نظام الراتب</th>
                        <th>تاريخ التعيين</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                        <tr>
                            <td><input class="employee-select" type="checkbox" value="{{ $employee->id }}" data-edit-url="{{ route('employees.edit', $employee->id) }}" aria-label="تحديد الموظف {{ $employee->name }}"></td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->country ?: '-' }}</td>
                            <td>{{ $employee->job_title ?: '-' }}</td>
                            <td>{{ $employee->age ?: '-' }}</td>
                            <td>{{ $employee->email ?: '-' }}</td>
                            <td>{{ $employee->phone }}</td>
                            <td>{{ $employee->salary === null ? '-' : number_format((float) $employee->salary, 2) }}</td>
                            <td>{{ $employee->salary_type ?: '-' }}</td>
                            <td>{{ $employee->hire_date ? \Illuminate\Support\Carbon::parse($employee->hire_date)->format('d/m/Y') : '-' }}</td>
                            <td><a class="row-action d-inline-flex align-items-center justify-content-center" href="{{ route('employees.edit', $employee->id) }}" aria-label="تعديل الموظف {{ $employee->name }}"><i class="fa-solid fa-pen"></i></a></td>
                            <td>
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف الموظف؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="row-action" type="submit" aria-label="حذف الموظف {{ $employee->name }}"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="12" class="py-4 text-muted">لا يوجد موظفون مسجلون. اضغط على (+) لإضافة موظف أو محامٍ.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pager">
            <span>{{ $employees->total() }} من النتائج</span>
            {{ $employees->links() }}
        </div>
    </section>
</main>

<div class="modal fade" id="attendanceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-end">
            <form id="attendanceForm" action="{{ route('employees.attendance.store') }}" method="POST">
                @csrf
                <input type="hidden" name="_method" id="attendanceMethod" value="POST">
                <div class="modal-header border-secondary">
                    <h2 class="modal-title fs-5" id="attendanceModalTitle">إضافة سجل حضور وانصراف</h2>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="attendanceEmployee">الموظف/المحامي</label>
                        <select class="form-select" id="attendanceEmployee" name="employee_id" required>
                            <option value="">اختر الموظف</option>
                            @foreach($employeeOptions as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }} - {{ $employee->job_title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="attendanceDate">اليوم</label>
                        <input class="form-control" type="date" id="attendanceDate" name="attendance_date" value="{{ now()->toDateString() }}" required>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label" for="attendanceCheckIn">وقت الحضور</label>
                            <input class="form-control" type="time" id="attendanceCheckIn" name="check_in">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label" for="attendanceCheckOut">وقت الانصراف</label>
                            <input class="form-control" type="time" id="attendanceCheckOut" name="check_out">
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="attendanceStatus">الحالة</label>
                        <select class="form-select" id="attendanceStatus" name="status" required>
                            @foreach($attendanceStatuses as $status)
                                <option value="{{ $status }}">{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-secondary">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">إلغاء</button>
                    <button class="btn btn-light" type="submit">حفظ</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    const employeeCharts = @json($charts);
    if (typeof Chart !== 'undefined') {
        new Chart(document.getElementById('attendanceChart'), {
            type: 'line',
            data: {
                labels: employeeCharts.labels,
                datasets: [{
                    label: 'سجلات الحضور',
                    data: employeeCharts.attendance,
                    borderColor: '#8b6a3a',
                    backgroundColor: '#8b6a3a66',
                    fill: true,
                    tension: 0.35,
                    pointRadius: 2
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { ticks: { color: '#fff', font: { size: 9 } }, grid: { color: 'rgba(255,255,255,.25)' } },
                    y: { beginAtZero: true, ticks: { color: '#fff', precision: 0, font: { size: 9 } }, grid: { color: 'rgba(255,255,255,.25)' } }
                }
            }
        });
    }

    function setupSelection(prefix, editButton, deleteButton, formId, inputsId) {
        const checkboxes = Array.from(document.querySelectorAll(`.${prefix}-select`));
        const selectAll = document.getElementById(`selectAll${prefix === 'employee' ? 'Employees' : 'Attendance'}`);
        const update = () => {
            const selected = checkboxes.filter((checkbox) => checkbox.checked);
            editButton.disabled = selected.length !== 1;
            deleteButton.disabled = selected.length === 0;
            selectAll.checked = checkboxes.length > 0 && selected.length === checkboxes.length;
            selectAll.indeterminate = selected.length > 0 && selected.length < checkboxes.length;
        };
        checkboxes.forEach((checkbox) => checkbox.addEventListener('change', update));
        selectAll.addEventListener('change', () => {
            checkboxes.forEach((checkbox) => { checkbox.checked = selectAll.checked; });
            update();
        });
        editButton.addEventListener('click', () => {
            const selected = checkboxes.find((checkbox) => checkbox.checked);
            if (selected) {
                if (prefix === 'employee') {
                    window.location.href = selected.dataset.editUrl;
                } else {
                    openAttendanceEditor(selected);
                }
            }
        });
        document.getElementById(formId).addEventListener('submit', (event) => {
            const selected = checkboxes.filter((checkbox) => checkbox.checked);
            if (selected.length === 0) {
                event.preventDefault();
                return;
            }
            const inputs = document.getElementById(inputsId);
            inputs.replaceChildren(...selected.map((checkbox) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ids[]';
                input.value = checkbox.value;
                return input;
            }));
        });
    }

    const attendanceModal = new bootstrap.Modal(document.getElementById('attendanceModal'));
    const attendanceForm = document.getElementById('attendanceForm');
    const attendanceStoreUrl = @json(route('employees.attendance.store'));
    const attendanceMethod = document.getElementById('attendanceMethod');

    function openAttendanceEditor(record) {
        attendanceForm.action = record.dataset.updateUrl || attendanceStoreUrl;
        attendanceMethod.value = record.dataset.updateUrl ? 'PUT' : 'POST';
        document.getElementById('attendanceModalTitle').textContent = record.dataset.updateUrl
            ? 'تعديل سجل الحضور والانصراف'
            : 'إضافة سجل حضور وانصراف';
        document.getElementById('attendanceEmployee').value = record.dataset.employeeId || '';
        document.getElementById('attendanceDate').value = record.dataset.date || @json(now()->toDateString());
        document.getElementById('attendanceCheckIn').value = (record.dataset.checkIn || '').slice(0, 5);
        document.getElementById('attendanceCheckOut').value = (record.dataset.checkOut || '').slice(0, 5);
        document.getElementById('attendanceStatus').value = record.dataset.status || 'حاضر';
        attendanceModal.show();
    }

    document.getElementById('addAttendance').addEventListener('click', () => {
        openAttendanceEditor({ dataset: {} });
    });
    document.querySelectorAll('.attendance-edit').forEach((button) => {
        button.addEventListener('click', () => openAttendanceEditor(button));
    });

    setupSelection(
        'attendance',
        document.getElementById('editAttendanceSelected'),
        document.getElementById('deleteAttendanceSelected'),
        'attendanceBulkDeleteForm',
        'selectedAttendanceInputs'
    );
    setupSelection(
        'employee',
        document.getElementById('editEmployeeSelected'),
        document.getElementById('deleteEmployeeSelected'),
        'employeeBulkDeleteForm',
        'selectedEmployeeInputs'
    );
</script>
</body>
</html>
