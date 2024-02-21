@extends('layouts.master')

@section('title')
Dashboard
@endsection

@section('content')
<div class="main-content">
    <div class="tab-settings">
        <div class="tab-left">
            {{-- <button class="filter-btn menu-style">
                Filter
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 6H21" stroke="black" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M7 12L17 12" stroke="black" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M11 18L13 18" stroke="black" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>

            </button> --}}
        </div>
        <div class="tab-right">

            <form role="search" id="form">
                <input type="search" id="query" name="q" placeholder="Search history.."
                    aria-label="Search through site content">
                <button class="search-btn">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 17L21 21" stroke="black" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M3 11C3 15.4183 6.58172 19 11 19C13.213 19 15.2161 18.1015 16.6644 16.6493C18.1077 15.2022 19 13.2053 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11Z"
                            stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                </button>
            </form>
        </div>

    </div>

    <div class="table-content table-responsive">
        <table class="table table-width">
            <thead>
                <tr>
                    <th scope="col">Subscriber</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone number</th>
                    <th scope="col">Subscribe up to</th>
                    <th scope="col">Last package</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row" class="name-cus">
                        <img class="img-fluid avatar-style custo-img" src="{{ asset('icon/avatar.png') }}" alt="">
                        &nbsp;
                        Anita Sari
                    </th>
                    <td>anita@gmail.com</td>
                    <td>082284789876</td>
                    <td>Mar 20, 2023</td>
                    <td>Business</td>
                    <td>
                        <div class="dropdown-dot">
                            <i onclick="dotDetail()" class="fa-solid fa-ellipsis dropbtn-dot "></i>
                            <div id="myDropdownDot" class="dropdown-content-dot">
                                <button id="detailSubs" data-bs-toggle="modal" data-bs-target="#subDetail">
                                    Detail subscriber
                                </button>
                                <button style="color: #DB1020" id="susSubs" data-bs-toggle="modal"
                                    data-bs-target="#subSus">
                                    Suspend
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th scope="row" class="name-cus">
                        <img class="img-fluid avatar-style custo-img" src="{{ asset('icon/avatar.png') }}" alt="">
                        &nbsp;
                        Bayu Pramudita
                    </th>
                    <td>bayu@gmail.com</td>
                    <td>082284789876</td>
                    <td>Mar 20, 2023</td>
                    <td>Professional</td>
                    <td>
                        <div class="dropdown-dot">
                            <i onclick="dotDetail()" class="fa-solid fa-ellipsis dropbtn-dot "></i>
                            <div id="myDropdownDot" class="dropdown-content-dot">

                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th scope="row" class="name-cus">
                        <img class="img-fluid avatar-style custo-img" src="{{ asset('icon/avatar.png') }}" alt="">
                        &nbsp;
                        Anisa Dewi
                    </th>
                    <td>anisa@gmail.com</td>
                    <td>082284789876</td>
                    <td>Mar 20, 2023</td>
                    <td>Personal</td>
                    <td>
                        <div class="dropdown-dot">
                            <i onclick="dotDetail()" class="fa-solid fa-ellipsis dropbtn-dot "></i>
                            <div id="myDropdownDot" class="dropdown-content-dot">

                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection