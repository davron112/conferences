<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <!-- The above 3 meta tags *must* come first in the head -->

    <!-- SITE TITLE -->
    <title>Emeet</title>
    <meta name="description" content="Responsive Emeet HTML Template"/>
    <meta name="keywords" content="Bootstrap3, Event,  Conference, Meetup, Template, Responsive, HTML5"/>
    <meta name="author" content="themearth.com"/>

    <!-- twitter card starts from here, if you don't need remove this section -->
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="@yourtwitterusername"/>
    <meta name="twitter:creator" content="@yourtwitterusername"/>
    <meta name="twitter:url" content="http://yourdomain.com/"/>
    <meta name="twitter:title" content="Your home page title, max 140 char"/>
    <!-- maximum 140 char -->
    <meta name="twitter:description" content="Your site description, maximum 140 char "/>
    <!-- maximum 140 char -->
    <meta name="twitter:image" content="assets/img/twittercardimg/twittercard-280-150.jpg"/>
    <!-- when you post this page url in twitter , this image will be shown -->
    <!-- twitter card ends from here -->

    <!-- facebook open graph starts from here, if you don't need then delete open graph related  -->
    <meta property="og:title" content="Your home page title"/>
    <meta property="og:url" content="http://your domain here.com"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:site_name" content="Your site name here"/>
    <!--meta property="fb:admins" content="" /-->  <!-- use this if you have  -->
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="assets/img/opengraph/fbphoto.jpg"/>
    <!-- when you post this page url in facebook , this image will be shown -->
    <!-- facebook open graph ends from here -->

    <!--  FAVICON AND TOUCH ICONS -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}"/>
    <!-- this icon shows in browser toolbar -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}"/>
    <!-- this icon shows in browser toolbar -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/img/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/img/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/img/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/img/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/img/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/img/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/img/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/img/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/img/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon/favicon-16x16.png') }}">


    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}" media="all"/>

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="{{ asset('assets/libs/fontawesome/css/font-awesome.min.css') }}" media="all"/>

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="{{ asset('assets/libs/maginificpopup/magnific-popup.css') }}" media="all"/>

    <!-- Time Circle -->
    <link rel="stylesheet" href="{{ asset('assets/libs/timer/TimeCircles.css') }}" media="all"/>

    <!-- OWL CAROUSEL CSS -->
    <link rel="stylesheet" href="{{ asset('assets/libs/owlcarousel/owl.carousel.min.css') }}" media="all" />
    <link rel="stylesheet" href="{{ asset('assets/libs/owlcarousel/owl.theme.default.min.css') }}" media="all" />

    <!-- GOOGLE FONT -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Oswald:400,700%7cRaleway:300,400,400i,500,600,700,900"/>

    <!-- MASTER  STYLESHEET  -->
    <link id="lgx-master-style" rel="stylesheet" href="{{ asset('assets/css/style-default.min.css') }}" media="all"/>

    <!-- MODERNIZER CSS  -->
    <script src="{{ asset('assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
</head>

<body class="home">

<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->

<div class="lgx-container ">
    <!-- ***  ADD YOUR SITE CONTENT HERE *** -->


    <!--HEADER-->
    <header>
        <div id="lgx-header" class="lgx-header">
            <div class="lgx-header-position lgx-header-position-white lgx-header-position-fixed"> <!--lgx-header-position-fixed lgx-header-position-white lgx-header-fixed-container lgx-header-fixed-container-gap lgx-header-position-white-->
                <div class="lgx-container"> <!--lgx-container-fluid-->
                    <nav class="navbar navbar-default lgx-navbar">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Menu</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <div class="lgx-logo">
                                <a href="/" class="lgx-scroll">
                                    <img src="assets/img/logo.png" alt="Emeet Logo"/>
                                </a>
                            </div>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
                            <div class="lgx-nav-right navbar-right">
                                <div class="lgx-cart-area">
                                    <a class="lgx-btn lgx-btn-red" href="/registration">Ishtirok etish</a>
                                </div>
                            </div>
                            <ul class="nav navbar-nav lgx-nav navbar-right">
                                <li><a class="lgx-scroll" href="#lgx-speakers">Bosh sahifa</a></li>
                                <li><a class="lgx-scroll" href="#lgx-speakers">Ishtirokchilar</a></li>
                                <li><a class="lgx-scroll" href="#lgx-schedule">Konferensiya jadvali</a></li>
                                <li><a class="lgx-scroll" href="#lgx-sponsors">Homiylar</a></li>
                                <li><a class="lgx-scroll" href="/about">Batafsil</a></li>
                                <li><a class="lgx-scroll" href="#lgx-travelinfo">Bog'lanish uchun</a></li>
                            </ul>
                        </div><!--/.nav-collapse -->
                    </nav>
                </div>
                <!-- //.CONTAINER -->
            </div>
        </div>
    </header>
    <!--HEADER END-->

    @yield('content')

