<div class="wrap-setting">
    <div class="menu-follup">
        <div class="userHeader" style="padding: 0px; margin-bottom: 20px">
            <div class="box" style="grid-column: span 1">
                <img class="setting-img" src="{{ asset('img/user.png') }}" alt="">
            </div>
            <div class="box" style="margin: auto; grid-column: span 5; margin-left: -5px">
                <h2 style="margin-bottom: 0px">Anita Sari</h2>
                <div class="icons" style="margin-bottom: 5px">
                    anita@gmail.com
                </div>
            </div>
        </div>

        <a class="{{routeActive('setting.index')}}" href="{{route('setting.index')}}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 18V17C7 14.2386 9.23858 12 12 12V12C14.7614 12 17 14.2386 17 17V18" stroke-width="1.5"
                    stroke-linecap="round" />
                <path
                    d="M12 12C13.6569 12 15 10.6569 15 9C15 7.34315 13.6569 6 12 6C10.3431 6 9 7.34315 9 9C9 10.6569 10.3431 12 12 12Z"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <circle cx="12" cy="12" r="10" stroke-width="1.5" />
            </svg>

            Profile
        </a>
        <a class="{{routeActive('setting.company')}}" href="{{route('setting.company')}}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 9.01L7.01 8.99889" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M11 9.01L11.01 8.99889" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M7 13.01L7.01 12.9989" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M11 13.01L11.01 12.9989" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M7 17.01L7.01 16.9989" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M11 17.01L11.01 16.9989" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path
                    d="M15 21H3.6C3.26863 21 3 20.7314 3 20.4V5.6C3 5.26863 3.26863 5 3.6 5H9V3.6C9 3.26863 9.26863 3 9.6 3H14.4C14.7314 3 15 3.26863 15 3.6V9M15 21H20.4C20.7314 21 21 20.7314 21 20.4V9.6C21 9.26863 20.7314 9 20.4 9H15M15 21V17M15 9V13M15 13H17M15 13V17M15 17H17"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Company
        </a>
        <a class="{{routeActive('setting.tag')}}" href="{{route('setting.tag')}}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M3 17.4V6.6C3 6.26863 3.26863 6 3.6 6H16.6789C16.8795 6 17.0668 6.10026 17.1781 6.26718L20.7781 11.6672C20.9125 11.8687 20.9125 12.1313 20.7781 12.3328L17.1781 17.7328C17.0668 17.8997 16.8795 18 16.6789 18H3.6C3.26863 18 3 17.7314 3 17.4Z"
                    stroke-width="1.5" />
            </svg>
            Tags
        </a>
        <a class="{{routeActive(['setting.subscription', 'setting.checkout', 'setting.invoice'])}}"
            href="{{route('setting.subscription')}}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M14.2718 10.445L18 2M9.31612 10.6323L5 2M12.7615 10.0479L8.835 2M14.36 2L13.32 4.5M6 16C6 19.3137 8.68629 22 12 22C15.3137 22 18 19.3137 18 16C18 12.6863 15.3137 10 12 10C8.68629 10 6 12.6863 6 16Z"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Subscription
        </a>
        <a class="{{routeActive('setting.integration')}}" href="{{route('setting.integration')}}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M17 7C18.1046 7 19 6.10457 19 5C19 3.89543 18.1046 3 17 3C15.8954 3 15 3.89543 15 5C15 6.10457 15.8954 7 17 7Z"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path
                    d="M7 7C8.10457 7 9 6.10457 9 5C9 3.89543 8.10457 3 7 3C5.89543 3 5 3.89543 5 5C5 6.10457 5.89543 7 7 7Z"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path
                    d="M7 21C8.10457 21 9 20.1046 9 19C9 17.8954 8.10457 17 7 17C5.89543 17 5 17.8954 5 19C5 20.1046 5.89543 21 7 21Z"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M7 7V17" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M17 7V8C17 10.5 15 11 15 11L9 13C9 13 7 13.5 7 16V17" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            Integration
        </a>
    </div>
</div>