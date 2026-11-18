<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>الاستشارات القانونية - TCMG</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
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
        .charts{display:grid;grid-template-columns:1.55fr 1fr;gap:16px;margin-bottom:18px;direction:ltr}
        .card{background:var(--panel);border:0;border-radius:7px;color:#fff}
        .chart-card{padding:18px;min-width:0;direction:rtl}
        .chart-heading{font-size:15px;font-weight:700;text-align:center;margin:0 0 4px}
        .chart-subtitle{font-size:9px;text-align:center;color:var(--muted);margin-bottom:10px}
        .chart-box{position:relative;height:155px}
        .chart-box.pie{height:155px}
        .table-card{overflow:hidden}
        .table-heading{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:15px 16px;border-bottom:1px solid #8990aa}
        .table-heading h1{font-size:20px;font-weight:700;margin:0}
        .heading-tools{display:flex;align-items:center;gap:8px;flex-wrap:wrap}
        .heading-tools .btn{font-size:11px}
        .table-tools{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:14px 16px}
        .action-buttons{display:flex;align-items:center;gap:8px}
        .action-buttons .btn{width:34px;height:32px;padding:4px}
        .action-buttons form{margin:0}
        .filters{display:flex;align-items:center;gap:8px;flex:1;justify-content:flex-end}
        .filters form{display:flex;gap:8px;max-width:430px;width:100%}
        .filter-input,.filter-select{background:#151c3d!important;color:#fff!important;border-color:#687294!important;font-family:inherit;font-size:11px!important}
        .filter-input::placeholder{color:var(--muted)}
        .consultation-table{margin:0;color:#fff;--bs-table-bg:transparent;--bs-table-color:#fff;--bs-table-border-color:#30385f;--bs-table-hover-bg:#222a58}
        .consultation-table th{color:#c3c9df;font-size:10px;font-weight:600;white-space:nowrap}
        .consultation-table td{font-size:10px;vertical-align:middle;white-space:nowrap}
        .consultation-table input[type=checkbox]{accent-color:#5375ff}
        .row-action{border:1px solid #9aa3c7;color:#fff;background:transparent;width:28px;height:26px;border-radius:4px}
        .row-action:hover{background:#fff;color:#10153a}
        .pager{display:flex;align-items:center;justify-content:space-between;padding:14px 18px;color:var(--muted);font-size:10px}
        .pager .pagination{margin:0}
        .pagination .page-link{background:transparent;color:#c3c9df;border-color:#30385f;font-size:10px}
        .pagination .active .page-link{background:#5375ff;border-color:#5375ff;color:#fff}
        @media(max-width:650px){.charts{grid-template-columns:1fr}.chart-box,.chart-box.pie{height:190px}}
        @media(max-width:760px){.sidebar{display:none}.main{margin-right:0}}
        @media(max-width:650px){.main{padding:12px}.topbar-tools:nth-child(2){display:none}.table-heading,.table-tools{align-items:stretch;flex-direction:column}.heading-tools{justify-content:flex-start}.filters,.filters form{width:100%}.filters form{flex-wrap:wrap}.filter-input{width:100%!important}.consultation-table{min-width:900px}.table-responsive{overflow-x:auto}.pager{gap:12px;flex-wrap:wrap}}
        @media print{body{background:#fff;color:#000}.sidebar,.topbar,.charts,.table-tools,.heading-tools,.row-action,.no-print{display:none!important}.main{margin:0;padding:0}.card,.table-card{background:#fff;color:#000}.consultation-table{color:#000!important;--bs-table-color:#000;--bs-table-border-color:#888}.table-heading{border-color:#888}.table-heading h1{color:#000}}
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
        <a class="nav-link" href="/permissions"><i class="fa-solid fa-lock"></i> صلاحيات الدخول</a>
        <a class="nav-link active" href="{{ route('consultations.index') }}"><i class="fa-solid fa-gavel"></i> الاستشارات القانونية</a>
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

    <section class="charts">
        <div class="card chart-card">
            <h2 class="chart-heading">عدد الاستشارات القانونية</h2>
            <div class="chart-subtitle">آخر عشرة أيام</div>
            <div class="chart-box"><canvas id="consultationCountChart"></canvas></div>
        </div>
        <div class="card chart-card">
            <h2 class="chart-heading">الاستشارات القانونية</h2>
            <div class="chart-subtitle">حسب نوع الاستشارة</div>
            <div class="chart-box pie"><canvas id="consultationTypeChart"></canvas></div>
        </div>
    </section>

    <section class="card table-card">
        <div class="table-heading">
            <h1>الاستشارات القانونية</h1>
            <div class="heading-tools no-print">
                <button class="btn btn-sm btn-outline-light" type="button" onclick="window.print()"><i class="fa-solid fa-print me-1"></i> طباعة</button>
                <button class="btn btn-sm btn-outline-light" type="button" onclick="window.print()"><i class="fa-regular fa-file-pdf me-1"></i> تحميل PDF</button>
            </div>
        </div>
        <div class="table-tools no-print">
            <div class="action-buttons">
                <a class="btn btn-sm btn-outline-light" href="{{ route('consultations.create') }}" title="إضافة استشارة" aria-label="إضافة استشارة"><i class="fa-solid fa-plus"></i></a>
                <button class="btn btn-sm btn-outline-light" id="editSelected" type="button" title="تعديل المحدد" aria-label="تعديل الاستشارة المحددة" disabled><i class="fa-solid fa-pen"></i></button>
                <form id="bulkDeleteForm" action="{{ route('consultations.bulk-destroy') }}" method="POST" onsubmit="return confirm('هل تريد حذف الاستشارات المحددة؟')">
                    @csrf
                    @method('DELETE')
                    <div id="selectedConsultationInputs"></div>
                    <button class="btn btn-sm btn-outline-light" id="deleteSelected" type="submit" title="حذف المحدد" aria-label="حذف الاستشارات المحددة" disabled><i class="fa-solid fa-trash"></i></button>
                </form>
            </div>
            <div class="filters">
                <form action="{{ route('consultations.index') }}" method="GET">
                    <select class="form-select form-select-sm filter-select" name="type" aria-label="تصفية حسب النوع">
                        <option value="">كل الأنواع</option>
                        @foreach($types as $type)
                            <option value="{{ $type }}" @selected(request('type') === $type)>{{ $type }}</option>
                        @endforeach
                    </select>
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
            <table class="table table-hover consultation-table text-center align-middle">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll" aria-label="تحديد الكل"></th>
                        <th>الاستشارة</th>
                        <th>البلد</th>
                        <th>العميل</th>
                        <th>قسم الاستشارة</th>
                        <th>التاريخ</th>
                        <th>المحامي</th>
                        <th>النوع</th>
                        <th>الحالة</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($consultations as $consultation)
                        <tr>
                            <td><input class="consultation-select" type="checkbox" value="{{ $consultation->id }}" data-edit-url="{{ route('consultations.edit', $consultation->id) }}" aria-label="تحديد الاستشارة رقم {{ $consultation->id }}"></td>
                            <td>استشارة {{ $consultation->id }}</td>
                            <td>{{ $consultation->country ?: ($consultation->client_country ?: '-') }}</td>
                            <td>{{ $consultation->client_name ?: '-' }}</td>
                            <td>{{ $consultation->specialization ?: $consultation->subject ?: '-' }}</td>
                            <td>{{ $consultation->consultation_date ? \Illuminate\Support\Carbon::parse($consultation->consultation_date)->format('d/m/Y') : \Illuminate\Support\Carbon::parse($consultation->created_at)->format('d/m/Y') }}</td>
                            <td>{{ $consultation->lawyer_name ?: '-' }}</td>
                            <td>{{ $consultation->consultation_type ?: '-' }}</td>
                            <td><span class="badge {{ $consultation->status === 'مغلقة' ? 'bg-success' : ($consultation->status === 'تم الرد' ? 'bg-primary' : 'bg-secondary') }}">{{ $consultation->status }}</span></td>
                            <td><a class="row-action d-inline-flex align-items-center justify-content-center" href="{{ route('consultations.edit', $consultation->id) }}" aria-label="تعديل الاستشارة رقم {{ $consultation->id }}"><i class="fa-solid fa-pen"></i></a></td>
                            <td>
                                <form action="{{ route('consultations.destroy', $consultation->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف الاستشارة؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="row-action" type="submit" aria-label="حذف الاستشارة رقم {{ $consultation->id }}"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="11" class="py-5 text-muted">لا توجد استشارات قانونية مسجلة حاليًا.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pager">
            <span>{{ $consultations->total() }} من النتائج</span>
            {{ $consultations->links() }}
        </div>
    </section>
</main>

<script>
    const consultationCharts = @json($charts);
    const chartColors = ['#8b6a3a', '#fff', '#4a7fb5', '#8a1f3d'];
    Chart.defaults.font.family = 'Cairo';
    const chartTicks = { color: '#fff', font: { size: 9 } };

    new Chart(document.getElementById('consultationCountChart'), {
        type: 'line',
        data: {
            labels: consultationCharts.labels,
            datasets: [{
                data: consultationCharts.daily,
                borderColor: '#8b6a3a',
                backgroundColor: 'rgba(139,106,58,.65)',
                fill: true,
                tension: .35,
                pointRadius: 2,
                borderWidth: 1.5
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { ticks: chartTicks, grid: { color: 'rgba(255,255,255,.35)' } },
                y: { beginAtZero: true, ticks: { ...chartTicks, precision: 0 }, grid: { color: 'rgba(255,255,255,.35)' } }
            }
        }
    });

    new Chart(document.getElementById('consultationTypeChart'), {
        type: 'pie',
        data: {
            labels: consultationCharts.typeLabels,
            datasets: [{
                data: consultationCharts.typeValues,
                backgroundColor: chartColors,
                borderColor: '#1a2148'
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'left', labels: { color: '#dce1f3', boxWidth: 8, font: { size: 9 } } }
            }
        }
    });

    const consultationCheckboxes = Array.from(document.querySelectorAll('.consultation-select'));
    const selectAll = document.getElementById('selectAll');
    const editSelected = document.getElementById('editSelected');
    const deleteSelected = document.getElementById('deleteSelected');

    function updateSelection() {
        const selected = consultationCheckboxes.filter((checkbox) => checkbox.checked);
        editSelected.disabled = selected.length !== 1;
        deleteSelected.disabled = selected.length === 0;
        selectAll.checked = consultationCheckboxes.length > 0 && selected.length === consultationCheckboxes.length;
        selectAll.indeterminate = selected.length > 0 && selected.length < consultationCheckboxes.length;
    }

    consultationCheckboxes.forEach((checkbox) => checkbox.addEventListener('change', updateSelection));
    selectAll.addEventListener('change', () => {
        consultationCheckboxes.forEach((checkbox) => { checkbox.checked = selectAll.checked; });
        updateSelection();
    });
    editSelected.addEventListener('click', () => {
        const selected = consultationCheckboxes.find((checkbox) => checkbox.checked);
        if (selected) window.location.href = selected.dataset.editUrl;
    });
    document.getElementById('bulkDeleteForm').addEventListener('submit', (event) => {
        const selected = consultationCheckboxes.filter((checkbox) => checkbox.checked);
        if (selected.length === 0) {
            event.preventDefault();
            return;
        }

        document.getElementById('selectedConsultationInputs').replaceChildren(...selected.map((checkbox) => {
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