<!--GOOGLE MAP-->
    {{--<div class="innerpage-section">
        <div class="lgxmapcanvas map-canvas-default" id="map_canvas"> </div>
    </div>--}}
    <!--GOOGLE MAP END-->

    <!--FOOTER-->
    <footer>
        <div id="lgx-footer" class="lgx-footer"> <!--lgx-footer-white-->
            <div class="lgx-inner-footer">
                <div class="lgx-subscriber-area lgx-subscriber-area-indiv lgx-subscriber-area-black">
                    <div class="container">
                        <div class="lgx-subscriber-inner lgx-subscriber-inner-indiv">  <!--lgx-subscriber-inner-indiv-->
                            <h3 class="subscriber-title">Yangi anjumanlar haqida ma'lumot olib turing</h3>
                            <form class="lgx-subscribe-form" >
                                <div class="form-group form-group-email">
                                    <input type="email" id="subscribe" placeholder="Enter your email Address  ..." class="form-control lgx-input-form form-control"  />
                                </div>
                                <div class="form-group form-group-submit">
                                    <button type="submit" name="lgx-submit" id="lgx-submit" class="lgx-btn lgx-submit"><span>Subscribe</span></button>
                                </div>
                            </form> <!--//.SUBSCRIBE-->
                        </div>
                    </div>
                </div>
                <div class="container">
                    {{--<div class="lgx-footer-area lgx-footer-area-center">
                        <div class="lgx-footer-single">
                            <h3 class="footer-title">Ijtimoiy tarmoq orqali</h3>
                            <p class="text">
                                Yangiliklarimizni bilish uchun ijtimoiy tarmoqlarimizga ulashingiz kerak
                            </p>
                            <ul class="list-inline lgx-social-footer">
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>--}}

                    <div class="lgx-footer-bottom">
                        <div class="lgx-copyright">
                            <p> <span>©</span> 2021 DevMind</p>
                        </div>
                    </div>

                </div>
                <!-- //.CONTAINER -->
            </div>
            <!-- //.footer Middle -->
        </div>
    </footer>
    <!--FOOTER END-->


</div>
<!--//.LGX SITE CONTAINER-->
<!-- *** ADD YOUR SITE SCRIPT HERE *** -->
<!-- JQUERY  -->
<script src="{{ asset('assets/js/vendor/jquery-1.12.4.min.js') }}"></script>

<!-- BOOTSTRAP JS  -->
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- Smooth Scroll  -->
<script src="{{ asset('assets/libs/jquery.smooth-scroll.js') }}"></script>

<!-- SKILLS SCRIPT  -->
<script src="{{ asset('assets/libs/jquery.validate.js') }}"></script>

<!-- if load google maps then load this api, change api key as it may expire for limit cross as this is provided with any theme -->
{{--
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIKbFTvAyZuB8CuFqSIEVEHmbqfDm6UD8"></script>
--}}

<!-- CUSTOM GOOGLE MAP -->
{{--
<script type="text/javascript" src="{{ asset('assets/libs/gmap/jquery.googlemap.js"></script>
--}}

<!-- adding magnific popup js library -->
<script type="text/javascript" src="{{ asset('assets/libs/maginificpopup/jquery.magnific-popup.min.js') }}"></script>

<!-- Owl Carousel  -->
<script src="{{ asset('assets/libs/owlcarousel/owl.carousel.min.js') }}"></script>

<!-- COUNTDOWN   -->
<script src="{{ asset('assets/libs/countdown.js') }}"></script>
<script src="{{ asset('assets/libs/timer/TimeCircles.js') }}"></script>

<!-- Counter JS -->
<script src="{{ asset('assets/libs/waypoints.min.js') }}"></script>
<script src="{{ asset('assets/libs/counterup/jquery.counterup.min.js') }}"></script>

<!-- SMOTH SCROLL -->
<script src="{{ asset('assets/libs/jquery.smooth-scroll.min.js') }}"></script>
<script src="{{ asset('assets/libs/jquery.easing.min.js') }}"></script>

<!-- type js -->
<script src="{{ asset('assets/libs/typed/typed.min.js') }}"></script>

<!-- header parallax js -->
<script src="{{ asset('assets/libs/header-parallax.js') }}"></script>

<!-- instafeed js -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/instafeed.js/1.4.1/instafeed.min.js"></script>-->
<script src="{{ asset('assets/libs/instafeed.min.js') }}"></script>

<!-- CUSTOM SCRIPT  -->
<script src="{{ asset('assets/js/custom.script.js') }}"></script>

</body>

</html>
