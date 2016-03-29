    	<?php include('page_header.php'); ?>
		<link href="style/index.css" rel="stylesheet">
    			<div class="container">
                    <!-- Jssor Slider Begin -->
                    <!-- To move inline styles to css file/block, please specify a class name for each element. --> 
                    <!-- ================================================== -->
                    <div id="slider1_container">
                        <!-- Loading Screen -->
                        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block; background-color: #000; top: 0px; left: 0px; width: 100%; height:100%;">
                            </div>
                            <div style="position: absolute; display: block; background: url(images/slider/loading.gif) no-repeat center center; top: 0px; left: 0px; width: 100%; height:100%;">
                            </div>
                        </div>
                        <!-- Slides Container -->
                        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1140px; height: 550px; overflow: hidden;">
                            <div>
                                <img u="image" src2="images/slider/01.jpg" />
                            </div>
                            <div>
                                <img u="image" src2="images/slider/02.jpg" />
                            </div>
                            <div>
                                <img u="image" src2="images/slider/03.jpg" />
                            </div>
                            <div>
                                <img u="image" src2="images/slider/04.jpg" />
                            </div>
                            <div>
                                <img u="image" src2="images/slider/05.jpg" />
                            </div>
                            <div>
                                <img u="image" src2="images/slider/06.jpg" />
                            </div>
                        </div>
                        <!--#region Bullet Navigator Skin Begin -->
                        <!-- Help: http://www.jssor.com/development/slider-with-bullet-navigator-jquery.html -->
                        <!-- bullet navigator container -->
                        <div u="navigator" class="jssorb05" style="bottom: 16px; right: 6px;">
                            <!-- bullet navigator item prototype -->
                            <div u="prototype"></div>
                        </div>
                        <!--#endregion Bullet Navigator Skin End -->
                        <!--#region Arrow Navigator Skin Begin -->
                        <!-- Help: http://www.jssor.com/development/slider-with-arrow-navigator-jquery.html -->
                        <!-- Arrow Left -->
                        <span u="arrowleft" class="jssora11l" style="top: 123px; left: 8px;">
                        </span>
                        <!-- Arrow Right -->
                        <span u="arrowright" class="jssora11r" style="top: 123px; right: 8px;">
                        </span>
                        <!--#endregion Arrow Navigator Skin End -->
                        <a style="display: none" href="http://www.jssor.com">Bootstrap Carousel</a>
                    </div>
                    <!-- Jssor Slider End -->
        			<!--<div class="ordernow">
                        <a href="signup.html"><img src="images/Index_OrderNowButton.png" alt="Order Now" width="200" height="66"></a>
                    </div>
                    <img src="images/Index_Divider.png" alt="Divider" width="800" height="10"/>-->
                </div>
    			<div id="maintext">
    				<h1>Welcome to Tokyo Thyme</h1>
    				<p>Tokyo Thyme located at the north edge of Kerrisdale, Vancouver.  We focus on cuisine that is a fusion between traditional Japanese and contemporary. Our aim is to appeal to customers by incorporating quality through traditional methods and show casing its dishes by giving it a modern feel/twist. You can definitely expect to get the best of both worlds when you come in to dine or order take-out at our restaurant. </p>
    				<p>The restaurant is owned by a husband and wife that are passionate about Japanese cuisine. The sushi chef has received training from a Japanese chef during his time in San Francisco. He and his wife immigrated to Vancouver where he worked for a short period of time at Vancouver’s prestigious Tojo’s before he decided to open a store with his wife. During his time at Tojo’s he was recognized as Vancouver’s first Mexican sushi chef that met the strict Japanese standards necessary to be a sushi chef in Japan.</p>
                </div>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="scripts/slider/js/jquery-1.9.1.min.js"></script>
        <script src="scripts/slider/examples-bootstrap/bootstrap.min.js"></script>
        <script src="scripts/slider/examples-bootstrap/docs.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="scripts/slider/examples-bootstrap/ie10-viewport-bug-workaround.js"></script>
        <!-- jssor slider scripts-->
        <!-- use jssor.slider.debug.js for debug -->
        <script type="text/javascript" src="scripts/slider/js/jssor.slider.mini.js"></script>
        <script>
            jQuery(document).ready(function ($) {
                var options = {
                    $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                    $AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
                    $Idle: 2000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                    $PauseOnHover: 1,                                   //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1
                    $ArrowKeyNavigation: true,                          //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                    $SlideEasing: $JssorEasing$.$EaseOutQuint,          //[Optional] Specifies easing for right to left animation, default value is $JssorEasing$.$EaseOutQuad
                    $SlideDuration: 800,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                    $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
                    //$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                    //$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                    $SlideSpacing: 0,                                   //[Optional] Space between each slide in pixels, default value is 0
                    $Cols: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                    $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                    $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
                    $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
                    $DragOrientation: 1,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $Cols is greater than 1, or parking position is not 0)
                    $ArrowNavigatorOptions: {                           //[Optional] Options to specify and enable arrow navigator or not
                        $Class: $JssorArrowNavigator$,                  //[Requried] Class to create arrow navigator instance
                        $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                        $AutoCenter: 2,                                 //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                        $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
                        $Scale: false                                   //Scales bullets navigator or not while slider scale
                    },
                    $BulletNavigatorOptions: {                                //[Optional] Options to specify and enable navigator or not
                        $Class: $JssorBulletNavigator$,                       //[Required] Class to create navigator instance
                        $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                        $AutoCenter: 1,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                        $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
                        $Rows: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
                        $SpacingX: 12,                                   //[Optional] Horizontal space between each item in pixel, default value is 0
                        $SpacingY: 4,                                   //[Optional] Vertical space between each item in pixel, default value is 0
                        $Orientation: 1,                                //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
                        $Scale: false                                   //Scales bullets navigator or not while slider scale
                    }
                };
                var jssor_slider1 = new $JssorSlider$("slider1_container", options);
                //responsive code begin
                //you can remove responsive code if you don't want the slider scales while window resizing
                function ScaleSlider() {
                    var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                    if (parentWidth) {
                        jssor_slider1.$ScaleWidth(parentWidth - 30);
                    }
                    else
                        window.setTimeout(ScaleSlider, 30);
                }
                ScaleSlider();
                $(window).bind("load", ScaleSlider);
                $(window).bind("resize", ScaleSlider);
                $(window).bind("orientationchange", ScaleSlider);
                //responsive code end
            });
        </script>

<?php include('page_footer.php'); ?>
