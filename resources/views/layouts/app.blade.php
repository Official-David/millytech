<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:image" content="page-error-404.html" />
    <meta name="format-detection" content="telephone=no">

    <meta name="_token" content="{{ csrf_token() }}">

    <!-- PAGE TITLE HERE -->
    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{ favicon() }}" />
    <link href="{{ asset('back/vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('back/vendor/toastr/css/toastr.min.css') }}">

    <!-- Style css -->
    <link href="{{ asset('back/css/style.css') }}" rel="stylesheet">
    <style>
        .form-group {
            margin-bottom: 10px;
        }

        input[type=text],
        select {
            border-color: #eee !important;
        }

        .form-select {
            height: 2.75rem;
        }

        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
            text-align: center;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .nice-select.open .list {
            max-height: 300px;
            overflow-y: scroll;
        }

        .nice-select {
            float: none;
        }
    </style>
    @stack('css')

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="/" class="brand-logo">
                <img src="{{ logo() }}" alt="" width="180">
            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="nav-item">
                                {{-- <div class="input-group search-area">
                                    <input type="text" class="form-control" placeholder="Search here">
                                    <span class="input-group-text"><a href="javascript:void(0)"><i
                                                class="flaticon-381-search-2"></i></a></span>
                                </div> --}}
                                <i class="fa fa-sun fs-16"></i>
                                <label class="switch" for="theme-toggle">
                                    <input type="checkbox" id="theme-toggle">
                                    <span class="slider round"></span>
                                </label>
                                <i class="fa fa-moon fs-16"></i>
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
                            @if(request()->isUser())
                                @auth('user')
                                    <x-notification :user="auth()->user()" />
                                @endauth
                            @endif
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                                    <div class="header-info me-3">
                                        <span class="fs-18 font-w500 text-end">{{
                                            auth(config('fortify.guard'))->user()->name }}</span>
                                        <small class="text-end fs-14 font-w400">{{
                                            auth(config('fortify.guard'))->user()->email }}</small>
                                    </div>
                                    <img src="{{ profile_picture() }}" width="20" alt="" />
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    @if (request()->isUser())
                                    <a href="{{ route('user.settings.profile') }}" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary"
                                            width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span class="ms-2">Profile </span>
                                    </a>
                                    @endif
                                    {{-- <a href="email-inbox.html" class="dropdown-item ai-icon">
                                        <svg id="icon-inbox" xmlns="http://www.w3.org/2000/svg" class="text-success"
                                            width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path
                                                d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                            </path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg>
                                        <span class="ms-2">Inbox </span> --}}
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item ai-icon"
                                        onclick="document.getElementById('logout-form').submit()">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger"
                                            width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" y1="12" x2="9" y2="12">
                                            </line>
                                        </svg>
                                        <span class="ms-2">Logout </span>
                                        <form id="logout-form" action="{{ route('logout') }}" method="post">@csrf
                                        </form>
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item">

                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="deznav">
            <div class="deznav-scroll">
                @if (request()->isAdmin())
                @include('partials.admin-sidebar')
                @elseif(request()->isUser())
                @include('partials.sidebar')
                @endif
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            @if (request()->isUser() && !config('system.trading'))
            <div class="alert alert-outline-warning fade show mx-4 mt-4" role="alert">
                <strong>Notice!!!</strong> The trading system is temporarily disabled, we will be back shortly.
            </div>
            @endif
            @yield('content')
        </div>
        <!--**********************************
            Content body end
        ***********************************-->



        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © {{ config('app.name') }} {{ now()->format('Y') }}</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('back/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('back/vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('back/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>



    <!-- Chart piety plugin files -->
    <script src="{{ asset('back/vendor/peity/jquery.peity.min.js') }}"></script>
    <!-- JS for dotted map -->



    <script src="{{ asset('back/js/custom.min.js') }}"></script>
    <script src="{{ asset('back/js/deznav-init.js') }}"></script>
    <script src="{{ asset('back/vendor/toastr/js/toastr.min.js') }}"></script>
    <x-live-chat />

    <script>
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
        .forEach(el => new bootstrap.Tooltip(el))

        function toast(message, type = 'success') {
            let data = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "positionClass": "toast-bottom-center",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            if (type == 'success') {
                toastr.success(message, data)
            } else if (type == 'info') {
                toastr.info(message, data)
            } else {
                toastr.error(message, data)
            }
        }

        let storage = window.localStorage
        let theme = storage.getItem('theme')
        let bodyTag = document.querySelector('body')
        let toggler = document.querySelector('#theme-toggle')

        document.addEventListener("DOMContentLoaded", e => {
            if (theme == null) {
                theme = bodyTag.dataset.themeVersion
                storage.setItem('theme', theme)
            } else {
                if (theme == 'dark') {
                    toggler.setAttribute('checked', true)
                }
                bodyTag.dataset.themeVersion = theme
            }
        })
        toggler.addEventListener('change', e => {
            element = e.target
            if (element.hasAttribute('checked')) {
                element.removeAttribute('checked')
                storage.setItem('theme', 'light')
                bodyTag.dataset.themeVersion = 'light'
            } else {
                element.setAttribute('checked', true)
                storage.setItem('theme', 'dark')
                bodyTag.dataset.themeVersion = 'dark'
            }

        })
    </script>

    @if (session()->has('message'))
    <script>
        toast("{{ session()->get('message') }}")
    </script>
    @endif

    @if (session()->has('error'))
    <script>
        toast("{{ session()->get('error') }}", "error")
    </script>
    @endif


    @stack('js')

</body>


</html>
