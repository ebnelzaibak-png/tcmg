<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>الصفحة الرئيسية - TCMG Law Office</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #0b0f19; color: #c9d1d9; font-family: Tahoma, sans-serif; overflow-x: hidden; }
        .sidebar { background-color: #111622; min-height: 100vh; border-left: 1px solid #21262d; position: fixed; right: 0; top: 0; width: 16.666%; }
        .sidebar a { color: #8b949e; text-decoration: none; padding: 12px 20px; display: block; transition: 0.2s; font-size: 14px; }
        .sidebar a:hover, .sidebar a.active { background-color: #1f2430; color: #58a6ff; }
        .main-content { margin-right: 16.666%; padding: 25px; }
        .top-navbar { background-color: #111622; border-bottom: 1px solid #21262d; padding: 12px 25px; border-radius: 10px; margin-bottom: 25px; }
        .card-custom { background-color: #111622; border: 1px solid #21262d; border-radius: 12px; padding: 20px; color: #fff; height: 100%; }
        .text-muted-custom { color: #8b949e; font-size: 13px; }
        .badge-dot { height: 10px; width: 10px; border-radius: 50%; display: inline-block; margin-left: 5px; }
        .table-dark-custom { background-color: #111622; color: #fff; border-color: #21262d; }
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
            <a href="/dashboard" class="active"><i class="fa-solid fa-house me-2"></i> الصفحة الرئيسية</a>
            <a href="/contacts"><i class="fa-solid fa-phone me-2"></i> الاتصال</a>
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
            
            <!-- الشريط العلوي (Navbar) -->
            <div class="top-navbar d-flex justify-content-between align-items-center shadow-sm">
                <div class="d-flex align-items-center">
                    <div class="input-group" style="width: 300px;">
                        <span class="input-group-text bg-dark border-secondary text-muted"><i class="fa-solid fa-search"></i></span>
                        <input type="text" class="form-control bg-dark border-secondary text-white" placeholder="كيف يمكنني مساعدتك؟">
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <span class="me-3 text-white"><i class="fa-solid fa-flag text-danger"></i> 🇪🇬</span>
                    <span class="me-3 position-relative text-white"><i class="fa-solid fa-bell"></i><span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary" style="font-size: 9px;">5</span></span>
                    <span class="me-3 text-white"><i class="fa-solid fa-comments"></i></span>
                    <div class="dropdown">
                        <a href="#" class="text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name=Admin&background=1f2430&color=fff" class="rounded-circle me-1" width="32"> Admin
                        </a>
                    </div>
                </div>
            </div>

            <!-- الصف الأول: رسم القضايا + التقويم (Calendar) -->
            <div class="row mb-4">
                <div class="col-md-8">
                    <div class="card-custom">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h5 class="fw-bold mb-0">القضايا</h5>
                                <span class="text-muted-custom">من ١ مارس إلى ١ مارس</span>
                            </div>
                            <div>
                                <span class="badge-dot" style="background-color: #d97706;"></span> <span class="text-muted-custom me-3">نشطة</span>
                                <span class="badge-dot" style="background-color: #ffffff;"></span> <span class="text-muted-custom">مغلقة</span>
                            </div>
                        </div>
                        <!-- محاكاة الرسم البياني للقضايا -->
                        <div class="text-center py-4">
                            <svg viewBox="0 0 700 180" class="w-100" style="max-height: 160px;">
                                <polyline fill="none" stroke="#d97706" stroke-width="2.5" points="0,120 70,140 140,80 210,140 280,60 350,90 420,40 490,50 560,110 630,95" />
                                <polyline fill="none" stroke="#ffffff" stroke-width="2" points="0,40 70,100 140,40 210,30 280,100 350,30 420,20 490,40 560,120 700,90" />
                                <text x="0" y="170" fill="#8b949e" font-size="10">0</text>
                                <text x="70" y="170" fill="#8b949e" font-size="10">1</text>
                                <text x="140" y="170" fill="#8b949e" font-size="10">2</text>
                                <text x="210" y="170" fill="#8b949e" font-size="10">3</text>
                                <text x="280" y="170" fill="#8b949e" font-size="10">4</text>
                                <text x="350" y="170" fill="#8b949e" font-size="10">5</text>
                                <text x="420" y="170" fill="#8b949e" font-size="10">6</text>
                                <text x="490" y="170" fill="#8b949e" font-size="10">7</text>
                                <text x="560" y="170" fill="#8b949e" font-size="10">8</text>
                                <text x="630" y="170" fill="#8b949e" font-size="10">9</text>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card-custom">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <i class="fa-solid fa-chevron-right text-muted" style="cursor: pointer;"></i>
                            <h6 class="fw-bold mb-0">Mar 2024</h6>
                            <i class="fa-solid fa-chevron-left text-muted" style="cursor: pointer;"></i>
                        </div>
                        <table class="table table-borderless text-center text-white mb-0" style="font-size: 13px;">
                            <thead>
                                <tr class="text-muted-custom">
                                    <th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-muted">29</td><td class="text-muted">30</td><td>01</td><td>02</td><td>03</td><td>04</td><td>05</td>
                                </tr>
                                <tr>
                                    <td>06</td><td>07</td><td>08</td><td>09</td><td>10</td><td class="bg-warning text-dark rounded fw-bold">11</td><td>12</td>
                                </tr>
                                <tr>
                                    <td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td>
                                </tr>
                                <tr>
                                    <td>20</td><td>21</td><td>22</td><td>23</td><td>24</td><td>25</td><td>26</td>
                                </tr>
                                <tr>
                                    <td>27</td><td>28</td><td class="text-muted">29</td><td class="text-muted">30</td><td class="text-muted">31</td><td class="text-muted">01</td><td class="text-muted">02</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- الصف الثاني: البطاقات الإحصائية الأربعة (تتحدث تلقائياً حسب الأقسام) -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card-custom d-flex flex-column justify-content-between">
                        <div class="d-flex justify-content-between align-items-center text-muted-custom">
                            <span>مجموع حالات الانتظار</span>
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <h2 class="fw-bold my-3 text-white">{{ $tasksCount ?? 2 }}</h2>
                        <div class="text-danger" style="font-size: 12px;">
                            <i class="fa-solid fa-arrow-down"></i> 7% عن الشهر الماضي <span class="text-muted float-start">حالات الانتظار</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-custom d-flex flex-column justify-content-between">
                        <div class="d-flex justify-content-between align-items-center text-muted-custom">
                            <span>مجموع جهات الاتصال</span>
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <h2 class="fw-bold my-3 text-white">{{ $contactsCount ?? 124 }}</h2>
                        <div class="text-success" style="font-size: 12px;">
                            <i class="fa-solid fa-arrow-up"></i> 5% زيادة عن الشهر الماضي <span class="text-muted float-start">جهات الاتصال</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-custom d-flex flex-column justify-content-between">
                        <div class="d-flex justify-content-between align-items-center text-muted-custom">
                            <span>مجموع الوحدات التابعة</span>
                            <i class="fa-solid fa-building"></i>
                        </div>
                        <h2 class="fw-bold my-3 text-white">{{ $casesCount ?? 4 }}</h2>
                        <div class="text-muted-custom" style="font-size: 12px;">
                            — العدد ثابت <span class="text-muted float-start">الوحدات التابعة</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-custom d-flex flex-column justify-content-between">
                        <div class="d-flex justify-content-between align-items-center text-muted-custom">
                            <span>مجموع المحامين</span>
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                        <h2 class="fw-bold my-3 text-white">{{ $employeesCount ?? 34 }}</h2>
                        <div class="text-success" style="font-size: 12px;">
                            <i class="fa-solid fa-arrow-up"></i> 3% زيادة عن الشهر الماضي <span class="text-muted float-start">المحامين</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- الصف الثالث: فئات القضايا (دائري) + العملاء (أعمدة) -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card-custom text-center">
                        <div class="text-end mb-2">
                            <h6 class="fw-bold mb-0">فئات القضايا</h6>
                            <span class="text-muted-custom">من ١ مارس إلى ١ مارس</span>
                        </div>
                        <div class="py-2">
                            <svg width="150" height="150" viewBox="0 0 42 42" class="mx-auto">
                                <circle cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#58a6ff" stroke-width="5"></circle>
                                <circle cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#d97706" stroke-width="5" stroke-dasharray="65 35" stroke-dashoffset="25"></circle>
                                <circle cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#8b1e2e" stroke-width="5" stroke-dasharray="25 75" stroke-dashoffset="60"></circle>
                            </svg>
                        </div>
                        <div class="text-start mt-2" style="font-size: 12px;">
                            <div><span class="badge-dot bg-warning"></span> أدوال شخصية</div>
                            <div><span class="badge-dot bg-primary"></span> قضايا عقارية</div>
                            <div><span class="badge-dot bg-secondary"></span> قضايا إدارية</div>
                            <div><span class="badge-dot" style="background-color: #8b1e2e;"></span> قضايا جنائية</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card-custom">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h5 class="fw-bold mb-0">العملاء</h5>
                                <span class="text-muted-custom">من ١ مارس إلى ١ مارس</span>
                            </div>
                            <div>
                                <span class="badge-dot" style="background-color: #d97706;"></span> <span class="text-muted-custom me-3">شركات و مؤسسات</span>
                                <span class="badge-dot" style="background-color: #ffffff;"></span> <span class="text-muted-custom">أفراد ({{ $clientsCount ?? 0 }})</span>
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
            </div>

            <!-- الصف الرابع: الاستشارات القانونية -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-custom">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h5 class="fw-bold mb-0">الاستشارات القانونية</h5>
                                <span class="text-muted-custom">من ١ مارس إلى ١ مارس (الإجمالي: {{ $consultationsCount ?? 0 }})</span>
                            </div>
                            <div>
                                <span class="badge-dot bg-warning"></span> <span class="text-muted-custom me-3">مكتبية</span>
                                <span class="badge-dot bg-white"></span> <span class="text-muted-custom me-3">هاتفية</span>
                                <span class="badge-dot bg-primary"></span> <span class="text-muted-custom me-3">عبر واتس آب</span>
                                <span class="badge-dot" style="background-color: #8b1e2e;"></span> <span class="text-muted-custom">شركات</span>
                            </div>
                        </div>
                        <!-- محاكاة أعمدة الاستشارات المتعددة -->
                        <div class="d-flex justify-content-around align-items-end pt-3" style="height: 160px; border-bottom: 1px solid #21262d;">
                            <div class="bg-warning rounded-top" style="width: 20px; height: 100px;"></div>
                            <div class="bg-white rounded-top" style="width: 20px; height: 60px;"></div>
                            <div class="bg-primary rounded-top" style="width: 20px; height: 90px;"></div>
                            <div class="bg-warning rounded-top" style="width: 20px; height: 80px;"></div>
                            <div class="bg-white rounded-top" style="width: 20px; height: 30px;"></div>
                            <div class="bg-primary rounded-top" style="width: 20px; height: 100px;"></div>
                            <div class="bg-warning rounded-top" style="width: 20px; height: 40px;"></div>
                            <div class="bg-white rounded-top" style="width: 20px; height: 30px;"></div>
                            <div class="bg-primary rounded-top" style="width: 20px; height: 50px;"></div>
                            <div class="bg-warning rounded-top" style="width: 20px; height: 90px;"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>