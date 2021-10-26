<body>

    <!-- begin::preloader-->
    <div class="preloader">
        <div class="preloader-icon"></div>
    </div>
    <!-- end::preloader -->

    <!-- begin::header -->
    <div class="header">

        <div>
            <ul class="navbar-nav">

                <!-- begin::navigation-toggler -->
                <li class="nav-item navigation-toggler">
                    <a href="#" class="nav-link" title="Hide navigation">
                        <i data-feather="arrow-left"></i>
                    </a>
                </li>
                <li class="nav-item navigation-toggler mobile-toggler">
                    <a href="#" class="nav-link" title="Show navigation">
                        <i data-feather="menu"></i>
                    </a>
                </li>
                <!-- end::navigation-toggler -->

                <li class="nav-item">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Create</a>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item">User</a>
                        <a href="#" class="dropdown-item">Category</a>
                        <a href="#" class="dropdown-item">Product</a>
                        <a href="#" class="dropdown-item">Report</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Apps</a>
                    <div class="dropdown-menu dropdown-menu-big">
                        <div class="p-3">
                            <div class="row row-xs">
                                <div class="col-6">
                                    <a href="chat.html">
                                        <div class="p-3 border-radius-1 border text-center mb-3">
                                            <i class="width-23 height-23" data-feather="message-circle"></i>
                                            <div class="mt-2">Chat</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="inbox.html">
                                        <div class="p-3 border-radius-1 border text-center mb-3">
                                            <i class="width-23 height-23" data-feather="mail"></i>
                                            <div class="mt-2">Mail</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="app-todo.html">
                                        <div class="p-3 border-radius-1 border text-center">
                                            <i class="width-23 height-23" data-feather="check-circle"></i>
                                            <div class="mt-2">Todo</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="file-manager.html">
                                        <div class="p-3 border-radius-1 border text-center">
                                            <i class="width-23 height-23" data-feather="file"></i>
                                            <div class="mt-2">File Manager</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <div>
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img width="18" class="mr-2"
                            src=" {{ url('users/assets/media/image/flags/261-china.png') }} " alt="flag"> China
                    </a>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item">
                            <img width="18" src=" {{ url('users/assets/media/image/flags/003-tanzania.png') }} "
                                class="mr-2" alt="flag">
                            Tanzania
                        </a>
                        <a href="#" class="dropdown-item">
                            <img width="18" src=" {{ url('users/assets/media/image/flags/262-united-kingdom.png') }} "
                                class="mr-2" alt="flag"> United Kingdom
                        </a>
                        <a href="#" class="dropdown-item">
                            <img width="18" src=" {{ url('users/assets/media/image/flags/013-tunisia.png') }} "
                                class="mr-2" alt="flag">
                            Tunisia
                        </a>
                        <a href="#" class="dropdown-item">
                            <img width="18" src=" {{ url('users/assets/media/image/flags/044-spain.png') }} "
                                class="mr-2" alt="flag"> Spain
                        </a>
                    </div>
                </li>

                <!-- begin::header search -->
                <li class="nav-item">
                    <a href="#" class="nav-link" title="Search" data-toggle="dropdown">
                        <i data-feather="search"></i>
                    </a>
                    <div class="dropdown-menu p-2 dropdown-menu-right">
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search">
                                <div class="input-group-prepend">
                                    <button class="btn" type="button">
                                        <i data-feather="search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <!-- end::header search -->




                <!-- begin::mobile header toggler -->
                <ul class="navbar-nav d-flex align-items-center">
                    <li class="nav-item header-toggler">
                        <a href="#" class="nav-link">
                            <i data-feather="arrow-down"></i>
                        </a>
                    </li>
                </ul>
                <!-- end::mobile header toggler -->
        </div>

    </div>
    <!-- end::header -->

    <!-- begin::main -->
    <div id="main">

        <!-- begin::navigation -->
        <div class="navigation">

            <!-- <div class="navigation-menu-tab">
            <div>
                <div class="navigation-menu-tab-header" data-toggle="tooltip" title="Roxana Roussell" data-placement="right">
                    <a href="#" class="nav-link" data-toggle="dropdown" aria-expanded="false">
                        <figure class="avatar avatar-sm">
                            <img src=" {{ url('users/assets/media/image/user/women_avatar1.jpg') }} " class="rounded-circle" alt="avatar">
                        </figure>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                        <div class="p-3 text-center" data-backround-image=" {{ url('users/assets/media/image/image1.jpg') }} ">
                            <figure class="avatar mb-3">
                                <img src=" {{ url('users/assets/media/image/user/women_avatar1.jpg') }} " class="rounded-circle" alt="image">
                            </figure>
                            <h6 class="d-flex align-items-center justify-content-center">
                                Roxana Roussell
                                <a href="#" class="btn btn-primary btn-sm ml-2" data-toggle="tooltip" title="Edit profile">
                                    <i data-feather="edit-2"></i>
                                </a>
                            </h6>
                            <small>Balance: <strong>₦105</strong></small>
                        </div>
                        <div class="dropdown-menu-body">
                            <div class="border-bottom p-4">
                                <h6 class="text-uppercase font-size-11 d-flex justify-content-between">
                                    Storage
                                    <span>%25</span>
                                </h6>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 35%;"
                                         aria-valuenow="35"
                                         aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="list-group list-group-flush">
                                <a href="#" class="list-group-item">Profile</a>
                                <a href="#" class="list-group-item d-flex">
                                    Followers <span class="text-muted ml-auto">214</span>
                                </a>
                                <a href="#" class="list-group-item d-flex">
                                    Inbox <span class="text-muted ml-auto">18</span>
                                </a>
                                <a href="#" class="list-group-item" data-sidebar-target="#settings">Billing</a>
                                <a href="#" class="list-group-item" data-sidebar-target="#settings">Need help?</a>
                                <a href="#" class="list-group-item text-danger" data-sidebar-target="#settings">Sign Out!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-grow-1">
                <ul>
                    <li>
                        <a class="active" href="#" data-toggle="tooltip" data-placement="right" title="Dashboards"
                           data-nav-target="#dashboards">
                            <i data-feather="bar-chart-2"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-toggle="tooltip" data-placement="right" title="Apps" data-nav-target="#apps">
                            <i data-feather="command"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-toggle="tooltip" data-placement="right" title="UI Elements"
                           data-nav-target="#elements">
                            <i data-feather="layers"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-toggle="tooltip" data-placement="right" title="Pages" data-nav-target="#pages">
                            <i data-feather="copy"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <ul>
                    <li>
                        <a href="#" data-toggle="tooltip" data-placement="right" title="Settings">
                            <i data-feather="settings"></i>
                        </a>
                    </li>
                    <li>
                        <a href="login.html" data-toggle="tooltip" data-placement="right" title="Logout">
                            <i data-feather="log-out"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div> -->

            <!-- begin::navigation menu -->
            <div class="navigation-menu-body">

                <!-- begin::navigation-logo -->
                <div>
                    <div id="navigation-logo">
                        <a href="{{ route('user.dashboard') }}">
                            <img class="logo" src=" {{ url('users/assets/media/image/logo.png') }} "
                                alt="logo">
                            <img class="logo-light" src=" {{ url('users/assets/media/image/logo-light.png') }} "
                                alt="light logo">
                        </a>
                    </div>
                </div>
                <!-- end::navigation-logo -->
                <div class="navigation-menu-group">


                    <div class="open" id="pages">
                        <ul>
                            <!-- <li class="navigation-divider">Pages</li> -->
                            <li><a href=" {{ route('user.dashboard') }} ">Dashboard</a></li>
                            <li><a href=" {{ route('user.transactions') }} ">Transaction Log</a></li>
                            <li><a href=" {{ route('user.products') }} ">Products</a></li>
                            <li><a href=" {{ route('user.profile') }} ">Profile</a></li>
                            <li><a href=" {{ route('user.logout') }} "
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                            </li>
                            <form action=" {{ route('user.logout') }} " id="logout-form" method="post">
                                @csrf
                            </form>
                            <!-- <li><a href="invoice.html">Invoice</a></li>

        <li><a href="pricing-table.html">Pricing Table</a></li>
        <li><a href="search-result.html">Search Result</a></li>
        <li>
            <a href="#">Error Pages</a>
            <ul>
                <li><a href="404.html">404</a></li>
                <li><a href="404-2.html">404 V2</a></li>
                <li><a href="503.html">503</a></li>
                <li><a href="mean-at-work.html">Mean at Work</a></li>
            </ul>
        </li>
        <li><a href="blank-page.html">Starter Page</a></li>
        <li>
            <a href="#">Email Templates</a>
            <ul>
                <li><a href="email-template-basic.html">Basic</a></li>
                <li><a href="email-template-alert.html">Alert</a></li>
                <li><a href="email-template-billing.html">Billing</a></li>
            </ul>
        </li>
        <li>
            <a href="#">Menu Level</a>
            <ul>
                <li>
                    <a href="#">Menu Level</a>
                    <ul>
                        <li>
                            <a href="#">Menu Level </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li> -->
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end::navigation menu -->

        </div>
        <!-- end::navigation -->


        <!-- end::page-header -->

        <!-- begin::page-content -->
        @yield('content')

        
