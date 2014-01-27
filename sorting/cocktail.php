<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-GB" xmlns="http://www.w3.org/1999/xhtml" xml:lang="" class="no-js">
    <head>
        <style>
            * { margin: 0; padding: 0; }
            html, body { height: 100%; width: 100%; }
            canvas { display: block; }
        </style>
        <title>
            The TEST
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta name="owner" content="Ross Hulley" />
        <meta name="rating" content="General" />
        <meta name="language" content="en" />
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script>
            $(function() {
                var numBlocks = 300, a = shuffle(range(1, numBlocks)), blockheight = 300, blockwidth = 10, intval, canvas, context, width, height, curmax=a.length - 1, curmin=-1;

                canvas = $("#canvas")[0];
                width = canvas.width;
                height = canvas.height;
                context = canvas.getContext("2d");
                context.fillStyle = "rgb(0, 0, 0)";

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

                function range(start, count) {
                    height = $(window).get(0).innerHeight;
                    width = $(window).get(0).innerWidth;
                    if (arguments.length == 1) {
                        count = start;
                        start = 0;
                    }

                    var foo = [];
                    for (var i = 0; i < count; i++) {
                        foo.push({
                            value: start + i,
                            height: ((start + i) / count) * height,
                            width: width / count,
                            color: "rgb(255,255,255)"
                        });
                    }
                    return foo;
                }

                function shuffle(array) {
                    var counter = array.length, temp, index;

                    // While there are elements in the array
                    while (counter > 0) {
                        // Pick a random index
                        index = Math.floor(Math.random() * counter);

                        // Decrease counter by 1
                        counter--;

                        // And swap the last element with it
                        temp = array[counter];
                        array[counter] = array[index];
                        array[index] = temp;
                    }

                    return array;
                }

                draw();

                function bubbleSort()
                {
                    moved=false;
                    // increases `begin` because the elements before `begin` are in correct order
                    curmin++;
                    for (var i=curmin; i < curmax; i++) {
                        if (a[i].value > a[i + 1].value) {
                            updateFreq(a[i].value * 6);
                            var temp = a[i];
                            a[i] = a[i + 1];
                            a[i + 1] = temp;
                            draw();
                            moved = true;
                        }
                    }
                    if (!moved) {
                        clearInterval(intval);

                        intval = setInterval(function() {
                            checkAll();
                        }, 1);
                    };
                    curmax--;
                    for (var i=curmax; i >= curmin; i--)
                         if (a[i].value < a[i-1].value) {
                            updateFreq(a[i].value * 6);
                            var temp = a[i];
                            a[i] = a[i - 1];
                            a[i - 1] = temp;
                            draw();
                            moved=true;
                         }
                    if (!moved) {
                        clearInterval(intval);


                        intval = setInterval(function() {
                            checkAll();
                        }, 1);

                    }
                }

                function checkAll() {
                    for (var i = 0; i < numBlocks; i++) {
                        if(a[i].color != "rgb(0, 255, 0)"){
                            a[i].color = "rgb(0, 255, 0)";
                            updateFreq(a[i].value * 6);
                            draw();
                            break;
                        }
                        if(a[numBlocks-1].color == "rgb(0, 255, 0)"){
                            clearInterval(intval);
                            // kill sound
                            oscillator.disconnect();
                        }
                    }
                    
                }

                function draw() {
                    context.fillStyle = "rgb(0, 0, 0)";
                    context.fillRect(0, 0, width, height);
                    var i, block;
                    for (i = 0; i < numBlocks; i += 1) {
                        block = a[i];
                        context.fillStyle = block.color;
                        context.fillRect(block.width * i, height - block.height, block.width, block.height);
                    }
                }

                intval = setInterval(function() {
                    bubbleSort();
                }, 1000 / 36);


                var oscContext = new webkitAudioContext(),
                        oscillator = oscContext.createOscillator();

                var updateFreq = function(freq) {
                    oscillator.type = parseInt(2);
                    oscillator.frequency.value = freq;
                    oscillator.connect(oscContext.destination);
                    oscillator.noteOn && oscillator.noteOn(0); // this method doesn't seem to exist, though it's in the docs?
                };


            });
        </script>
    </head>


    <body>
        <canvas id="canvas">
        </canvas>
    </body>
</html>
