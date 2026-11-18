<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>الاستشارات القانونية - TCMG</title>
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
            <a href="/permissions"><i class="fa-solid fa-lock me-2"></i> صلاحيات الدخول</a>
            <a href="/consultations" class="active"><i class="fa-solid fa-gavel me-2"></i> الاستشارات القانونية</a>
            <a href="/settings"><i class="fa-solid fa-gear me-2"></i> النظام</a>
        </div>

        <!-- المحتوى الرئيسي (يسار) -->
        <div class="col-md-10 p-4">
            @include('partials.topbar')
            <h2 class="mb-4 fw-bold text-center"><i class="fa-solid fa-gavel me-2 text-warning"></i> سجل الاستشارات القانونية</h2>

            @if(session('success'))
                <div class="alert alert-dark text-success border-success mb-4">{{ session('success') }}</div>
            @endif

            <div class="modal fade" id="addConsultationModal" tabindex="-1" aria-labelledby="addConsultationTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content text-end">
                        <form action="{{ route('consultations.store') }}" method="POST">
                @csrf
                            <div class="modal-header">
                                <h2 id="addConsultationTitle" class="modal-title">إضافة استشارة قانونية</h2>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">رقم الاستشارة</label>
                        <input type="text" name="consultation_number" class="form-control" placeholder="CONS-502#" required autocomplete="off">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">الموكل / العميل</label>
                        <input type="text" name="client_name" class="form-control" placeholder="اسم العميل أو الشركة" required autocomplete="off">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">نوع الاستشارة</label>
                        <input type="text" name="consultation_type" class="form-control" placeholder="استشارة تعاقدية / تجارية" required autocomplete="off">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">المستشار المسؤول</label>
                        <input type="text" name="lawyer_name" class="form-control" placeholder="اسم المستشار المسؤول" required autocomplete="off">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">الحالة</label>
                        <select name="status" class="form-select">
                            <option value="مكتملة">مكتملة</option>
                            <option value="قيد الدراسة">قيد الدراسة</option>
                            <option value="معلقة">معلقة</option>
                        </select>
                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إلغاء</button>
                                <button type="submit" class="btn btn-warning"><i class="fa-solid fa-floppy-disk"></i> حفظ الاستشارة</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- جدول عرض الاستشارات القانونية المسجلة -->
            <div class="card module-table-card">
                <div class="module-table-toolbar">
                    <button class="btn btn-sm btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#addConsultationModal" aria-label="إضافة استشارة" title="إضافة استشارة"><i class="fa-solid fa-plus"></i></button>
                    <div class="module-table-filters">
                        <input id="consultationSearch" class="form-control module-search" type="search" placeholder="Search..." aria-label="بحث في الاستشارات">
                        <select id="consultationStatusFilter" class="form-select module-search" aria-label="تصفية حسب الحالة">
                            <option value="">كل الحالات</option>
                            <option value="مكتملة">مكتملة</option>
                            <option value="قيد الدراسة">قيد الدراسة</option>
                            <option value="معلقة">معلقة</option>
                        </select>
                    </div>
                    <h2>الاستشارات القانونية</h2>
                </div>
                <div class="table-responsive">
                <table class="table table-hover mb-0 text-center align-middle" id="consultationsTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>رقم الاستشارة</th>
                            <th>الموكل / العميل</th>
                            <th>نوع الاستشارة</th>
                            <th>المستشار المسؤول</th>
                            <th>الحالة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($consultations) && count($consultations) > 0)
                            @foreach($consultations as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="fw-bold text-white">{{ $item->consultation_number ?? '-' }}</td>
                                    <td>{{ $item->client_name ?? '-' }}</td>
                                    <td>{{ $item->consultation_type ?? '-' }}</td>
                                    <td>{{ $item->lawyer_name ?? '-' }}</td>
                                    <td>
                                        <span class="badge {{ ($item->status == 'مكتملة') ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $item->status ?? 'مكتملة' }}
                                        </span>
                                    </td>
                                    <td>
                                        <!-- زر التعديل (Modal) -->
                                        <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#editConsultationModal{{ $item->id }}" title="تعديل">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <!-- زر الحذف الحقيقي -->
                                        <a href="{{ route('consultations.delete', $item->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذه الاستشارة؟')" title="حذف">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                                <!-- نافذة التعديل المنبثقة لكل استشارة -->
                                <div class="modal fade" id="editConsultationModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content text-end">
                                            <form action="{{ route('consultations.update', $item->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-header border-secondary">
                                                    <h5 class="modal-title text-warning">تعديل الاستشارة: {{ $item->consultation_number }}</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">رقم الاستشارة</label>
                                                        <input type="text" name="consultation_number" value="{{ $item->consultation_number }}" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">الموكل / العميل</label>
                                                        <input type="text" name="client_name" value="{{ $item->client_name }}" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">نوع الاستشارة</label>
                                                        <input type="text" name="consultation_type" value="{{ $item->consultation_type }}" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">المستشار المسؤول</label>
                                                        <input type="text" name="lawyer_name" value="{{ $item->lawyer_name }}" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">الحالة</label>
                                                        <select name="status" class="form-select">
                                                            <option value="مكتملة" {{ ($item->status == 'مكتملة') ? 'selected' : '' }}>مكتملة</option>
                                                            <option value="قيد الدراسة" {{ ($item->status == 'قيد الدراسة') ? 'selected' : '' }}>قيد الدراسة</option>
                                                            <option value="معلقة" {{ ($item->status == 'معلقة') ? 'selected' : '' }}>معلقة</option>
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
                                <td colspan="7" class="text-muted">لا توجد استشارات قانونية مسجلة حالياً.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JS لتشغيل نوافذ التعديل -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const consultationSearch = document.getElementById('consultationSearch');
    const consultationStatusFilter = document.getElementById('consultationStatusFilter');
    const consultationRows = document.querySelectorAll('#consultationsTable tbody tr');

    function filterConsultations() {
        const searchTerm = consultationSearch.value.trim().toLocaleLowerCase('ar');
        const selectedStatus = consultationStatusFilter.value;

        consultationRows.forEach((row) => {
            const matchesSearch = row.textContent.toLocaleLowerCase('ar').includes(searchTerm);
            const status = row.querySelector('.badge')?.textContent.trim() ?? '';
            row.hidden = !matchesSearch || (selectedStatus && status !== selectedStatus);
        });
    }

    consultationSearch.addEventListener('input', filterConsultations);
    consultationStatusFilter.addEventListener('change', filterConsultations);
</script>
</body>
</html>