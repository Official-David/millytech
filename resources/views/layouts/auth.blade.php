<!DOCTYPE html>
<html lang="en" class="h-100">


<!-- Mirrored from griya.dexignzone.com/xhtml/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 10 Jul 2021 11:48:05 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Griya : Real Estate Admin" />
    <meta property="og:title" content="Griya : Real Estate Admin" />
    <meta property="og:description" content="Griya : Real Estate Admin" />
    <meta property="og:image" content="page-error-404.html" />
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>@yield('title') | Authentication</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{favicon()}}" />
    <link href="{{asset('back/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('back/vendor/toastr/css/toastr.min.css')}}">


</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-5">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <a href=""><img src="{{logo()}}" alt=""></a>
                                    </div>
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{asset('back/vendor/global/global.min.js')}}"></script>
    <script src="{{asset('back/js/custom.min.js')}}"></script>
    <script src="{{asset('back/js/deznav-init.js')}}"></script>
    <script src="{{asset('back/js/styleSwitcher.js')}}"></script>
    <script src="{{asset('back/vendor/toastr/js/toastr.min.js')}}"></script>

    {{-- @include('includes.alert') --}}
</body>


</html>
