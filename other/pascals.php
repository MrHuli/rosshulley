<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-GB" xmlns="http://www.w3.org/1999/xhtml" xml:lang="" class="no-js">
    <head>
        <title>
            The TEST
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta name="owner" content="Ross Hulley" />
        <meta name="rating" content="General" />
        <meta name="language" content="en" />

    </head>

    <body>


        <br/><br/>
        <strong>Pascals</strong><br/>
        <p>Enter Depth</p>

        <form id="theform" name="theform" method="post" action="">
            <input type="text" name="depth" id="depth"  value="<?php echo $_POST['depth'] ?>"/>
            <input type="submit" value="Submit" />
        </form>
        <p style="text-align: center;">
            <?php
            if ($_POST['depth'] != '') {

                function pascalsTriangle($num) {
                    $c = 1;
                    $triangle = Array();
                    for ($i = 0; $i <= $num; $i++) {
                        $triangle[$i] = Array();
                        if (!isset($triangle[$i - 1])) {
                            $triangle[$i][] = $c;
                        } else {
                            for ($j = 0; $j < count($triangle[$i - 1]) + 1; $j++) {
                                $triangle[$i][] = (isset($triangle[$i - 1][$j - 1]) && isset($triangle[$i - 1][$j])) ? $triangle[$i - 1][$j - 1] + $triangle[$i - 1][$j] : $c;
                            }
                        }
                        if($i > 100){
                            break;
                        }
                    }
                    return $triangle;
                }

                $spread = 26;

                for($c=0;$c<3;++$c) {
                    $color[$c] = rand(0+$spread,255-$spread);
                }

                for ($i=0; $i <$_POST['depth']; $i++) {
                        $colors[$i]['r'] = rand($color[0]-$spread, $color[0]+$spread);
                        $colors[$i]['g'] = rand($color[1]-$spread, $color[1]+$spread);
                        $colors[$i]['b'] = rand($color[2]-$spread, $color[2]+$spread);
                }

                $tria = pascalsTriangle($_POST['depth']);
                echo '<table style="width:100%;border-collapse:collapse;">';
                foreach ($tria as $val) {

                echo '<tr style="margin:0;padding:0;">';
                $j = 0;
                    for ($i=0; $i < count($val); $i++) {
                        $value = $val[$i];
                        if($i < count($val)/2){
                            $j = $i;
                        }
                        if($i > count($val)/2){
                            $j--;
                        }
                        echo '<td style="width:'.(100/count($val)).'%; text-align:center;float: left; padding:0;background-color:rgb('.$colors[$j]['r'].','.$colors[$j]['g'].','.$colors[$j]['b'].');">'
                                .
                                $value.
                                
                                '&nbsp;</td>';
                        
                        
                    }

                echo '</tr>';
                }

                echo '</table>';
            }
            ?></p>
    </body>
</html>
