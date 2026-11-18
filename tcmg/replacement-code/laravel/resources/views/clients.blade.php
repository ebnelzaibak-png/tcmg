<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>العملاء - TCMG Law Office</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #0b0f19; color: #c9d1d9; font-family: Tahoma, sans-serif; overflow-x: hidden; }
        .sidebar { background-color: #111622; min-height: 100vh; border-left: 1px solid #21262d; position: fixed; right: 0; top: 0; width: 16.666%; z-index: 100; }
        .sidebar a { color: #8b949e; text-decoration: none; padding: 12px 20px; display: block; transition: 0.2s; font-size: 14px; }
        .sidebar a:hover, .sidebar a.active { background-color: #1f2430; color: #58a6ff; }
        .main-content { margin-right: 16.666%; padding: 25px; }
        .top-navbar { background-color: #111622; border-bottom: 1px solid #21262d; padding: 12px 25px; border-radius: 10px; margin-bottom: 25px; }
        .card-custom { background-color: #111622; border: 1px solid #21262d; border-radius: 12px; padding: 20px; color: #fff; margin-bottom: 25px; }
        .text-muted-custom { color: #8b949e; font-size: 13px; }
        .badge-dot { height: 10px; width: 10px; border-radius: 50%; display: inline-block; margin-left: 5px; }
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
            <a href="/contacts"><i class="fa-solid fa-phone me-2"></i> الاتصال</a>
            <a href="/clients" class="active"><i class="fa-solid fa-users me-2"></i> العملاء</a>
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
                    <span class="me-3 position-relative text-white"><i class="fa-solid fa-bell"></i></span>
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

            <!-- الصف الأول: الرسوم البيانية العليا (أعمدة العملاء + جنسيات العملاء) -->
            <div class="row mb-4">
                <div class="col-md-7">
                    <div class="card-custom">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h5 class="fw-bold mb-0">العملاء</h5>
                                <span class="text-muted-custom">من ١ مارس إلى ١ مارس</span>
                            </div>
                            <div>
                                <span class="badge-dot" style="background-color: #d97706;"></span> <span class="text-muted-custom me-3">شركات و مؤسسات</span>
                                <span class="badge-dot" style="background-color: #ffffff;"></span> <span class="text-muted-custom">أفراد</span>
                            </div>
                        </div>
                        <!-- محاكاة أعمدة العملاء -->
                        <div class="d-flex justify-content-around align-items-end pt-3" style="height: 160px; border-bottom: 1px solid #21262d;">
                            <div class="bg-warning rounded-top" style="width: 15px; height: 20px;"></div>
                            <div class="bg-white rounded-top" style="width: 15px; height: 10px;"></div>
                            <div class="bg-warning rounded-top" style="width: 15px; height: 60px;"></div>
                            <div class="bg-white rounded-top" style="width: 15px; height: 20px;"></div>
                            <div class="bg-warning rounded-top" style="width: 15px; height: 60px;"></div>
                            <div class="bg-white rounded-top" style="width: 15px; height: 5px;"></div>
                            <div class="bg-warning rounded-top" style="width: 15px; height: 65px;"></div>
                            <div class="bg-white rounded-top" style="width: 15px; height: 40px;"></div>
                            <div class="bg-warning rounded-top" style="width: 15px; height: 35px;"></div>
                            <div class="bg-white rounded-top" style="width: 15px; height: 45px;"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card-custom text-center">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h5 class="fw-bold mb-0 text-end">جنسيات العملاء</h5>
                                <span class="text-muted-custom">من ١ مارس إلى ١ مارس</span>
                            </div>
                        </div>
                        <div class="py-1">
                            <svg width="130" height="130" viewBox="0 0 42 42" class="mx-auto">
                                <circle cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#d97706" stroke-width="5"></circle>
                                <circle cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#ffffff" stroke-width="5" stroke-dasharray="65 35" stroke-dashoffset="25"></circle>
                                <circle cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#8b1e2e" stroke-width="5" stroke-dasharray="25 75" stroke-dashoffset="60"></circle>
                                <circle cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#0ea5e9" stroke-width="5" stroke-dasharray="15 85" stroke-dashoffset="80"></circle>
                            </svg>
                        </div>
                        <div class="row text-start mt-2" style="font-size: 11px;">
                            <div class="col-6"><span class="badge-dot" style="background-color: #d97706;"></span> مصر</div>
                            <div class="col-6"><span class="badge-dot bg-white"></span> السعودية</div>
                            <div class="col-6"><span class="badge-dot" style="background-color: #8b1e2e;"></span> البحرين</div>
                            <div class="col-6"><span class="badge-dot bg-danger"></span> قطر</div>
                            <div class="col-6"><span class="badge-dot bg-primary"></span> عمان</div>
                            <div class="col-6"><span class="badge-dot" style="background-color: #f97316;"></span> الإمارات</div>
                            <div class="col-6"><span class="badge-dot bg-info"></span> الكويت</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- الصف الثاني: قائمة العملاء المطابقة للصورة تماماً -->
            <div class="card-custom shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-3 border-bottom border-secondary pb-3">
                    <div>
                        <!-- زر (+) الذي يفتح نافذة الإضافة المطابقة لـ Orders-2 -->
                        <button class="btn btn-sm btn-outline-light me-2" data-bs-toggle="modal" data-bs-target="#addClientModal" title="إضافة عميل">
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
                        <h4 class="fw-bold mb-0 ms-3 text-white">قائمة العملاء</h4>
                    </div>
                </div>

                <table class="table table-dark table-hover mb-0 text-center align-middle" style="font-size: 13px;">
                    <thead>
                        <tr class="text-muted">
                            <th><input type="checkbox"></th>
                            <th>الاسم</th>
                            <th>البلد</th>
                            <th>الفئة</th>
                            <th>رقم التواصل</th>
                            <th>البريد الالكتروني</th>
                            <th>تعديل</th>
                            <th>حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($clients) && count($clients) > 0)
                            @foreach($clients as $item)
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td class="fw-bold text-white">{{ $item->name ?? 'عميل 1' }}</td>
                                    <td>{{ $item->country ?? 'مصر' }}</td>
                                    <td>{{ $item->type ?? 'N/A' }}</td>
                                    <td>{{ $item->phone ?? '01000000000' }}</td>
                                    <td>{{ $item->email ?? 'admin23@gmail.com' }}</td>
                                    <td>
                                        <button class="btn btn-sm text-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <a href="{{ route('clients.delete', $item->id) }}" class="btn btn-sm text-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <!-- عينات افتراضية مطابقة لصورة الجدول تماماً -->
                            @for($i=1; $i<=8; $i++)
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td class="fw-bold text-white">عميل ١</td>
                                    <td>مصر</td>
                                    <td>N/A</td>
                                    <td>01000000000</td>
                                    <td>admin23@gmail.com</td>
                                    <td><i class="fa-solid fa-pen-to-square text-warning"></i></td>
                                    <td><i class="fa-solid fa-trash text-danger"></i></td>
                                </tr>
                            @endfor
                        @endif
                    </tbody>
                </table>

                <!-- تذييل الجدول والترقيم (Pagination) مطابق للصورة -->
                <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top border-secondary" style="font-size: 13px;">
                    <span class="text-muted-custom">678 من النتائج</span>
                    <ul class="pagination pagination-sm m-0">
                        <li class="page-item"><a class="page-link bg-dark border-secondary text-white" href="#"><i class="fa-solid fa-chevron-right"></i></a></li>
                        <li class="page-item active"><a class="page-link bg-primary border-primary text-white" href="#">1</a></li>
                        <li class="page-item"><a class="page-link bg-dark border-secondary text-white" href="#">2</a></li>
                        <li class="page-item"><a class="page-link bg-dark border-secondary text-white" href="#">3</a></li>
                        <li class="page-item"><a class="page-link bg-dark border-secondary text-white" href="#">4</a></li>
                        <li class="page-item"><a class="page-link bg-dark border-secondary text-white" href="#">5</a></li>
                        <li class="page-item"><a class="page-link bg-dark border-secondary text-white" href="#">6</a></li>
                        <li class="page-item disabled"><span class="page-link bg-dark border-secondary text-muted">...</span></li>
                        <li class="page-item"><a class="page-link bg-dark border-secondary text-white" href="#">24</a></li>
                        <li class="page-item"><a class="page-link bg-dark border-secondary text-white" href="#"><i class="fa-solid fa-chevron-left"></i></a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- نافذة إضافة عميل (Modal) مطابقة لتصميم Orders-2 الأنيق والأيقونات الداخلية -->
<div class="modal fade" id="addClientModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: #111622; color: #fff; border: 1px solid #21262d;">
            <form action="{{ route('clients.store') }}" method="POST">
                @csrf
                <div class="modal-header border-secondary">
                    <h3 class="modal-title fw-bold text-white w-100 text-end">إضافة جهة اتصال / عميل</h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <!-- الاسم -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label d-block text-end text-muted" style="font-size: 13px;">الاسم</label>
                            <div class="input-icon-wrapper">
                                <input type="text" name="name" class="form-control form-control-custom text-end" placeholder="الاسم" required autocomplete="off">
                                <i class="fa-regular fa-user"></i>
                            </div>
                        </div>

                        <!-- البلد -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label d-block text-end text-muted" style="font-size: 13px;">البلد</label>
                            <div class="input-icon-wrapper">
                                <select name="country" class="form-select form-control-custom text-end">
                                    <option value="مصر" selected>مصر</option>
                                    <option value="السعودية">السعودية</option>
                                    <option value="البحرين">البحرين</option>
                                    <option value="قطر">قطر</option>
                                    <option value="عمان">عمان</option>
                                    <option value="الإمارات">الإمارات</option>
                                    <option value="الكويت">الكويت</option>
                                </select>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </div>

                        <!-- رقم التواصل -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label d-block text-end text-muted" style="font-size: 13px;">رقم التواصل</label>
                            <div class="input-icon-wrapper">
                                <input type="text" name="phone" class="form-control form-control-custom text-end" placeholder="الرقم" required autocomplete="off">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                        </div>

                        <!-- البريد الإلكتروني -->
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
                                <select name="type" class="form-select form-control-custom text-end">
                                    <option value="فرد" selected>عميل / فرد</option>
                                    <option value="محامي">محامي</option>
                                    <option value="شركة ومؤسسة">شركة ومؤسسة</option>
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