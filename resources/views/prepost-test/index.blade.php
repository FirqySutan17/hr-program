@extends('layouts.master')

@section('title')
Pre - Post Test
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

    .qna {
        margin-bottom: 20px
    }

    .qna label {
        font-weight: 500 !important;
    }

    .answer {
        margin-top: 10px
    }

    input {
        display: inline-block;
        vertical-align: middle;
        margin-top: 2px !important;
        margin-right: 8px !important;
    }

    .question {
        font-size: 17px;
        font-weight: 600
    }

    h3.sub-title {
        font-size: 20px;
        font-weight: 700;
        text-decoration: none;
        margin-top: 20px;
        margin-bottom: 20px
    }

    .box-att {
        background: #007bff;
        color: #fff;
        padding: 20px;
        border-radius: 10px
    }

    .divi-delayed-button-2 {
        text-align: center;
        padding: 15px;
        font-weight: 800;
        font-size: 18px;
        border: none;
        /* border-top-right-radius: 10px; */
        background: #007bff;
        color: #fff;
        border-radius: 8px;
        margin-bottom: 20px
    }

    .divi-delayed-button-2:hover {
        background: #58a9ff
    }

    .content-task {
        border-top: 1px solid #000;
        border-bottom: 1px solid #000;
        margin-bottom: 20px
    }

    .answer {
        margin-left: 25px;
        display: flex;
        justify-content: left;
        align-content: center;
    }

    [type="checkbox"],
    [type="radio"] {
        width: 15px !important;
    }

    @media(max-width: 600px) {
        .answer {
            margin-left: 0px
        }

        input {
            margin-right: 10px !important
        }

        [type="checkbox"],
        [type="radio"] {
            width: 30px !important;
        }

        .question {
            line-height: 25px;
            font-size: 18px
        }
    }
</style>

@section('content')
<div class="main-content pre-posttest">
    <h3 class="card-title">
        HR Program - {{ $ujian->nama }}
    </h3>
    <h4>{{ $ujian->desc }}</h4>
    <h5 style="font-size: 14px; padding: 10px 0px 20px 0px; text-align: left;font-style: italic; font-weight: 600">*Note
        :
        Pilih opsi yang benar untuk setiap pertanyaan dan tulis huruf yang sesuai pada lembar jawaban Anda.</h5>

    <form action="{{ route('prepost.store') }}" method="POST">
        @csrf
        <input type="hidden" name="ujian" value="{{ $ujian->id }}">
        <input type="hidden" name="start_date" value="{{ $start_date }}">
        @foreach ($soal_data as $data)
        <div class="content-task">
            <h3 class="sub-title">BAG : {{ strtoupper($data['nama']) }}</h3>
            @foreach ($data['data'] as $soal)
            <div class="qna">
                <h5 class="question">
                    {{ $loop->iteration }}. {{ $soal['soal']->soal }}
                </h5>
                <input type="hidden" name="soal[]" value="{{ $soal['soal']->id.'-'.$soal['soal']->jawaban_id }}">
                @foreach ($soal['jawaban'] as $jawaban)
                <div class="answer">
                    <input type="radio" id="{{ $jawaban->id }}" name="jawaban[{{ $jawaban->soal_id }}]"
                        value="{{ $jawaban->id }}" required>
                    <label for="{{ $jawaban->id }}">{{ $jawaban->jawaban }}</label>
                    <br>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
        @endforeach

        <button type="submit" class="divi-delayed-button-2" style="width:100%">SUBMIT</button>
    </form>
</div>
@endsection