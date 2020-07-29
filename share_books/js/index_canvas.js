// canvas
var canvas = document.getElementById("mycan");      
var ctx = canvas.getContext("2d");
// var mouse = {x:0,y:0} ;
var box = document.getElementsByClassName('leftBox');
// console.log(document.getElementsByClassName('leftBox'));
// console.log(box.clientHeight);
canvas.height = box[0].clientHeight;
canvas.width = box[0].clientWidth; 
var rate = 60,
    arc = 100,
    w = canvas.width,
    h = canvas.height,
    time,
    count,
    size = 7,
    speed = 20,
    lights = new Array,
    colors = ['#80CBC4','#FAD65B','#CECDCB'];

    function init() {
            time = 0;
            count = 0;

            for(var i = 0; i < arc; i++) {
                lights[i] = {
                x: Math.ceil(Math.random() * w),
                y: Math.ceil(Math.random() * h),
                toX: Math.random() * 5 + 1,
                toY: Math.random() * 5 + 1,
                c: colors[Math.floor(Math.random()*colors.length)],
                size: Math.random() * size
                }
            }
        // console.log( lights);
    }

    function bubble() {
        ctx.clearRect(0,0,w,h);
        
        ctx.fillStyle="#1A2930";
        ctx.fillRect(0, 0, w,h);

        for(var i = 0; i < arc; i++) {
            var li = lights[i];
            
            ctx.beginPath();
            ctx.arc(li.x,li.y,li.size,0,Math.PI*2,false);
            ctx.fillStyle = li.c;
            ctx.fill();
            
            li.x = li.x + li.toX * (time * 0.05);
            li.y = li.y + li.toY * (time * 0.05);
            
            if(li.x > w) { li.x = 0; }
            if(li.y > h) { li.y = 0; }
            if(li.x < 0) { li.x = w; }
            if(li.y < 0) { li.y = h; }
        }
        if(time < speed) {
            time++;
        }
        timerID = setTimeout(bubble,1000/rate);
    }


    init();
    bubble();