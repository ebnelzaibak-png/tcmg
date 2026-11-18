<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>المهام والأعمال - TCMG</title>
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
        .charts-top{display:grid;grid-template-columns:.7fr 1.65fr;gap:16px;margin-bottom:16px;direction:ltr}
        .chart-card{direction:rtl;min-width:0;min-height:190px}
        .card-dark{background:var(--panel);border:1px solid #0b1027;border-radius:6px;padding:16px}
        .card-title{font-size:18px;font-weight:700;margin:0}
        .sub{font-size:11px;color:var(--muted)}
        .legend{display:flex;gap:14px;flex-wrap:wrap;font-size:11px;color:var(--muted)}
        .legend i{display:inline-block;width:9px;height:9px;border-radius:50%;margin-inline-end:5px}
        .chart-box{position:relative;height:155px;margin-top:8px}
        .doughnut-box{position:relative;width:145px;height:145px;margin:6px auto}
        .doughnut-center{position:absolute;inset:0;display:flex;flex-direction:column;justify-content:center;align-items:center;text-align:center;pointer-events:none;font-size:11px}
        .doughnut-center strong{font-size:18px}
        .overall-card{margin-bottom:16px}
        .tasks-card{padding:0;overflow:hidden}
        .tasks-title{padding:14px 18px;border-bottom:1px solid #8990aa;font-size:20px;font-weight:700}
        .table-tools{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:12px 16px}
        .action-buttons,.filters{display:flex;align-items:center;gap:8px}
        .action-buttons .btn{width:34px;height:32px;padding:4px}
        .action-buttons form{margin:0}
        .filter-input,.filter-select{background:#151c3d!important;color:#fff!important;border-color:#687294!important;font-family:inherit;font-size:12px!important}
        .filter-input::placeholder{color:var(--muted)}
        .tasks-table{margin:0;color:#fff;--bs-table-bg:transparent;--bs-table-color:#fff;--bs-table-border-color:#30385f;--bs-table-hover-bg:#222a58}
        .tasks-table th{color:#c3c9df;font-size:11px;font-weight:600;white-space:nowrap}
        .tasks-table td{font-size:12px;vertical-align:middle;white-space:nowrap}
        .tasks-table input[type=checkbox]{accent-color:#5375ff}
        .row-action{border:1px solid #9aa3c7;color:#fff;background:transparent;width:30px;height:28px;border-radius:4px}
        .row-action:hover{background:#fff;color:#10153a}
        .pager{display:flex;align-items:center;justify-content:space-between;padding:14px 18px;color:var(--muted);font-size:11px}
        .pager .pagination{margin:0}
        .pagination .page-link{background:transparent;color:#c3c9df;border-color:#30385f;font-size:11px}
        .pagination .active .page-link{background:#5375ff;border-color:#5375ff;color:#fff}
        @media(max-width:1050px){.main{padding:16px}.charts-top{grid-template-columns:.8fr 1.4fr}}
        @media(max-width:760px){.sidebar{display:none}.main{margin-right:0}.charts-top{grid-template-columns:1fr}}
        @media(max-width:650px){.main{padding:12px}.topbar-tools:nth-child(2){display:none}.table-tools{align-items:stretch;flex-direction:column}.filters form{width:100%;flex-wrap:wrap}.filter-input{width:100%!important}.tasks-table{min-width:720px}.pager{gap:12px;flex-wrap:wrap}}
        @media print{body{background:#fff;color:#000}.sidebar,.topbar,.charts-top,.overall-card,.table-tools,.no-print{display:none!important}.main{margin:0;padding:0}.tasks-card{border:0;background:#fff}.tasks-table{color:#000!important;--bs-table-color:#000;--bs-table-border-color:#888}.tasks-title{color:#000;border-color:#888}}
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
        <a class="nav-link active" href="{{ route('tasks.index') }}"><i class="fa-solid fa-check"></i> المهام و الأعمال</a>
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
        <div class="search-help"><input type="search" placeholder="كيف يمكنني مساعدتك؟" aria-label="كيف يمكنني مساعدتك؟"></div>
    </header>

    @if(session('success'))
        <div class="alert alert-success text-end">{{ session('success') }}</div>
    @endif

    <section class="charts-top">
        <article class="card-dark chart-card">
            <h2 class="card-title text-center">نسبة المهام المكتملة</h2>
            <div class="doughnut-box">
                <canvas id="completionChart"></canvas>
                <div class="doughnut-center"><span>المهام المكتملة</span><strong>{{ $charts['completionRate'] }}%</strong></div>
            </div>
        </article>
        <article class="card-dark chart-card">
            <div class="d-flex justify-content-between align-items-start gap-3">
                <div>
                    <h1 class="card-title">المهام</h1>
                    <div class="sub">آخر 10 أيام</div>
                </div>
                <div class="legend">
                    <span><i style="background:var(--gold)"></i>قيد التنفيذ</span>
                    <span><i style="background:#fff"></i>مكتملة</span>
                </div>
            </div>
            <div class="chart-box"><canvas id="tasksChart"></canvas></div>
        </article>
    </section>

    <section class="card-dark chart-card overall-card">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h2 class="card-title">إجمالي الأعمال</h2>
                <div class="sub">عدد المهام المسجلة خلال آخر 10 أيام</div>
            </div>
        </div>
        <div class="chart-box"><canvas id="overallChart"></canvas></div>
    </section>

    <section class="card-dark tasks-card">
        <div class="tasks-title d-flex justify-content-between align-items-center gap-2">
            <span>المهام و الأعمال</span>
            <div class="d-flex gap-2 no-print">
                <button class="btn btn-sm btn-outline-light" type="button" onclick="window.print()">طباعة</button>
                <button class="btn btn-sm btn-outline-light" type="button" onclick="window.print()">تحميل PDF</button>
            </div>
        </div>
        <div class="table-tools">
            <div class="action-buttons">
                <a class="btn btn-sm btn-outline-light" href="{{ route('tasks.create') }}" title="إضافة مهمة/عمل" aria-label="إضافة مهمة/عمل"><i class="fa-solid fa-plus"></i></a>
                <button class="btn btn-sm btn-outline-light" id="editSelected" type="button" title="تعديل المحدد" aria-label="تعديل المحدد" disabled><i class="fa-solid fa-pen"></i></button>
                <form id="bulkDeleteForm" action="{{ route('tasks.bulk-destroy') }}" method="POST" onsubmit="return confirm('هل تريد حذف المهام المحددة؟')">
                    @csrf
                    @method('DELETE')
                    <div id="selectedTaskInputs"></div>
                    <button class="btn btn-sm btn-outline-light" id="deleteSelected" type="submit" title="حذف المحدد" aria-label="حذف المحدد" disabled><i class="fa-solid fa-trash"></i></button>
                </form>
            </div>
            <div class="filters">
                <form action="{{ route('tasks.index') }}" method="GET" class="d-flex gap-2">
                    <select class="form-select form-select-sm filter-select" name="category" aria-label="تصفية حسب الفئة">
                        <option value="">كل الفئات</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" @selected(request('category') === $category)>{{ $category }}</option>
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
            <table class="table table-hover tasks-table text-center align-middle">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll" aria-label="تحديد الكل"></th>
                        <th>المهمة/العمل</th>
                        <th>البلد</th>
                        <th>الفئة</th>
                        <th>التاريخ</th>
                        <th>الحالة</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                        <tr>
                            <td><input class="task-select" type="checkbox" value="{{ $task->id }}" data-edit-url="{{ route('tasks.edit', $task->id) }}" aria-label="تحديد المهمة {{ $task->title }}"></td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->country ?: '-' }}</td>
                            <td>{{ $task->category ?: '-' }}</td>
                            <td>{{ $task->due_date ? \Illuminate\Support\Carbon::parse($task->due_date)->format('d/m/Y') : '-' }}</td>
                            <td>
                                @php
                                    $statusClass = match($task->status) {
                                        'مكتملة' => 'bg-success',
                                        'متوقفة' => 'bg-danger',
                                        default => 'bg-warning text-dark',
                                    };
                                @endphp
                                <span class="badge {{ $statusClass }}">{{ $task->status ?: 'قيد التنفيذ' }}</span>
                            </td>
                            <td><a class="row-action d-inline-flex align-items-center justify-content-center" href="{{ route('tasks.edit', $task->id) }}" aria-label="تعديل المهمة {{ $task->title }}"><i class="fa-solid fa-pen"></i></a></td>
                            <td>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذه المهمة؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="row-action" type="submit" aria-label="حذف المهمة {{ $task->title }}"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="py-5 text-muted">لا توجد مهام مسجلة. اضغط على (+) لإضافة مهمة أو عمل.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pager">
            <span>{{ $tasks->total() }} من النتائج</span>
            {{ $tasks->links() }}
        </div>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    const taskCharts = @json($charts);
    if (typeof Chart !== 'undefined') {
        const scales = {
            x: { ticks: { color: '#fff', font: { size: 9 } }, grid: { color: 'rgba(255,255,255,.25)' } },
            y: { beginAtZero: true, ticks: { color: '#fff', precision: 0, font: { size: 9 } }, grid: { color: 'rgba(255,255,255,.25)' } }
        };
        const chartOptions = { maintainAspectRatio: false, plugins: { legend: { display: false } }, scales };

        new Chart(document.getElementById('tasksChart'), {
            type: 'line',
            data: { labels: taskCharts.labels, datasets: [
                { label: 'قيد التنفيذ', data: taskCharts.active, borderColor: '#8b6a3a', backgroundColor: '#8b6a3a', pointRadius: 2 },
                { label: 'مكتملة', data: taskCharts.completed, borderColor: '#fff', backgroundColor: '#fff', pointRadius: 2 }
            ] },
            options: chartOptions
        });
        new Chart(document.getElementById('completionChart'), {
            type: 'doughnut',
            data: { datasets: [{ data: [taskCharts.completionRate, 100 - taskCharts.completionRate], backgroundColor: ['#8b6a3a', '#fff'], borderWidth: 0 }] },
            options: { maintainAspectRatio: false, cutout: '72%', plugins: { legend: { display: false } } }
        });
        new Chart(document.getElementById('overallChart'), {
            type: 'line',
            data: { labels: taskCharts.labels, datasets: [
                { label: 'إجمالي الأعمال', data: taskCharts.total, borderColor: '#8b6a3a', backgroundColor: '#8b6a3a66', fill: true, tension: 0.35, pointRadius: 2 }
            ] },
            options: chartOptions
        });
    }

    const taskCheckboxes = Array.from(document.querySelectorAll('.task-select'));
    const selectAll = document.getElementById('selectAll');
    const editSelected = document.getElementById('editSelected');
    const deleteSelected = document.getElementById('deleteSelected');

    function updateSelection() {
        const selected = taskCheckboxes.filter((checkbox) => checkbox.checked);
        editSelected.disabled = selected.length !== 1;
        deleteSelected.disabled = selected.length === 0;
        selectAll.checked = taskCheckboxes.length > 0 && selected.length === taskCheckboxes.length;
        selectAll.indeterminate = selected.length > 0 && selected.length < taskCheckboxes.length;
    }

    taskCheckboxes.forEach((checkbox) => checkbox.addEventListener('change', updateSelection));
    selectAll.addEventListener('change', () => {
        taskCheckboxes.forEach((checkbox) => { checkbox.checked = selectAll.checked; });
        updateSelection();
    });
    editSelected.addEventListener('click', () => {
        const selected = taskCheckboxes.find((checkbox) => checkbox.checked);
        if (selected) window.location.href = selected.dataset.editUrl;
    });
    document.getElementById('bulkDeleteForm').addEventListener('submit', (event) => {
        const selected = taskCheckboxes.filter((checkbox) => checkbox.checked);
        if (selected.length === 0) {
            event.preventDefault();
            return;
        }

        const inputs = document.getElementById('selectedTaskInputs');
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
