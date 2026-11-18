<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>المهام والأعمال - TCMG</title>
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
            <a href="/tasks" class="active"><i class="fa-solid fa-list-check me-2"></i> المهام والأعمال</a>
            <a href="/employees"><i class="fa-solid fa-user-gear me-2"></i> الموارد البشرية</a>
            <a href="/vacations"><i class="fa-solid fa-clock-rotate-left me-2"></i> الإجازات</a>
            <a href="/permissions"><i class="fa-solid fa-lock me-2"></i> صلاحيات الدخول</a>
            <a href="/consultations"><i class="fa-solid fa-gavel me-2"></i> الاستشارات القانونية</a>
            <a href="/settings"><i class="fa-solid fa-gear me-2"></i> النظام</a>
        </div>

        <!-- المحتوى الرئيسي (يسار) -->
        <div class="col-md-10 p-4">
            @include('partials.topbar')
            <h2 class="mb-4 fw-bold text-center"><i class="fa-solid fa-list-check me-2 text-danger"></i> جدول المهام والأعمال</h2>

            @if(session('success'))
                <div class="alert alert-success bg-dark text-success border-success mb-4">{{ session('success') }}</div>
            @endif

            <!-- نموذج إضافة مهمة جديدة في أعلى الصفحة -->
            <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content text-end">
                        <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                            <div class="modal-header"><h2 id="addTaskTitle" class="modal-title">إضافة مهمة جديدة</h2><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="إغلاق"></button></div>
                            <div class="modal-body"><div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">عنوان المهمة</label>
                        <input type="text" name="title" class="form-control" placeholder="صياغة مذكرة الدفاع للقضية #104" required autocomplete="off">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">المكلف بالمهمة</label>
                        <input type="text" name="assigned_to" class="form-control" placeholder="محمد حسن" required autocomplete="off">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">تاريخ الاستحقاق</label>
                        <input type="date" name="due_date" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">الأولوية</label>
                        <select name="priority" class="form-select">
                            <option value="عالية">عالية</option>
                            <option value="متوسطة">متوسطة</option>
                            <option value="منخفضة">منخفضة</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">الحالة</label>
                        <select name="status" class="form-select">
                            <option value="قيد التنفيذ">قيد التنفيذ</option>
                            <option value="مكتملة">مكتملة</option>
                            <option value="متوقفة">متوقفة</option>
                        </select>
                    </div>
                            </div></div>
                            <div class="modal-footer"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إلغاء</button><button type="submit" class="btn btn-warning"><i class="fa-solid fa-floppy-disk"></i> حفظ المهمة</button></div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- جدول عرض المهام المسجلة -->
            <div class="card p-4 shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-3"><h4 class="text-danger mb-0">المهام الحالية والمستندة</h4><button class="btn btn-sm btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#addTaskModal" aria-label="إضافة مهمة"><i class="fa-solid fa-plus"></i></button></div>
                <table class="table table-dark table-hover mb-0 text-center align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان المهمة</th>
                            <th>المكلف بالمهمة</th>
                            <th>تاريخ الاستحقاق</th>
                            <th>الأولوية</th>
                            <th>الحالة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($tasks)
                            @foreach($tasks as $item)
                                <tr>
                                    <td>{{ $item->id ?? $loop->iteration }}</td>
                                    <td>{{ $item->title ?? '-' }}</td>
                                    <td>{{ $item->assigned_to ?? '-' }}</td>
                                    <td>{{ $item->due_date ?? '-' }}</td>
                                    <td>
                                        <span class="badge {{ ($item->priority == 'عالية') ? 'bg-danger' : 'bg-warning text-dark' }}">
                                            {{ $item->priority ?? 'عادية' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ ($item->status == 'مكتملة') ? 'bg-success' : 'bg-info text-dark' }}">
                                            {{ $item->status ?? 'قيد التنفيذ' }}
                                        </span>
                                    </td>
                                    <td>
                                        <!-- زر التعديل (يفتح نافذة منبثقة Modal) -->
                                        <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#editTaskModal{{ $item->id }}" title="تعديل">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <!-- زر الحذف الحقيقي -->
                                        <a href="{{ route('tasks.delete', $item->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذه المهمة؟')" title="حذف">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                                <!-- نافذة التعديل المنبثقة لكل مهمة -->
                                <div class="modal fade" id="editTaskModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content text-end">
                                            <form action="{{ route('tasks.update', $item->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-header border-secondary">
                                                    <h5 class="modal-title text-warning">تعديل المهمة: {{ $item->title }}</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">عنوان المهمة</label>
                                                        <input type="text" name="title" value="{{ $item->title }}" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">المكلف بالمهمة</label>
                                                        <input type="text" name="assigned_to" value="{{ $item->assigned_to }}" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">تاريخ الاستحقاق</label>
                                                        <input type="date" name="due_date" value="{{ $item->due_date }}" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">الأولوية</label>
                                                        <select name="priority" class="form-select">
                                                            <option value="عالية" {{ ($item->priority == 'عالية') ? 'selected' : '' }}>عالية</option>
                                                            <option value="متوسطة" {{ ($item->priority == 'متوسطة') ? 'selected' : '' }}>متوسطة</option>
                                                            <option value="منخفضة" {{ ($item->priority == 'منخفضة') ? 'selected' : '' }}>منخفضة</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">الحالة</label>
                                                        <select name="status" class="form-select">
                                                            <option value="قيد التنفيذ" {{ ($item->status == 'قيد التنفيذ') ? 'selected' : '' }}>قيد التنفيذ</option>
                                                            <option value="مكتملة" {{ ($item->status == 'مكتملة') ? 'selected' : '' }}>مكتملة</option>
                                                            <option value="متوقفة" {{ ($item->status == 'متوقفة') ? 'selected' : '' }}>متوقفة</option>
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
                                <td colspan="7" class="text-muted">لا توجد مهام مسجلة حالياً.</td>
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