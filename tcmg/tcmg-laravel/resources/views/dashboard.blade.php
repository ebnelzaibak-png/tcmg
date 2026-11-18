<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>TCMG - الصفحة الرئيسية</title>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<style>
:root{--bg:#0f1530;--panel:#1a2148;--panel2:#222a58;--gold:#8b6a3a;--white:#fff;--muted:#9aa3c7;--red:#8a1f3d;--navy:#10153a}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Cairo',Tahoma,sans-serif;background:var(--bg);color:var(--white);min-height:100vh;display:flex}
.sidebar{width:250px;background:var(--panel);padding:24px 14px;flex-shrink:0;position:sticky;top:0;height:100vh}
.logo{text-align:center;font-weight:700;letter-spacing:4px;font-size:22px;margin-bottom:28px;padding:10px 0}
.logo span{color:var(--gold)}
.nav a{display:flex;align-items:center;gap:12px;padding:11px 14px;border-radius:6px;color:var(--white);text-decoration:none;font-size:14px;margin-bottom:4px}
.nav a.active{background:#fff;color:var(--navy);font-weight:600}
.nav a:not(.active):hover{background:var(--panel2)}
svg.ic{width:18px;height:18px;flex-shrink:0;stroke:currentColor;fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
.main{flex:1;padding:18px 24px;min-width:0}
.topbar{display:flex;align-items:center;gap:16px;margin-bottom:22px}
.search{flex:1;max-width:520px;margin:0 auto}
.search input{width:100%;padding:9px 16px;border-radius:6px;border:0;font-family:inherit;font-size:13px;background:#fff;color:#222}
.tools{display:flex;align-items:center;gap:16px;color:var(--muted);font-size:13px}
.avatar{width:26px;height:26px;border-radius:50%;background:var(--gold);display:inline-block;vertical-align:middle}
.badge{position:relative}.badge::after{content:"";position:absolute;top:-3px;inset-inline-end:-4px;width:8px;height:8px;border-radius:50%;background:#3b82f6}
.grid-top{display:grid;grid-template-columns:2fr 1fr;gap:18px;margin-bottom:18px}
.card{background:var(--panel);border-radius:10px;padding:18px}
.card h3{font-size:18px;margin-bottom:2px}
.sub{font-size:11px;color:var(--muted);margin-bottom:12px}
.legend{display:flex;gap:16px;font-size:11px;color:var(--muted);margin-bottom:8px;flex-wrap:wrap}
.legend i{display:inline-block;width:9px;height:9px;border-radius:50%;margin-inline-end:5px}
.chart-box{position:relative;height:220px}
.cal-head{display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;font-size:13px}
.cal-head button{background:none;border:0;color:#fff;cursor:pointer;font-size:16px}
.cal{display:grid;grid-template-columns:repeat(7,1fr);gap:4px;text-align:center;font-size:12px;direction:ltr}
.cal .dow{color:var(--muted);font-size:11px;padding-bottom:6px}
.cal .d{padding:7px 0;border-radius:4px;cursor:pointer}
.cal .off{color:#5b648f}
.cal .sel{background:#fff;color:var(--navy);font-weight:600}
.stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(190px,1fr));gap:18px;margin-bottom:18px}
.stat .top{display:flex;align-items:center;justify-content:space-between;font-size:13px;gap:8px}
.stat .num{font-size:28px;font-weight:700;margin:6px 0 14px}
.stat .foot{display:flex;justify-content:space-between;font-size:10px;color:var(--muted)}
.up{color:#6fd39a}.down{color:#f08a8a}
.grid-bot{display:grid;grid-template-columns:1fr 1.6fr;gap:18px}
.pie-wrap{display:flex;gap:14px;align-items:center;flex-wrap:wrap}
.pie-wrap .chart-box{height:210px;width:210px;flex:none}
@media(max-width:1000px){.grid-top,.grid-bot{grid-template-columns:1fr}.sidebar{display:none}}
</style>
</head>
<body>

<aside class="sidebar">
  <div class="logo">✦ <span>TCMG</span></div>
  <nav class="nav" id="nav"></nav>
</aside>

<div class="main">
  <div class="topbar">
    <div class="tools"><span class="avatar"></span> {{ auth()->user()->name ?? 'Admin' }} ▾</div>
    <div class="tools"><span>💬</span><span class="badge">🔔</span><span>🇪🇬 ▾</span></div>
    <div class="search"><input type="search" placeholder="كيف يمكنني مساعدتك؟"></div>
  </div>

  @php $range = 'من '.$from->translatedFormat('j F').' إلى '.$to->translatedFormat('j F'); @endphp

  <div class="grid-top">
    <div class="card">
      <h3>القضايا والجلسات</h3>
      <div class="sub">{{ $range }}</div>
      <div class="legend"><span><i style="background:var(--gold)"></i>قضايا مسجلة</span><span><i style="background:#fff"></i>جلسات محددة</span></div>
      <div class="chart-box"><canvas id="casesChart"></canvas></div>
    </div>
    <div class="card">
      <div class="cal-head"><button id="next">‹</button><b id="calTitle"></b><button id="prev">›</button></div>
      <div class="cal" id="cal"></div>
    </div>
  </div>

  <div class="stats">
    @foreach($stats as $s)
      <div class="card stat">
        <div class="top"><span>{{ $s['title'] }}</span><svg class="ic" viewBox="0 0 24 24" data-icon="{{ $s['icon'] }}"></svg></div>
        <div class="num">{{ number_format($s['value']) }}</div>
        <div class="foot"><span class="{{ $s['class'] }}">{{ $s['note'] }}</span><span>‹ {{ $s['link'] }}</span></div>
      </div>
    @endforeach
  </div>

  <div class="grid-bot">
    <div class="card">
      <h3>فئات القضايا</h3>
      <div class="sub">{{ $range }}</div>
      <div class="pie-wrap">
        <div class="legend" style="flex-direction:column;gap:8px">
          @foreach($charts['categories']['labels'] as $index => $label)
            <span><i style="background:{{ ['#8b6a3a', '#fff', '#10153a', '#8a1f3d'][$index % 4] }};border:1px solid #fff"></i>{{ $label }}</span>
          @endforeach
        </div>
        <div class="chart-box"><canvas id="pieChart"></canvas></div>
      </div>
    </div>
    <div class="card">
      <h3>العملاء</h3>
      <div class="sub">{{ $range }}</div>
      <div class="legend"><span><i style="background:var(--gold)"></i>عملاء مسجلون</span></div>
      <div class="chart-box"><canvas id="barChart"></canvas></div>
    </div>
  </div>

  <div class="card" style="margin-top:18px">
    <h3>الاستشارات القانونية</h3>
    <div class="sub">{{ $range }}</div>
    <div class="legend">
      @foreach($charts['consultations']['statuses'] as $status)
        <span><i style="background:{{ $status['color'] }}"></i>{{ $status['label'] }}</span>
      @endforeach
    </div>
    <div class="chart-box" style="height:280px"><canvas id="consultChart"></canvas></div>
  </div>
</div>

<script>
/* ---------- Icons + Sidebar ---------- */
const P={
 home:'<path d="M3 11l9-8 9 8M5 10v10h14V10"/>',
 phone:'<path d="M5 4h4l2 5-2.5 1.5a11 11 0 005 5L15 13l5 2v4a2 2 0 01-2 2A16 16 0 013 6a2 2 0 012-2z"/>',
 users:'<circle cx="9" cy="8" r="3"/><path d="M3 20c0-3.5 3-5 6-5s6 1.5 6 5M16 5a3 3 0 010 6M18 15c2 .7 3 2 3 5"/>',
 file:'<path d="M6 3h8l4 4v14H6zM14 3v4h4"/>',
 scale:'<path d="M12 3v18M6 21h12M5 7h14M5 7l-3 7a3 3 0 006 0zM19 7l-3 7a3 3 0 006 0z"/>',
 check:'<path d="M4 12l5 5L20 6"/>',
 clock:'<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
 lock:'<rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V8a4 4 0 018 0v3"/>',
 gavel:'<path d="M14 4l6 6-3 3-6-6zM9 9l-6 6 3 3 6-6M4 21h10"/>',
 gear:'<circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3M5 5l2 2M17 17l2 2M5 19l2-2M17 7l2-2"/>',
 pin:'<path d="M12 21s7-6 7-12a7 7 0 10-14 0c0 6 7 12 7 12z"/><circle cx="12" cy="9" r="2.5"/>',
 user:'<circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-6 8-6s8 2 8 6"/>'
};
document.querySelectorAll('[data-icon]').forEach(el => el.innerHTML = P[el.dataset.icon]);

const menu=[['الصفحة الرئيسية','home',1],['الاتصال','phone'],['العملاء','users'],['القضايا','file'],['المحكمة','scale'],['المهام و الأعمال','check'],['الموارد البشرية','users'],['الإجازات','clock'],['صلاحيات الدخول','lock'],['الاستشارات القانونية','gavel'],['النظام','gear']];
const contactsUrl=@json(route('contacts.index'));
document.getElementById('nav').innerHTML=menu.map(m=>`<a href="${m[1]==='phone'?contactsUrl:'#'}" class="${m[2]?'active':''}"><svg class="ic" viewBox="0 0 24 24">${P[m[1]]}</svg>${m[0]}</a>`).join('');

/* ---------- Calendar ---------- */
const months=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
let cur=new Date(), selected=cur.getDate();
function renderCal(){
  const y=cur.getFullYear(),m=cur.getMonth();
  document.getElementById('calTitle').textContent=months[m]+' '+y;
  const first=new Date(y,m,1).getDay(), days=new Date(y,m+1,0).getDate(), prevDays=new Date(y,m,0).getDate();
  let h=['Sun','Mon','Tue','Wed','Thu','Fri','Sat'].map(d=>`<div class="dow">${d}</div>`).join('');
  for(let i=first-1;i>=0;i--)h+=`<div class="d off">${prevDays-i}</div>`;
  for(let d=1;d<=days;d++)h+=`<div class="d ${d===selected?'sel':''}" data-d="${d}">${String(d).padStart(2,'0')}</div>`;
  const rest=(7-((first+days)%7))%7;
  for(let i=1;i<=rest;i++)h+=`<div class="d off">${String(i).padStart(2,'0')}</div>`;
  const el=document.getElementById('cal');el.innerHTML=h;
  el.querySelectorAll('[data-d]').forEach(n=>n.onclick=()=>{selected=+n.dataset.d;renderCal()});
}
document.getElementById('prev').onclick=()=>{cur.setDate(1);cur.setMonth(cur.getMonth()-1);renderCal()};
document.getElementById('next').onclick=()=>{cur.setDate(1);cur.setMonth(cur.getMonth()+1);renderCal()};
renderCal();

/* ---------- Charts (data from Laravel) ---------- */
const C = @json($charts);
const GOLD='#8b6a3a',grid='rgba(255,255,255,.55)',tick={color:'#fff',font:{size:10}};
Chart.defaults.font.family='Cairo';
const scales={x:{ticks:tick,grid:{color:grid}},y:{beginAtZero:true,ticks:{...tick,precision:0},grid:{color:grid}}};
const base={maintainAspectRatio:false,plugins:{legend:{display:false}},scales:scales};

new Chart(casesChart,{type:'line',data:{labels:C.labels,datasets:[
 {label:'جلسات محددة',data:C.cases.sessions,borderColor:'#fff',backgroundColor:'#fff',tension:0,pointRadius:3,borderWidth:1.5},
 {label:'قضايا مسجلة',data:C.cases.registered,borderColor:GOLD,backgroundColor:GOLD,tension:0,pointRadius:3,borderWidth:1.5}]},options:base});

new Chart(pieChart,{type:'pie',data:{labels:C.categories.labels,
 datasets:[{data:C.categories.values,backgroundColor:[GOLD,'#fff','#10153a','#8a1f3d'],borderColor:'#1a2148'}]},
 options:{maintainAspectRatio:false,plugins:{legend:{display:false}}}});

new Chart(barChart,{type:'bar',data:{labels:C.labels,datasets:[
 {label:'عملاء مسجلون',data:C.clients.registered,backgroundColor:GOLD}]},options:base});

new Chart(consultChart,{type:'bar',data:{labels:C.labels,datasets:[
 ...C.consultations.statuses.map(status=>({label:status.label,data:status.values,backgroundColor:status.color}))
]},options:base});
</script>
</body>
</html>