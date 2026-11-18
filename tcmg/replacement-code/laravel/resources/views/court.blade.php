<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>المحكمة والجلسات - TCMG</title>
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
            <a href="/cases"><i class="fa-solid fa-briefcase me-2"></i> القضايا</a>
            <a href="/court" class="active"><i class="fa-solid fa-scale-balanced me-2"></i> المحكمة</a>
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
            <h2 class="mb-4 fw-bold text-center"><i class="fa-solid fa-scale-balanced me-2 text-info"></i> جدول جلسات المحكمة</h2>

            @if(session('success'))
                <div class="alert alert-success bg-dark text-success border-success mb-4">{{ session('success') }}</div>
            @endif

            <!-- نموذج إضافة جلسة جديدة في أعلى الصفحة -->
            <div class="modal fade" id="addCourtModal" tabindex="-1" aria-labelledby="addCourtTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content text-end">
                        <form action="{{ route('court.store') }}" method="POST">
                @csrf
                            <div class="modal-header"><h2 id="addCourtTitle" class="modal-title">إضافة جلسة جديدة</h2><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="إغلاق"></button></div>
                            <div class="modal-body"><div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">رقم القضية</label>
                        <input type="text" name="case_number" class="form-control" placeholder="مثال: CASE-104#" required autocomplete="off">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">المحكمة / الدائرة</label>
                        <input type="text" name="court_name" class="form-control" placeholder="محكمة الاستئناف - الدائرة 3" required autocomplete="off">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">تاريخ الجلسة</label>
                        <input type="date" name="session_date" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">المحامي الحاضر</label>
                        <input type="text" name="lawyer_name" class="form-control" placeholder="أدخل اسم المحامي..." required autocomplete="off">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">القرار / المتطلبات</label>
                        <input type="text" name="decision" class="form-control" placeholder="تقديم المذكرة الختامية..." required autocomplete="off">
                    </div>
                            </div></div>
                            <div class="modal-footer"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إلغاء</button><button type="submit" class="btn btn-warning"><i class="fa-solid fa-floppy-disk"></i> حفظ الجلسة</button></div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- جدول عرض الجلسات المسجلة -->
            <div class="card p-4 shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-3"><h4 class="text-info mb-0">الجلسات القادمة والسابقة</h4><button class="btn btn-sm btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#addCourtModal" aria-label="إضافة جلسة"><i class="fa-solid fa-plus"></i></button></div>
                <table class="table table-dark table-hover mb-0 text-center align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>رقم القضية</th>
                            <th>المحكمة / الدائرة</th>
                            <th>تاريخ الجلسة</th>
                            <th>المحامي الحاضر</th>
                            <th>القرار / المتطلبات</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($court_sessions)
                            @foreach($court_sessions as $item)
                                <tr>
                                    <td>{{ $item->id ?? $loop->iteration }}</td>
                                    <td>{{ $item->case_number ?? '-' }}</td>
                                    <td>{{ $item->court_name ?? '-' }}</td>
                                    <td>{{ $item->session_date ?? '-' }}</td>
                                    <td>{{ $item->lawyer_name ?? '-' }}</td>
                                    <td>{{ $item->decision ?? '-' }}</td>
                                    <td>
                                        <!-- زر التعديل (يفتح نافذة منبثقة Modal) -->
                                        <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#editCourtModal{{ $item->id }}" title="تعديل">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <!-- زر الحذف الحقيقي -->
                                        <a href="{{ route('court.delete', $item->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذه الجلسة؟')" title="حذف">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                                <!-- نافذة التعديل المنبثقة لكل جلسة -->
                                <div class="modal fade" id="editCourtModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content text-end">
                                            <form action="{{ route('court.update', $item->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-header border-secondary">
                                                    <h5 class="modal-title text-warning">تعديل جلسة القضية: {{ $item->case_number }}</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">رقم القضية</label>
                                                        <input type="text" name="case_number" value="{{ $item->case_number }}" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">المحكمة / الدائرة</label>
                                                        <input type="text" name="court_name" value="{{ $item->court_name }}" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">تاريخ الجلسة</label>
                                                        <input type="date" name="session_date" value="{{ $item->session_date }}" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">المحامي الحاضر</label>
                                                        <input type="text" name="lawyer_name" value="{{ $item->lawyer_name }}" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">القرار / المتطلبات</label>
                                                        <input type="text" name="decision" value="{{ $item->decision }}" class="form-control" required>
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
                                <td colspan="7" class="text-muted">لا توجد جلسات مسجلة حالياً.</td>
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