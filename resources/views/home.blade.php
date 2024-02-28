@extends('layouts.master')

@section('title')
Dashboard
@endsection

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }


    @font-face {
        font-family: cjfont;
        src: url('{{ asset("font/cjfont.ttf")}}');
    }

    .nav-dash,
    .slider {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative;
        background-color: #ffffff;
        text-align: center;
        padding: 0 2em;
        height: 80vh;
    }

    .nav-dash h1,
    .slider h1 {
        font-family: cjfont;
        font-size: 2vw;
        margin: 0;
        padding-bottom: 0.5rem;
        letter-spacing: 0.5rem;
        color: #04302c;
        transition: all 0.3s ease;
        z-index: 3;
        margin-bottom: 20px
    }

    h1:hover {
        transform: translate3d(0, -10px, 22px);
        color: #ee141e;
    }

    .nav-dash h2,
    .slider h2 {
        font-size: 2vw;
        letter-spacing: 0.5rem;
        font-family: "ROBOTO", sans-serif;
        font-weight: 300;
        color: #ff9600;
        z-index: 4;
    }

    .nav-dash a {
        text-decoration: none;
        z-index: 10;
        background: #000;
        border: 1px solid transparent;
        color: #fff;
        font-size: 18px;
        padding: 10px 70px;
        border-radius: 10px;
        font-family: cjfont;
        transition: all 0.5s ease;
    }

    .nav-dash a:hover {
        background: transparent;
        border: 1px solid #000;
        color: #000;
    }

    .nav-dash-container {
        display: flex;
        flex-direction: row;
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 75px;
        box-shadow: 20px 20px 50px rgba(0, 0, 0, 0.5);
        background: #1e1f26;
        z-index: 10;
        transition: all 0.3s cubic-bezier(0.19, 1, 0.22, 1);
    }

    .nav-dash-container--top-first {
        position: fixed;
        top: 75px;
        transition: all 0.3s cubic-bezier(0.19, 1, 0.22, 1);
    }

    .nav-dash-container--top-second {
        position: fixed;
        top: 0;
    }

    .nav-dash-container--top-second {
        position: fixed;
        top: 0;
    }

    .nav-dash-tab {
        display: flex;
        justify-content: center;
        align-items: center;
        flex: 1;
        color: #03dac6;
        letter-spacing: 0.1rem;
        transition: all 0.5s ease;
        font-size: 2vw;
    }

    .nav-dash-tab:hover {
        color: #1e1f26;
        background: #03dac6;
        transition: all 0.5s ease;
    }

    .nav-dash-tab-slider {
        position: absolute;
        bottom: 0;
        width: 0;
        height: 5px;
        background: #03dac6;
        transition: left 0.3s ease;
    }

    .background {
        position: absolute;
        height: 100vh;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: auto;
    }

    @media (max-width: 800px) {

        .nav-dash h1,
        .slider h1 {
            font-size: 20px;
            margin-top: 30px;
            line-height: 35px
        }

        .nav-dash h2,
        .slider h2 {
            font-size: 3vw;
        }

        .nav-dash-tab {
            font-size: 3vw;
        }
    }

    @media screen only (min-width: 360px) {


        .nav-dash h2,
        .slider h2 {
            font-size: 2vw;
            letter-spacing: 0.2vw;
        }

        .nav-dash-tab {
            font-size: 1.2vw;
        }
    }

    .background {
        position: absolute;
        height: 100vh;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 0;
    }
</style>

@section('content')
<div class="main-content">
    <section class="nav-dash">
        @include('sweetalert::alert')
        <center>
            <img src="{{ asset('img/logo.png') }}" style="width: 100%; object-fit: cover;z-index: 100">
        </center>
        <h1>
            WELCOME, <br><br> {{ Auth::user()->name }}
        </h1>
    </section>
</div>
@endsection