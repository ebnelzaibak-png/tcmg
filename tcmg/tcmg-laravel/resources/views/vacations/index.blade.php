<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>الإجازات - TCMG</title>
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
        .leave-card{background:var(--panel);border:1px solid #0b1027;border-radius:6px;padding:0;overflow:hidden}
        .leave-title{padding:18px 20px;border-bottom:1px solid #8990aa;font-size:22px;font-weight:700}
        .table-tools{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:14px 18px}
        .action-buttons,.filters{display:flex;align-items:center;gap:8px}
        .action-buttons .btn{width:34px;height:32px;padding:4px}
        .action-buttons form{margin:0}
        .filter-input,.filter-select{background:#151c3d!important;color:#fff!important;border-color:#687294!important;font-family:inherit;font-size:12px!important}
        .filter-input::placeholder{color:var(--muted)}
        .leave-table{margin:0;color:#fff;--bs-table-bg:transparent;--bs-table-color:#fff;--bs-table-border-color:#30385f;--bs-table-hover-bg:#222a58}
        .leave-table th{color:#c3c9df;font-size:11px;font-weight:600;white-space:nowrap}
        .leave-table td{font-size:11px;vertical-align:middle;white-space:nowrap}
        .leave-table td.reason-cell{max-width:180px;white-space:normal}
        .leave-table input[type=checkbox]{accent-color:#5375ff}
        .row-action{border:1px solid #9aa3c7;color:#fff;background:transparent;width:29px;height:27px;border-radius:4px}
        .row-action:hover{background:#fff;color:#10153a}
        .pager{display:flex;align-items:center;justify-content:space-between;padding:14px 18px;color:var(--muted);font-size:11px}
        .pager .pagination{margin:0}
        .pagination .page-link{background:transparent;color:#c3c9df;border-color:#30385f;font-size:11px}
        .pagination .active .page-link{background:#5375ff;border-color:#5375ff;color:#fff}
        .request-link{display:flex;justify-content:flex-start;margin-top:24px}
        @media(max-width:760px){.sidebar{display:none}.main{margin-right:0}}
        @media(max-width:650px){.main{padding:12px}.topbar-tools:nth-child(2){display:none}.table-tools{align-items:stretch;flex-direction:column}.filters,.filters form{width:100%}.filters form{flex-wrap:wrap}.filter-input{width:100%!important}.leave-table{min-width:950px}.table-responsive{overflow-x:auto}.pager{gap:12px;flex-wrap:wrap}}
        @media print{body{background:#fff;color:#000}.sidebar,.topbar,.table-tools,.no-print,.request-link{display:none!important}.main{margin:0;padding:0}.leave-card{border:0;background:#fff}.leave-table{color:#000!important;--bs-table-color:#000;--bs-table-border-color:#888}.leave-title{color:#000;border-color:#888}}
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
        <a class="nav-link active" href="{{ route('vacations.index') }}"><i class="fa-regular fa-clock"></i> الإجازات</a>
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

    <section class="leave-card">
        <div class="leave-title">إدارة الإجازات</div>
        <div class="table-tools">
            <div class="action-buttons">
                <a class="btn btn-sm btn-outline-light" href="{{ route('vacations.create') }}" title="إضافة إجازة" aria-label="إضافة إجازة"><i class="fa-solid fa-plus"></i></a>
                <button class="btn btn-sm btn-outline-light" id="editSelected" type="button" title="تعديل المحدد" aria-label="تعديل الإجازة المحددة" disabled><i class="fa-solid fa-pen"></i></button>
                <form id="bulkDeleteForm" action="{{ route('vacations.bulk-destroy') }}" method="POST" onsubmit="return confirm('هل تريد حذف طلبات الإجازة المحددة؟')">
                    @csrf
                    @method('DELETE')
                    <div id="selectedVacationInputs"></div>
                    <button class="btn btn-sm btn-outline-light" id="deleteSelected" type="submit" title="حذف المحدد" aria-label="حذف الإجازات المحددة" disabled><i class="fa-solid fa-trash"></i></button>
                </form>
            </div>
            <div class="filters">
                <form action="{{ route('vacations.index') }}" method="GET" class="d-flex gap-2">
                    <select class="form-select form-select-sm filter-select" name="status" aria-label="تصفية حسب الحالة">
                        <option value="">كل الحالات</option>
                        @foreach($statuses as $status)
                            <option value="{{ $status }}" @selected(request('status') === $status)>{{ $status }}</option>
                        @endforeach
                    </select>
                    <div class="input-group">
                        <input class="form-control form-control-sm filter-input" type="search" name="q" value="{{ request('q') }}" placeholder="بحث..." aria-label="بحث">
                        <button class="btn btn-sm btn-outline-secondary" type="submit" aria-label="بحث"><i class="fa-solid fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover leave-table text-center align-middle">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll" aria-label="تحديد الكل"></th>
                        <th>الموظف/المحامي</th>
                        <th>البلد</th>
                        <th>الدور</th>
                        <th>نوع الإجازة</th>
                        <th>المدة</th>
                        <th>الطلب / التقرير</th>
                        <th>من</th>
                        <th>إلى</th>
                        <th>الحالة</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vacations as $vacation)
                        <tr>
                            <td><input class="vacation-select" type="checkbox" value="{{ $vacation->id }}" data-edit-url="{{ route('vacations.edit', $vacation->id) }}" aria-label="تحديد إجازة {{ $vacation->employee_name ?: $vacation->id }}"></td>
                            <td>{{ $vacation->employee_name ?: '-' }}</td>
                            <td>{{ $vacation->country ?: '-' }}</td>
                            <td>{{ $vacation->job_title ?: '-' }}</td>
                            <td>{{ $vacation->leave_type }}</td>
                            <td>{{ max(1, (int) \Illuminate\Support\Carbon::parse($vacation->start_date)->diffInDays(\Illuminate\Support\Carbon::parse($vacation->end_date)) + 1) }} يوم</td>
                            <td class="reason-cell">{{ $vacation->reason ? \Illuminate\Support\Str::limit($vacation->reason, 50) : '-' }}</td>
                            <td>{{ \Illuminate\Support\Carbon::parse($vacation->start_date)->format('d/m/Y') }}</td>
                            <td>{{ \Illuminate\Support\Carbon::parse($vacation->end_date)->format('d/m/Y') }}</td>
                            <td><span class="badge {{ $vacation->status === 'مقبولة' ? 'bg-success' : ($vacation->status === 'مرفوضة' ? 'bg-danger' : 'bg-secondary') }}">{{ $vacation->status }}</span></td>
                            <td><a class="row-action d-inline-flex align-items-center justify-content-center" href="{{ route('vacations.edit', $vacation->id) }}" aria-label="تعديل إجازة {{ $vacation->employee_name ?: $vacation->id }}"><i class="fa-solid fa-pen"></i></a></td>
                            <td>
                                <form action="{{ route('vacations.destroy', $vacation->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف طلب الإجازة؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="row-action" type="submit" aria-label="حذف إجازة {{ $vacation->employee_name ?: $vacation->id }}"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="12" class="py-5 text-muted">لا توجد طلبات إجازة مسجلة. اضغط على (+) لإضافة طلب جديد.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pager">
            <span>{{ $vacations->total() }} من النتائج</span>
            {{ $vacations->links() }}
        </div>
    </section>

    <div class="request-link">
        <a class="btn btn-link text-white text-decoration-none" href="{{ route('vacations.create') }}">طلب الإجازة <i class="fa-solid fa-arrow-left me-2"></i></a>
    </div>
</main>

<script>
    const vacationCheckboxes = Array.from(document.querySelectorAll('.vacation-select'));
    const selectAll = document.getElementById('selectAll');
    const editSelected = document.getElementById('editSelected');
    const deleteSelected = document.getElementById('deleteSelected');

    function updateSelection() {
        const selected = vacationCheckboxes.filter((checkbox) => checkbox.checked);
        editSelected.disabled = selected.length !== 1;
        deleteSelected.disabled = selected.length === 0;
        selectAll.checked = vacationCheckboxes.length > 0 && selected.length === vacationCheckboxes.length;
        selectAll.indeterminate = selected.length > 0 && selected.length < vacationCheckboxes.length;
    }

    vacationCheckboxes.forEach((checkbox) => checkbox.addEventListener('change', updateSelection));
    selectAll.addEventListener('change', () => {
        vacationCheckboxes.forEach((checkbox) => { checkbox.checked = selectAll.checked; });
        updateSelection();
    });
    editSelected.addEventListener('click', () => {
        const selected = vacationCheckboxes.find((checkbox) => checkbox.checked);
        if (selected) window.location.href = selected.dataset.editUrl;
    });
    document.getElementById('bulkDeleteForm').addEventListener('submit', (event) => {
        const selected = vacationCheckboxes.filter((checkbox) => checkbox.checked);
        if (selected.length === 0) {
            event.preventDefault();
            return;
        }

        const inputs = document.getElementById('selectedVacationInputs');
        inputs.replaceChildren(...selected.map((checkbox) => {
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
