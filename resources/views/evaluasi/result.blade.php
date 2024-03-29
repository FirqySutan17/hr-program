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
    <p>NPK <br> <strong>{{ Auth::user()->employee_id}}</strong> </p>
    <P>NAMA <br> <strong>{{ Auth::user()->name }}</strong> </P>

    <?php $jawaban_user = json_decode($ujian_user->json_jawaban); ?>
    @foreach ($soal_data as $data)
    <div class="content-task">
        <div class="form-group _form-group" style="display: flex; width: 100%; margin-top: 20px">
            <label for="trainer" style="width: 10%; padding-top: 10px">
                TRAINER <span style="color: red">*</span>
            </label>
            <input id="trainer" name="trainer" type="text" value="{{ $ujian_user->trainer }}"
                style="text-transform:capitalize; width: 90%" class="form-control" placeholder="Nama trainer.." required
                readonly />
        </div>
        <h3 class="sub-title">BAG : {{ strtoupper($data['nama']) }}</h3>
        @foreach ($data['data'] as $soal)
        <?php 
            $key = array_search($soal['soal']->id, array_column($jawaban_user, 'soal_id'));
            $jawab = $jawaban_user[$key];
        ?>
        <div class="qna">
            <h5 class="question">
                {{ $loop->iteration }}. {{ $soal['soal']->soal }}
            </h5>
            @if ($soal['soal']->type == 1)
            <div class="answer">
                <textarea cols="5" rows="10" class="form-control" style="padding: 20px"
                    readonly>{{ $jawab->jawaban_id }}</textarea>
            </div>
            @else
            @foreach ($soal['jawaban'] as $jawaban)
            <div class="answer">
                <input type="radio" value="{{ $jawaban->id }}" disabled {{ $jawaban->id == $jawab->jawaban_id ?
                'checked' : '' }} >
                <label for="{{ $jawaban->id }}">{{ $jawaban->jawaban }}</label>
                <br>
            </div>
            @endforeach
            @endif
        </div>
        @endforeach
    </div>
    @endforeach
</div>
@endsection