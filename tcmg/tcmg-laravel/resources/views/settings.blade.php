<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إعدادات النظام - TCMG</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #0d1117; color: #c9d1d9; font-family: Tahoma, sans-serif; overflow-x: hidden; }
        .sidebar { background-color: #161b22; min-height: 100vh; border-left: 1px solid #30363d; }
        .sidebar a { color: #8b949e; text-decoration: none; padding: 12px 20px; display: block; transition: 0.2s; }
        .sidebar a:hover, .sidebar a.active { background-color: #21262d; color: #58a6ff; }
        .card, .accordion-item, .accordion-header, .accordion-collapse { background-color: #161b22 !important; color: #c9d1d9 !important; border-color: #30363d !important; }
        .accordion-button { background-color: #161b22 !important; color: #c9d1d9 !important; box-shadow: none !important; border-bottom: 1px solid #30363d; }
        .accordion-button:not(.collapsed) { background-color: #21262d !important; color: #58a6ff !important; }
        .form-control, .form-select { background-color: #0d1117; border-color: #30363d; color: #fff; }
        .form-control:focus, .form-select:focus { background-color: #0d1117; color: #fff; border-color: #58a6ff; box-shadow: none; }
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
            <a href="/cases"><i class="fa-solid fa-briefcase me-2"></i> القضايا</a>
            <a href="/court"><i class="fa-solid fa-scale-balanced me-2"></i> المحكمة</a>
            <a href="/tasks"><i class="fa-solid fa-list-check me-2"></i> المهام والأعمال</a>
            <a href="/employees"><i class="fa-solid fa-user-gear me-2"></i> الموارد البشرية</a>
            <a href="/vacations"><i class="fa-solid fa-clock-rotate-left me-2"></i> الإجازات</a>
            <a href="/permissions"><i class="fa-solid fa-lock me-2"></i> صلاحيات الدخول</a>
            <a href="/consultations"><i class="fa-solid fa-gavel me-2"></i> الاستشارات القانونية</a>
            <a href="/settings" class="active"><i class="fa-solid fa-gear me-2"></i> النظام</a>
        </div>

        <!-- المحتوى الرئيسي (يسار) -->
        <div class="col-md-10 p-4">
            @include('partials.topbar')
            <h2 class="mb-4 fw-bold text-center"><i class="fa-solid fa-gear me-2 text-warning"></i> إعدادات النظام</h2>

            @if(session('success'))
                <div class="alert alert-dark text-success border-success mb-4">{{ session('success') }}</div>
            @endif

            <form action="{{ route('settings.update') }}" method="POST">
                @csrf
                <div class="accordion shadow-sm rounded overflow-hidden border border-secondary" id="systemSettingsAccordion">
                    
                    <!-- 1. اللغة -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingLang">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLang" aria-expanded="true" aria-controls="collapseLang">
                                <i class="fa-solid fa-globe me-2 text-warning"></i> اللغة
                            </button>
                        </h2>
                        <div id="collapseLang" class="accordion-collapse collapse show" aria-labelledby="headingLang" data-bs-parent="#systemSettingsAccordion">
                            <div class="accordion-body">
                                <select name="system_language" class="form-select">
                                    <option value="ar" selected>العربية (Arabic)</option>
                                    <option value="en">الإنجليزية (English)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- 2. تغيير صورة الدخول -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingImage">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseImage" aria-expanded="false" aria-controls="collapseImage">
                                <i class="fa-solid fa-image me-2 text-warning"></i> تغيير صورة الدخول
                            </button>
                        </h2>
                        <div id="collapseImage" class="accordion-collapse collapse" aria-labelledby="headingImage" data-bs-parent="#systemSettingsAccordion">
                            <div class="accordion-body">
                                <input type="file" name="login_image" class="form-control">
                                <small class="text-muted mt-2 d-block">اختر صورة خلفية جديدة لشاشة تسجيل الدخول.</small>
                            </div>
                        </div>
                    </div>

                    <!-- 3. تنسيق التاريخ -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingDate">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDate" aria-expanded="false" aria-controls="collapseDate">
                                <i class="fa-solid fa-calendar-days me-2 text-warning"></i> تنسيق التاريخ
                            </button>
                        </h2>
                        <div id="collapseDate" class="accordion-collapse collapse" aria-labelledby="headingDate" data-bs-parent="#systemSettingsAccordion">
                            <div class="accordion-body">
                                <select name="date_format" class="form-select">
                                    <option value="YYYY-MM-DD" selected>YYYY-MM-DD (2026-11-07)</option>
                                    <option value="DD-MM-YYYY">DD-MM-YYYY (07-11-2026)</option>
                                    <option value="MM/DD/YYYY">MM/DD/YYYY (11/07/2026)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- 4. العملة -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingCurrency">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCurrency" aria-expanded="false" aria-controls="collapseCurrency">
                                <i class="fa-solid fa-money-bill-wave me-2 text-warning"></i> العملة
                            </button>
                        </h2>
                        <div id="collapseCurrency" class="accordion-collapse collapse" aria-labelledby="headingCurrency" data-bs-parent="#systemSettingsAccordion">
                            <div class="accordion-body">
                                <select name="currency" class="form-select">
                                    <option value="EGP" selected>جنيه مصري (EGP)</option>
                                    <option value="SAR">ريال سعودي (SAR)</option>
                                    <option value="USD">دولار أمريكي (USD)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- 5. المنطقة الزمنية -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTimezone">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTimezone" aria-expanded="false" aria-controls="collapseTimezone">
                                <i class="fa-solid fa-clock me-2 text-warning"></i> المنطقة الزمنية
                            </button>
                        </h2>
                        <div id="collapseTimezone" class="accordion-collapse collapse" aria-labelledby="headingTimezone" data-bs-parent="#systemSettingsAccordion">
                            <div class="accordion-body">
                                <select name="timezone" class="form-select">
                                    <option value="Africa/Cairo" selected>القاهرة (GMT+2)</option>
                                    <option value="Asia/Riyadh">الرياض (GMT+3)</option>
                                    <option value="UTC">التوقيت العالمي (UTC)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- زر حفظ الإعدادات -->
                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-warning text-dark fw-bold px-5 py-2">
                        <i class="fa-solid fa-save me-1"></i> حفظ إعدادات النظام
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>