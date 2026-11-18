<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $consultationRecord ? 'تعديل الاستشارة' : 'إضافة استشارة قانونية' }} - TCMG</title>
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
        .form-card{background:var(--panel);border:1px solid #0b1027;border-radius:7px;min-height:calc(100vh - 100px);overflow:hidden}
        .form-title{padding:20px 26px;border-bottom:1px solid #8990aa;font-size:24px;font-weight:700}
        .consultation-form{padding:28px 5.5%}
        .form-grid{display:grid;grid-template-columns:1fr 1fr;column-gap:9%;row-gap:15px}
        .field-label{display:block;color:#e5e8f4;font-size:12px;margin:0 0 5px}
        .form-control,.form-select{height:46px;background:#fff;color:#222;border:1px solid #d5d9e3;font-family:inherit;font-size:13px}
        .form-control::placeholder{color:#9aa3c7}
        .form-control:focus,.form-select:focus{border-color:#8b6a3a;box-shadow:0 0 0 .2rem #8b6a3a33}
        .form-control[readonly]{background:#f1f2f6}
        .report-field{grid-column:1/-1}
        .report-field textarea{height:86px;resize:vertical}
        .form-actions{display:flex;justify-content:flex-start;align-items:center;gap:18px;margin-top:30px}
        .save-button{border:0;background:none;color:#fff;font-weight:700;font-family:inherit}
        .back-link{color:#fff;text-decoration:none}
        .validation-errors,.no-clients{margin:20px 5.5% 0}
        @media(max-width:760px){.sidebar{display:none}.main{margin-right:0}.form-grid{grid-template-columns:1fr;gap:14px}.report-field{grid-column:auto}.form-actions{margin-top:24px}}
        @media(max-width:650px){.main{padding:12px}.topbar-tools:nth-child(2){display:none}.form-title{font-size:20px;padding:18px}.consultation-form{padding:22px}.validation-errors,.no-clients{margin-inline:22px}}
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
        <a class="nav-link active" href="{{ route('consultations.index') }}"><i class="fa-solid fa-gavel"></i> الاستشارات القانونية</a>
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
        <h1 class="form-title">{{ $consultationRecord ? 'تعديل الاستشارة القانونية' : 'إضافة استشارة قانونية' }}</h1>
        @if($errors->any())
            <div class="alert alert-danger validation-errors text-end">
                <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif
        @if($clients->isEmpty())
            <div class="alert alert-warning no-clients text-end">
                يجب تسجيل عميل أولًا لإضافة استشارة. <a href="{{ route('clients.create') }}" class="alert-link">إضافة عميل</a>
            </div>
        @endif

        <form class="consultation-form" action="{{ $consultationRecord ? route('consultations.update', $consultationRecord->id) : route('consultations.store') }}" method="POST">
            @csrf
            @if($consultationRecord)
                @method('PUT')
            @endif
            <div class="form-grid">
                <div>
                    <label class="field-label" for="consultation_type">نوع الاستشارة</label>
                    <select class="form-select text-end" id="consultation_type" name="consultation_type" required>
                        <option value="">النوع</option>
                        @foreach($types as $type)
                            <option value="{{ $type }}" @selected(old('consultation_type', $consultationRecord->consultation_type ?? '') === $type)>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="field-label" for="specialization">تخصص الاستشارة</label>
                    <select class="form-select text-end" id="specialization" name="specialization" required>
                        <option value="">التخصص</option>
                        @foreach($specializations as $specialization)
                            <option value="{{ $specialization }}" @selected(old('specialization', $consultationRecord->specialization ?? $consultationRecord->subject ?? '') === $specialization)>{{ $specialization }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="field-label" for="clint_id">اسم العميل</label>
                    <select class="form-select text-end" id="clint_id" name="clint_id" required @disabled($clients->isEmpty())>
                        <option value="">العميل</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" data-phone="{{ $client->phone }}" data-email="{{ $client->email }}" data-country="{{ $client->nationality }}" @selected((string) old('clint_id', $consultationRecord->clint_id ?? '') === (string) $client->id)>{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="field-label" for="lawyer_name">المحامي المختص</label>
                    <input class="form-control text-end" id="lawyer_name" name="lawyer_name" value="{{ old('lawyer_name', $consultationRecord->lawyer_name ?? '') }}" placeholder="المحامي" required maxlength="255">
                </div>
                <div>
                    <label class="field-label" for="client_phone">رقم التواصل</label>
                    <input class="form-control text-end" id="client_phone" value="{{ $selectedClient->phone ?? '' }}" placeholder="الرقم" readonly>
                </div>
                <div>
                    <label class="field-label" for="client_email">البريد الإلكتروني للعميل</label>
                    <input class="form-control text-end" id="client_email" value="{{ $selectedClient->email ?? '' }}" placeholder="البريد الإلكتروني" readonly>
                </div>
                <div>
                    <label class="field-label" for="consultation_date">تاريخ الاستشارة</label>
                    <input class="form-control text-end" type="date" id="consultation_date" name="consultation_date" value="{{ old('consultation_date', $consultationRecord->consultation_date ?? '') }}" required>
                </div>
                <div>
                    <label class="field-label" for="consultation_time">موعد الاستشارة</label>
                    <input class="form-control text-end" type="time" id="consultation_time" name="consultation_time" value="{{ old('consultation_time', $consultationRecord->consultation_time ?? '') }}" required>
                </div>
                <div>
                    <label class="field-label" for="country">البلد</label>
                    <select class="form-select text-end" id="country" name="country" required>
                        <option value="">البلد</option>
                        @foreach($countries as $country)
                            <option value="{{ $country }}" @selected(old('country', $consultationRecord->country ?? $selectedClient->nationality ?? '') === $country)>{{ $country }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="field-label" for="price">سعر الاستشارة</label>
                    <div class="input-group">
                        <input class="form-control text-end" type="number" id="price" name="price" value="{{ old('price', $consultationRecord->price ?? '') }}" placeholder="السعر" min="0" max="9999999999" step="0.01" required>
                        <span class="input-group-text">$</span>
                    </div>
                </div>
                @if($consultationRecord)
                    <div>
                        <label class="field-label" for="status">حالة الاستشارة</label>
                        <select class="form-select text-end" id="status" name="status" required>
                            @foreach($statuses as $status)
                                <option value="{{ $status }}" @selected(old('status', $consultationRecord->status) === $status)>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="report-field">
                    <label class="field-label" for="details">التقرير</label>
                    <textarea class="form-control text-end" id="details" name="details" placeholder="التقرير..." required maxlength="10000">{{ old('details', $consultationRecord->details ?? '') }}</textarea>
                </div>
            </div>
            <div class="form-actions">
                <a class="back-link" href="{{ route('consultations.index') }}" aria-label="رجوع"><i class="fa-solid fa-arrow-left"></i></a>
                <button class="save-button" type="submit" @disabled($clients->isEmpty())>حفظ</button>
            </div>
        </form>
    </section>
</main>

<script>
    const clientSelect = document.getElementById('clint_id');
    const clientPhone = document.getElementById('client_phone');
    const clientEmail = document.getElementById('client_email');
    const clientCountry = document.getElementById('country');

    function updateClientDetails(updateCountry) {
        const client = clientSelect.selectedOptions[0];
        clientPhone.value = client ? client.dataset.phone || '' : '';
        clientEmail.value = client ? client.dataset.email || '' : '';
        if (updateCountry) {
            clientCountry.value = client ? client.dataset.country || '' : '';
        }
    }

    clientSelect.addEventListener('change', () => updateClientDetails(true));
    updateClientDetails(false);
</script>
</body>
</html>
