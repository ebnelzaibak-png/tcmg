<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>العملاء - TCMG</title>
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
        .main{margin-right:230px;padding:18px 24px;min-height:100vh}
        .topbar{display:flex;align-items:center;gap:18px;margin-bottom:24px}
        .topbar-tools{display:flex;align-items:center;gap:16px;color:var(--muted);font-size:13px;white-space:nowrap}
        .avatar{width:26px;height:26px;border-radius:50%;background:var(--gold);display:inline-block}
        .search-help{flex:1;max-width:440px;margin:auto}
        .search-help input{width:100%;padding:9px 16px;border:0;border-radius:6px;font-family:inherit;font-size:13px}
        .charts{display:grid;grid-template-columns:1.55fr 1fr;gap:16px;margin-bottom:16px}
        .card-dark{background:var(--panel);border:1px solid #0b1027;border-radius:6px;padding:18px}
        .chart-card{min-height:178px}
        .card-title{font-size:18px;font-weight:700;margin:0}
        .sub{font-size:11px;color:var(--muted)}
        .legend{display:flex;gap:14px;flex-wrap:wrap;font-size:11px;color:var(--muted)}
        .legend i{display:inline-block;width:9px;height:9px;border-radius:50%;margin-inline-end:5px}
        .chart-box{position:relative;height:130px;margin-top:8px}
        .nationality-layout{display:flex;align-items:center;justify-content:center;gap:14px}
        .nationality-chart{width:125px;height:125px;flex:none}
        .nationality-legend{display:grid;grid-template-columns:1fr 1fr;gap:5px 10px;font-size:10px;color:var(--muted)}
        .nationality-legend span{white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
        .clients-card{padding:0;overflow:hidden}
        .clients-title{padding:16px 18px;border-bottom:1px solid #8990aa;font-size:20px;font-weight:700}
        .table-tools{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:14px 18px}
        .action-buttons,.filters{display:flex;align-items:center;gap:8px}
        .action-buttons .btn{width:34px;height:32px;padding:4px}
        .filter-input,.filter-select{background:#151c3d!important;color:#fff!important;border-color:#687294!important;font-family:inherit;font-size:12px!important}
        .filter-input::placeholder{color:var(--muted)}
        .clients-table{margin:0;color:#fff;--bs-table-bg:transparent;--bs-table-color:#fff;--bs-table-border-color:#30385f;--bs-table-hover-bg:#222a58}
        .clients-table th{color:#c3c9df;font-size:11px;font-weight:600;white-space:nowrap}
        .clients-table td{font-size:12px;vertical-align:middle}
        .clients-table input[type=checkbox]{accent-color:#5375ff}
        .row-action{border:1px solid #9aa3c7;color:#fff;background:transparent;width:30px;height:28px;border-radius:4px}
        .row-action:hover{background:#fff;color:#10153a}
        .pager{display:flex;align-items:center;justify-content:space-between;padding:14px 18px;color:var(--muted);font-size:11px}
        .pager .pagination{margin:0}
        .pagination .page-link{background:transparent;color:#c3c9df;border-color:#30385f;font-size:11px}
        .pagination .active .page-link{background:#5375ff;border-color:#5375ff;color:#fff}
        .modal-content{background:var(--panel);color:#fff;border:1px solid #30385f}
        .modal .form-label{color:#aab1cc;font-size:12px}
        .modal .form-control,.modal .form-select{font-family:inherit;font-size:13px}
        @media(max-width:760px){.sidebar{display:none}.main{margin-right:0}.charts{grid-template-columns:1fr}}
        @media(max-width:650px){.main{padding:12px}.topbar-tools:nth-child(2){display:none}.table-tools{align-items:stretch;flex-direction:column}.filters{width:100%}.filters form{flex:1}.filter-input{width:100%!important}.clients-table{min-width:780px}.table-responsive{overflow-x:auto}.pager{gap:12px;flex-wrap:wrap}}
    </style>
</head>
<body>
<aside class="sidebar">
    <div class="logo">✦ <span>TCMG</span></div>
    <nav>
        <a class="nav-link" href="{{ route('dashboard') }}"><i class="fa-solid fa-house"></i> الصفحة الرئيسية</a>
        <a class="nav-link" href="{{ route('contacts.index') }}"><i class="fa-solid fa-phone"></i> الاتصال</a>
        <a class="nav-link active" href="{{ route('clients.index') }}"><i class="fa-solid fa-users"></i> العملاء</a>
        <a class="nav-link" href="/cases"><i class="fa-regular fa-file-lines"></i> القضايا</a>
        <a class="nav-link" href="/court"><i class="fa-solid fa-scale-balanced"></i> المحكمة</a>
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

    <section class="charts">
        <article class="card-dark chart-card">
            <div class="d-flex justify-content-between align-items-start gap-3">
                <div>
                    <h1 class="card-title">العملاء</h1>
                    <div class="sub">آخر 10 أيام</div>
                </div>
                <div class="legend">
                    <span><i style="background:var(--gold)"></i>شركات ومؤسسات</span>
                    <span><i style="background:#fff"></i>أفراد</span>
                </div>
            </div>
            <div class="chart-box"><canvas id="clientsChart"></canvas></div>
        </article>
        <article class="card-dark chart-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h2 class="card-title">جنسيات العملاء</h2>
                    <div class="sub">حسب البلد المسجل</div>
                </div>
            </div>
            <div class="nationality-layout">
                <div class="nationality-legend" id="nationalityLegend"></div>
                <div class="nationality-chart"><canvas id="nationalityChart"></canvas></div>
            </div>
        </article>
    </section>

    <section class="card-dark clients-card">
        <div class="clients-title">قائمة العملاء</div>
        <div class="table-tools">
            <div class="action-buttons">
                <a class="btn btn-sm btn-outline-light" href="{{ route('clients.create') }}" title="إضافة عميل" aria-label="إضافة عميل"><i class="fa-solid fa-plus"></i></a>
                <button class="btn btn-sm btn-outline-light" id="editSelected" type="button" title="تعديل المحدد" aria-label="تعديل المحدد" disabled><i class="fa-solid fa-pen"></i></button>
                <form id="bulkDeleteForm" action="{{ route('clients.bulk-destroy') }}" method="POST" onsubmit="return confirm('هل تريد حذف العملاء المحددين؟')">
                    @csrf
                    @method('DELETE')
                    <div id="selectedClientInputs"></div>
                    <button class="btn btn-sm btn-outline-light" id="deleteSelected" type="submit" title="حذف المحدد" aria-label="حذف المحدد" disabled><i class="fa-solid fa-trash"></i></button>
                </form>
            </div>
            <div class="filters">
                <form action="{{ route('clients.index') }}" method="GET" class="d-flex gap-2">
                    <select class="form-select form-select-sm filter-select" name="type" aria-label="تصفية حسب الفئة">
                        <option value="">كل الفئات</option>
                        @foreach($types as $type)
                            <option value="{{ $type }}" @selected(request('type') === $type)>{{ $type }}</option>
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
            <table class="table table-hover clients-table text-center align-middle">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll" aria-label="تحديد الكل"></th>
                        <th>الاسم</th>
                        <th>البلد</th>
                        <th>الفئة</th>
                        <th>رقم التواصل</th>
                        <th>البريد الإلكتروني</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clients as $client)
                        <tr>
                            <td><input class="client-select" type="checkbox" value="{{ $client->id }}" aria-label="تحديد {{ $client->name }}"></td>
                            <td class="fw-semibold">{{ $client->name }}</td>
                            <td>{{ $client->nationality ?: '-' }}</td>
                            <td>{{ $client->type === 'فرد' ? 'عميل' : ($client->type ?: '-') }}</td>
                            <td dir="ltr">{{ $client->phone }}</td>
                            <td>{{ $client->email ?: '-' }}</td>
                            <td>
                                <button class="row-action" type="button" data-bs-toggle="modal" data-bs-target="#editClient{{ $client->id }}" aria-label="تعديل {{ $client->name }}"><i class="fa-solid fa-pen"></i></button>
                            </td>
                            <td>
                                <form action="{{ route('clients.delete', $client->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف العميل؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="row-action" type="submit" aria-label="حذف {{ $client->name }}"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="py-5 text-muted">لا توجد بيانات عملاء. اضغط على (+) لإضافة عميل جديد.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pager">
            <span>{{ $clients->total() }} من النتائج</span>
            {{ $clients->links() }}
        </div>
    </section>
</main>

@foreach($clients as $client)
    <div class="modal fade" id="editClient{{ $client->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('clients.update', $client->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header border-secondary">
                        <h2 class="modal-title fs-5">تعديل بيانات العميل</h2>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="client-name-{{ $client->id }}">الاسم</label>
                                <input class="form-control" id="client-name-{{ $client->id }}" name="name" value="{{ $client->name }}" required maxlength="255">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="client-country-{{ $client->id }}">البلد</label>
                                <select class="form-select" id="client-country-{{ $client->id }}" name="nationality" required>
                                    @foreach($countries as $country)
                                        <option value="{{ $country }}" @selected($client->nationality === $country)>{{ $country }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="client-phone-{{ $client->id }}">رقم التواصل</label>
                                <input class="form-control" id="client-phone-{{ $client->id }}" name="phone" type="tel" value="{{ $client->phone }}" required maxlength="50">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="client-email-{{ $client->id }}">البريد الإلكتروني</label>
                                <input class="form-control" id="client-email-{{ $client->id }}" name="email" type="email" value="{{ $client->email }}" maxlength="255">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="client-type-{{ $client->id }}">الفئة</label>
                                <select class="form-select" id="client-type-{{ $client->id }}" name="type" required>
                                    @foreach($types as $type)
                                        <option value="{{ $type }}" @selected($client->type === $type)>{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button class="btn btn-light" type="submit">حفظ التعديلات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script>
    const clientCharts = @json($charts);
    const chartColors = ['#8b6a3a', '#fff', '#8a1f3d', '#4a7fb5', '#6fd39a', '#9aa3c7', '#d97706'];
    const checkboxes = Array.from(document.querySelectorAll('.client-select'));
    const selectAll = document.getElementById('selectAll');
    const editSelected = document.getElementById('editSelected');
    const deleteSelected = document.getElementById('deleteSelected');

    function updateSelection() {
        const selected = checkboxes.filter((checkbox) => checkbox.checked);
        editSelected.disabled = selected.length !== 1;
        deleteSelected.disabled = selected.length === 0;
        selectAll.checked = checkboxes.length > 0 && selected.length === checkboxes.length;
        selectAll.indeterminate = selected.length > 0 && selected.length < checkboxes.length;
    }

    checkboxes.forEach((checkbox) => checkbox.addEventListener('change', updateSelection));
    selectAll.addEventListener('change', () => {
        checkboxes.forEach((checkbox) => { checkbox.checked = selectAll.checked; });
        updateSelection();
    });

    editSelected.addEventListener('click', () => {
        const selected = checkboxes.find((checkbox) => checkbox.checked);
        if (selected) {
            bootstrap.Modal.getOrCreateInstance(document.getElementById(`editClient${selected.value}`)).show();
        }
    });

    document.getElementById('bulkDeleteForm').addEventListener('submit', (event) => {
        const selected = checkboxes.filter((checkbox) => checkbox.checked);
        if (selected.length === 0) {
            event.preventDefault();
            return;
        }

        document.getElementById('selectedClientInputs').innerHTML = selected
            .map((checkbox) => `<input type="hidden" name="ids[]" value="${checkbox.value}">`)
            .join('');
    });

    new Chart(document.getElementById('clientsChart'), {
        type: 'bar',
        data: {
            labels: clientCharts.labels,
            datasets: [
                { label: 'شركات ومؤسسات', data: clientCharts.companies, backgroundColor: '#8b6a3a' },
                { label: 'أفراد', data: clientCharts.individuals, backgroundColor: '#fff' }
            ]
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

    new Chart(document.getElementById('nationalityChart'), {
        type: 'pie',
        data: {
            labels: clientCharts.nationalities.labels,
            datasets: [{ data: clientCharts.nationalities.values, backgroundColor: chartColors, borderColor: '#1a2148' }]
        },
        options: { maintainAspectRatio: false, plugins: { legend: { display: false } } }
    });

    const nationalityLegend = document.getElementById('nationalityLegend');
    clientCharts.nationalities.labels.forEach((label, index) => {
        const item = document.createElement('span');
        const marker = document.createElement('i');
        marker.style.cssText = 'display:inline-block;width:8px;height:8px;border-radius:50%;margin-inline-end:4px';
        marker.style.backgroundColor = chartColors[index % chartColors.length];
        item.title = label;
        item.append(marker, document.createTextNode(label));
        nationalityLegend.append(item);
    });
</script>
</body>
</html>
