<!DOCTYPE HTML>
<html>
    <head>
        <style>
            * { margin: 0; padding: 0; }
            html, body { height: 100%; width: 100%; }
            canvas { display: block; }
        </style>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
        <script src="Shake.js"></script>
        <script type="text/javascript">
            $(function() {
                var points = [], maxPoints = 5000, numPoints = 0, dotsize = 5, dragging = false, gravity = 0.5, sidePull = 0, i, j, intval, canvas, context, width, height, bounce = -0.9, drag = 1, mass = 10;

                canvas = $("#canvas")[0];
                width = canvas.width;
                height = canvas.height;
                context = canvas.getContext("2d");
                context.fillStyle = "rgb(0, 0, 0)";

//                var img = new Image();
//                img.src = 'nath2.png';
//
//                var img2 = new Image();
//                img2.src = 'logo-idu.gif';

                $("#canvas").attr("width", $(window).get(0).innerWidth);
                $("#canvas").attr("height", $(window).get(0).innerHeight);

                $(window).resize(resizeCanvas);

                function resizeCanvas() {
                    $("#canvas").attr("width", $(window).get(0).innerWidth);
                    $("#canvas").attr("height", $(window).get(0).innerHeight);
                    width = canvas.width;
                    height = canvas.height;
                    context.fillRect(0, 0, width, height);
                }
                ;


                resizeCanvas();

                window.addEventListener('shake', shakeEventDidOccur, false);

                window.ondevicemotion = function(event) {
                    ax = Math.round(event.accelerationIncludingGravity.x * 1);
                    ay = Math.round(event.accelerationIncludingGravity.y * 1);
                    az = Math.round(event.accelerationIncludingGravity.z * 1);
                    gravity = ax / 10;
                    sidePull = ay / 10;
                }

                function shakeEventDidOccur() {
                    context.fillStyle = "rgb(0, 0, 0)";
                    context.fillRect(0, 0, width, height);
                    points.splice(1, Math.ceil(numPoints / 2));
                    numPoints = numPoints - Math.ceil(numPoints / 2);
                }

                function randomColor() {
                    var r, g, b;
                    r = Math.floor(Math.random() * 255);
                    g = Math.floor(Math.random() * 255);
                    b = Math.floor(Math.random() * 255);
                    return "rgb(" + r + "," + g + "," + b + ")";
                }

                $('body').bind("touchstart mousedown", function(e) {
                    e.preventDefault();
                    clearInterval(intval);
                    if (dragging) {
                        //remove event, otherwise it is sticky!
                        $('body').unbind('mousemove touchmove');
                        dragging = false;
                    }
                    dragging = true;
                    $('body').bind("touchmove mousemove", function(e) {
                        clearInterval(intval);
                        e.preventDefault();
                        addpoint(e);
                        intval = setInterval(function() {
                            addpoint(e);
                        }, 1000 / 24);
                    });
                    intval = setInterval(function() {
                        addpoint(e);
                    }, 1000 / 24);
                });

                function addpoint(e) {
                    if (e.type === 'touchmove') {
                        e = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
                    }
                    if (numPoints > maxPoints) {
                        points.splice(1, 1);
                        numPoints--;
                    }
                    points.push({x: e.pageX,
                        y: e.pageY,
                        vx: Math.random() * 10 - 5,
                        vy: Math.random() * 10 - 5,
                        color: randomColor(),
                        bounced: 0,
                        mass: mass});
                    numPoints++;
                }

                $('body').bind("touchend mouseup", function(e) {
                    clearInterval(intval);
                    if (dragging) {
                        //remove event, otherwise it is sticky!
                        $('body').unbind('mousemove touchmove');
                        dragging = false;
                    }
                });

                function update() {
                    var i, point;
                    for (i = 0; i < numPoints; i += 1) {
                        point = points[i];
                        point.vy += gravity;
                        point.vx += sidePull;
                        point.vy *= drag;
                        point.vx *= drag;
                        point.x += point.vx;
                        point.y += point.vy;
                        if (point.x > width - dotsize) {
                            point.x = width - dotsize;
                            point.vx *= bounce;
                        }
                        else if (point.x < dotsize) {
                            point.x = dotsize;
                            point.vx *= bounce;
                        }
                        if (point.y > height - dotsize) {
                            point.y = height - dotsize;
                            point.vy *= bounce;
                        }
                        else if (point.y < dotsize) {
                            point.y = dotsize;
                            point.vy *= bounce;
                        }
                    }
                }

                function collide() {

                }

                function draw() {
                    context.fillStyle = "rgb(0, 0, 0)";
                    context.fillRect(0, 0, width, height);
                    var i, point;
                    for (i = 0; i < numPoints; i += 1) {
                        point = points[i];
//                        context.save();
//                        context.translate(point.x, point.y);
//                        context.translate(50, 74);
//                        context.rotate((point.vy / point.vx )/10);
//                        if(i%10 == 0){
//                            context.drawImage(img2,-50, -74);
//                        } else {
//                            context.drawImage(img,-50, -74);
//                        }
//                        context.restore();
                        context.beginPath();
                        context.fillStyle = point.color;
                        context.arc(point.x, point.y, dotsize, 0, Math.PI * 2, false);
                        context.fill();
                    }
                }

                setInterval(function() {
                    update();
                    draw();
                }, 1000 / 24);
            });
        </script>
    </head>
    <body>
        <canvas id="canvas">
        </canvas>
    </body>
</html>