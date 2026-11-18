<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $courtRecord ? 'تعديل محكمة' : 'إضافة محكمة' }} - TCMG</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root{--bg:#0f1530;--panel:#1a2148;--panel2:#222a58;--gold:#8b6a3a;--muted:#9aa3c7}
        *{box-sizing:border-box}
        body{margin:0;background:var(--bg);color:#fff;font-family:'Cairo',Tahoma,sans-serif;min-height:100vh}
        .sidebar{position:fixed;inset:0 0 0 auto;width:230px;background:var(--panel);padding:24px 14px;z-index:5}
        .logo{text-align:center;font-size:22px;font-weight:700;letter-spacing:4px;padding:10px 0 25px}
        .logo span{color:var(--gold)}
        .nav-link{display:flex;align-items:center;gap:12px;padding:11px 14px;margin-bottom:4px;border-radius:6px;color:#fff;text-decoration:none;font-size:14px}
        .nav-link.active{background:#fff;color:#10153a;font-weight:600}
        .nav-link:not(.active):hover{background:var(--panel2);color:#fff}
        .main{margin-right:230px;padding:18px 24px;min-height:100vh}
        .topbar{display:flex;align-items:center;gap:18px;margin-bottom:48px}
        .topbar-tools{display:flex;align-items:center;gap:16px;color:var(--muted);font-size:13px;white-space:nowrap}
        .avatar{width:26px;height:26px;border-radius:50%;background:var(--gold);display:inline-block}
        .search-help{flex:1;max-width:440px;margin:auto}
        .search-help input{width:100%;padding:9px 16px;border:0;border-radius:6px;font-family:inherit;font-size:13px}
        .form-card{max-width:780px;margin:0 auto;background:var(--panel);border:1px solid #0b1027;box-shadow:0 2px 6px #05091a55}
        .form-title{padding:18px 22px;border-bottom:1px solid #8990aa;text-align:right;font-size:22px;font-weight:700}
        .form-body{padding:28px 5% 22px}
        .field-label{display:block;color:#aab1cc;font-size:12px;margin-bottom:5px;text-align:right}
        .field-wrap{position:relative}
        .field-wrap .form-control,.field-wrap .form-select{height:42px;border:0;border-radius:4px;background:#fff;color:#343a40;font-family:inherit;font-size:13px;padding:8px 14px 8px 40px}
        .field-wrap .form-control:focus,.field-wrap .form-select:focus{box-shadow:0 0 0 3px #8b6a3a55}
        .field-wrap>i{position:absolute;left:14px;top:13px;color:#808bac;pointer-events:none}
        .save-row{display:flex;justify-content:flex-start;align-items:center;padding:22px 0 0}
        .save-button{border:0;background:transparent;color:#fff;font-weight:700;font-family:inherit;padding:8px 4px}
        .save-button:hover{color:#d8bc91}
        @media(max-width:760px){.sidebar{display:none}.main{margin-right:0;padding:14px}.topbar{margin-bottom:24px}.form-card{margin-top:5px}}
        @media(max-width:575px){.topbar-tools:nth-child(2){display:none}.form-body{padding:20px}}
    </style>
</head>
<body>
<aside class="sidebar">
    <div class="logo">✦ <span>TCMG</span></div>
    <nav>
        <a class="nav-link" href="{{ route('dashboard') }}"><i class="fa-solid fa-house"></i> الصفحة الرئيسية</a>
        <a class="nav-link" href="{{ route('contacts.index') }}"><i class="fa-solid fa-phone"></i> الاتصال</a>
        <a class="nav-link" href="{{ route('clients.index') }}"><i class="fa-solid fa-users"></i> العملاء</a>
        <a class="nav-link" href="{{ route('cases.index') }}"><i class="fa-regular fa-file-lines"></i> القضايا</a>
        <a class="nav-link active" href="{{ route('court.index') }}"><i class="fa-solid fa-scale-balanced"></i> المحكمة</a>
        <a class="nav-link" href="/tasks"><i class="fa-solid fa-check"></i> المهام و الأعمال</a>
        <a class="nav-link" href="/employees"><i class="fa-solid fa-users"></i> الموارد البشرية</a>
        <a class="nav-link" href="/vacations"><i class="fa-regular fa-clock"></i> الإجازات</a>
        <a class="nav-link" href="/permissions"><i class="fa-solid fa-lock"></i> صلاحيات الدخول</a>
        <a class="nav-link" href="/consultations"><i class="fa-solid fa-gavel"></i> الاستشارات القانونية</a>
        <a class="nav-link" href="/settings"><i class="fa-solid fa-gear"></i> النظام</a>
    </nav>
</aside>

<main class="main">
    <header class="topbar">
        <div class="topbar-tools"><span class="avatar"></span> Admin ▾</div>
        <div class="topbar-tools"><span>💬</span><span>🔔</span><span>🇪🇬 ▾</span></div>
        <div class="search-help"><input type="search" placeholder="كيف يمكنني مساعدتك؟"></div>
    </header>

    <section class="form-card">
        <div class="form-title">{{ $courtRecord ? 'تعديل محكمة' : 'إضافة محكمة' }}</div>
        <form action="{{ $courtRecord ? route('court.update', $courtRecord->id) : route('court.store') }}" method="POST">
            @csrf
            @if($courtRecord)
                @method('PUT')
            @endif
            <div class="form-body">
                @if($errors->any())
                    <div class="alert alert-danger text-end">
                        <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="field-label" for="category">الفئة</label>
                        <div class="field-wrap">
                            <select id="category" name="category" class="form-select" required>
                                <option value="">اختر الفئة</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" @selected(old('category', $courtRecord->category ?? '') === $category)>{{ $category }}</option>
                                @endforeach
                            </select>
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="field-label" for="country">البلد</label>
                        <div class="field-wrap">
                            <select id="country" name="country" class="form-select" required>
                                <option value="">اختر البلد</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country }}" @selected(old('country', $courtRecord->country ?? '') === $country)>{{ $country }}</option>
                                @endforeach
                            </select>
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="field-label" for="city">مدينة</label>
                        <div class="field-wrap">
                            <input id="city" name="city" type="text" class="form-control" placeholder="مدينة" value="{{ old('city', $courtRecord->city ?? '') }}" required maxlength="255">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="field-label" for="governorate">محافظة/ولاية</label>
                        <div class="field-wrap">
                            <input id="governorate" name="governorate" type="text" class="form-control" placeholder="محافظة/ولاية" value="{{ old('governorate', $courtRecord->governorate ?? '') }}" required maxlength="255">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="field-label" for="police_station">قسم/مركز الشرطة</label>
                        <div class="field-wrap">
                            <input id="police_station" name="police_station" type="text" class="form-control" placeholder="قسم/مركز الشرطة" value="{{ old('police_station', $courtRecord->police_station ?? '') }}" required maxlength="255">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                    </div>
                </div>
                <div class="save-row">
                    <a class="btn btn-link text-white text-decoration-none me-3" href="{{ route('court.index') }}">إلغاء</a>
                    <button class="save-button" type="submit">حفظ <i class="fa-solid fa-arrow-left ms-2"></i></button>
                </div>
            </div>
        </form>
    </section>
</main>
</body>
</html>
