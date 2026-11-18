<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>صلاحيات الدخول - TCMG</title>
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
            <a href="/court"><i class="fa-solid fa-scale-balanced me-2"></i> المحكمة</a>
            <a href="/tasks"><i class="fa-solid fa-list-check me-2"></i> المهام والأعمال</a>
            <a href="/employees"><i class="fa-solid fa-user-gear me-2"></i> الموارد البشرية</a>
            <a href="/vacations"><i class="fa-solid fa-clock-rotate-left me-2"></i> الإجازات</a>
            <a href="/permissions" class="active"><i class="fa-solid fa-lock me-2"></i> صلاحيات الدخول</a>
            <a href="/consultations"><i class="fa-solid fa-gavel me-2"></i> الاستشارات القانونية</a>
            <a href="/settings"><i class="fa-solid fa-gear me-2"></i> النظام</a>
        </div>

        <!-- المحتوى الرئيسي (يسار) -->
        <div class="col-md-10 p-4">
            @include('partials.topbar')
            <h2 class="mb-4 fw-bold text-center"><i class="fa-solid fa-lock me-2 text-warning"></i> إدارة الصلاحيات والمجموعات</h2>

            @if(session('success'))
                <div class="alert alert-dark text-success border-success mb-4">{{ session('success') }}</div>
            @endif

            <!-- نموذج إضافة صلاحية جديدة -->
            <form action="{{ route('permissions.store') }}" method="POST" class="card p-4 mb-4 shadow-sm">
                @csrf
                <h5 class="mb-3 text-warning"><i class="fa-solid fa-plus-circle me-1"></i> إضافة صلاحية للقسم</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">اسم القسم / الموديول</label>
                        <input type="text" name="module_name" class="form-control" placeholder="مثال: القضايا" required autocomplete="off">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">عرض</label>
                        <select name="can_view" class="form-select">
                            <option value="1">نعم</option>
                            <option value="0">لا</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">إضافة</label>
                        <select name="can_add" class="form-select">
                            <option value="1">نعم</option>
                            <option value="0">لا</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">تعديل</label>
                        <select name="can_edit" class="form-select">
                            <option value="1">نعم</option>
                            <option value="0">لا</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">حذف</label>
                        <select name="can_delete" class="form-select">
                            <option value="1">نعم</option>
                            <option value="0">لا</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-warning text-dark fw-bold"><i class="fa-solid fa-save me-1"></i> حفظ الصلاحية</button>
            </form>

            <!-- جدول عرض الصلاحيات -->
            <div class="card p-4 shadow-sm">
                <h4 class="text-warning mb-3">قائمة الصلاحيات المسجلة</h4>
                <table class="table table-dark table-hover mb-0 text-center align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>القسم / الموديول</th>
                            <th>عرض</th>
                            <th>إضافة</th>
                            <th>تعديل</th>
                            <th>حذف</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($permissions) && count($permissions) > 0)
                            @foreach($permissions as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="fw-bold text-white">{{ $item->module_name ?? '-' }}</td>
                                    <td>{!! ($item->can_view == 1) ? '<span class="text-success">✔</span>' : '<span class="text-danger">✖</span>' !!}</td>
                                    <td>{!! ($item->can_add == 1) ? '<span class="text-success">✔</span>' : '<span class="text-danger">✖</span>' !!}</td>
                                    <td>{!! ($item->can_edit == 1) ? '<span class="text-success">✔</span>' : '<span class="text-danger">✖</span>' !!}</td>
                                    <td>{!! ($item->can_delete == 1) ? '<span class="text-success">✔</span>' : '<span class="text-danger">✖</span>' !!}</td>
                                    <td>
                                        <!-- زر التعديل (Modal) -->
                                        <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}" title="تعديل">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <!-- زر الحذف -->
                                        <a href="{{ route('permissions.delete', $item->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')" title="حذف">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                                <!-- نافذة التعديل -->
                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content text-end">
                                            <form action="{{ route('permissions.update', $item->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-header border-secondary">
                                                    <h5 class="modal-title text-warning">تعديل صلاحيات قسم: {{ $item->module_name }}</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">القسم / الموديول</label>
                                                        <input type="text" name="module_name" value="{{ $item->module_name }}" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">عرض</label>
                                                        <select name="can_view" class="form-select">
                                                            <option value="1" {{ ($item->can_view == 1) ? 'selected' : '' }}>نعم</option>
                                                            <option value="0" {{ ($item->can_view == 0) ? 'selected' : '' }}>لا</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">إضافة</label>
                                                        <select name="can_add" class="form-select">
                                                            <option value="1" {{ ($item->can_add == 1) ? 'selected' : '' }}>نعم</option>
                                                            <option value="0" {{ ($item->can_add == 0) ? 'selected' : '' }}>لا</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">تعديل</label>
                                                        <select name="can_edit" class="form-select">
                                                            <option value="1" {{ ($item->can_edit == 1) ? 'selected' : '' }}>نعم</option>
                                                            <option value="0" {{ ($item->can_edit == 0) ? 'selected' : '' }}>لا</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">حذف</label>
                                                        <select name="can_delete" class="form-select">
                                                            <option value="1" {{ ($item->can_delete == 1) ? 'selected' : '' }}>نعم</option>
                                                            <option value="0" {{ ($item->can_delete == 0) ? 'selected' : '' }}>لا</option>
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
                                <td colspan="7" class="text-muted">لا توجد صلاحيات مسجلة حالياً.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>