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
    <link rel="stylesheet" href="{{ asset('css/figma-dashboard.css') }}">
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
            @if($errors->any())
                <div class="alert alert-danger mb-4 text-end">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <!-- 1. قسم جهات الاتصال -->
            <div class="section-card shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-3 border-bottom border-secondary pb-3">
                    <div>
                        <a class="btn btn-sm btn-outline-light me-2" href="{{ route('contacts.create') }}" title="إضافة جهة اتصال">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    </div>
                    <div class="d-flex align-items-center">
                        <form method="GET" action="{{ route('contacts.index') }}" class="d-flex align-items-center gap-2 me-3">
                            <input type="search" name="q" value="{{ request('q') }}" class="form-control bg-dark border-secondary text-white form-control-sm" placeholder="Search..." aria-label="بحث" style="width: 180px;">
                            <select name="category" class="form-select bg-dark border-secondary text-white form-select-sm" aria-label="تصفية حسب الفئة" style="width: 110px;">
                                <option value="">كل الفئات</option>
                                <option value="عميل" @selected(request('category') === 'عميل')>عميل</option>
                                <option value="محامي" @selected(request('category') === 'محامي')>محامي</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-outline-secondary" aria-label="بحث"><i class="fa-solid fa-search"></i></button>
                        </form>
                        <h4 class="fw-bold mb-0 ms-3 text-white">جهات الاتصال</h4>
                    </div>
                </div>

                <div class="table-responsive">
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
                        @forelse($contacts as $item)
                            <tr>
                                <td><input type="checkbox" aria-label="تحديد {{ $item->name }}"></td>
                                <td class="fw-bold text-white">{{ $item->name }}</td>
                                <td>{{ $item->country ?: '-' }}</td>
                                <td>{{ \Illuminate\Support\Carbon::parse($item->created_at)->format('Y-m-d H:i') }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->email ?: '-' }}</td>
                                <td>{{ $item->other_lawyer_phone ?: '-' }}</td>
                                <td>
                                    <a href="{{ route('contacts.edit', $item->id) }}" class="btn btn-sm text-warning" aria-label="تعديل {{ $item->name }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('contacts.destroy', $item->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm text-danger" aria-label="حذف {{ $item->name }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-muted py-3">لا توجد جهات اتصال مسجلة. اضغط على زر (+) لإضافة جهة اتصال جديدة.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <span class="small text-muted">{{ $contacts->total() }} من النتائج</span>
                    {{ $contacts->links('pagination::bootstrap-5') }}
                </div>
            </div>

            <!-- 2. قسم قائمة الترويج -->
            <div class="section-card shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-3 border-bottom border-secondary pb-3">
                    <div>
                        <button type="button" class="btn btn-sm btn-outline-light me-2" data-bs-toggle="modal" data-bs-target="#addPromotionModal" title="إضافة لقائمة الترويج"><i class="fa-solid fa-plus"></i></button>
                        <button type="button" class="btn btn-sm btn-outline-secondary me-1" data-edit-selected="promotions" title="تعديل المحدد"><i class="fa-solid fa-pen"></i></button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-delete-selected="promotions" data-bulk-form="deletePromotionsForm" title="حذف المحدد"><i class="fa-solid fa-trash"></i></button>
                        <form id="deletePromotionsForm" action="{{ route('promotions.bulk-destroy') }}" method="POST" class="d-none">
                            @csrf
                            @method('DELETE')
                            <div data-bulk-inputs></div>
                        </form>
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
                            <th><input type="checkbox" data-select-all="promotions" aria-label="تحديد الكل"></th>
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
                        @forelse($promotions as $promotion)
                            <tr>
                                <td><input type="checkbox" data-row-select="promotions" value="{{ $promotion->id }}" aria-label="تحديد {{ $promotion->name }}"></td>
                                <td>{{ $promotion->name }}</td>
                                <td>{{ $promotion->country }}</td>
                                <td>{{ \Illuminate\Support\Carbon::parse($promotion->created_at)->format('Y-m-d H:i') }}</td>
                                <td>{{ $promotion->phone }}</td>
                                <td>{{ $promotion->email ?: '-' }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm text-warning"
                                            data-bs-toggle="modal" data-bs-target="#editPromotionModal" data-edit-modal
                                            data-update-url="{{ route('promotions.update', $promotion->id) }}"
                                            data-name="{{ $promotion->name }}" data-country="{{ $promotion->country }}"
                                            data-phone="{{ $promotion->phone }}" data-email="{{ $promotion->email }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </td>
                                <td>
                                    <form action="{{ route('promotions.destroy', $promotion->id) }}" method="POST" onsubmit="return confirm('هل تريد حذف هذا الاسم من قائمة الترويج؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm text-danger" aria-label="حذف {{ $promotion->name }}"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="text-muted py-3">لا توجد أسماء في قائمة الترويج.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- 3. قسم الاجتماعات -->
            <div class="section-card shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-3 border-bottom border-secondary pb-3">
                    <div>
                        <button type="button" class="btn btn-sm btn-outline-light me-2" data-bs-toggle="modal" data-bs-target="#addMeetingModal" title="إضافة اجتماع"><i class="fa-solid fa-plus"></i></button>
                        <button type="button" class="btn btn-sm btn-outline-secondary me-1" data-edit-selected="meetings" title="تعديل المحدد"><i class="fa-solid fa-pen"></i></button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-delete-selected="meetings" data-bulk-form="deleteMeetingsForm" title="حذف المحدد"><i class="fa-solid fa-trash"></i></button>
                        <form id="deleteMeetingsForm" action="{{ route('meetings.bulk-destroy') }}" method="POST" class="d-none">
                            @csrf
                            @method('DELETE')
                            <div data-bulk-inputs></div>
                        </form>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="input-group me-3" style="width: 220px;">
                            <input type="text" class="form-control bg-dark border-secondary text-white form-control-sm" placeholder="Search...">
                            <span class="input-group-text bg-dark border-secondary text-muted"><i class="fa-solid fa-search"></i></span>
                        </div>
                        <h4 class="fw-bold mb-0 ms-3 text-white">الاجتماعات</h4>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-dark table-hover mb-0 text-center align-middle" style="font-size: 13px;">
                        <thead>
                            <tr class="text-muted">
                                <th><input type="checkbox" data-select-all="meetings" aria-label="تحديد الكل"></th>
                                <th>الاجتماع</th>
                                <th>البلد</th>
                                <th>تاريخ ووقت الاجتماع</th>
                                <th>تعديل</th>
                                <th>حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($meetings as $meeting)
                                <tr>
                                    <td><input type="checkbox" data-row-select="meetings" value="{{ $meeting->id }}" aria-label="تحديد {{ $meeting->title }}"></td>
                                    <td>{{ $meeting->title }}</td>
                                    <td>{{ $meeting->country }}</td>
                                    <td>{{ \Illuminate\Support\Carbon::parse($meeting->meeting_at)->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm text-warning"
                                                data-bs-toggle="modal" data-bs-target="#editMeetingModal" data-edit-modal
                                                data-update-url="{{ route('meetings.update', $meeting->id) }}"
                                                data-title="{{ $meeting->title }}" data-country="{{ $meeting->country }}"
                                                data-meeting-at="{{ \Illuminate\Support\Carbon::parse($meeting->meeting_at)->format('Y-m-d\TH:i') }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <form action="{{ route('meetings.destroy', $meeting->id) }}" method="POST" onsubmit="return confirm('هل تريد حذف هذا الاجتماع؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm text-danger" aria-label="حذف {{ $meeting->title }}"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="text-muted py-3">لا توجد اجتماعات مسجلة.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="addPromotionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color:#111622;color:#fff;border:1px solid #21262d">
            <form action="{{ route('promotions.store') }}" method="POST">
                @csrf
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">إضافة إلى قائمة الترويج</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">الاسم</label><input name="name" class="form-control form-control-custom text-end" required maxlength="255" value="{{ old('name') }}"></div>
                        <div class="col-md-6"><label class="form-label">البلد</label><select name="country" class="form-select form-control-custom text-end" required><option value="مصر">مصر</option><option value="السعودية">السعودية</option><option value="الإمارات">الإمارات</option></select></div>
                        <div class="col-md-6"><label class="form-label">رقم التواصل</label><input name="phone" type="tel" class="form-control form-control-custom text-end" required maxlength="50"></div>
                        <div class="col-md-6"><label class="form-label">البريد الإلكتروني</label><input name="email" type="email" class="form-control form-control-custom text-end" maxlength="255"></div>
                    </div>
                </div>
                <div class="modal-footer border-secondary"><button type="submit" class="btn btn-outline-light">حفظ</button></div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editPromotionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color:#111622;color:#fff;border:1px solid #21262d">
            <form method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">تعديل بيانات قائمة الترويج</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">الاسم</label><input name="name" class="form-control form-control-custom text-end" required maxlength="255"></div>
                        <div class="col-md-6"><label class="form-label">البلد</label><select name="country" class="form-select form-control-custom text-end" required><option value="مصر">مصر</option><option value="السعودية">السعودية</option><option value="الإمارات">الإمارات</option></select></div>
                        <div class="col-md-6"><label class="form-label">رقم التواصل</label><input name="phone" type="tel" class="form-control form-control-custom text-end" required maxlength="50"></div>
                        <div class="col-md-6"><label class="form-label">البريد الإلكتروني</label><input name="email" type="email" class="form-control form-control-custom text-end" maxlength="255"></div>
                    </div>
                </div>
                <div class="modal-footer border-secondary"><button type="submit" class="btn btn-outline-light">حفظ التعديلات</button></div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addMeetingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color:#111622;color:#fff;border:1px solid #21262d">
            <form action="{{ route('meetings.store') }}" method="POST">
                @csrf
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">إضافة اجتماع جديد</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">عنوان الاجتماع</label><input name="title" class="form-control form-control-custom text-end" required maxlength="255"></div>
                        <div class="col-md-6"><label class="form-label">البلد</label><select name="country" class="form-select form-control-custom text-end" required><option value="مصر">مصر</option><option value="السعودية">السعودية</option><option value="الإمارات">الإمارات</option></select></div>
                        <div class="col-12"><label class="form-label">تاريخ ووقت الاجتماع</label><input name="meeting_at" type="datetime-local" class="form-control form-control-custom text-end" required></div>
                    </div>
                </div>
                <div class="modal-footer border-secondary"><button type="submit" class="btn btn-outline-light">حفظ</button></div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editMeetingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color:#111622;color:#fff;border:1px solid #21262d">
            <form method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">تعديل الاجتماع</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">عنوان الاجتماع</label><input name="title" class="form-control form-control-custom text-end" required maxlength="255"></div>
                        <div class="col-md-6"><label class="form-label">البلد</label><select name="country" class="form-select form-control-custom text-end" required><option value="مصر">مصر</option><option value="السعودية">السعودية</option><option value="الإمارات">الإمارات</option></select></div>
                        <div class="col-12"><label class="form-label">تاريخ ووقت الاجتماع</label><input name="meeting_at" type="datetime-local" class="form-control form-control-custom text-end" required></div>
                    </div>
                </div>
                <div class="modal-footer border-secondary"><button type="submit" class="btn btn-outline-light">حفظ التعديلات</button></div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('editPromotionModal').addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget;
    const form = event.target.querySelector('form');
    form.action = button.dataset.updateUrl;
    form.elements.name.value = button.dataset.name;
    form.elements.country.value = button.dataset.country;
    form.elements.phone.value = button.dataset.phone;
    form.elements.email.value = button.dataset.email;
});

document.getElementById('editMeetingModal').addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget;
    const form = event.target.querySelector('form');
    form.action = button.dataset.updateUrl;
    form.elements.title.value = button.dataset.title;
    form.elements.country.value = button.dataset.country;
    form.elements.meeting_at.value = button.dataset.meetingAt;
});

