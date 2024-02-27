<style>
    li.dropdown {
        display: block;
        float: none;
        width: 100%;
        padding: 0 20px;
        position: relative;
    }

    li.dropdown ul {
        background-color: #f7f7f7;
        border-radius: 10px;
        padding: 10px 0px 10px 0px;
        margin-top: 10px;
        z-index: 1;
        position: relative;
    }

    li.dropdown ul a {
        padding: 8px 25px;
        font-size: 13px;
        color: #717171;
        display: flex;
        position: relative;
        letter-spacing: 0px;
        padding-left: 28px !important;
        vertical-align: middle;
        border-radius: 10px;
        margin: 5px 0px
    }

    li.dropdown ul a:hover {
        background: #f8971d;
        color: #fff
    }

    li.dropdown ul a.active {
        background: #f8971d;
        color: #fff
    }

    li.dropdown.active {
        padding-bottom: 20px
    }

    th {
        height: auto !important;
    }
</style>

<?php 
$uu = DB::table('tb_ujian_user')->where('ujian_id', $ujian->id)->where('employee_id', auth()->user()->employee_id)->first();
?>

<nav id="myNav">
    <div class="menu-items">
        <ul class="nav-links">
            <li class="{{routeActive('home')}}">
                <a href="{{ route('home') }}">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M17 21H7C4.79086 21 3 19.2091 3 17V10.7076C3 9.30887 3.73061 8.01175 4.92679 7.28679L9.92679 4.25649C11.2011 3.48421 12.7989 3.48421 14.0732 4.25649L19.0732 7.28679C20.2694 8.01175 21 9.30887 21 10.7076V17C21 19.2091 19.2091 21 17 21Z"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9 17H15" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <span class="link-name">Dashboard</span>
                </a>
            </li>

            <li class="{{routeActive('report.index')}}">
                <a href="{{ route('report.index') }}">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M14 14V6M14 14L20.1023 17.487C20.5023 17.7156 21 17.4268 21 16.9661V3.03391C21 2.57321 20.5023 2.28439 20.1023 2.51296L14 6M14 14H7C4.79086 14 3 12.2091 3 10V10C3 7.79086 4.79086 6 7 6H14"
                            stroke-width="1.5" />
                        <path
                            d="M7.75716 19.3001L7 14H11L11.6772 18.7401C11.8476 19.9329 10.922 21 9.71716 21C8.73186 21 7.8965 20.2755 7.75716 19.3001Z"
                            stroke-width="1.5" />
                    </svg>

                    <span class="link-name">Pre - Test</span>
                    <div class="icon-menu">
                        <i class="fa-solid fa-circle" style="color: lightgreen"></i>
                    </div>
                    <div class="icon-menu">
                        <i class="fa-solid fa-check" style="color: green"></i>
                    </div>
                </a>
            </li>

            <li class="{{routeActive('report.index')}}">
                <a href="{{ route('report.index') }}">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 12L17 12" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M7 8L13 8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M3 20.2895V5C3 3.89543 3.89543 3 5 3H19C20.1046 3 21 3.89543 21 5V15C21 16.1046 20.1046 17 19 17H7.96125C7.35368 17 6.77906 17.2762 6.39951 17.7506L4.06852 20.6643C3.71421 21.1072 3 20.8567 3 20.2895Z"
                            stroke-width="1.5" />
                    </svg>

                    <span class="link-name">Post - Test</span>
                    <div class="icon-menu">
                        <i class="fa-solid fa-ban" style="color: red"></i>
                    </div>
                </a>
            </li>

            <li class="{{routeActive('report.index')}}">
                <a href="{{ route('report.index') }}">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 19V5C4 3.89543 4.89543 3 6 3H19.4C19.7314 3 20 3.26863 20 3.6V16.7143"
                            stroke-width="1.5" stroke-linecap="round" />
                        <path d="M10 14C10 14 10.9 10.8824 13 9" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M12.8022 12.4246L12.6677 12.4372C10.9758 12.5962 9.469 11.3542 9.30214 9.66304C9.13527 7.97193 10.3715 6.47214 12.0634 6.31317L15.049 6.03263C15.2406 6.01463 15.4111 6.15524 15.43 6.34669L15.6847 8.92762C15.8589 10.693 14.5683 12.2586 12.8022 12.4246Z"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M6 17L20 17" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M6 21L20 21" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M6 21C4.89543 21 4 20.1046 4 19C4 17.8954 4.89543 17 6 17" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <span class="link-name">Evaluasi</span>
                    <div class="icon-menu">
                        <i class="fa-solid fa-ban" style="color: red"></i>
                    </div>
                </a>
            </li>


            <?php $employee_ids = ['01220014', '01220023']; ?>
            @if (in_array(auth()->user()->employee_id, $employee_ids))
            <li class="{{routeActive('report.index')}}">
                <a href="{{ route('report.index') }}">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M14 14V6M14 14L20.1023 17.487C20.5023 17.7156 21 17.4268 21 16.9661V3.03391C21 2.57321 20.5023 2.28439 20.1023 2.51296L14 6M14 14H7C4.79086 14 3 12.2091 3 10V10C3 7.79086 4.79086 6 7 6H14"
                            stroke-width="1.5" />
                        <path
                            d="M7.75716 19.3001L7 14H11L11.6772 18.7401C11.8476 19.9329 10.922 21 9.71716 21C8.73186 21 7.8965 20.2755 7.75716 19.3001Z"
                            stroke-width="1.5" />
                    </svg>

                    <span class="link-name">Report</span>
                </a>
            </li>
            @endif

            {{-- <li class="mt-5">
                <a class="btn btn-block btn-danger" href="{{ route('logout') }}"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    LOGOUT
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            </li> --}}
        </ul>
    </div>
</nav>