<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>صلاحيات الدخول - TCMG</title>
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
        .topbar{display:flex;align-items:center;gap:18px;margin-bottom:24px}
        .topbar-tools{display:flex;align-items:center;gap:16px;color:var(--muted);font-size:13px;white-space:nowrap}
        .avatar{width:26px;height:26px;border-radius:50%;background:var(--gold);display:inline-block}
        .search-help{flex:1;max-width:440px;margin:auto}
        .search-help input{width:100%;padding:9px 16px;border:0;border-radius:6px;font-family:inherit;font-size:13px}
        .permissions-card{background:var(--panel);border:1px solid #0b1027;overflow:hidden}
        .page-title{padding:18px 20px;border-bottom:1px solid #8990aa;font-size:23px;font-weight:700}
        .table-tools{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:14px 18px}
        .action-buttons,.filters{display:flex;align-items:center;gap:8px}
        .action-buttons .btn{width:34px;height:32px;padding:4px}
        .action-buttons form{margin:0}
        .filters form{display:flex;gap:8px;width:100%;max-width:420px}
        .filter-input{background:#151c3d!important;color:#fff!important;border-color:#687294!important;font-family:inherit;font-size:11px!important}
        .filter-input::placeholder{color:var(--muted)}
        .permissions-table{margin:0;color:#fff;--bs-table-bg:transparent;--bs-table-color:#fff;--bs-table-border-color:#30385f;--bs-table-hover-bg:#222a58}
        .permissions-table th{color:#c3c9df;font-size:10px;font-weight:600;white-space:nowrap}
        .permissions-table td{font-size:11px;vertical-align:middle;white-space:nowrap}
        .permissions-table input[type=checkbox]{accent-color:#5375ff}
        .module-badges{max-width:260px;white-space:normal!important}
        .module-badges .badge{margin:2px;font-size:9px;font-weight:400}
        .row-action{border:1px solid #9aa3c7;color:#fff;background:transparent;width:29px;height:27px;border-radius:4px}
        .row-action:hover{background:#fff;color:#10153a}
        .pager{display:flex;align-items:center;justify-content:space-between;padding:14px 18px;color:var(--muted);font-size:11px}
        .pager .pagination{margin:0}
        .pagination .page-link{background:transparent;color:#c3c9df;border-color:#30385f;font-size:11px}
        .pagination .active .page-link{background:#5375ff;border-color:#5375ff;color:#fff}
        @media(max-width:760px){.sidebar{display:none}.main{margin-right:0}}
        @media(max-width:650px){.main{padding:12px}.topbar-tools:nth-child(2){display:none}.table-tools{align-items:stretch;flex-direction:column}.filters,.filters form{width:100%}.filters form{flex-wrap:wrap}.permissions-table{min-width:850px}.table-responsive{overflow-x:auto}.pager{gap:12px;flex-wrap:wrap}}
        @media print{body{background:#fff;color:#000}.sidebar,.topbar,.table-tools,.no-print{display:none!important}.main{margin:0;padding:0}.permissions-card{border:0;background:#fff}.permissions-table{color:#000!important;--bs-table-color:#000;--bs-table-border-color:#888}.page-title{color:#000;border-color:#888}}
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
        <a class="nav-link" href="{{ route('employees.index') }}"><i class="fa-solid fa-users"></i> الموارد البشرية</a>
        <a class="nav-link" href="{{ route('vacations.index') }}"><i class="fa-regular fa-clock"></i> الإجازات</a>
        <a class="nav-link active" href="{{ route('permissions.index') }}"><i class="fa-solid fa-lock"></i> صلاحيات الدخول</a>
        <a class="nav-link" href="{{ route('consultations.index') }}"><i class="fa-solid fa-gavel"></i> الاستشارات القانونية</a>
        <a class="nav-link" href="{{ route('settings.index') }}"><i class="fa-solid fa-gear"></i> النظام</a>
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
    @if($errors->any())
        <div class="alert alert-danger text-end">
            <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <section class="permissions-card">
        <h1 class="page-title">صلاحيات الدخول</h1>
        <div class="table-tools no-print">
            <div class="action-buttons">
                <a class="btn btn-sm btn-outline-light" href="{{ route('permissions.create') }}" title="إضافة موظف وصلاحيات" aria-label="إضافة موظف وصلاحيات"><i class="fa-solid fa-plus"></i></a>
                <button class="btn btn-sm btn-outline-light" id="editSelected" type="button" title="تعديل المحدد" aria-label="تعديل الموظف المحدد" disabled><i class="fa-solid fa-pen"></i></button>
                <form id="bulkDeleteForm" action="{{ route('permissions.bulk-destroy') }}" method="POST" onsubmit="return confirm('سيتم إلغاء صلاحيات الدخول مع الاحتفاظ بملفات الموظفين. هل تريد المتابعة؟')">
                    @csrf
                    @method('DELETE')
                    <div id="selectedEmployeeInputs"></div>
                    <button class="btn btn-sm btn-outline-light" id="deleteSelected" type="submit" title="إلغاء الصلاحيات المحددة" aria-label="إلغاء الصلاحيات المحددة" disabled><i class="fa-solid fa-trash"></i></button>
                </form>
            </div>
            <div class="filters">
                <form action="{{ route('permissions.index') }}" method="GET">
                    <div class="input-group">
                        <input class="form-control form-control-sm filter-input" type="search" name="q" value="{{ request('q') }}" placeholder="بحث..." aria-label="بحث">
                        <button class="btn btn-sm btn-outline-secondary" type="submit" aria-label="بحث"><i class="fa-solid fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover permissions-table text-center align-middle">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll" aria-label="تحديد الكل"></th>
                        <th>المحامي/الموظف</th>
                        <th>البلد</th>
                        <th>الدور</th>
                        <th>الحالة</th>
                        <th>الصلاحيات</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                        @php($granted = $enabledModules->get($employee->id, []))
                        <tr>
                            <td><input class="employee-select" type="checkbox" value="{{ $employee->id }}" data-edit-url="{{ route('permissions.edit', $employee->id) }}" aria-label="تحديد {{ $employee->name }}"></td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->country ?: '-' }}</td>
                            <td>{{ $employee->job_title ?: '-' }}</td>
                            <td><span class="badge {{ count($granted) > 0 ? 'bg-success' : 'bg-secondary' }}">{{ count($granted) > 0 ? 'نشط' : 'غير نشط' }}</span></td>
                            <td class="module-badges">
                                @forelse($granted as $module)
                                    <span class="badge bg-secondary">{{ $module }}</span>
                                @empty
                                    <span class="text-muted">لا توجد صلاحيات</span>
                                @endforelse
                            </td>
                            <td><a class="row-action d-inline-flex align-items-center justify-content-center" href="{{ route('permissions.edit', $employee->id) }}" aria-label="تعديل {{ $employee->name }}"><i class="fa-solid fa-pen"></i></a></td>
                            <td>
                                <form action="{{ route('permissions.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('سيتم إلغاء صلاحيات الدخول مع الاحتفاظ بملف الموظف. هل تريد المتابعة؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="row-action" type="submit" aria-label="إلغاء صلاحيات {{ $employee->name }}"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="py-5 text-muted">لا توجد صلاحيات مسجلة. اضغط على (+) لإضافة موظف وصلاحياته.</td></tr>
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

<script>
    const employeeCheckboxes = Array.from(document.querySelectorAll('.employee-select'));
    const selectAll = document.getElementById('selectAll');
    const editSelected = document.getElementById('editSelected');
    const deleteSelected = document.getElementById('deleteSelected');

    function updateSelection() {
        const selected = employeeCheckboxes.filter((checkbox) => checkbox.checked);
        editSelected.disabled = selected.length !== 1;
        deleteSelected.disabled = selected.length === 0;
        selectAll.checked = employeeCheckboxes.length > 0 && selected.length === employeeCheckboxes.length;
        selectAll.indeterminate = selected.length > 0 && selected.length < employeeCheckboxes.length;
    }

    employeeCheckboxes.forEach((checkbox) => checkbox.addEventListener('change', updateSelection));
    selectAll.addEventListener('change', () => {
        employeeCheckboxes.forEach((checkbox) => { checkbox.checked = selectAll.checked; });
        updateSelection();
    });
    editSelected.addEventListener('click', () => {
        const selected = employeeCheckboxes.find((checkbox) => checkbox.checked);
        if (selected) window.location.href = selected.dataset.editUrl;
    });
    document.getElementById('bulkDeleteForm').addEventListener('submit', (event) => {
        const selected = employeeCheckboxes.filter((checkbox) => checkbox.checked);
        if (selected.length === 0) {
            event.preventDefault();
            return;
        }

        document.getElementById('selectedEmployeeInputs').replaceChildren(...selected.map((checkbox) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'ids[]';
            input.value = checkbox.value;
            return input;
        }));
    });
</script>
</body>
</html>
