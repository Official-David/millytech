<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from griya.dexignzone.com/xhtml/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 10 Jul 2021 11:23:12 GMT -->

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

    <meta name="_token" content="{{csrf_token()}}">

    <!-- PAGE TITLE HERE -->
    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{ favicon() }}" />
    <link href="{{asset('back/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('back/vendor/dotted-map/css/contrib/jquery.smallipop-0.3.0.min.css')}}"
        type="text/css" media="all" />
    <link rel="stylesheet" href="{{asset('back/vendor/toastr/css/toastr.min.css')}}">

    <!-- Style css -->
    <link href="{{asset('back/css/style.css')}}" rel="stylesheet">
    <style>
        .form-group {
            margin-bottom: 10px;
        }

        input[type=text], select{
            border-color: #eee !important;
        }

        .form-select{
            height: 2.75rem;
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
                <img src="{{ logo() }}" alt="" width="80">
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
                                <div class="input-group search-area">
                                    <input type="text" class="form-control" placeholder="Search here">
                                    <span class="input-group-text"><a href="javascript:void(0)"><i
                                                class="flaticon-381-search-2"></i></a></span>
                                </div>
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10.4524 25.6682C11.0605 27.0357 12.409 28 14.0005 28C15.592 28 16.9405 27.0357 17.5487 25.6682C16.4265 25.7231 15.2594 25.76 14.0005 25.76C12.7417 25.76 11.5746 25.723 10.4524 25.6682Z"
                                            fill="#737B8B" />
                                        <path
                                            d="M26.3532 19.74C24.877 17.8785 22.3996 14.2195 22.3996 10.64C22.3996 7.09073 20.1193 3.89758 16.7996 2.72382C16.7593 1.21406 15.5183 0 14.0007 0C12.482 0 11.2422 1.21406 11.2018 2.72382C7.88101 3.89758 5.6007 7.09073 5.6007 10.64C5.6007 14.2207 3.1244 17.8785 1.64712 19.74C1.15433 20.3616 1.00197 21.1825 1.24058 21.9363C1.47354 22.6721 2.05367 23.2422 2.79288 23.4595C4.08761 23.8415 6.20997 24.2715 9.44682 24.491C10.8479 24.5851 12.3543 24.64 14.0008 24.64C15.646 24.64 17.1525 24.5851 18.5535 24.491C21.7915 24.2715 23.9128 23.8415 25.2086 23.4595C25.9478 23.2422 26.5268 22.6722 26.7598 21.9363C26.9983 21.1825 26.8449 20.3616 26.3532 19.74Z"
                                            fill="#737B8B" />
                                    </svg>
                                    <span class="badge light text-white bg-primary rounded-circle">0</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3"
                                        style="height:380px;">
                                        <ul class="timeline">
                                            {{-- <li>
                                                <div class="timeline-panel">
                                                    <div class="media me-2">
                                                        <img alt="image" width="50" src="/assets/back/images/avatar/1.jpg">
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="mb-1">Dr sultads Send you Photo</h6>
                                                        <small class="d-block">29 July 2020 - 02:26 PM</small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="timeline-panel">
                                                    <div class="media me-2 media-primary">
                                                        <i class="fa fa-home"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="mb-1">Reminder : Treatment Time!</h6>
                                                        <small class="d-block">29 July 2020 - 02:26 PM</small>
                                                    </div>
                                                </div>
                                            </li> --}}
                                        </ul>
                                    </div>
                                    {{-- <a class="all-notification" href="javascript:void(0);">See all notifications <i
                                            class="ti-arrow-end"></i></a> --}}
                                </div>
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                                    <div class="header-info me-3">
                                        <span class="fs-18 font-w500 text-end">{{ auth(config('fortify.guard'))->user()->name }}</span>
                                        <small class="text-end fs-14 font-w400">{{ auth(config('fortify.guard'))->user()->email }}</small>
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
                                            <line x1="21" y1="12" x2="9" y2="12"></line>
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
                <p>Copyright © {{ config('app.name') }}; {{ now()->format('Y') }}</p>
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
    <script src="{{asset('back/vendor/global/global.min.js')}}"></script>
    <script src="{{asset('back/vendor/chart.js/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('back/vendor/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>



    <!-- Chart piety plugin files -->
    <script src="{{asset('back/vendor/peity/jquery.peity.min.js')}}"></script>
    <!-- JS for dotted map -->
    <script src="{{asset('back/vendor/dotted-map/js/contrib/jquery.smallipop-0.3.0.min.js')}}"></script>
    <script src="{{asset('back/vendor/dotted-map/js/contrib/suntimes.js')}}"></script>
    <script src="{{asset('back/vendor/dotted-map/js/contrib/color-0.4.1.js')}}"></script>

    <script src="{{asset('back/vendor/dotted-map/js/world.js')}}"></script>
    <script src="{{asset('back/vendor/dotted-map/js/smallimap.js')}}"></script>



    <script src="{{asset('back/js/custom.min.js')}}"></script>
    <script src="{{asset('back/js/deznav-init.js')}}"></script>
    <script src="{{asset('back/js/styleSwitcher.js')}}"></script>
    <script src="{{asset('back/vendor/toastr/js/toastr.min.js')}}"></script>
    <x-live-chat />

    <script>
        function toast(message, type = 'success') {
            let data = {
                timeOut: 500000000,
                closeButton: !0,
                debug: !1,
                newestOnTop: !0,
                progressBar: !0,
                positionClass: "toast-top-right",
                preventDuplicates: !0,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                tapToDismiss: !1
            };
            if (type == 'success') {
                toastr.success(message, "Sucess", data)
            } else if(type == 'info'){
                toastr.info(message, "Info",data)
            } else {
                toastr.error(message, "Error", data)
            }
        }
    </script>

    @if(session()->has('success'))
        <script>
            toast("{{session()->get('success')}}")
        </script>
    @endif

    @if(session()->has('error'))
        <script>
            toast("{{session()->get('error')}}","error")
        </script>
    @endif

    @stack('js')

</body>


</html>
