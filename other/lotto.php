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
        <strong>LOTTO SIM</strong><br/>
        <p>Enter Your Numbers</p>

        <form id="theform" name="theform" method="post" action="">
            <input type="text" name="no1" size="1" id="no1" maxlength="2" value="<?php echo $_POST['no1'] ?>"/>
            <input type="text" name="no2" size="1" id="no1" maxlength="2" value="<?php echo $_POST['no2'] ?>"/>
            <input type="text" name="no3" size="1" id="no1" maxlength="2" value="<?php echo $_POST['no3'] ?>"/>
            <input type="text" name="no4" size="1" id="no1" maxlength="2" value="<?php echo $_POST['no4'] ?>"/>
            <input type="text" name="no5" size="1" id="no1" maxlength="2" value="<?php echo $_POST['no5'] ?>"/>
            <input type="text" name="no6" size="1" id="no1" maxlength="2" value="<?php echo $_POST['no6'] ?>"/>
            <label for="weeks">How Many Weeks:</label>
            <input type="text" name="weeks" id="weeks"  value="<?php echo $_POST['weeks'] ?>"/>
            <input type="submit" value="Submit" />
        </form>
        <?php
        if ($_POST['weeks'] != '') {
            $j = 0;
            $results = array();
            $losses = array();
            while ($j < $_POST['weeks']) {
                $numbers = array();
                $matches = 0;
                while (sizeof($numbers) < 6) {
                    $random = rand(1, 49);
                    if (!in_array($random, $numbers)) {
                        $numbers[] = $random;
                    }
                }
                sort($numbers);
                for ($i = 0; $i < 6; $i++) {
                    if (in_array($_POST['no' . $i], $numbers)) {
                        $matches++;
                    }
                }
                if ($matches < 3) {
                    $losses[] = $matches;
                } else if ($matches > 3) {
                    echo '<strong style="color:red;">WOW, YOU WON AND MATCHED <b>' . $matches . ' </b> numbers</strong>, The winning numbers were: ';
                    foreach ($numbers as $number) {
                        echo $number . ', ';
                    }
                    echo '<br/>';
                    $results[] = $matches;
                } else {
                    $results[] = $matches;
                }
                $j++;
                if($j > 50000){
                   $capped = true;
                   break;
                }
            }
            $winnings = 0;
            foreach ($results as $result) {
                if ($result == 3) {
                    $winnings += 10;
                } elseif ($result == 4) {
                    $winnings += 62;
                } elseif ($result == 5) {
                    $winnings += 1500;
                } elseif ($result == 6) {
                    $winnings += 2000000;
                }
            }
            echo 'You lost a total of ' . sizeof($losses) . ' games, and won ' . sizeof($results) . ' games from a total of ' . $_POST['weeks'] . ' games!.<br/>';
            echo '<br/>You spent £' . $_POST['weeks'] . '<br/>You Won £' . $winnings;
            if($capped){
                echo '<br/>Results capped to 50000 plays';
            }
        }
        ?>
    </body>
</html>
