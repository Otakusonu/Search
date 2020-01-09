/* Search form AJAX handler */
function search() {
  document.body.innerHTML += '<img id="loading" src="http://www.vitorazevedo.net/external_files/loading_small.png">';
  document.getElementById('searchTerm').blur();
  var query = document.getElementById("searchTerm").value;
  var elements = document.getElementsByClassName("searchTerm");
  var formData = new FormData();
  for(var i=0; i<elements.length; i++) {
    formData.append(elements[i].name, elements[i].value);
  }
  var xmlHttp = new XMLHttpRequest();
  xmlHttp.onreadystatechange = function() {
    if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
      var loader = document.querySelector( '#loading' );
      loader.parentNode.removeChild( loader );
      var element =  document.getElementById('results');
      if (typeof(element) != 'undefined' && element != null) {
        document.getElementById("results").innerHTML = xmlHttp.responseText;
        document.getElementById("searchTerm").value = query;
        create();
        particles();
      } else {
        document.body.innerHTML += "<div id='results'>" + xmlHttp.responseText + "</div>";
        document.getElementById("searchTerm").value = query;
        create();
        particles();
      }
    }
  }
  xmlHttp.open("post", "ajax.php");
  xmlHttp.send(formData);
}

/* shameless Plug */
var button = document.getElementById("github");
button.addEventListener("click",function(e){
    //window.open('', '_blank');
    document.location.href = 'https://myanime.ml/';
},false);

/* Background animation stuffs */
var w = window.innerWidth,
    h = window.innerHeight,
    canvas = document.getElementById('test'),
    ctx = canvas.getContext('2d'),
    rate = 60,
    arc = 100,
    time,
    count,
    size = 7,
    speed = 20,
    parts = new Array,
    colors = ['grey','#f57900','darkgrey'];
var mouse = { x: 0, y: 0 };

canvas.setAttribute('width',w);
canvas.setAttribute('height',h);

function create() {
  time = 0;
  count = 0;

  for(var i = 0; i < arc; i++) {
    parts[i] = {
      x: Math.ceil(Math.random() * w),
      y: Math.ceil(Math.random() * h),
      toX: Math.random() * 5 - 1,
      toY: Math.random() * 2 - 1,
      c: colors[Math.floor(Math.random()*colors.length)],
      size: Math.random() * size
    }
  }
}

function particles() {
  ctx.clearRect(0,0,w,h);
  for(var i = 0; i < arc; i++) {
    var li = parts[i];
    var distanceFactor = DistanceBetween( mouse, parts[i] );
    var distanceFactor = Math.max( Math.min( 15 - ( distanceFactor / 10 ), 10 ), 1 );
    ctx.beginPath();
    ctx.arc(li.x,li.y,li.size*distanceFactor,0,Math.PI*2,false);
    ctx.fillStyle = li.c;
    ctx.strokeStyle=li.c;
    if(i%2==0)
      ctx.stroke();
    else
      ctx.fill();

    li.x = li.x + li.toX * (time * 0.05);
    li.y = li.y + li.toY * (time * 0.05);

    if(li.x > w){
       li.x = 0;
    }
    if(li.y > h) {
       li.y = 0;
    }
    if(li.x < 0) {
       li.x = w;
    }
    if(li.y < 0) {
       li.y = h;
    }


  }
  if(time < speed) {
    time++;
  }
  setTimeout(particles,1000/rate);
}
function DistanceBetween(p1,p2) {
   var dx = p2.x-p1.x;
   var dy = p2.y-p1.y;
   return Math.sqrt(dx*dx + dy*dy);
}
create();
particles();
