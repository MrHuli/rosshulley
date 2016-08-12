<!DOCTYPE HTML>
<html>
    <head>
        <style>
            * { margin: 0; padding: 0; }
            html, body { height: 100%; width: 100%; font-family: calibri; }
            canvas { display: block; }
            #header {
                margin: 20px;
                padding: 10px;
                position: absolute;
                z-index: 10000;
                text-align: center;
                color: rgb(180, 180, 180);
                background: #333;
                border-radius: 5px;
                width: 24%;
                opacity: 0.75;
                border: 1px solid #777;
            }
            #showbtn {
                margin: 0;
                padding: 0;
                position: absolute;
                z-index: 10000;
                text-align: center;
                color: rgb(180, 180, 180);
                background: #333;
                border-radius: 5px;
                opacity: 0.75;
                border: 1px solid #777;
            }

            #header table{
                color: rgb(150, 150, 150);
            }

            #header table td {
                font-size: 10pt;
            }

            #U_display {
                font-size: 10pt;
            }

            #header table td.label {
                text-align: right;
                font-size: 14pt;
                color: rgb(200, 200, 200);
                width: 50%;
            }

            #header table td.component_name {
                text-align: left;
                font-size: 16pt;
                color: #3871B2;
                border-top: 1px solid rgb(150, 150, 150);
            }

            #header h1 {
                color: #3871B2;
                text-shadow: 1px 1px 3px #111;
            }

            #footer {
                position: absolute;
                bottom: 10px;
                right: 10px;
                font-size: 10pt;
                color: #666;
            }
        </style>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
        <script src="Shake.js"></script>
        <script src='spectrum.js'></script>
        <link rel='stylesheet' href='spectrum.css' />
        <script type="text/javascript">
            $(function() {
                var points = [], maxPoints = 5000, numPoints = 0, dotsize = 20, dragging = false, gravity = 0.5, sidePull = 0, i, j, intval, canvas, context, width, height, bounce = -0.9, drag = 0.97, mouseX, mouseY, showTrails = false, showArrow = false, multicolor = true, ballColor = "rgb(255,0,0)";

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
                };

                resizeCanvas();

                window.addEventListener('shake', shakeEventDidOccur, false);

                window.ondevicemotion = function(event) {
                    ax = Math.round(event.accelerationIncludingGravity.x * 1);
                    ay = Math.round(event.accelerationIncludingGravity.y * 1);
                    az = Math.round(event.accelerationIncludingGravity.z * 1);
                    gravity = ax / 10;
                    sidePull = ay / 10;
                };

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

                $('canvas').bind("touchstart mousedown", function(e) {
                    e.preventDefault();
                    clearInterval(intval);
                    if (dragging) {
                        //remove event, otherwise it is sticky!
                        $('canvas').unbind('mousemove touchmove');
                        dragging = false;
                    }
                    dragging = true;
                    $('canvas').bind("touchmove mousemove", function(e) {
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
                    tmpmass = Math.random() * dotsize;
                    size = Math.ceil(tmpmass);
                    points.push({x: e.pageX,
                        y: e.pageY,
                        vx: (Math.random() * 10) - 5,
                        vy: (Math.random() * 10) - 5,
                        color: randomColor(),
                        bounced: 0,
                        mass: tmpmass/4,
                        size: size});
                    numPoints++;
                }

                $('canvas').bind("touchend mouseup", function(e) {
                    clearInterval(intval);
                    if (dragging) {
                        //remove event, otherwise it is sticky!
                        $('canvas').unbind('mousemove touchmove');
                        dragging = false;
                    }
                });

                $('#trails').bind("click", function() {
                    showTrails = !showTrails;
                });


                $('#arrow').bind("click", function() {
                    showArrow = !showArrow;
                    if(!showArrow){
                        $('canvas').unbind('mousemove');
                        gravity = parseFloat($('#gravity').val());
                        sidePull = 0;
                    }
                });

                $('#apply').bind("click", function() {
                    gravity = parseFloat($('#gravity').val());
                    drag = 1 - parseFloat($('#drag').val());
                    if(drag < 0){
                        drag = 0;
                    } else if(drag > 1) {
                        drag = 1;
                    }
                    bounce = -parseFloat($('#bounce').val());
                    dotsize = parseFloat($('#size').val())
                });

                $('#reset').bind("click", function() {
                    $('canvas').unbind('mousemove');
                    points = [];
                    numPoints = 0;
                    gravity = 0.5;
                    sidePull = 0;
                    bounce = -0.9;
                    drag = 0.97;
                    dotsize = 20;
                    showTrails = false;
                    showArrow = false;
                    multicolor = true;
                    $('#bounce').val(-bounce);
                    $('#size').val(dotsize);
                    $('#drag').val((1 - drag).toFixed(2));
                    $('#gravity').val(gravity);
                    $("#multicolor").prop("checked", true);
                    $('#color').hide();
                    $("#arrow").prop("checked", false);
                    $("#trails").prop("checked", false);
                });

                $('#multicolor').bind("click", function(){
                    multicolor = !multicolor;
                    $('#color').toggle();
                });

                function update() {
                    if(showArrow){

                        $('#canvas').bind("mousemove", function(e) {
                            ax = ((e.pageX - (width / 2)) / width) * 10;
                            ay = ((e.pageY - (height / 2)) / height) * 10;
                            mouseX = e.pageX;
                            mouseY = e.pageY;
                            gravity = ay / 10;
                            sidePull = ax / 10;
                        });
                    }
                    var i, point;
                    for (i = 0; i < numPoints; i += 1) {
                        point = points[i];
                        point.vy += gravity * point.mass;
                        point.vx += sidePull * point.mass;
                        point.vy *= drag;
                        point.vx *= drag;
                        point.x += point.vx;
                        point.y += point.vy;
                        if (point.x > width - point.size) {
                            point.x = width - point.size;
                            point.vx *= bounce;
                        }
                        else if (point.x < point.size) {
                            point.x = point.size;
                            point.vx *= bounce;
                        }
                        if (point.y > height - point.size) {
                            point.y = height - point.size;
                            point.vy *= bounce;
                        }
                        else if (point.y < point.size) {
                            point.y = point.size;
                            point.vy *= bounce;
                        }
                    }
                }

                function collide() {

                }

                function drawArrow(fromx, fromy, tox, toy) {
                    var headlen = 10;   // length of head in pixels
                    var angle = Math.atan2(toy - fromy, tox - fromx);
                    context.strokeStyle = "rgb(0, 255, 255)";
                    context.lineWidth = 2;
                    context.beginPath();
                    context.moveTo(fromx, fromy);
                    context.lineTo(tox, toy);
                    context.lineTo(tox - headlen * Math.cos(angle - Math.PI / 6), toy - headlen * Math.sin(angle - Math.PI / 6));
                    context.moveTo(tox, toy);
                    context.lineTo(tox - headlen * Math.cos(angle + Math.PI / 6), toy - headlen * Math.sin(angle + Math.PI / 6));
                    context.stroke();
                }

                function draw() {
                    if(!showTrails){
                        context.fillStyle = "rgb(0, 0, 0)";
                        context.fillRect(0, 0, width, height);
                    }
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
                        if(multicolor){
                            context.fillStyle = point.color;
                        } else {
                            context.fillStyle = ballColor;
                        }
                        context.arc(point.x, point.y, point.size, 0, Math.PI * 2, false);
                        context.fill();
                    }
                    if(showArrow){
                        drawArrow(width / 2, height / 2, mouseX, mouseY);
                    }
                    
                }



                setInterval(function() {
                    update();
                    draw();
                }, 1000 / 24);



            $("#picker").spectrum({
                color: "#f00",
                change: function(color) {
                    ballColor = color.toRgbString();
                }
            });

            });

            function toggle_menu() {
                $('#header').toggle();
                $('#showbtn').toggle();
            }
            
        </script>
    </head>
    <body>
        <div id="showbtn" style="display:none;">
            <input type="button" id="show_button" value="Show Menu" onclick="toggle_menu();">
        </div>
        <div id="header">
            <h1>Bounce Control Panel</h1>

            <table cellpadding="5" cellspacing="10" width="100%" class="control_panel">
                <tbody><tr>
                        <td colspan="2" class="label" style="text-align: center;">
                            Trails: <input type="checkbox" id="trails">
                            Gravity Arrow: <input type="checkbox" id="arrow">
                        </td>
                    </tr>
                    <tr>
                        <td class="component_name" colspan="2" style="color: #BADA55;">Balls</td>
                    </tr>
                    <tr>
                        <td class="label">Max-Size:</td>
                        <td><input type="text" id="size" value="20" size="10"></td>
                    </tr>
                    <tr>
                        <td class="label">Multicolor:</td>
                        <td><input type="checkbox" id="multicolor" checked="checked"></td>
                    </tr>
                    <tr id="color" style="display:none">
                        <td class="label">Color:</td>
                        <td><input type='text' id="picker" /></td>
                    </tr>
                    <tr>
                        <td class="component_name" colspan="2" style="color: rgba(241, 163, 64,0.75);">Physics</td>
                    </tr>
                    <tr>
                        <td class="label">Air Resistance:</td>
                        <td><input type="text" id="drag" value="0.03" size="10"></td>
                    </tr>
                    <tr>
                        <td class="label">Gravity:</td>
                        <td><input type="text" id="gravity" value="0.5" size="10"></td>
                    </tr>
                    <tr>
                        <td class="label">Bounciness:</td>
                        <td><input type="text" id="bounce" value="0.9" size="10"></td>
                    </tr>

                    <tr><td colspan="2"><br></td></tr>
                </tbody></table>
            <input type="button" id="apply" value="Apply Changes">
            <input type="button" id="reset" value="Reset">
            <input type="button" id="hide_button" value="Hide Menu" onclick="toggle_menu();"><!-- control_panel -->

        </div>
        <canvas id="canvas">
        </canvas>
    </body>
</html>