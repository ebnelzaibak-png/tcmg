<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>جهات الاتصال - TCMG</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #0b0f19; color: #c9d1d9; font-family: Tahoma, sans-serif; overflow-x: hidden; }
        .sidebar { background-color: #111622; min-height: 100vh; border-left: 1px solid #21262d; position: fixed; right: 0; top: 0; width: 16.666%; z-index: 100; }
        .sidebar a { color: #8b949e; text-decoration: none; padding: 12px 20px; display: block; transition: 0.2s; font-size: 14px; }
        .sidebar a:hover, .sidebar a.active { background-color: #1f2430; color: #58a6ff; }
        .main-content { margin-right: 16.666%; padding: 25px; }
        .top-navbar { background-color: #111622; border-bottom: 1px solid #21262d; padding: 12px 25px; border-radius: 10px; margin-bottom: 25px; }
        .section-card { background-color: #111622; border: 1px solid #21262d; border-radius: 12px; padding: 20px; color: #fff; margin-bottom: 25px; }
        .table-dark-custom { background-color: #111622; color: #fff; border-color: #21262d; }
        .form-control-custom { background-color: #0b0f19; border: 1px solid #21262d; color: #fff; border-radius: 8px; padding: 10px 15px 10px 40px; }
        .form-control-custom:focus { background-color: #0b0f19; color: #fff; border-color: #58a6ff; box-shadow: none; }
        .input-icon-wrapper { position: relative; }
        .input-icon-wrapper i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #8b949e; }
    </style>
    <link rel="stylesheet" href="{{ asset('css/figma-replacement.css') }}">
</head>
<body>

<div class="container-fluid p-0">
    <div class="row g-0">
        
        <!-- القائمة الجانبية (يمين) -->
        <div class="col-md-2 sidebar p-0">
            <div class="text-center py-4 border-bottom border-secondary mb-2">
                <h4 class="text-white fw-bold m-0" style="font-size: 20px;"><i class="fa-solid fa-scale-balanced text-warning me-1"></i> TCMG ✦</h4>
            </div>
            <a href="/dashboard"><i class="fa-solid fa-house me-2"></i> الصفحة الرئيسية</a>
            <a href="/contacts" class="active"><i class="fa-solid fa-phone me-2"></i> الاتصال</a>
            <a href="/clients"><i class="fa-solid fa-users me-2"></i> العملاء</a>
            <a href="/cases"><i class="fa-solid fa-briefcase me-2"></i> القضايا</a>
            <a href="/court"><i class="fa-solid fa-scale-balanced me-2"></i> المحكمة</a>
            <a href="/tasks"><i class="fa-solid fa-list-check me-2"></i> المهام والأعمال</a>
            <a href="/employees"><i class="fa-solid fa-user-gear me-2"></i> الموارد البشرية</a>
            <a href="/vacations"><i class="fa-solid fa-clock-rotate-left me-2"></i> الإجازات</a>
            <a href="/permissions"><i class="fa-solid fa-lock me-2"></i> صلاحيات الدخول</a>
            <a href="/consultations"><i class="fa-solid fa-gavel me-2"></i> الاستشارات القانونية</a>
            <a href="/settings"><i class="fa-solid fa-gear me-2"></i> النظام</a>
        </div>

        <!-- المحتوى الرئيسي (يسار) -->
        <div class="col-md-10 main-content">
            
            <!-- الشريط العلوي -->
            <div class="top-navbar d-flex justify-content-between align-items-center shadow-sm">
                <div class="d-flex align-items-center">
                    <div class="input-group" style="width: 300px;">
                        <span class="input-group-text bg-dark border-secondary text-muted"><i class="fa-solid fa-search"></i></span>
                        <input type="text" class="form-control bg-dark border-secondary text-white" placeholder="كيف يمكنني مساعدتك؟">
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <span class="me-3 text-white"><i class="fa-solid fa-flag text-danger"></i> 🇪🇬</span>
                    <span class="me-3 text-white"><i class="fa-solid fa-bell"></i></span>
                    <div class="dropdown">
                        <a href="#" class="text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name=Admin&background=1f2430&color=fff" class="rounded-circle me-1" width="32"> Admin
                        </a>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-dark text-success border-success mb-4 text-end">{{ session('success') }}</div>
            @endif

            <!-- 1. قسم جهات الاتصال -->
            <div class="section-card shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-3 border-bottom border-secondary pb-3">
                    <div>
                        <!-- زر (+) الذي يفتح نافذة إضافة جهة اتصال المطابقة لصورة Orders-2 -->
                        <button class="btn btn-sm btn-outline-light me-2" data-bs-toggle="modal" data-bs-target="#addContactModal" title="إضافة جهة اتصال">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-secondary me-1"><i class="fa-solid fa-pen"></i></button>
                        <button class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-trash"></i></button>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="input-group me-3" style="width: 220px;">
                            <input type="text" class="form-control bg-dark border-secondary text-white form-control-sm" placeholder="Search...">
                            <span class="input-group-text bg-dark border-secondary text-muted"><i class="fa-solid fa-search"></i></span>
                        </div>
                        <select class="form-select bg-dark border-secondary text-white form-select-sm" style="width: 110px;">
                            <option>المدخلات</option>
                        </select>
                        <h4 class="fw-bold mb-0 ms-3 text-white">جهات الاتصال</h4>
                    </div>
                </div>

                <table class="table table-dark table-hover mb-0 text-center align-middle" style="font-size: 13px;">
                    <thead>
                        <tr class="text-muted">
                            <th><input type="checkbox"></th>
                            <th>الاسم</th>
                            <th>البلد</th>
                            <th>تاريخ الإضافة</th>
                            <th>رقم التواصل</th>
                            <th>البريد الإلكتروني</th>
                            <th>رقم تواصل محامي الطرف الآخر</th>
                            <th>تعديل</th>
                            <th>حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($contacts) && count($contacts) > 0)
                            @foreach($contacts as $item)
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td class="fw-bold text-white">{{ $item->name ?? '-' }}</td>
                                    <td>{{ $item->country ?? '-' }}</td>
                                    <td>{{ $item->created_at ?? '2024-02-13/16:12:23' }}</td>
                                    <td>{{ $item->phone ?? '-' }}</td>
                                    <td>{{ $item->email ?? '-' }}</td>
                                    <td>{{ $item->other_lawyer_phone ?? '01000000000' }}</td>
                                    <td>
                                        <button class="btn btn-sm text-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <a href="{{ route('contacts.delete', $item->id) }}" class="btn btn-sm text-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" class="text-muted py-3">لا توجد جهات اتصال مسجلة. اضغط على زر (+) لإضافة جهة اتصال جديدة.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- 2. قسم قائمة الترويج -->
            <div class="section-card shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-3 border-bottom border-secondary pb-3">
                    <div>
                        <button class="btn btn-sm btn-outline-light me-2"><i class="fa-solid fa-plus"></i></button>
                        <button class="btn btn-sm btn-outline-secondary me-1"><i class="fa-solid fa-pen"></i></button>
                        <button class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-trash"></i></button>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="input-group me-3" style="width: 220px;">
                            <input type="text" class="form-control bg-dark border-secondary text-white form-control-sm" placeholder="Search...">
                            <span class="input-group-text bg-dark border-secondary text-muted"><i class="fa-solid fa-search"></i></span>
                        </div>
                        <select class="form-select bg-dark border-secondary text-white form-select-sm" style="width: 110px;">
                            <option>المدخلات</option>
                        </select>
                        <h4 class="fw-bold mb-0 ms-3 text-white">قائمة الترويج</h4>
                    </div>
                </div>
                <table class="table table-dark table-hover mb-0 text-center align-middle" style="font-size: 13px;">
                    <thead>
                        <tr class="text-muted">
                            <th><input type="checkbox"></th>
                            <th>الاسم</th>
                            <th>البلد</th>
                            <th>تاريخ الإضافة</th>
                            <th>رقم التواصل</th>
                            <th>البريد الإلكتروني</th>
                            <th>تعديل</th>
                            <th>حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>شخص 1</td>
                            <td>مصر</td>
                            <td>2024-02-13/16:12:23</td>
                            <td>01000000000</td>
                            <td>admin23@gmail.com</td>
                            <td><i class="fa-solid fa-pen-to-square text-warning"></i></td>
                            <td><i class="fa-solid fa-trash text-danger"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- 3. قسم الاجتماعات -->
            <div class="section-card shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-3 border-bottom border-secondary pb-3">
                    <div>
                        <button class="btn btn-sm btn-outline-light me-2"><i class="fa-solid fa-plus"></i></button>
                        <button class="btn btn-sm btn-outline-secondary me-1"><i class="fa-solid fa-pen"></i></button>
                        <button class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-trash"></i></button>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="input-group me-3" style="width: 220px;">
                            <input type="text" class="form-control bg-dark border-secondary text-white form-control-sm" placeholder="Search...">
                            <span class="input-group-text bg-dark border-secondary text-muted"><i class="fa-solid fa-search"></i></span>
                        </div>
                        <select class="form-select bg-dark border-secondary text-white form-select-sm" style="width: 110px;">
                            <option>المدخلات</option>
                        </select>
                        <h4 class="fw-bold mb-0 ms-3 text-white">الاجتماعات</h4>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- نافذة إضافة جهة اتصال (Modal) مطابقة تماماً لصورة Orders-2 -->
<div class="modal fade" id="addContactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: #111622; color: #fff; border: 1px solid #21262d;">
            <form action="{{ route('contacts.store') }}" method="POST">
                @csrf
                <div class="modal-header border-secondary">
                    <h3 class="modal-title fw-bold text-white w-100 text-end">إضافة جهة اتصال</h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <!-- الحقل الأول: الاسم -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label d-block text-end text-muted" style="font-size: 13px;">الاسم</label>
                            <div class="input-icon-wrapper">
                                <input type="text" name="name" class="form-control form-control-custom text-end" placeholder="الاسم" required autocomplete="off">
                                <i class="fa-regular fa-user"></i>
                            </div>
                        </div>

                        <!-- الحقل الثاني: البلد -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label d-block text-end text-muted" style="font-size: 13px;">البلد</label>
                            <div class="input-icon-wrapper">
                                <select name="country" class="form-select form-control-custom text-end">
                                    <option value="مصر" selected>مصر</option>
                                    <option value="السعودية">السعودية</option>
                                    <option value="الإمارات">الإمارات</option>
                                </select>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </div>

                        <!-- الحقل الثالث: رقم التواصل -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label d-block text-end text-muted" style="font-size: 13px;">رقم التواصل</label>
                            <div class="input-icon-wrapper">
                                <input type="text" name="phone" class="form-control form-control-custom text-end" placeholder="الرقم" required autocomplete="off">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                        </div>

                        <!-- الحقل الرابع: البريد الإلكتروني -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label d-block text-end text-muted" style="font-size: 13px;">البريد الالكتروني</label>
                            <div class="input-icon-wrapper">
                                <input type="email" name="email" class="form-control form-control-custom text-end" placeholder="البريد الالكتروني" required autocomplete="off">
                                <i class="fa-regular fa-envelope"></i>
                            </div>
                        </div>

                        <!-- الفئة -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label d-block text-end text-muted" style="font-size: 13px;">الفئة</label>
                            <div class="input-icon-wrapper">
                                <select name="category" class="form-select form-control-custom text-end">
                                    <option value="عميل" selected>عميل</option>
                                    <option value="محامي">محامي</option>
                                </select>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-secondary justify-content-start">
                    <button type="submit" class="btn text-white fw-bold px-4" style="background: transparent;">
                        حفظ <i class="fa-solid fa-arrow-left ms-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>