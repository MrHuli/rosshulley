<?php
//key = key=AIzaSyBQkJZJCF0krHo-j8XeT4m1_BuQyZDDWgg
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        <script type="text/javascript"
                src="http://maps.googleapis.com/maps/api/js?sensor=false&region=GB">
        </script>
        <link href="bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="main.css" rel="stylesheet" type="text/css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
        <script src="bootstrap.min.js" ></script>
        <script src="js.js" ></script>
    </head>
    <body>
        <!-- Modal -->
        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 id="myModalLabel">RESULT!</h4>
          </div>
          <div class="modal-body">
            <div id="result-map"></div>
            <span id="thisScore"></span>
          </div>
          <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Next!</button>
          </div>
        </div>
        <div id="pano"></div>
        <div class="sidebar">
            <div id="map-canvas"></div>
            <div class="undermap">
                <span>Total Score: </span><span id="score">0</span>
                <a href="#myModal" role="button"  id="submit-btn" class="submit-btn btn disabled">Take a guess!</a>
            </div>
        </div>
    </body>
</html>