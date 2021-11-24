<!DOCTYPE html>
<html lang="en">

<head>
    <!--required meta tags-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!--twitter og-->
    <meta name="twitter:site" content="@millytechtrade">
    <meta name="twitter:creator" content="@millytechtrade">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="MillyTech Trade - Sell Your Giftcards with Ease!">
    <meta name="twitter:description" content="Sell Your Giftcards with Ease!.">
    <meta name="Keywords" content="Millytech, MilytechTrade, Millytech Trade, Sell Giftcards, Giftcard">
    <meta name="twitter:image" content="#">

    <!--facebook og-->
    <meta property="og:url" content="#">
    <meta name="twitter:title" content="MillyTech Trade - Sell Your Giftcards with Ease!">
    <meta property="og:description" content="MillyTech Trade - Sell Your Giftcards with Ease!.">
    <meta name="Keywords" content="Millytech, MilytechTrade, Millytech Trade, Sell Giftcards, Giftcard">
    <meta property="og:image" content="#">
    <meta property="og:image:secure_url" content="#">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!--meta-->
    <meta name="description" content="MillyTech Trade - Sell Your Giftcards with Ease!.">
    <meta name="author" content="millytech">

    <!--favicon icon-->
    <link rel="icon" href="{{ asset('front/img/favicon.png')}}" type="image/png" sizes="16x16">

    <!--title-->
    <title>@yield('title') | {{ config('app.name') }} | Sell Your Giftcards with Ease!</title>

    <!--google fonts-->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&amp;family=Open+Sans:wght@400;600&amp;display=swap"
        rel="stylesheet">

    <!--build:css-->
    <link rel="stylesheet" href="{{ asset('front/css/main.css') }}">
    <!-- endbuild -->

    <!--custom css start-->
    <link rel="stylesheet" href="{{ asset('front/css/custom.css') }}">
    <!--custom css end-->

</head>

<body>

    <!--preloader start-->
    <div id="preloader">
        <div class="preloader-wrap">
            <img src="{{ asset('front/img/favicon.png') }}" alt="logo" class="img-fluid preloader-icon" />
            <div class="loading-bar"></div>
        </div>
    </div>
    <!--preloader end-->
    <!--main content wrapper start-->
    <div class="main-wrapper">

        <!--header section start-->
        <!--header start-->
        <header class="main-header position-absolute w-100">
            <nav class="navbar navbar-expand-xl navbar-dark sticky-header">
                <div class="container d-flex align-items-center justify-content-lg-between position-relative">
                    <a href="{{ route('front.home')}}" class="navbar-brand d-flex align-items-center mb-md-0 text-decoration-none">
                        <img src="{{ asset('front/img/logo-white.png')}}" alt="logo" class="img-fluid logo-white">
                        <img src="{{ asset('front/img/logo-color.png')}}" alt="logo" class="img-fluid logo-color">
                    </a>

                    <a class="navbar-toggler position-absolute right-0 border-0 " href="#offcanvasWithBackdrop"
                        role="button">
                        <span class="far fa-bars" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop"
                            aria-controls="offcanvasWithBackdrop"></span>
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse navbar-collapse justify-content-center">
                        <ul class="nav col-12 col-md-auto justify-content-center main-menu">
                            <li><a href="{{ route('front.home') }}" class="nav-link">Home</a></li>
                            <li><a href="{{ route('front.services') }}" class="nav-link">Services</a></li>
                            <li><a href="{{ route('front.business') }}" class="nav-link">Business</a></li>
                            <li><a href="{{ route('front.contact-us') }}" class="nav-link">Contact Us</a></li>
                        </ul>
                    </div>

                    <div class="action-btns text-end me-5 me-lg-0 d-none d-md-block d-lg-block">
                        <a href="{{ route('user.index') }}" class="btn btn-link text-decoration-none me-2">Sign In</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                    </div>

                    <!--offcanvas menu start-->
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasWithBackdrop">
                        <div class="offcanvas-header d-flex align-items-center mt-4">
                            <a href="index.html" class="d-flex align-items-center mb-md-0 text-decoration-none">
                                <img src="{{ asset('front/img/logo-color.png') }}" alt="logo" class="img-fluid ps-2">
                            </a>
                            <button type="button" class="close-btn text-danger" data-bs-dismiss="offcanvas"
                                aria-label="Close"><i class="far fa-close"></i></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="nav col-12 col-md-auto justify-content-center main-menu">
                                <li><a href="{{ route('front.home') }}" class="nav-link">Home</a></li>
                            <li><a href="{{ route('front.services') }}" class="nav-link">Services</a></li>
                            <li><a href="{{ route('front.business') }}" class="nav-link">Business</a></li>
                            <li><a href="{{ route('front.contact-us') }}" class="nav-link">Contact Us</a></li>
                            </ul>
                            <div class="action-btns mt-4 ps-3">
                                <a href="{{ route('user.index') }}" class="btn btn-outline-primary me-2">Sign In</a>
                                <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                            </div>
                        </div>

                    </div>
                    <!--offcanvas menu end-->
                </div>
            </nav>
        </header>
        <!--header end-->
        <!--header section end-->

        @yield('content')


        <!--footer section start-->
        <footer class="footer-section">
            <!--footer bottom start-->
            <div class="footer-bottom footer-light py-4">
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-7 col-lg-7">
                            <div class="copyright-text">
                                <p class="mb-lg-0 mb-md-0">&copy; 2021 MillyTech Trade. All Rights Reserved.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="footer-single-col text-start text-lg-end text-md-end">
                                <ul class="list-unstyled list-inline footer-social-list mb-0">
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-dribbble"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-github"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--footer bottom end-->
        </footer>
        <!--footer section end-->
    </div>
    <!--build:js-->
    <script src="{{ asset('front/js/vendors/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('front/js/vendors/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('front/js/vendors/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('front/js/vendors/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('front/js/vendors/parallax.min.js') }}"></script>
    <script src="{{ asset('front/js/vendors/aos.js') }}"></script>
    <script src="{{ asset('front/js/app.js') }}"></script>
    <!--endbuild-->
</body>

</html>
