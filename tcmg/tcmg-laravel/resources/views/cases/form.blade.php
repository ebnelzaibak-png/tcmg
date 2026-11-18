<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $caseRecord ? 'تعديل قضية' : 'إضافة قضية' }} - TCMG</title>
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
        .topbar{display:flex;align-items:center;gap:18px;margin-bottom:40px}
        .topbar-tools{display:flex;align-items:center;gap:16px;color:var(--muted);font-size:13px;white-space:nowrap}
        .avatar{width:26px;height:26px;border-radius:50%;background:var(--gold);display:inline-block}
        .search-help{flex:1;max-width:440px;margin:auto}
        .search-help input{width:100%;padding:9px 16px;border:0;border-radius:6px;font-family:inherit;font-size:13px}
        .form-card{max-width:860px;margin:0 auto;background:var(--panel);border:1px solid #0b1027;box-shadow:0 2px 6px #05091a55}
        .form-title{padding:18px 22px;border-bottom:1px solid #8990aa;text-align:right;font-size:22px;font-weight:700}
        .form-body{padding:24px 5% 22px}
        .field-label{display:block;color:#aab1cc;font-size:12px;margin-bottom:5px;text-align:right}
        .field-wrap{position:relative}
        .field-wrap .form-control,.field-wrap .form-select{height:42px;border:0;border-radius:4px;background:#fff;color:#343a40;font-family:inherit;font-size:13px;padding:8px 14px 8px 40px}
        .field-wrap .form-control:focus,.field-wrap .form-select:focus,.report-field:focus{box-shadow:0 0 0 3px #8b6a3a55}
        .field-wrap>i{position:absolute;left:14px;top:13px;color:#808bac;pointer-events:none}
        .report-field{height:180px!important;resize:vertical}
        .save-row{display:flex;justify-content:flex-start;align-items:center;padding:12px 0 0}
        .save-button{border:0;background:transparent;color:#fff;font-weight:700;font-family:inherit;padding:8px 4px}
        .save-button:hover{color:#d8bc91}
        .case-number-note{font-size:11px;color:var(--muted);margin:0 0 16px}
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
        <a class="nav-link active" href="{{ route('cases.index') }}"><i class="fa-regular fa-file-lines"></i> القضايا</a>
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
        <div class="search-help"><input type="search" placeholder="كيف يمكنني مساعدتك؟"></div>
    </header>

    <section class="form-card">
        <div class="form-title">{{ $caseRecord ? 'تعديل قضية' : 'إضافة قضية' }}</div>
        <form action="{{ $caseRecord ? route('cases.update', $caseRecord->id) : route('cases.store') }}" method="POST">
            @csrf
            @if($caseRecord)
                @method('PUT')
            @endif
            <div class="form-body">
                @if($errors->any())
                    <div class="alert alert-danger text-end">
                        <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif
                @if($clients->isEmpty())
                    <div class="alert alert-warning text-end">
                        يجب إضافة عميل قبل تسجيل القضية.
                        <a href="{{ route('clients.create') }}" class="alert-link">إضافة عميل</a>
                    </div>
                @endif
                <p class="case-number-note">يُنشأ رقم القضية تلقائيًا عند الحفظ.</p>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="field-label" for="case_type">الفئة</label>
                        <div class="field-wrap">
                            <select id="case_type" name="case_type" class="form-select" required>
                                <option value="">اختر الفئة</option>
                                @foreach($caseTypes as $type)
                                    <option value="{{ $type }}" @selected(old('case_type', $caseRecord->case_type ?? '') === $type)>{{ $type }}</option>
                                @endforeach
                            </select>
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="field-label" for="country">البلد</label>
                        <div class="field-wrap">
                            <select id="country" name="country" class="form-select" required>
                                @foreach($countries as $country)
                                    <option value="{{ $country }}" @selected(old('country', $caseRecord->country ?? 'مصر') === $country)>{{ $country }}</option>
                                @endforeach
                            </select>
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="field-label" for="clint_id">اسم العميل 1</label>
                        <div class="field-wrap">
                            <select id="clint_id" name="clint_id" class="form-select" required @disabled($clients->isEmpty())>
                                <option value="">اختر العميل</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" @selected((string) old('clint_id', $caseRecord->clint_id ?? '') === (string) $client->id)>{{ $client->name }} - {{ $client->phone }} (#{{ $client->id }})</option>
                                @endforeach
                            </select>
                            <i class="fa-regular fa-user"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="field-label" for="client2_id">اسم العميل 2</label>
                        <div class="field-wrap">
                            <select id="client2_id" name="client2_id" class="form-select">
                                <option value="">بدون عميل ثانٍ</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" @selected((string) old('client2_id', $caseRecord->client2_id ?? '') === (string) $client->id)>{{ $client->name }} - {{ $client->phone }} (#{{ $client->id }})</option>
                                @endforeach
                            </select>
                            <i class="fa-regular fa-user"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="field-label" for="lawyer1_name">محامي 1</label>
                        <div class="field-wrap">
                            <input id="lawyer1_name" name="lawyer1_name" type="text" class="form-control" placeholder="اسم المحامي" value="{{ old('lawyer1_name', $caseRecord->lawyer1_name ?? '') }}" maxlength="255">
                            <i class="fa-regular fa-user"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="field-label" for="lawyer2_name">محامي 2</label>
                        <div class="field-wrap">
                            <input id="lawyer2_name" name="lawyer2_name" type="text" class="form-control" placeholder="اسم المحامي" value="{{ old('lawyer2_name', $caseRecord->lawyer2_name ?? '') }}" maxlength="255">
                            <i class="fa-regular fa-user"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="field-label" for="first_session_date">تاريخ الجلسة الأولى</label>
                        <div class="field-wrap">
                            <input id="first_session_date" name="first_session_date" type="date" class="form-control" value="{{ old('first_session_date', $caseRecord->first_session_date ?? '') }}">
                            <i class="fa-regular fa-calendar"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="field-label" for="session_date">تاريخ الجلسة التالية (إن وجدت)</label>
                        <div class="field-wrap">
                            <input id="session_date" name="session_date" type="date" class="form-control" value="{{ old('session_date', $caseRecord->session_date ?? '') }}">
                            <i class="fa-regular fa-calendar"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="field-label" for="judgment_date">تاريخ إصدار الحكم</label>
                        <div class="field-wrap">
                            <input id="judgment_date" name="judgment_date" type="date" class="form-control" value="{{ old('judgment_date', $caseRecord->judgment_date ?? '') }}">
                            <i class="fa-regular fa-calendar"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="field-label" for="judgment">الحكم</label>
                        <div class="field-wrap">
                            <input id="judgment" name="judgment" type="text" class="form-control" placeholder="الحكم" value="{{ old('judgment', $caseRecord->judgment ?? '') }}" maxlength="255">
                            <i class="fa-solid fa-scale-balanced"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="field-label" for="court_name">المحكمة</label>
                        <div class="field-wrap">
                            <input id="court_name" name="court_name" type="text" class="form-control" placeholder="المحكمة" value="{{ old('court_name', $caseRecord->court_name ?? '') }}" required maxlength="255">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="field-label" for="status">الحالة</label>
                        <div class="field-wrap">
                            <select id="status" name="status" class="form-select" required>
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}" @selected(old('status', $caseRecord->status ?? 'نشطة') === $status)>{{ $status }}</option>
                                @endforeach
                            </select>
                            <i class="fa-regular fa-circle-question"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="field-label" for="fee">السعر</label>
                        <div class="field-wrap">
                            <input id="fee" name="fee" type="number" min="0" step="0.01" class="form-control" placeholder="السعر" value="{{ old('fee', $caseRecord->fee ?? '') }}">
                            <i class="fa-solid fa-dollar-sign"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="field-label" for="tasks">المهام</label>
                        <div class="field-wrap">
                            <input id="tasks" name="tasks" type="text" class="form-control" placeholder="المهام" value="{{ old('tasks', $caseRecord->tasks ?? '') }}">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="field-label" for="report">التقرير</label>
                        <div class="field-wrap">
                            <textarea id="report" name="report" class="form-control report-field" placeholder="التقرير">{{ old('report', $caseRecord->report ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="save-row">
                    <a class="btn btn-link text-white text-decoration-none me-3" href="{{ route('cases.index') }}">إلغاء</a>
                    <button class="save-button" type="submit" @disabled($clients->isEmpty())>
                        حفظ <i class="fa-solid fa-arrow-left ms-2"></i>
                    </button>
                </div>
            </div>
        </form>
    </section>
</main>
</body>
</html>
