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

        </ul>
    </div>
</nav>