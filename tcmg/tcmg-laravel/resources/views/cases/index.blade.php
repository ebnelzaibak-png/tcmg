<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>القضايا - TCMG</title>
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
        .charts-top{display:grid;grid-template-columns:1.55fr .7fr;gap:16px;margin-bottom:16px;direction:ltr}
        .charts-bottom{display:grid;grid-template-columns:.75fr 1.65fr;gap:16px;margin-bottom:16px;direction:ltr}
        .card-dark{background:var(--panel);border:1px solid #0b1027;border-radius:6px;padding:16px}
        .chart-card{direction:rtl;min-width:0}
        .chart-card{min-height:180px}
        .card-title{font-size:18px;font-weight:700;margin:0}
        .sub{font-size:11px;color:var(--muted)}
        .legend{display:flex;gap:14px;flex-wrap:wrap;font-size:11px;color:var(--muted)}
        .legend i{display:inline-block;width:9px;height:9px;border-radius:50%;margin-inline-end:5px}
        .chart-box{position:relative;height:130px;margin-top:8px}
        .doughnut-box{position:relative;width:135px;height:135px;margin:10px auto}
        .doughnut-center{position:absolute;inset:0;display:flex;flex-direction:column;justify-content:center;align-items:center;text-align:center;pointer-events:none;font-size:11px}
        .doughnut-center strong{font-size:17px}
        .case-card{padding:0;overflow:hidden}
        .case-title{padding:14px 18px;border-bottom:1px solid #8990aa;font-size:20px;font-weight:700}
        .case-tools{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:12px 16px}
        .action-buttons,.filters{display:flex;align-items:center;gap:8px}
        .action-buttons .btn{width:34px;height:32px;padding:4px}
        .filters form{display:flex;gap:8px}
        .filter-input,.filter-select{background:#151c3d!important;color:#fff!important;border-color:#687294!important;font-family:inherit;font-size:12px!important}
        .filter-input::placeholder{color:var(--muted)}
        .cases-table{margin:0;color:#fff;--bs-table-bg:transparent;--bs-table-color:#fff;--bs-table-border-color:#30385f;--bs-table-hover-bg:#222a58}
        .cases-table th{color:#c3c9df;font-size:11px;font-weight:600;white-space:nowrap}
        .cases-table td{font-size:11px;vertical-align:middle;white-space:nowrap}
        .cases-table input[type=checkbox]{accent-color:#5375ff}
        .row-action{border:1px solid #9aa3c7;color:#fff;background:transparent;width:28px;height:26px;border-radius:4px}
        .row-action:hover{background:#fff;color:#10153a}
        .pager{display:flex;align-items:center;justify-content:space-between;padding:14px 18px;color:var(--muted);font-size:11px}
        .pager .pagination{margin:0}
        .pagination .page-link{background:transparent;color:#c3c9df;border-color:#30385f;font-size:11px}
        .pagination .active .page-link{background:#5375ff;border-color:#5375ff;color:#fff}
        .print-only{display:none}
        @media(max-width:1050px){.charts-top{grid-template-columns:1.3fr .8fr}.charts-bottom{grid-template-columns:1fr 1.5fr}.main{padding:16px}}
        @media(max-width:760px){.sidebar{display:none}.main{margin-right:0}.charts-top,.charts-bottom{grid-template-columns:1fr}}
        @media(max-width:650px){.main{padding:12px}.topbar-tools:nth-child(2){display:none}.case-tools{align-items:stretch;flex-direction:column}.filters{width:100%}.filters form{width:100%}.filter-input{width:100%!important}.cases-table{min-width:1250px}.pager{gap:12px;flex-wrap:wrap}}
        @media print{body{background:#fff;color:#000}.sidebar,.topbar,.charts,.case-tools,.no-print{display:none!important}.main{margin:0;padding:0}.case-card{border:0;background:#fff}.cases-table{color:#000!important;--bs-table-color:#000;--bs-table-border-color:#888}.case-title{color:#000;border-color:#888}}
    </style>
</head>
<body>
<aside class="sidebar">
    <div class="logo">✦ <span>TCMG</span></div>
    <nav>
        <a class="nav-link" href="{{ route('dashboard') }}"><i class="fa-solid fa-house"></i> الصفحة الرئيسية</a>
        <a class="nav-link" href="{{ route('contacts.index') }}"><i class="fa-solid fa-phone"></i> الاتصال</a>
        <a class="nav-link" href="{{ route('clients.index') }}"><i class="fa-solid fa-users"></i> العملاء</a>
        <a class="nav-link active" href="{{ route('cases.index') }}"><i class="fa-regular fa-file-lines"></i> القضايا</a>
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

    <section class="charts-top">
        <article class="card-dark chart-card">
            <div class="d-flex justify-content-between align-items-start gap-3">
                <div>
                    <h1 class="card-title">القضايا</h1>
                    <div class="sub">آخر 10 أيام</div>
                </div>
                <div class="legend">
                    <span><i style="background:var(--gold)"></i>نشطة</span>
                    <span><i style="background:#fff"></i>مغلقة</span>
                </div>
            </div>
            <div class="chart-box"><canvas id="casesChart"></canvas></div>
        </article>
        <article class="card-dark chart-card">
            <h2 class="card-title text-center">نسبة القضايا المغلقة</h2>
            <div class="doughnut-box">
                <canvas id="closureChart"></canvas>
                <div class="doughnut-center"><span>القضايا المغلقة</span><strong>{{ $charts['closureRate'] }}%</strong></div>
            </div>
        </article>
    </section>

    <section class="charts-bottom">
        <article class="card-dark chart-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h2 class="card-title">فئات القضايا</h2>
                    <div class="sub">حسب نوع القضية</div>
                </div>
            </div>
            <div class="chart-box"><canvas id="caseTypesChart"></canvas></div>
        </article>
        <article class="card-dark chart-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h2 class="card-title">الجلسات القادمة</h2>
                    <div class="sub">عدد الجلسات المسجلة خلال آخر 10 أيام</div>
                </div>
            </div>
            <div class="chart-box"><canvas id="sessionsChart"></canvas></div>
        </article>
    </section>

    <section class="card-dark case-card">
        <div class="case-title d-flex justify-content-between align-items-center gap-2">
            <span>القضايا</span>
            <div class="d-flex gap-2 no-print">
                <button class="btn btn-sm btn-outline-light" type="button" onclick="window.print()">طباعة</button>
                <button class="btn btn-sm btn-outline-light" type="button" onclick="window.print()">تحميل PDF</button>
            </div>
        </div>
        <div class="case-tools">
            <div class="action-buttons">
                <a class="btn btn-sm btn-outline-light" href="{{ route('cases.create') }}" title="إضافة قضية" aria-label="إضافة قضية"><i class="fa-solid fa-plus"></i></a>
                <button class="btn btn-sm btn-outline-light" id="editSelected" type="button" title="تعديل المحدد" aria-label="تعديل المحدد" disabled><i class="fa-solid fa-pen"></i></button>
                <form id="bulkDeleteForm" action="{{ route('cases.bulk-destroy') }}" method="POST" onsubmit="return confirm('هل تريد حذف القضايا المحددة؟')">
                    @csrf
                    @method('DELETE')
                    <div id="selectedCaseInputs"></div>
                    <button class="btn btn-sm btn-outline-light" id="deleteSelected" type="submit" title="حذف المحدد" aria-label="حذف المحدد" disabled><i class="fa-solid fa-trash"></i></button>
                </form>
            </div>
            <div class="filters">
                <form action="{{ route('cases.index') }}" method="GET">
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
            <table class="table table-hover cases-table text-center align-middle">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll" aria-label="تحديد الكل"></th>
                        <th>رقم القضية</th>
                        <th>الفئة</th>
                        <th>البلد</th>
                        <th>العميل 1</th>
                        <th>العميل 2</th>
                        <th>المحامي 1</th>
                        <th>المحامي 2</th>
                        <th>المحكمة</th>
                        <th>السعر</th>
                        <th>الحكم</th>
                        <th>تاريخ الجلسة الأولى</th>
                        <th>الجلسة التالية</th>
                        <th>الحالة</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cases as $case)
                        <tr>
                            <td><input class="case-select" type="checkbox" value="{{ $case->id }}" data-edit-url="{{ route('cases.edit', $case->id) }}" aria-label="تحديد القضية {{ $case->case_number }}"></td>
                            <td>{{ $case->case_number ?: $case->id }}</td>
                            <td>{{ $case->case_type ?: '-' }}</td>
                            <td>{{ $case->country ?: '-' }}</td>
                            <td>{{ $case->client_name ?: '-' }}</td>
                            <td>{{ $case->client2_name ?: '-' }}</td>
                            <td>{{ $case->lawyer1_name ?: '-' }}</td>
                            <td>{{ $case->lawyer2_name ?: '-' }}</td>
                            <td>{{ $case->court_name ?: '-' }}</td>
                            <td>{{ $case->fee === null ? '-' : number_format((float) $case->fee, 2) }}</td>
                            <td>{{ $case->judgment ?: '-' }}</td>
                            <td>{{ $case->first_session_date ?: '-' }}</td>
                            <td>{{ $case->session_date ?: '-' }}</td>
                            <td><span class="badge {{ $case->status === 'مغلقة' ? 'bg-secondary' : ($case->status === 'نشطة' ? 'bg-success' : 'bg-warning text-dark') }}">{{ $case->status ?: 'نشطة' }}</span></td>
                            <td><a class="row-action d-inline-flex align-items-center justify-content-center" href="{{ route('cases.edit', $case->id) }}" aria-label="تعديل القضية {{ $case->case_number }}"><i class="fa-solid fa-pen"></i></a></td>
                            <td>
                                <form action="{{ route('cases.destroy', $case->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف القضية؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="row-action" type="submit" aria-label="حذف القضية {{ $case->case_number }}"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="16" class="py-5 text-muted">لا توجد قضايا مسجلة. اضغط على (+) لإضافة قضية جديدة.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pager">
            <span>{{ $cases->total() }} من النتائج</span>
            {{ $cases->links() }}
        </div>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    const caseCharts = @json($charts);
    const chartColors = ['#8b6a3a', '#fff', '#10153a', '#8a1f3d', '#4a7fb5', '#6fd39a', '#9aa3c7'];
    const scales = {
        x: { ticks: { color: '#fff', font: { size: 9 } }, grid: { color: 'rgba(255,255,255,.25)' } },
        y: { beginAtZero: true, ticks: { color: '#fff', precision: 0, font: { size: 9 } }, grid: { color: 'rgba(255,255,255,.25)' } }
    };

    new Chart(document.getElementById('casesChart'), {
        type: 'line',
        data: {
            labels: caseCharts.labels,
            datasets: [
                { label: 'نشطة', data: caseCharts.active, borderColor: '#8b6a3a', backgroundColor: '#8b6a3a', tension: 0, pointRadius: 2 },
                { label: 'مغلقة', data: caseCharts.closed, borderColor: '#fff', backgroundColor: '#fff', tension: 0, pointRadius: 2 }
            ]
        },
        options: { maintainAspectRatio: false, plugins: { legend: { display: false } }, scales }
    });

    new Chart(document.getElementById('closureChart'), {
        type: 'doughnut',
        data: { datasets: [{ data: [caseCharts.closureRate, 100 - caseCharts.closureRate], backgroundColor: ['#8b6a3a', '#fff'], borderWidth: 0 }] },
        options: { maintainAspectRatio: false, cutout: '72%', plugins: { legend: { display: false } } }
    });

    new Chart(document.getElementById('caseTypesChart'), {
        type: 'pie',
        data: { labels: caseCharts.types.labels, datasets: [{ data: caseCharts.types.values, backgroundColor: chartColors, borderColor: '#1a2148' }] },
        options: { maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { color: '#fff', boxWidth: 8, font: { size: 9 } } } } }
    });

    new Chart(document.getElementById('sessionsChart'), {
        type: 'line',
        data: {
            labels: caseCharts.labels,
            datasets: [{ label: 'الجلسات', data: caseCharts.sessions, borderColor: '#8b6a3a', backgroundColor: '#8b6a3a55', fill: true, tension: 0.35, pointRadius: 2 }]
        },
        options: { maintainAspectRatio: false, plugins: { legend: { display: false } }, scales }
    });

    const caseCheckboxes = Array.from(document.querySelectorAll('.case-select'));
    const selectAll = document.getElementById('selectAll');
    const editSelected = document.getElementById('editSelected');
    const deleteSelected = document.getElementById('deleteSelected');

    function updateSelection() {
        const selected = caseCheckboxes.filter((checkbox) => checkbox.checked);
        editSelected.disabled = selected.length !== 1;
        deleteSelected.disabled = selected.length === 0;
        selectAll.checked = caseCheckboxes.length > 0 && selected.length === caseCheckboxes.length;
        selectAll.indeterminate = selected.length > 0 && selected.length < caseCheckboxes.length;
    }

    caseCheckboxes.forEach((checkbox) => checkbox.addEventListener('change', updateSelection));
    selectAll.addEventListener('change', () => {
        caseCheckboxes.forEach((checkbox) => { checkbox.checked = selectAll.checked; });
        updateSelection();
    });
    editSelected.addEventListener('click', () => {
        const selected = caseCheckboxes.find((checkbox) => checkbox.checked);
        if (selected) window.location.href = selected.dataset.editUrl;
    });
    document.getElementById('bulkDeleteForm').addEventListener('submit', (event) => {
        const selected = caseCheckboxes.filter((checkbox) => checkbox.checked);
        if (selected.length === 0) {
            event.preventDefault();
            return;
        }
        document.getElementById('selectedCaseInputs').innerHTML = selected
            .map((checkbox) => `<input type="hidden" name="ids[]" value="${checkbox.value}">`)
            .join('');
    });
</script>
</body>
</html>
