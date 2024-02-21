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
            <li class="{{routeActive(['home', 'mapping', 'placement.index'])}}">
                <a href="{{ route('home') }}">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M19.6224 10.3954L18.5247 7.7448L20 6L18 4L16.2647 5.48295L13.5578 4.36974L12.9353 2H10.981L10.3491 4.40113L7.70441 5.51596L6 4L4 6L5.45337 7.78885L4.3725 10.4463L2 11V13L4.40111 13.6555L5.51575 16.2997L4 18L6 20L7.79116 18.5403L10.397 19.6123L11 22H13L13.6045 19.6132L16.2551 18.5155C16.6969 18.8313 18 20 18 20L20 18L18.5159 16.2494L19.6139 13.598L21.9999 12.9772L22 11L19.6224 10.3954Z"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <span class="link-name">Placement</span>
                </a>
            </li>

            <li class="{{routeActive(['stockbalance', 'detailbalance', 'mappingcs'])}} dropdown">
                <a href="javascript:void(0)">
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


                    <span class="link-name">Report</span>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"
                        width="14" height="14" version="1.1" id="Layer_1" viewBox="0 0 330 330" xml:space="preserve"
                        style="position: absolute; right: 5px;
                        top: 20px;">
                        <path id="XMLID_225_"
                            d="M325.607,79.393c-5.857-5.857-15.355-5.858-21.213,0.001l-139.39,139.393L25.607,79.393  c-5.857-5.857-15.355-5.858-21.213,0.001c-5.858,5.858-5.858,15.355,0,21.213l150.004,150c2.813,2.813,6.628,4.393,10.606,4.393  s7.794-1.581,10.606-4.394l149.996-150C331.465,94.749,331.465,85.251,325.607,79.393z" />
                    </svg>
                </a>
                <ul class="nav-submenu menu-content">
                    <li>
                        <a href="{{ route('stockbalance') }}" class="{{routeActive(['stockbalance'])}}">
                            Stock Balance
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('detailbalance') }}" class="{{routeActive(['detailbalance'])}}">
                            Detail Balance
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mappingcs') }}" class="{{routeActive(['mappingcs'])}}">
                            Mapping Cold Storage
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</nav>