<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>إعدادات النظام - TCMG</title>
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
        .settings-panel{background:var(--panel);border:1px solid #0b1027;margin:30px 5.5%;min-height:645px}
        .panel-title{padding:21px 24px;border-bottom:1px solid #8990aa;text-align:right;font-size:24px;font-weight:700}
        .setting-row{border-bottom:1px solid #8990aa}
        .setting-row summary{min-height:55px;display:flex;align-items:center;justify-content:space-between;padding:0 26px;cursor:pointer;list-style:none;color:#dce1f3}
        .setting-row summary::-webkit-details-marker{display:none}
        .setting-name{display:flex;align-items:center;gap:14px;font-size:15px}
        .setting-name i{width:18px;text-align:center;color:#fff}
        .chevron{font-size:14px;transition:transform .18s ease}
        .setting-row[open] .chevron{transform:rotate(180deg)}
        .setting-content{padding:4px 26px 20px;background:#171e40}
        .setting-form{display:flex;align-items:end;gap:12px;max-width:650px}
        .setting-control{flex:1}
        .setting-control label{display:block;color:#c3c9df;font-size:12px;margin-bottom:6px}
        .setting-control select{min-height:40px;font-family:inherit;font-size:13px}
        .save-button{min-height:40px;background:#fff;color:#10153a;border:0;border-radius:5px;padding:7px 22px;font-family:inherit;font-size:13px;font-weight:700}
        .save-button:hover{background:#e8ebf5}
        .table-choices{display:flex;gap:12px;flex-wrap:wrap}
        .table-choice{position:relative;display:flex;align-items:center;gap:10px;padding:10px 14px;border:1px solid #4d587d;border-radius:6px;cursor:pointer}
        .table-choice:has(input:checked){border-color:#fff;background:#222a58}
        .table-choice input{accent-color:#5375ff}
        .table-preview{width:48px;height:28px;border:1px solid #8c94ad;border-radius:3px;display:flex;flex-direction:column;overflow:hidden}
        .table-preview span{height:9px;border-bottom:1px solid #8c94ad;background:#1a2148}
        .table-preview.striped span:nth-child(even){background:#35406f}
        .table-preview.compact span{height:6px}
        .validation-errors{margin:20px 5.5% 0}
        .success-message{margin:20px 5.5% 0}
        @media(max-width:900px){.settings-panel{margin-inline:2%}.setting-row summary{padding-inline:18px}}
        @media(max-width:760px){.sidebar{display:none}.main{margin-right:0}.settings-panel{margin:18px 0;min-height:calc(100vh - 100px)}.success-message,.validation-errors{margin-inline:0}}
        @media(max-width:560px){.main{padding:12px}.topbar-tools:nth-child(2){display:none}.panel-title{font-size:20px;padding:18px}.setting-content{padding:8px 16px 16px}.setting-form{align-items:stretch;flex-direction:column}.save-button{align-self:flex-start}.setting-name{font-size:13px}.setting-row summary{padding-inline:14px}}
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
        <a class="nav-link" href="/permissions"><i class="fa-solid fa-lock"></i> صلاحيات الدخول</a>
        <a class="nav-link" href="/consultations"><i class="fa-solid fa-gavel"></i> الاستشارات القانونية</a>
        <a class="nav-link active" href="{{ route('settings.index') }}"><i class="fa-solid fa-gear"></i> النظام</a>
    </nav>
</aside>

<main class="main">
    <header class="topbar">
        <div class="topbar-tools"><span class="avatar"></span> Admin ▾</div>
        <div class="topbar-tools"><span>💬</span><span>🔔</span><span>🇪🇬 ▾</span></div>
        <div class="search-help"><input type="search" placeholder="كيف يمكنني مساعدتك؟" aria-label="كيف يمكنني مساعدتك؟"></div>
    </header>

    @if(session('success'))
        <div class="alert alert-success success-message text-end">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger validation-errors text-end">
            <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <section class="settings-panel" aria-labelledby="settings-title">
        <h1 class="panel-title" id="settings-title">إعدادات النظام</h1>

        <details class="setting-row">
            <summary>
                <span class="setting-name"><i class="fa-solid fa-globe"></i> اللغة</span>
                <i class="fa-solid fa-chevron-down chevron"></i>
            </summary>
            <div class="setting-content">
                <form class="setting-form" action="{{ route('settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="section" value="language">
                    <div class="setting-control">
                        <label for="language">لغة النظام</label>
                        <select class="form-select" id="language" name="language">
                            @foreach($options['language'] as $value => $label)
                                <option value="{{ $value }}" @selected($settings['language'] === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="save-button" type="submit">حفظ</button>
                </form>
            </div>
        </details>

        <details class="setting-row">
            <summary>
                <span class="setting-name"><i class="fa-solid fa-table"></i> تغيير صورة الجدول</span>
                <i class="fa-solid fa-chevron-down chevron"></i>
            </summary>
            <div class="setting-content">
                <form action="{{ route('settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="section" value="table_style">
                    <div class="table-choices">
                        @foreach($options['table_style'] as $value => $label)
                            <label class="table-choice">
                                <input type="radio" name="table_style" value="{{ $value }}" @checked($settings['table_style'] === $value)>
                                <span class="table-preview {{ $value }}"><span></span><span></span><span></span></span>
                                <span>{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                    <button class="save-button mt-3" type="submit">حفظ</button>
                </form>
            </div>
        </details>

        <details class="setting-row">
            <summary>
                <span class="setting-name"><i class="fa-regular fa-calendar"></i> تنسيق التاريخ</span>
                <i class="fa-solid fa-chevron-down chevron"></i>
            </summary>
            <div class="setting-content">
                <form class="setting-form" action="{{ route('settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="section" value="date_format">
                    <div class="setting-control">
                        <label for="date_format">تنسيق عرض التاريخ</label>
                        <select class="form-select" id="date_format" name="date_format">
                            @foreach($options['date_format'] as $value => $label)
                                <option value="{{ $value }}" @selected($settings['date_format'] === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="save-button" type="submit">حفظ</button>
                </form>
            </div>
        </details>

        <details class="setting-row">
            <summary>
                <span class="setting-name"><i class="fa-solid fa-dollar-sign"></i> العملة</span>
                <i class="fa-solid fa-chevron-down chevron"></i>
            </summary>
            <div class="setting-content">
                <form class="setting-form" action="{{ route('settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="section" value="currency">
                    <div class="setting-control">
                        <label for="currency">العملة الافتراضية</label>
                        <select class="form-select" id="currency" name="currency">
                            @foreach($options['currency'] as $value => $label)
                                <option value="{{ $value }}" @selected($settings['currency'] === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="save-button" type="submit">حفظ</button>
                </form>
            </div>
        </details>

        <details class="setting-row">
            <summary>
                <span class="setting-name"><i class="fa-regular fa-clock"></i> المنطقة الزمنية</span>
                <i class="fa-solid fa-chevron-down chevron"></i>
            </summary>
            <div class="setting-content">
                <form class="setting-form" action="{{ route('settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="section" value="timezone">
                    <div class="setting-control">
                        <label for="timezone">المنطقة الزمنية</label>
                        <select class="form-select" id="timezone" name="timezone">
                            @foreach($options['timezone'] as $value => $label)
                                <option value="{{ $value }}" @selected($settings['timezone'] === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="save-button" type="submit">حفظ</button>
                </form>
            </div>
        </details>
    </section>
</main>
</body>
</html>
