@extends('layouts.master')

@section('title')
Result | Pre - Post Test
@endsection

<style>
    .pre-posttest h3 {
        font-weight: 700;
        text-decoration: underline
    }

    .pre-posttest h4 {
        font-weight: 500;
        font-style: italic
    }

    .modal-bullet .modal-body {
        padding: 0px !important
    }

    .modal-bullet .card-body {
        padding: 0px !important
    }

    .modal-bullet .card {
        padding: 0px !important;
        margin: 0px !important;
    }

    .modal-bullet p {
        margin: 0px !important;
        padding: 0px !important
    }

    .carousel-indicators li {
        background-color: #000;
    }

    .result-view {
        box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
        padding: 70px 20px;
        border-radius: 10px;
        margin-top: 30px;
        margin-bottom: 30px
    }

    .result-view p {
        font-size: 20px;
        text-align: center
    }

    h1.poin {
        font-size: 56px;
        font-weight: 800
    }

    .divi-delayed-button-2 {
        float: right;
        margin-top: 20px;
        padding: 15px;
        font-weight: 800;
        font-size: 26px;
        border: none;
        /* border-top-right-radius: 10px; */
        background: #007bff;
        color: #fff;
    }

    .divi-delayed-button-2:hover {
        background: #58a9ff
    }
</style>

@section('content')
<div class="main-content pre-posttest">
    @include('sweetalert::alert')
    <h3 class="card-title">
        HR Program - RESULT
    </h3>
    <h4>Soft Skill (Leadership, Communication, dan Team Work)</h4>

    <div class="result-view" style="display: flex;
                                align-items: center;
                                justify-content: center;
                                flex-direction: column;">
        <p>NPK <br> <strong>{{ Auth::user()->employee_id}}</strong> </p>
        <P>NAMA <br> <strong>{{ Auth::user()->name }}</strong> </P>
        <h1 class="poin">{{ $ujian_user->score }}</h1>
        <p>POINTS</p>
        {{-- <br> --}}
        {{-- <p>BENAR : 15</p>
        <p>SALAH : 0</p> --}}

        {{-- @if ($result->score >= '80')
        <a style="text-align: center" href="{{url('portal/cj-kepatuhan/training')}}" class="divi-delayed-button-2">BACK
            TO MENU</a>
        @else
        <a style="text-align: center" href="{{url('portal/cj-kepatuhan/training/pus-posttest')}}"
            class="divi-delayed-button-2">TEST AGAIN</a>
        @endif --}}

        {{-- <a style="text-align: center" href="{{ route('prepost.index')}}" class="divi-delayed-button-2">BACK
            TO MENU</a> --}}
    </div>
</div>
@endsection