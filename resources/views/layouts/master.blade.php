<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="CJ Feed and Care">
    <meta name="keywords" content="CJ Feed and Care">
    <meta name="author" content="Cheiljedang Indonesia ">
    <link rel="icon" type="image/png" href="{{ asset('icon/iconcj.ico')}}" sizes="16x16">
    <link rel="icon" type="image/png" href="{{ asset('icon/iconcj.ico')}}" sizes="32x32">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>HR Program - CJ Feed & Care Indonesia</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Font Awesome -->
    <link href="{{ asset('vendor/css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/css/brands.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/css/solid.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/w3.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-master.css') }}" rel="stylesheet">
    <style>
        .btn-newicon svg {
            margin-top: -2px;
            margin-right: 5px;
        }
    </style>
    @stack('css-external')
</head>

<body class="body-auth">
    <div id="master">
        <div class="page-main-header">
            <div class="main-header-right row m-0">
                <div class="main-header-left">
                    <img id="sidebarOpen" onclick="sidebar_open()" class="img-fluid menu-style sidebar-toggle"
                        src="{{ asset('icon/menu-scale.png') }}" style="margin-left: 0px" alt="">
                    <img id="sidebarClose" onclick="sidebar_close()" class="img-fluid menu-style sidebar-toggle"
                        src="{{ asset('icon/menu.png') }}" style="margin-left: 0px" alt="">
                    <img class="img-fluid brand-style" src="{{ asset('img/cj-logo.png') }}" alt="">
                    <p class="breadcrumb b-style">@yield('title')</p>
                </div>

                <div class="nav-right col pull-right right-menu p-0">
                    {{-- <div class="split-btn">
                        <button class="btnIm">New</button>
                        <div class="dropdown-new">
                            <button onclick="newCusto()" class=" dropbtn-new">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 9L12 15L18 9" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>

                            </button>
                            <div id="myDropdownNew" class="dropdown-content-new">
                                <button id="createBtn" data-bs-toggle="modal" data-bs-target="#newChat"
                                    class="btn-newicon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 13.8214 2.48697 15.5291 3.33782 17L2.5 21.5L7 20.6622C8.47087 21.513 10.1786 22 12 22Z"
                                            stroke="black" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    New chat
                                </button>

                                <button id="createBtn" data-bs-toggle="modal" data-bs-target="#newBroadcast"
                                    class="btn-newicon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14 14V6M14 14L20.1023 17.487C20.5023 17.7156 21 17.4268 21 16.9661V3.03391C21 2.57321 20.5023 2.28439 20.1023 2.51296L14 6M14 14H7C4.79086 14 3 12.2091 3 10V10C3 7.79086 4.79086 6 7 6H14"
                                            stroke="black" stroke-width="1.5" />
                                        <path
                                            d="M7.75716 19.3001L7 14H11L11.6772 18.7401C11.8476 19.9329 10.922 21 9.71716 21C8.73186 21 7.8965 20.2755 7.75716 19.3001Z"
                                            stroke="black" stroke-width="1.5" />
                                    </svg>

                                    New broadcast
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="dd-notification">
                        <div class="wrap-noti">
                            <img onclick="ddNotification()" class="img-fluid menu-style dropbtn-notification"
                                src="{{ asset('icon/bell.png') }}" alt="">
                            <i class="fa-solid fa-circle circle-red-dot"></i>
                        </div>

                        <div id="myddNotification" class="dropdown-content-notification">
                            <div class="notification-box unread">
                                <h5 class="noti-title">Lorem ipsum dolor sit amet</h5>
                                <p class="noti-desc">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam,
                                    itaque nam
                                    recusandae...</p>
                                <p class="time">08:49</p>
                            </div>
                            <div class="notification-box read">
                                <h5 class="noti-title">Lorem ipsum dolor sit amet</h5>
                                <p class="noti-desc">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam,
                                    itaque nam
                                    recusandae...</p>
                                <p class="time">Yesterday</p>
                            </div>
                            <div class="notification-box read">
                                <h5 class="noti-title">Lorem ipsum dolor sit amet</h5>
                                <p class="noti-desc">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam,
                                    itaque nam
                                    recusandae...</p>
                                <p class="time">2 days ago</p>
                            </div>
                        </div>
                    </div> --}}
                    <div class="dropdown-profile">
                        <img onclick="ddProfile()" class="dd-profile img-fluid avatar-style"
                            src="{{ asset('icon/avatar.png') }}" alt="" style="max-width: 40px;">
                        <div id="myddProfile" class="dropdown-content-profile">
                            {{-- <a href="{{ route('setting.index') }}">Profile</a> --}}
                            <button type="button">
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class='bx bx-log-out-circle'></i> Log Out
                                </a>
                            </button>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>

                </div>
                {{-- <div class="d-lg-none mobile-toggle pull-right w-auto"><svg xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
                        <circle cx="12" cy="12" r="1"></circle>
                        <circle cx="19" cy="12" r="1"></circle>
                        <circle cx="5" cy="12" r="1"></circle>
                    </svg></div> --}}
            </div>
        </div>

        <main class="page-wrapper">
            @includeIf('layouts.partials.sidebar')
            <div id="main" class="main">
                @yield('content')
            </div>

        </main>
    </div>


    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/js/bootstrap.bundle.min.js') }}">
    </script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        // toggle sidebar
        $nav = $('.main-nav');
        $header = $('.page-main-header');
        $toggle_nav_top = $('#sidebar-toggle');
        $toggle_nav_top.click(function() {
        $this = $(this);
        $nav = $('.main-nav');
        $nav.toggleClass('close_icon');
        $header.toggleClass('close_icon');
        });

        $( window ).resize(function() {
        $nav = $('.main-nav');
        $header = $('.page-main-header');
        $toggle_nav_top = $('#sidebar-toggle');
        $toggle_nav_top.click(function() {
            $this = $(this);
            $nav = $('.main-nav');
            $nav.toggleClass('close_icon');
            $header.toggleClass('close_icon');
        });
        });
    </script>

    <script>
        /* When the user clicks on the button, 
        toggle between hiding and showing the dropdown content */
        function newCusto() {
        document.getElementById("myDropdownNew").classList.toggle("show");
        }
        
        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
        if (!event.target.matches('.dropbtn-new')) {
            var dropdownsNew = document.getElementsByClassName("dropdown-content-new");
            var i;
            for (i = 0; i < dropdownsNew.length; i++) {
            var openDropdownNew = dropdownsNew[i];
            if (openDropdownNew.classList.contains('show')) {
                openDropdownNew.classList.remove('show');
            }
            }
        }
        }
    </script>
    <script>
        /* When the user clicks on the button, 
        toggle between hiding and showing the dropdown content */
        function ddNotification() {
        document.getElementById("myddNotification").classList.toggle("show");
        }
        
        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
        if (!event.target.matches('.dropbtn-notification')) {
            var dropdownsNotification = document.getElementsByClassName("dropdown-content-notification");
            var i;
            for (i = 0; i < dropdownsNotification.length; i++) {
            var openddNotification = dropdownsNotification[i];
            if (openddNotification.classList.contains('show')) {
                openddNotification.classList.remove('show');
            }
            }
        }
        }
    </script>

    <script>
        /* When the user clicks on the button, 
    toggle between hiding and showing the dropdown content */
    function ddProfile() {
    document.getElementById("myddProfile").classList.toggle("show");
    }
        
        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
        if (!event.target.matches('.dd-profile')) {
            var dropdownsProfile = document.getElementsByClassName("dropdown-content-profile");
            var i;
            for (i = 0; i < dropdownsProfile.length; i++) {
            var openddProfile = dropdownsProfile[i];
            if (openddProfile.classList.contains('show')) {
                openddProfile.classList.remove('show');
            }
            }
        }
    }
    </script>

    <script>
        function sidebar_open() {
            var sideNav = document.getElementById("myNav");
            var mainNav = document.getElementById("main");
            document.getElementById("sidebarClose").style.display = "block";
            document.getElementById("sidebarOpen").style.display = "none";
            mainNav.classList.remove("close-main");
            mainNav.classList.add("open-main");
            sideNav.classList.remove("close-nav");
            sideNav.classList.add("open-nav");
            console.log('In Open');
        }
        function sidebar_close() {
            var sideNav = document.getElementById("myNav");
            var mainNav = document.getElementById("main");
            document.getElementById("sidebarOpen").style.display = "block";
            document.getElementById("sidebarClose").style.display = "none";
            mainNav.classList.remove("open-main");
            mainNav.classList.add("close-main");
            sideNav.classList.remove("open-nav");
            sideNav.classList.add("close-nav");
            console.log('In Close');
        }
    </script>
    @stack('javascript-external')
</body>

</html>