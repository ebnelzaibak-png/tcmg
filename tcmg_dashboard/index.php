<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TCMG | الشاشة الرئيسية</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <div class="app">
    <aside class="sidebar">
      <div class="brand"><span class="brand-mark">✦</span><span>TCMG</span></div>
      <nav>
        <a class="active" href="#"><span>⌂</span> الصفحة الرئيسية</a>
        <a href="#"><span>♧</span> الاتصال</a>
        <a href="#"><span>♙</span> العملاء</a>
        <a href="#"><span>▢</span> القضايا</a>
        <a href="#"><span>⚖</span> المحكمة</a>
        <a href="#"><span>✓</span> المهام و الأعمال</a>
        <a href="#"><span>♧</span> الموارد البشرية</a>
        <a href="#"><span>◷</span> الإجازات</a>
        <a href="#"><span>▣</span> صلاحيات الدخول</a>
        <a href="#"><span>⚒</span> الاستشارات القانونية</a>
        <a href="#"><span>⚙</span> النظام</a>
      </nav>
    </aside>

    <main class="main">
      <header class="topbar">
        <div class="user"><span class="avatar">A</span><span>Admin</span><span>⌄</span></div>
        <div class="top-actions"><span>▤</span><span class="bell">♧<i>5</i></span><span>🇪🇬</span></div>
        <label class="search"><span>⌕</span><input type="search" placeholder="كيف يمكننا مساعدتك؟"></label>
      </header>

      <section class="top-grid">
        <article class="panel cases-panel">
          <div class="panel-heading">
            <div><h1>القضايا</h1><p>من 1 مارس إلى 11 مارس</p></div>
            <div class="legend"><span><i class="gold"></i> نشطة</span><span><i class="white"></i> مغلقة</span></div>
          </div>
          <canvas id="casesLine"></canvas>
        </article>
        <article class="panel calendar-panel">
          <div class="calendar-head"><button id="prevMonth">‹</button><strong id="monthLabel">Mar 2024</strong><button id="nextMonth">›</button></div>
          <div class="calendar-grid" id="calendar"></div>
        </article>
      </section>

      <section class="stats-grid">
        <article class="stat-card"><div class="stat-top"><span>◷</span><b>مجموع حالات الانتظار</b></div><strong>2</strong><small>حالات الانتظار　‹</small></article>
        <article class="stat-card"><div class="stat-top"><span>♧</span><b>مجموع جهات الاتصال</b></div><strong>124</strong><small>جهات الاتصال　‹</small></article>
        <article class="stat-card"><div class="stat-top"><span>♧</span><b>مجموع الوحدات التابعة</b></div><strong>4</strong><small>الوحدات التابعة　‹</small></article>
        <article class="stat-card"><div class="stat-top"><span>♙</span><b>مجموع المحامين</b></div><strong>34</strong><small>المحامين　‹</small></article>
      </section>

      <section class="middle-grid">
        <article class="panel pie-panel">
          <div class="panel-heading"><div><h2>فئات القضايا</h2><p>من 1 مارس إلى 11 مارس</p></div></div>
          <canvas id="casesPie"></canvas>
        </article>
        <article class="panel clients-panel">
          <div class="panel-heading"><div><h2>العملاء</h2><p>من 1 مارس إلى 11 مارس</p></div><div class="legend"><span><i class="gold"></i> شركات ومؤسسات</span><span><i class="white"></i> أفراد</span></div></div>
          <canvas id="clientsBar"></canvas>
        </article>
      </section>

      <section class="panel consultations-panel">
        <div class="panel-heading"><div><h2>الاستشارات القانونية</h2><p>من 1 مارس إلى 11 مارس</p></div></div>
        <canvas id="consultationsBar"></canvas>
      </section>
    </main>
  </div>
  <script src="assets/js/app.js"></script>
</body>
</html>
