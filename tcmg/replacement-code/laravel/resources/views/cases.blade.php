<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>القضايا - TCMG</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #0d1117; color: #c9d1d9; font-family: Tahoma, sans-serif; overflow-x: hidden; }
        .sidebar { background-color: #161b22; min-height: 100vh; border-left: 1px solid #30363d; }
        .sidebar a { color: #8b949e; text-decoration: none; padding: 12px 20px; display: block; transition: 0.2s; }
        .sidebar a:hover, .sidebar a.active { background-color: #21262d; color: #58a6ff; }
        .card, .table, .modal-content { background-color: #161b22; color: #c9d1d9; border-color: #30363d !important; }
        .form-control, .form-select { background-color: #0d1117; border-color: #30363d; color: #fff; }
        .form-control:focus { background-color: #0d1117; color: #fff; border-color: #58a6ff; box-shadow: none; }
    </style>
    <link rel="stylesheet" href="{{ asset('css/figma-replacement.css') }}">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- القائمة الجانبية (يمين) -->
        <div class="col-md-2 sidebar p-0">
            <h4 class="text-center py-4 text-white border-bottom border-secondary mb-0 fw-bold">TCMG ✦</h4>
            <a href="/dashboard"><i class="fa-solid fa-house me-2"></i> الصفحة الرئيسية</a>
            <a href="/contacts"><i class="fa-solid fa-phone me-2"></i> الاتصال</a>
            <a href="/clients"><i class="fa-solid fa-users me-2"></i> العملاء</a>
            <a href="/cases" class="active"><i class="fa-solid fa-briefcase me-2"></i> القضايا</a>
            <a href="/court"><i class="fa-solid fa-scale-balanced me-2"></i> المحكمة</a>
            <a href="/tasks"><i class="fa-solid fa-list-check me-2"></i> المهام والأعمال</a>
            <a href="/employees"><i class="fa-solid fa-user-gear me-2"></i> الموارد البشرية</a>
            <a href="/vacations"><i class="fa-solid fa-clock-rotate-left me-2"></i> الإجازات</a>
            <a href="/permissions"><i class="fa-solid fa-lock me-2"></i> صلاحيات الدخول</a>
            <a href="/consultations"><i class="fa-solid fa-gavel me-2"></i> الاستشارات القانونية</a>
            <a href="/settings"><i class="fa-solid fa-gear me-2"></i> النظام</a>
        </div>

        <!-- المحتوى الرئيسي (يسار) -->
        <div class="col-md-10 p-4">
            @include('partials.topbar')
            <h2 class="mb-4 fw-bold text-center"><i class="fa-solid fa-briefcase me-2 text-primary"></i> سجل القضايا</h2>
            
            @if(session('success'))
                <div class="alert alert-success bg-dark text-success border-success mb-4">{{ session('success') }}</div>
            @endif

            <section class="cases-dashboard" aria-label="ملخص القضايا">
                <div class="cases-dashboard-row cases-dashboard-wide">
                    <article class="card cases-chart-card">
                        <div class="cases-chart-heading">
                            <div><h2>القضايا</h2><span>القضايا النشطة والمغلقة</span></div>
                            <div class="cases-chart-legend"><span><i class="gold-dot"></i> نشطة</span><span><i class="white-dot"></i> مغلقة</span></div>
                        </div>
                        <svg viewBox="0 0 640 220" role="img" aria-label="مخطط القضايا النشطة والمغلقة">
                            <g class="chart-grid"><path d="M52 24H620 M52 66H620 M52 108H620 M52 150H620 M52 192H620 M52 24V192 M166 24V192 M280 24V192 M394 24V192 M508 24V192 M620 24V192"/></g>
                            <g class="chart-labels"><text x="43" y="28">100</text><text x="43" y="70">75</text><text x="43" y="112">50</text><text x="43" y="154">25</text><text x="43" y="196">0</text><text x="52" y="214">يناير</text><text x="166" y="214">فبراير</text><text x="280" y="214">مارس</text><text x="394" y="214">أبريل</text><text x="508" y="214">مايو</text><text x="620" y="214">يونيو</text></g>
                            <path class="case-line-gold" d="M52 140L108 96L166 130L222 58L280 108L338 82L394 36L452 48L508 108L564 92L620 88"/>
                            <path class="case-line-white" d="M52 72L108 132L166 74L222 66L280 128L338 66L394 54L452 76L508 150L564 110L620 120"/>
                        </svg>
                    </article>
                    <article class="card cases-chart-card closure-chart">
                        <div class="cases-chart-heading"><div><h2>نسبة إغلاق القضايا</h2><span>معدل الإنجاز</span></div></div>
                        <div class="closure-ring"><div><strong>76.2%</strong><span>نسبة الإغلاق</span></div></div>
                    </article>
                </div>
                <div class="cases-dashboard-row cases-dashboard-narrow">
                    <article class="card cases-chart-card">
                        <div class="cases-chart-heading"><div><h2>حالات القضايا</h2><span>توزيع القضايا حسب الحالة</span></div></div>
                        <div class="case-status-layout">
                            <svg viewBox="0 0 180 180" role="img" aria-label="توزيع حالات القضايا"><path fill="#a67c3c" d="M90 90V16A74 74 0 0 1 159 64Z"/><path fill="#a7495a" d="M90 90L159 64A74 74 0 0 1 105 163Z"/><path fill="#edf1fa" d="M90 90L105 163A74 74 0 0 1 26 74Z"/><path fill="#4c70c7" d="M90 90L26 74A74 74 0 0 1 90 16Z"/></svg>
                            <div class="cases-chart-legend"><span><i class="gold-dot"></i> نشطة</span><span><i class="white-dot"></i> مكتملة</span><span><i class="red-dot"></i> معلقة</span></div>
                        </div>
                    </article>
                    <article class="card cases-chart-card">
                        <div class="cases-chart-heading"><div><h2>نشاط القضايا</h2><span>مؤشر متابعة القضايا</span></div></div>
                        <svg viewBox="0 0 640 220" role="img" aria-label="مخطط متابعة نشاط القضايا"><g class="chart-grid"><path d="M52 24H620 M52 66H620 M52 108H620 M52 150H620 M52 192H620 M52 24V192 M166 24V192 M280 24V192 M394 24V192 M508 24V192 M620 24V192"/></g><g class="chart-labels"><text x="43" y="28">100</text><text x="43" y="70">75</text><text x="43" y="112">50</text><text x="43" y="154">25</text><text x="43" y="196">0</text><text x="52" y="214">١</text><text x="166" y="214">٢</text><text x="280" y="214">٣</text><text x="394" y="214">٤</text><text x="508" y="214">٥</text><text x="620" y="214">٦</text></g><path class="case-area-fill" d="M52 174C100 170 114 162 166 152S224 128 280 102S340 58 394 52S452 46 508 38S574 33 620 27V192H52Z"/><path class="case-area-line" d="M52 174C100 170 114 162 166 152S224 128 280 102S340 58 394 52S452 46 508 38S574 33 620 27"/></svg>
                    </article>
                </div>
            </section>

            <div class="modal fade" id="addCaseModal" tabindex="-1" aria-labelledby="addCaseTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content text-end">
                        <form action="{{ route('cases.store') }}" method="POST">
                @csrf
                            <div class="modal-header">
                                <h2 id="addCaseTitle" class="modal-title">إضافة قضية جديدة</h2>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">رقم القضية</label>
                        <input type="text" name="case_number" class="form-control" placeholder="مثال: CASE-992#" required autocomplete="off">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">اسم الموكل</label>
                        <input type="text" name="client_name" class="form-control" placeholder="أدخل اسم الموكل..." required autocomplete="off">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">نوع القضية</label>
                        <input type="text" name="case_type" class="form-control" placeholder="تجاري / تعاقدات..." required autocomplete="off">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">المحامي المسؤول</label>
                        <input type="text" name="lawyer_name" class="form-control" placeholder="اسم المحامي..." required autocomplete="off">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">الحالة</label>
                        <select name="status" class="form-select">
                            <option value="نشطة">نشطة</option>
                            <option value="مغلقة">مغلقة</option>
                            <option value="قيد المراجعة">قيد المراجعة</option>
                        </select>
                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إلغاء</button>
                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> حفظ القضية</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- جدول عرض القضايا المسجلة -->
            <div class="card module-table-card">
                <div class="module-table-toolbar">
                    <button class="btn btn-sm btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#addCaseModal" aria-label="إضافة قضية" title="إضافة قضية"><i class="fa-solid fa-plus"></i></button>
                    <h2>القضايا</h2>
                    <input class="form-control module-search" type="search" placeholder="Search..." aria-label="بحث في القضايا" oninput="document.querySelectorAll('#casesTable tbody tr').forEach(row => row.hidden = !row.textContent.toLowerCase().includes(this.value.toLowerCase()))">
                </div>
                <div class="table-responsive">
                <table class="table table-dark table-hover mb-0 text-center align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>رقم القضية</th>
                            <th>اسم الموكل</th>
                            <th>نوع القضية</th>
                            <th>المحامي المسؤول</th>
                            <th>الحالة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($cases)
                            @foreach($cases as $item)
                                <tr>
                                    <td>{{ $item->id ?? $loop->iteration }}</td>
                                    <td>{{ $item->case_number ?? '-' }}</td>
                                    <td>{{ $item->client_name ?? '-' }}</td>
                                    <td>{{ $item->case_type ?? '-' }}</td>
                                    <td>{{ $item->lawyer_name ?? '-' }}</td>
                                    <td>
                                        <span class="badge {{ ($item->status == 'نشطة') ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $item->status ?? 'نشطة' }}
                                        </span>
                                    </td>
                                    <td>
                                        <!-- زر التعديل (يفتح نافذة منبثقة Modal) -->
                                        <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#editCaseModal{{ $item->id }}" title="تعديل">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <!-- زر الحذف الحقيقي -->
                                        <a href="{{ route('cases.delete', $item->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذه القضية؟')" title="حذف">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                                <!-- نافذة التعديل المنبثقة لكل قضية -->
                                <div class="modal fade" id="editCaseModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content text-end">
                                            <form action="{{ route('cases.update', $item->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-header border-secondary">
                                                    <h5 class="modal-title text-warning">تعديل القضية رقم: {{ $item->case_number }}</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">رقم القضية</label>
                                                        <input type="text" name="case_number" value="{{ $item->case_number }}" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">اسم الموكل</label>
                                                        <input type="text" name="client_name" value="{{ $item->client_name }}" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">نوع القضية</label>
                                                        <input type="text" name="case_type" value="{{ $item->case_type }}" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">المحامي المسؤول</label>
                                                        <input type="text" name="lawyer_name" value="{{ $item->lawyer_name }}" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">الحالة</label>
                                                        <select name="status" class="form-select">
                                                            <option value="نشطة" {{ ($item->status == 'نشطة') ? 'selected' : '' }}>نشطة</option>
                                                            <option value="مغلقة" {{ ($item->status == 'مغلقة') ? 'selected' : '' }}>مغلقة</option>
                                                            <option value="قيد المراجعة" {{ ($item->status == 'قيد المراجعة') ? 'selected' : '' }}>قيد المراجعة</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-secondary">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                                    <button type="submit" class="btn btn-warning fw-bold">حفظ التعديلات</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-muted">لا توجد قضايا مسجلة حالياً.</td>
                            </tr>
                        @endisset
                    </tbody>
                </table>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JS لتشغيل نوافذ التعديل -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>