
<!DOCTYPE html>
<html >
    <head>

        <title>Animated bar chart</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">


        <link rel="stylesheet" href="css/style.css">


    </head>



    <body>

        <h1>Daily Sales Medicine Income Report</h1>	

        <div id="chart">
            <ul id="numbers">
                <?php
                
                $max = max($price);

                $x = $max;
                $y = $max / 10;
                while ($x >= 0) {
                    ?>
                    <li><span><?php echo round($x, 0, PHP_ROUND_HALF_UP); ?></span></li>

                    <?php
                    $x = $x - $y;
                }
                ?>
                <div style="position: relative; transform: rotate(-90deg);top:-200px;left: -35px; font-weight: 900;"><?php echo "Income"; ?></div>
            </ul>
            <?php 
            if(($rw<=10)&& ($rw>7)){
                ?>
            <div style="position: absolute; left: 250px; top: 470px; font-weight: 900;"><?php echo "Medicine Name"; ?></div>
                <?php
            }  elseif (($rw<=7)&& ($rw>5)) {
                ?>
            <div style="position: absolute; left: 200px; top: 470px; font-weight: 900;"><?php echo "Medicine Name"; ?></div>
            <?php
            }  elseif (($rw<=5)&& ($rw>=4)) {
                ?>
            <div style="position: absolute; left: 150px; top: 470px; font-weight: 900;"><?php echo "Medicine Name"; ?></div>
            <?php
            }  elseif (($rw<=3)&& ($rw>=2)) {
                ?>
            <div style="position: absolute; left: 100px; top: 470px; font-weight: 900;"><?php echo "Medicine Name"; ?></div>
            <?php
            }  else {
                ?>
            <div style="position: absolute; left: 50px; top: 470px; font-weight: 900;"><?php echo "Medicine Name"; ?></div>
             <?php   
            }?>
            <!--<div id="chart">
            <ul id="numbers">
                  <li><span>5000</span></li>
                  <li><span>4500</span></li>
                  <li><span>4000</span></li>
                  <li><span>3500</span></li>
                  <li><span>3000</span></li>
                  <li><span>2500</span></li>
                  <li><span>2000</span></li>
                  <li><span>1500</span></li>
                  <li><span>1000</span></li>
                  <li><span>500</span></li>
                  <li><span>0</span></li>
            </ul>-->


            <?php
            foreach ($medicine as $keys => $values) {
                ?>

                <ul id="bars">
                    <li><div data-percentage=<?php echo $price[$keys]; ?> class="bar vertical-text"  ></div><span><?php echo $values; ?></span></li>
                </ul>
                <?php
            }
            ?>




        </div>
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script >
            $(function () {
                $("#bars li .bar").each(function (key, bar) {
                    var percentage = $(this).data('percentage');
                    var max = "<?php echo $max; ?>";
                    $(this).animate({
                        'height': (percentage * 100) / max + '%'
                    }, 1000);
                });
            });
        </script>

    </body>
</html>
