<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $employeeRecord ? 'تعديل موظف/محامي' : 'إضافة موظف/محامي' }} - TCMG</title>
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
        .topbar{display:flex;align-items:center;gap:18px;margin-bottom:24px}
        .topbar-tools{display:flex;align-items:center;gap:16px;color:var(--muted);font-size:13px;white-space:nowrap}
        .avatar{width:26px;height:26px;border-radius:50%;background:var(--gold);display:inline-block}
        .search-help{flex:1;max-width:440px;margin:auto}
        .search-help input{width:100%;padding:9px 16px;border:0;border-radius:6px;font-family:inherit;font-size:13px}
        .form-card{background:var(--panel);border-radius:8px;min-height:calc(100vh - 100px)}
        .form-title{padding:20px 26px;border-bottom:1px solid #8990aa;font-size:25px;font-weight:700}
        .employee-form{padding:24px 5.5%}
        .form-grid{display:grid;grid-template-columns:1fr 1fr;column-gap:9%;row-gap:14px}
        .field-label{display:block;color:#e5e8f4;font-size:12px;margin:0 0 5px}
        .form-control,.form-select{height:44px;background:#fff;color:#222;border:1px solid #d5d9e3;font-family:inherit;font-size:13px}
        .form-control::placeholder{color:#9aa3c7}
        .form-control:focus,.form-select:focus{border-color:#8b6a3a;box-shadow:0 0 0 .2rem #8b6a3a33}
        .access-section{grid-column:1/-1;margin-top:8px}
        .access-heading{font-size:19px;margin:8px 0 12px}
        .module-list{max-width:600px}
        .module-row{display:flex;align-items:center;justify-content:space-between;gap:16px;min-height:39px;padding:3px 4px;border-bottom:1px solid #30385f;cursor:pointer}
        .module-label{display:flex;align-items:center;gap:12px;font-size:14px}
        .module-label i{width:20px;text-align:center;color:#fff}
        .module-switch{appearance:none;-webkit-appearance:none;position:relative;width:38px;height:21px;margin:0;flex:none;border:0;border-radius:999px;background:#d6dced;cursor:pointer;transition:background .16s ease}
        .module-switch::before{content:"";position:absolute;top:3px;right:3px;width:15px;height:15px;border-radius:50%;background:#fff;transition:transform .16s ease}
        .module-switch:checked{background:#5375ff}
        .module-switch:checked::before{transform:translateX(-17px)}
        .module-switch:focus-visible{outline:2px solid #fff;outline-offset:2px}
        .form-actions{display:flex;justify-content:flex-start;align-items:center;gap:18px;margin-top:28px}
        .save-button{border:0;background:none;color:#fff;font-weight:700;font-family:inherit}
        .back-link{color:#fff;text-decoration:none}
        .validation-errors{margin:20px 5.5% 0}
        @media(max-width:760px){.sidebar{display:none}.main{margin-right:0}.form-grid{grid-template-columns:1fr;gap:13px}.access-section{grid-column:auto}.form-actions{margin-top:24px}}
        @media(max-width:650px){.main{padding:12px}.topbar-tools:nth-child(2){display:none}.form-title{font-size:20px;padding:18px}.employee-form{padding:20px}.validation-errors{margin-inline:20px}.access-heading{font-size:17px}}
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
        <a class="nav-link" href="{{ route('court.index') }}"><i class="fa-solid fa-scale-balanced"></i> المحكمة</a>
        <a class="nav-link" href="{{ route('tasks.index') }}"><i class="fa-solid fa-check"></i> المهام و الأعمال</a>
        <a class="nav-link" href="{{ route('employees.index') }}"><i class="fa-solid fa-users"></i> الموارد البشرية</a>
        <a class="nav-link" href="{{ route('vacations.index') }}"><i class="fa-regular fa-clock"></i> الإجازات</a>
        <a class="nav-link active" href="{{ route('permissions.index') }}"><i class="fa-solid fa-lock"></i> صلاحيات الدخول</a>
        <a class="nav-link" href="{{ route('consultations.index') }}"><i class="fa-solid fa-gavel"></i> الاستشارات القانونية</a>
        <a class="nav-link" href="{{ route('settings.index') }}"><i class="fa-solid fa-gear"></i> النظام</a>
    </nav>
</aside>

<main class="main">
    <header class="topbar">
        <div class="topbar-tools"><span class="avatar"></span> Admin ▾</div>
        <div class="topbar-tools"><span>💬</span><span>🔔</span><span>🇪🇬 ▾</span></div>
        <div class="search-help"><input type="search" placeholder="كيف يمكنني مساعدتك؟" aria-label="كيف يمكنني مساعدتك؟"></div>
    </header>

    <section class="form-card">
        <h1 class="form-title">{{ $employeeRecord ? 'تعديل موظف/محامي' : 'إضافة موظف/محامي' }}</h1>
        @if($errors->any())
            <div class="alert alert-danger validation-errors text-end">
                <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif
        @php($selectedModules = is_array(old('modules')) ? old('modules') : $enabledModules)
        <form class="employee-form" action="{{ $employeeRecord ? route('permissions.update', $employeeRecord->id) : route('permissions.store') }}" method="POST">
            @csrf
            @if($employeeRecord)
                @method('PUT')
            @endif
            <div class="form-grid">
                <div>
                    <label class="field-label" for="name">الاسم</label>
                    <input class="form-control text-end" id="name" name="name" value="{{ old('name', $employeeRecord->name ?? '') }}" placeholder="الاسم" maxlength="255" required>
                </div>
                <div>
                    <label class="field-label" for="country">البلد</label>
                    <select class="form-select text-end" id="country" name="country" required>
                        <option value="">البلد</option>
                        @foreach($countries as $country)
                            <option value="{{ $country }}" @selected(old('country', $employeeRecord->country ?? 'مصر') === $country)>{{ $country }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="field-label" for="age">السن</label>
                    <input class="form-control text-end" type="number" id="age" name="age" value="{{ old('age', $employeeRecord->age ?? '') }}" placeholder="السن" min="15" max="100">
                </div>
                <div>
                    <label class="field-label" for="hire_date">التاريخ</label>
                    <input class="form-control text-end" type="date" id="hire_date" name="hire_date" value="{{ old('hire_date', $employeeRecord->hire_date ?? '') }}" required>
                </div>
                <div>
                    <label class="field-label" for="email">البريد الإلكتروني</label>
                    <input class="form-control text-end" type="email" id="email" name="email" value="{{ old('email', $employeeRecord->email ?? '') }}" placeholder="البريد الإلكتروني">
                </div>
                <div>
                    <label class="field-label" for="phone">رقم التواصل</label>
                    <input class="form-control text-end" id="phone" name="phone" value="{{ old('phone', $employeeRecord->phone ?? '') }}" placeholder="الرقم" maxlength="50" required>
                </div>
                <div>
                    <label class="field-label" for="job_title">الدور</label>
                    <select class="form-select text-end" id="job_title" name="job_title" required>
                        <option value="">الدور</option>
                        @foreach($roles as $role)
                            <option value="{{ $role }}" @selected(old('job_title', $employeeRecord->job_title ?? '') === $role)>{{ $role }}</option>
                        @endforeach
                    </select>
                </div>

                <section class="access-section" aria-labelledby="access-heading">
                    <h2 class="access-heading" id="access-heading">الصلاحيات</h2>
                    <div class="module-list">
                        @foreach($modules as $module)
                            <label class="module-row" for="module-{{ $loop->index }}">
                                <span class="module-label"><i class="fa-solid {{ $moduleIcons[$module] }}"></i>{{ $module }}</span>
                                <input class="module-switch" type="checkbox" id="module-{{ $loop->index }}" name="modules[]" value="{{ $module }}" @checked(in_array($module, $selectedModules, true)) aria-label="السماح بالدخول إلى {{ $module }}">
                            </label>
                        @endforeach
                    </div>
                </section>
            </div>
            <div class="form-actions">
                <a class="back-link" href="{{ route('permissions.index') }}" aria-label="رجوع"><i class="fa-solid fa-arrow-left"></i></a>
                <button class="save-button" type="submit">حفظ</button>
            </div>
        </form>
    </section>
</main>
</body>
</html>
