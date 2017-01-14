<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../public/css/web/slideshow.css" type="text/css" />
        <script type="text/javascript" src="../public/js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="../public/js/jssor.slider-21.1.5.mini.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>

        <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="js/jssor.slider-21.1.5.mini.js"></script>
        <script>
            jQuery(document).ready(function($) {

                var jssor_1_SlideshowTransitions = [
                    {$Duration: 1200, $Opacity: 2}
                ];

                var jssor_1_SlideoTransitions = [
                    [{b: 0, d: 1160, x: 783, y: 3}],
                    [{b: 260, d: 780, x: -869, y: 18}],
                    [{b: 1160, d: 840, x: 667, y: 2}],
                    [{b: 2020, d: 760, x: -11, y: -315}],
                    [{b: 2780, d: 520, x: -272, y: -6}],
                    [{b: 3300, d: 640, x: -3, y: -145}],
                    [{b: 0, d: 700, x: 307, y: -1, i: 2}],
                    [{b: 0, d: 700, x: -851, y: -5, i: 1}],
                    [{b: 700, d: 800, x: -827, y: -11}],
                    [{b: 1500, d: 500, x: -10, y: -114}],
                    [{b: 2000, d: 500, x: -9, y: 141}],
                    [{b: 2000, d: 420, x: 14, y: -158}],
                    [{b: 2500, d: 1100, x: -281}],
                    [{b: 0, d: 800, x: -870, y: 3}],
                    [{b: 800, d: 500, x: 7, y: 112}],
                    [{b: 800, d: 500, x: 103, y: -202}],
                    [{b: 1300, d: 900, x: 12, y: -264}],
                    [{b: 2200, d: 1000, x: -450, y: 5}]
                ];

                var jssor_1_options = {
                    $AutoPlay: true,
                    $SlideshowOptions: {
                        $Class: $JssorSlideshowRunner$,
                        $Transitions: jssor_1_SlideshowTransitions,
                        $TransitionsOrder: 1
                    },
                    $CaptionSliderOptions: {
                        $Class: $JssorCaptionSlideo$,
                        $Transitions: jssor_1_SlideoTransitions
                    },
                    $ArrowNavigatorOptions: {
                        $Class: $JssorArrowNavigator$
                    },
                    $BulletNavigatorOptions: {
                        $Class: $JssorBulletNavigator$
                    }
                };

                var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

                //responsive code begin
                function ScaleSlider() {
                    var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                    if (refSize) {
                        refSize = Math.min(refSize, 870);
                        jssor_1_slider.$ScaleWidth(refSize);
                    }
                    else {
                        window.setTimeout(ScaleSlider, 30);
                    }
                }
                ScaleSlider();
                $(window).bind("load", ScaleSlider);
                $(window).bind("resize", ScaleSlider);
                $(window).bind("orientationchange", ScaleSlider);
                //responsive code end
            });
        </script>

        <style>

            .jssorb05 {
                position: absolute;
            }
            .jssorb05 div, .jssorb05 div:hover, .jssorb05 .av {
                position: absolute;
                /* size of bullet elment */
                width: 16px;
                height: 16px;
                margin-top: -90px;
                margin-left: 150px;
                background: url('../public/image/slideshow/b05.png') no-repeat;
                overflow: hidden;
                cursor: pointer;
            }
            .jssorb05 div { background-position: -7px -7px; }
            .jssorb05 div:hover, .jssorb05 .av:hover { background-position: -37px -7px; }
            .jssorb05 .av { background-position: -67px -7px; }
            .jssorb05 .dn, .jssorb05 .dn:hover { background-position: -97px -7px; }

            .jssora12l, .jssora12r {
                display: block;
                position: absolute;
                /* size of arrow element */
                width: 30px;
                height: 46px;
                left: 840px;
                cursor: pointer;
                background: url('../public/image/slideshow/a12.png') no-repeat;
                overflow: hidden;
            }
            .jssora12l { background-position: -16px -37px; }
            .jssora12r { background-position: -75px -37px; }
            .jssora12l:hover { background-position: -136px -37px; }
            .jssora12r:hover { background-position: -195px -37px; }
            .jssora12l.jssora12ldn { background-position: -256px -37px; }
            .jssora12r.jssora12rdn { background-position: -315px -37px; }

        </style>

        <p></p>
        <div id="jssor_1" style="position: relative; left: -8px; top:-17px; width: 561px; height: 364px; z-index: -1;">
            <!-- Loading Screen -->
            <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
                <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                <div style="position:absolute;display:block;background:url('../public/image/slideshow/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
            </div>
            <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 870px; height: 264px; overflow: hidden;">
                <div data-p="141.75" style="display: none;">
                    <img data-u="image" src="../public/image/slideshow/2-bg1.jpg" />
                    <div style="position: absolute; top: 54px; left: 1px; width: 778px; height: 131px;">
                        <img data-u="caption" data-t="0" style="position: absolute; top: 0px; left: -783px; width: 778px; height: 131px;" src="../public/image/slideshow/1-021.png" />
                        <img data-u="caption" data-t="1" style="position: absolute; top: 132px; left: 1130px; width: 392px; height: 74px;" src="../public/image/slideshow/health.png" />
                        <img data-u="caption" data-t="2" style="position: absolute; top: 24px; left: -285px; width: 270px; height: 70px;" src="../public/image/slideshow/1-031.png" />
                    </div>
                    <div style="position: absolute; top: -40px; left: 2px; width: 350px; height: 360px;">
                        <img data-u="caption" data-t="3" style="position: absolute; top: 340px; left: 12px; width: 300px; height: 350px;" src="../public/image/slideshow/1.png" />
                        <img data-u="caption" data-t="4" style="position: absolute; top: 70px; left: 830px; width: 290px; height: 275px;" src="../public/image/slideshow/2.png" />
                    </div>
                </div>
                <div data-p="141.75" style="display: none;">
                    <img data-u="image" src="../public/image/slideshow/2-bg1.jpg" />
                    <div style="position: absolute; top: 5px; left: 19px; width: 410px; height: 260px;">
                        <img data-u="caption" data-t="6" style="position: absolute; top: 3px; left: -332px; width: 220px; height: 243px;" src="../public/image/slideshow/3.png" />
                        <img data-u="caption" data-t="7" style="position: absolute; top: 225px; left: 855px; width: 220px; height: 30px;" src="../public/image/slideshow/eat.png" />
                        <img data-u="caption" data-t="8" style="position: absolute; top: 20px; left: 1084px; width: 50%; height: 60%;" src="../public/image/slideshow/2-3.png" />

                    </div>
                    <div style="position: absolute; top: -5px; left: 422px; width: 440px; height: 280px;">
                        <img data-u="caption" data-t="10" style="position: absolute; top: -110px; left: 8px; width: 150px; height: 77px;" src="../public/image/slideshow/feel.png" />
                        <img data-u="caption" data-t="11" style="position: absolute; top: 285px; left: 38px; width: 165px; height: 50px;" src="../public/image/slideshow/live.png" />
                        <img data-u="caption" data-t="12" style="position: absolute; top: 23px; left: 520px; width: 250px; height: 245px;" src="../public/image/slideshow/2-1.png" />
                    </div>
                </div>
                <div data-p="141.75" style="display: none;">
                    <img data-u="image" src="../public/image/slideshow/2-bg1.jpg" />
                    <div style="position: absolute; top: 2px; left: -2px; width: 310px; height: 260px;">
    <!--                     <img data-u="caption" data-t="13" style="position: absolute; top: 150px; left: 877px; width: 250px; height: 90px;" src="../public/image/slideshow/baby.png" /> -->
                        <img data-u="caption" data-t="13" style="position: absolute; top: 20px; left: 865px; width: 190px; height: 130px;" src="../public/image/slideshow/bucket.png" />
                    </div>
                    <div style="position: absolute; top: -4px; left: 311px; width: 560px; height: 260px;">
                        <img data-u="caption" data-t="16" style="position: absolute; top: 340px; left: 350px; width: 290px; height: 23  0px;" src="../public/image/slideshow/3-2.png" />
                  
                        <img data-u="caption" data-t="14" style="position: absolute; top: -110px; left: 11px; width: 283px; height: 120px;" src="../public/image/slideshow/baby.png" />
                    </div>
                    <div style="position: absolute; top: -4px; left: -201px; width: 560px; height: 260px;">
                        <img data-u="caption" data-t="17" style="position: absolute; top: 160px; left: 1080px; width: 250px; height: 80px;" src="../public/image/slideshow/3-4.png" />
                    </div>
                    <div style="position: absolute; top: -4px; left: 0pxs; width: 560px; height: 260px;">
                        <img data-u="caption" data-t="15" style="position: absolute; top: 340px; left: 86px; width: 200px; height: 56px;" src="../public/image/slideshow/3-5.png" />
                    </div>
                    <div style="position: absolute; top: -4px; left: 311px; width: 560px; height: 260px;">
                    </div>
                </div>

            </div>
            <!-- Bullet Navigator -->
            <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
                <!-- bullet navigator item prototype -->
                <div data-u="prototype" style="width:16px;height:16px;"></div>
            </div>
            <!-- Arrow Navigator -->
            <span data-u="arrowleft" class="jssora12l" style="top:0px;left:0px;width:30px;height:46px;" data-autocenter="2"></span>
            <span data-u="arrowright" class="jssora12r" style="top:0px;right:0px;width:30px;height:46px;" data-autocenter="2"></span>
        </div>

    </body>
</html>