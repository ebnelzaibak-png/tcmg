<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>المحكمة - TCMG</title>
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
        .court-card{max-width:960px;margin:30px auto;background:var(--panel);border:1px solid #0b1027;box-shadow:0 2px 6px #05091a55;padding:0}
        .court-title{padding:16px 18px;border-bottom:1px solid #8990aa;font-size:22px;font-weight:700}
        .court-tools{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:14px 18px}
        .action-buttons,.filters{display:flex;align-items:center;gap:8px}
        .action-buttons .btn{width:34px;height:32px;padding:4px}
        .filter-input{background:#151c3d!important;color:#fff!important;border-color:#687294!important;font-family:inherit;font-size:12px!important}
        .filter-input::placeholder{color:var(--muted)}
        .courts-table{margin:0;color:#fff;--bs-table-bg:transparent;--bs-table-color:#fff;--bs-table-border-color:#30385f;--bs-table-hover-bg:#222a58}
        .courts-table th{color:#c3c9df;font-size:12px;font-weight:600;white-space:nowrap}
        .courts-table td{font-size:12px;vertical-align:middle}
        .courts-table input[type=checkbox]{accent-color:#5375ff}
        .row-action{border:1px solid #9aa3c7;color:#fff;background:transparent;width:30px;height:28px;border-radius:4px}
        .row-action:hover{background:#fff;color:#10153a}
        .pager{display:flex;align-items:center;justify-content:space-between;padding:14px 18px;color:var(--muted);font-size:11px}
        .pager .pagination{margin:0}
        .pagination .page-link{background:transparent;color:#c3c9df;border-color:#30385f;font-size:11px}
        .pagination .active .page-link{background:#5375ff;border-color:#5375ff;color:#fff}
        @media(max-width:760px){.sidebar{display:none}.main{margin-right:0}.court-card{margin:12px auto}}
        @media(max-width:600px){.main{padding:12px}.topbar-tools:nth-child(2){display:none}.court-tools{align-items:stretch;flex-direction:column}.filters,.filters form{width:100%}.filter-input{width:100%!important}.courts-table{min-width:700px}.pager{gap:12px;flex-wrap:wrap}}
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
        <a class="nav-link active" href="{{ route('court.index') }}"><i class="fa-solid fa-scale-balanced"></i> المحكمة</a>
        <a class="nav-link" href="/tasks"><i class="fa-solid fa-check"></i> المهام و الأعمال</a>
        <a class="nav-link" href="/employees"><i class="fa-solid fa-users"></i> الموارد البشرية</a>
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
        <div class="search-help"><input type="search" placeholder="كيف يمكنني مساعدتك؟"></div>
    </header>

    @if(session('success'))
        <div class="alert alert-success text-end">{{ session('success') }}</div>
    @endif

    <section class="court-card">
        <div class="court-title">كشف بالمحاكم</div>
        <div class="court-tools">
            <div class="action-buttons">
                <a class="btn btn-sm btn-outline-light" href="{{ route('court.create') }}" title="إضافة محكمة" aria-label="إضافة محكمة"><i class="fa-solid fa-plus"></i></a>
                <button class="btn btn-sm btn-outline-light" id="editSelected" type="button" title="حدد محكمة واحدة للتعديل" aria-label="تعديل المحدد"><i class="fa-solid fa-pen"></i></button>
                <form id="bulkDeleteForm" action="{{ route('court.bulk-destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div id="selectedCourtInputs"></div>
                    <button class="btn btn-sm btn-outline-light" id="deleteSelected" type="submit" title="حدد محكمة واحدة على الأقل للحذف" aria-label="حذف المحدد"><i class="fa-solid fa-trash"></i></button>
                </form>
            </div>
            <div class="filters">
                <form action="{{ route('court.index') }}" method="GET" class="d-flex gap-2">
                    <div class="input-group">
                        <input class="form-control form-control-sm filter-input" type="search" name="q" value="{{ request('q') }}" placeholder="بحث..." aria-label="بحث">
                        <button class="btn btn-sm btn-outline-secondary" type="submit" aria-label="بحث"><i class="fa-solid fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover courts-table text-center align-middle">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll" aria-label="تحديد الكل"></th>
                        <th>المحكمة</th>
                        <th>البلد</th>
                        <th>المدينة</th>
                        <th>المحافظة/الولاية</th>
                        <th>قسم/مركز الشرطة</th>
                        <th>فئة المحكمة</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($courts as $court)
                        <tr>
                            <td><input class="court-select" type="checkbox" value="{{ $court->id }}" data-edit-url="{{ route('court.edit', $court->id) }}" aria-label="تحديد {{ $court->name }}"></td>
                            <td class="fw-semibold">{{ $court->name }}</td>
                            <td>{{ $court->country }}</td>
                            <td>{{ $court->city }}</td>
                            <td>{{ $court->governorate }}</td>
                            <td>{{ $court->police_station }}</td>
                            <td>{{ $court->category }}</td>
                            <td><a class="row-action d-inline-flex align-items-center justify-content-center" href="{{ route('court.edit', $court->id) }}" aria-label="تعديل {{ $court->name }}"><i class="fa-solid fa-pen"></i></a></td>
                            <td>
                                <form action="{{ route('court.delete', $court->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف المحكمة؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="row-action" type="submit" aria-label="حذف {{ $court->name }}"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="9" class="py-5 text-muted">لا توجد محاكم مسجلة. اضغط على (+) لإضافة محكمة.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pager">
            <span>{{ $courts->total() }} من النتائج</span>
            {{ $courts->links() }}
        </div>
    </section>
</main>

<script>
    const courtCheckboxes = Array.from(document.querySelectorAll('.court-select'));
    const selectAll = document.getElementById('selectAll');
    const editSelected = document.getElementById('editSelected');
    const deleteSelected = document.getElementById('deleteSelected');

    function updateSelection() {
        const selected = courtCheckboxes.filter((checkbox) => checkbox.checked);
        selectAll.checked = courtCheckboxes.length > 0 && selected.length === courtCheckboxes.length;
        selectAll.indeterminate = selected.length > 0 && selected.length < courtCheckboxes.length;
    }

    courtCheckboxes.forEach((checkbox) => checkbox.addEventListener('change', updateSelection));
    selectAll.addEventListener('change', () => {
        courtCheckboxes.forEach((checkbox) => { checkbox.checked = selectAll.checked; });
        updateSelection();
    });
    editSelected.addEventListener('click', () => {
        const selectedRows = courtCheckboxes.filter((checkbox) => checkbox.checked);
        if (selectedRows.length === 0) {
            window.alert('حدد محكمة واحدة للتعديل.');
            return;
        }
        if (selectedRows.length > 1) {
            window.alert('حدد محكمة واحدة فقط للتعديل.');
            return;
        }
        const selected = selectedRows[0];
        if (selected) window.location.href = selected.dataset.editUrl;
    });
    document.getElementById('bulkDeleteForm').addEventListener('submit', (event) => {
        const selected = courtCheckboxes.filter((checkbox) => checkbox.checked);
        if (selected.length === 0) {
            event.preventDefault();
            window.alert('حدد محكمة واحدة على الأقل للحذف.');
            return;
        }
        if (!window.confirm('هل تريد حذف المحاكم المحددة؟')) {
            event.preventDefault();
            return;
        }
        document.getElementById('selectedCourtInputs').innerHTML = selected
            .map((checkbox) => `<input type="hidden" name="ids[]" value="${checkbox.value}">`)
            .join('');
    });
</script>
</body>
</html>