document.querySelectorAll('[data-select-all]').forEach(master => {
    master.addEventListener('change', () => {
        document.querySelectorAll(`[data-row-select="${master.dataset.selectAll}"]`)
            .forEach(row => row.checked = master.checked);
    });
});

document.querySelectorAll('[data-edit-selected]').forEach(button => {
    button.addEventListener('click', () => {
        const selected = document.querySelectorAll(`[data-row-select="${button.dataset.editSelected}"]:checked`);
        if (selected.length !== 1) {
            alert('حدد عنصرًا واحدًا للتعديل.');
            return;
        }

        selected[0].closest('tr').querySelector('[data-edit-modal]').click();
    });
});

document.querySelectorAll('[data-delete-selected]').forEach(button => {
    button.addEventListener('click', () => {
        const selected = document.querySelectorAll(`[data-row-select="${button.dataset.deleteSelected}"]:checked`);
        if (selected.length === 0) {
            alert('حدد عنصرًا واحدًا على الأقل للحذف.');
            return;
        }
        if (!confirm(`هل تريد حذف ${selected.length} عنصر؟`)) return;

        const form = document.getElementById(button.dataset.bulkForm);
        const container = form.querySelector('[data-bulk-inputs]');
        container.replaceChildren(...Array.from(selected, row => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'ids[]';
            input.value = row.value;
            return input;
        }));
        form.submit();
    });
});
</script>
</body>
</html>