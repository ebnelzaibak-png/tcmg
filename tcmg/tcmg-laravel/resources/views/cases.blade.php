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
    <link rel="stylesheet" href="{{ asset('css/figma-dashboard.css') }}">
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

            <!-- نموذج إضافة قضية جديدة (خانات الإدخال في أعلى الصفحة) -->
            <form action="{{ route('cases.store') }}" method="POST" class="card p-4 mb-4 shadow-sm">
                @csrf
                <h5 class="mb-3 text-primary"><i class="fa-solid fa-plus-circle me-1"></i> إضافة قضية جديدة</h5>
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
                <button type="submit" class="btn btn-primary text-white fw-bold"><i class="fa-solid fa-save me-1"></i> حفظ القضية</button>
            </form>

            <!-- جدول عرض القضايا المسجلة -->
            <div class="card p-4 shadow-sm">
                <h4 class="text-primary mb-3">جميع القضايا المسجلة</h4>
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

<!-- Bootstrap JS لتشغيل نوافذ التعديل -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>