<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $contact ? 'تعديل جهة اتصال' : 'إضافة جهة اتصال' }} - TCMG</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root{--bg:#0f1530;--panel:#1a2148;--gold:#8b6a3a;--muted:#9aa3c7}
        *{box-sizing:border-box}
        body{margin:0;background:var(--bg);color:#fff;font-family:'Cairo',Tahoma,sans-serif;min-height:100vh}
        .sidebar{position:fixed;inset:0 0 0 auto;width:250px;background:var(--panel);padding:24px 14px;z-index:5}
        .logo{text-align:center;font-size:22px;font-weight:700;letter-spacing:4px;padding:10px 0 25px}
        .logo span{color:var(--gold)}
        .nav-link{display:flex;align-items:center;gap:12px;padding:11px 14px;margin-bottom:4px;border-radius:6px;color:#fff;text-decoration:none;font-size:14px}
        .nav-link.active{background:#fff;color:#10153a;font-weight:600}
        .nav-link:not(.active):hover{background:#222a58;color:#fff}
        .main{margin-right:250px;padding:18px 24px;min-height:100vh}
        .topbar{display:flex;align-items:center;gap:18px;margin-bottom:22px}
        .topbar-tools{display:flex;align-items:center;gap:16px;color:var(--muted);font-size:13px;white-space:nowrap}
        .avatar{width:26px;height:26px;border-radius:50%;background:var(--gold);display:inline-block}
        .search{flex:1;max-width:520px;margin:auto}
        .search input{width:100%;padding:9px 16px;border:0;border-radius:6px;font-family:inherit;font-size:13px}
        .form-card{max-width:900px;margin:12px auto;background:var(--panel);border:1px solid #0b1027;box-shadow:0 2px 6px #05091a55}
        .form-title{padding:18px 22px;border-bottom:1px solid #8990aa;text-align:right;font-size:22px;font-weight:700}
        .form-body{padding:28px 5% 22px}
        .field-label{display:block;color:#aab1cc;font-size:12px;margin-bottom:5px;text-align:right}
        .field-wrap{position:relative}
        .field-wrap .form-control,.field-wrap .form-select{height:42px;border:0;border-radius:4px;background:#fff;color:#343a40;font-family:inherit;font-size:13px;padding:8px 14px 8px 40px}
        .field-wrap .form-control:focus,.field-wrap .form-select:focus{box-shadow:0 0 0 3px #8b6a3a55}
        .field-wrap>i{position:absolute;left:14px;top:13px;color:#808bac;pointer-events:none}
        .field-wrap select{appearance:none}
        .save-row{display:flex;justify-content:flex-start;padding:12px 0 0}
        .save-button{border:0;background:transparent;color:#fff;font-weight:700;font-family:inherit;padding:8px 4px}
        .save-button:hover{color:#d8bc91}
        @media(max-width:900px){.sidebar{display:none}.main{margin-right:0;padding:14px}.form-card{margin-top:5px}}
        @media(max-width:575px){.topbar-tools:nth-child(2){display:none}.form-body{padding:20px}}
    </style>
</head>
<body>
<aside class="sidebar">
    <div class="logo">✦ <span>TCMG</span></div>
    <nav class="nav">
        <a class="nav-link" href="{{ route('dashboard') }}"><i class="fa-solid fa-house"></i> الصفحة الرئيسية</a>
        <a class="nav-link active" href="{{ route('contacts.index') }}"><i class="fa-solid fa-phone"></i> الاتصال</a>
        <a class="nav-link" href="/clients"><i class="fa-solid fa-users"></i> العملاء</a>
        <a class="nav-link" href="/cases"><i class="fa-regular fa-file-lines"></i> القضايا</a>
        <a class="nav-link" href="/court"><i class="fa-solid fa-scale-balanced"></i> المحكمة</a>
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
        <div class="search"><input type="search" placeholder="كيف يمكنني مساعدتك؟"></div>
    </header>

    <section class="form-card">
        <div class="form-title">{{ $contact ? 'تعديل جهة اتصال' : 'إضافة جهة اتصال' }}</div>
        <form action="{{ $contact ? route('contacts.update', $contact->id) : route('contacts.store') }}" method="POST">
            @csrf
            @if($contact)
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
                        <label class="field-label" for="name">الاسم</label>
                        <div class="field-wrap">
                            <input id="name" name="name" type="text" class="form-control" placeholder="الاسم" value="{{ old('name', $contact->name ?? '') }}" required maxlength="255" autocomplete="name">
                            <i class="fa-regular fa-user"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="field-label" for="country">البلد</label>
                        <div class="field-wrap">
                            <select id="country" name="country" class="form-select" required>
                                @foreach($countries as $country)
                                    <option value="{{ $country }}" @selected(old('country', $contact->country ?? 'مصر') === $country)>{{ $country }}</option>
                                @endforeach
                            </select>
                            <i class="fa-solid fa-chevron-down select-icon"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="field-label" for="phone">رقم التواصل</label>
                        <div class="field-wrap">
                            <input id="phone" name="phone" type="tel" class="form-control" placeholder="الرقم" value="{{ old('phone', $contact->phone ?? '') }}" required maxlength="50" autocomplete="tel">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="field-label" for="email">البريد الإلكتروني</label>
                        <div class="field-wrap">
                            <input id="email" name="email" type="email" class="form-control" placeholder="البريد الإلكتروني" value="{{ old('email', $contact->email ?? '') }}" maxlength="255" autocomplete="email">
                            <i class="fa-regular fa-envelope"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="field-label" for="category">الفئة</label>
                        <div class="field-wrap">
                            <select id="category" name="category" class="form-select" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" @selected(old('category', $contact->category ?? 'عميل') === $category)>{{ $category }}</option>
                                @endforeach
                            </select>
                            <i class="fa-solid fa-chevron-down select-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="save-row">
                    <button class="save-button" type="submit">حفظ <i class="fa-solid fa-arrow-left ms-2"></i></button>
                </div>
            </div>
        </form>
    </section>
</main>
</body>
</html>
