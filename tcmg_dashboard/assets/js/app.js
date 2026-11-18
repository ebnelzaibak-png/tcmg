const grid = document.getElementById('calendar');
const monthLabel = document.getElementById('monthLabel');
let shown = new Date(2024, 2, 1);
function renderCalendar(){
  const year=shown.getFullYear(), month=shown.getMonth();
  monthLabel.textContent=shown.toLocaleDateString('en-US',{month:'short',year:'numeric'});
  grid.innerHTML='';
  ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'].forEach(d=>{const s=document.createElement('span');s.className='day-name';s.textContent=d;grid.appendChild(s)});
  const first=new Date(year,month,1).getDay();
  const days=new Date(year,month+1,0).getDate();
  const prevDays=new Date(year,month,0).getDate();
  for(let i=0;i<42;i++){
    const s=document.createElement('span');let day, cls='';
    if(i<first){day=prevDays-first+i+1;cls='muted'}
    else if(i>=first+days){day=i-first-days+1;cls='muted'}
    else{day=i-first+1;if(day===11 && year===2024 && month===2)cls='selected'}
    s.className=cls;s.textContent=String(day).padStart(2,'0');grid.appendChild(s);
  }
}
document.getElementById('prevMonth').addEventListener('click',()=>{shown.setMonth(shown.getMonth()-1);renderCalendar()});
document.getElementById('nextMonth').addEventListener('click',()=>{shown.setMonth(shown.getMonth()+1);renderCalendar()});
renderCalendar();

Chart.defaults.color='#dfe5f5';
Chart.defaults.font.family='Cairo, Tahoma, sans-serif';
const gridColor='rgba(220,228,245,.65)';
new Chart(document.getElementById('casesLine'),{type:'line',data:{labels:['0','1','2','3','4','5','6','7','8','9'],datasets:[{data:[620,80,360,100,720,560,1000,930,490,610],borderColor:'#eef2ff',backgroundColor:'#eef2ff',pointRadius:3,tension:0},{data:[610,340,80,850,430,270,760,780,570,500],borderColor:'#916637',backgroundColor:'#916637',pointRadius:3,tension:0}]},options:{maintainAspectRatio:false,plugins:{legend:{display:false}},scales:{x:{grid:{color:gridColor}},y:{min:0,max:1000,ticks:{stepSize:250},grid:{color:gridColor}}}}});
new Chart(document.getElementById('casesPie'),{type:'pie',data:{labels:['قضايا نشطة','قضايا عادية','قضايا إدارية','قضايا مالية'],datasets:[{data:[900,365,298,183],backgroundColor:['#916637','#eef2ff','#0d152c','#8c2638'],borderColor:'#dce3f3',borderWidth:1}]},options:{maintainAspectRatio:false,plugins:{legend:{display:false}}}});
new Chart(document.getElementById('clientsBar'),{type:'bar',data:{labels:['0','1','2','3','4','5','6','7','8','9'],datasets:[{data:[8,45,44,4,9,25,5,12,13,40],backgroundColor:'#916637'},{data:[7,12,2,47,25,33,28,17,20,31],backgroundColor:'#eef2ff'}]},options:{maintainAspectRatio:false,plugins:{legend:{display:false}},scales:{x:{grid:{color:gridColor}},y:{min:0,max:60,ticks:{stepSize:15},grid:{color:gridColor}}}}});
new Chart(document.getElementById('consultationsBar'),{type:'bar',data:{labels:['0','1','2','3','4','5','6','7','8','9'],datasets:[{data:[950,960,800,400,410,500,720,760,390,50],backgroundColor:'#916637'},{data:[550,850,170,940,620,870,240,410,250,250],backgroundColor:'#eef2ff'},{data:[130,180,190,20,0,970,390,770,820,630],backgroundColor:'#8c2638'},{data:[800,60,460,530,130,600,410,230,720,900],backgroundColor:'#4e83b4'}]},options:{maintainAspectRatio:false,plugins:{legend:{display:false}},scales:{x:{grid:{color:gridColor}},y:{min:0,max:1000,ticks:{stepSize:250},grid:{color:gridColor}}}}});
