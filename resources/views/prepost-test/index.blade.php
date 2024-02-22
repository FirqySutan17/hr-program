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
        margin-top: -3px !important;
        margin-right: 5px !important;
    }

    .question {
        font-size: 17px;
        font-weight: 600
    }

    h3.sub-title {
        font-size: 20px;
        font-weight: 600;
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
</style>

@section('content')
<div class="main-content pre-posttest">
    <h3 class="card-title">
        HR Program - PRE/POST TEST
    </h3>
    <h4>Soft Skill (Leadership, Communication, dan Team Work)</h4>
    <h5 style="font-size: 14px; padding: 10px 0px 20px 0px; text-align: left;font-style: italic; font-weight: 600">*Note
        :
        Pilih opsi yang benar untuk setiap pertanyaan dan tulis huruf yang sesuai pada lembar jawaban Anda.</h5>

    <div class="content-task">
        <h3 class="sub-title">BAG : LEADERSHIP</h3>
        <div class="qna">
            <h5 class="question">
                1. Apa yang dimaksud dengan kepemimpinan?
            </h5>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11a" name="leadership[1a]"
                    value="Tindakan mengelola orang dan sumber daya dalam suatu organisasi" required>
                <label for="11a">Tindakan mengelola orang dan sumber daya dalam suatu organisasi</label>
                <br>
            </div>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11b" name="leadership[1b]"
                    value="Kemampuan untuk mempengaruhi dan membimbing orang lain untuk mencapai tujuan bersama"
                    required>
                <label for="11b">Kemampuan untuk mempengaruhi dan membimbing orang lain untuk mencapai tujuan
                    bersama</label>
                <br>
            </div>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11c" name="leadership[1c]"
                    value="Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim" required>
                <label for="11c">Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim</label>
                <br>
            </div>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11d" name="leadership[1d]"
                    value="Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim" required>
                <label for="11d">Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim</label>
                <br>
            </div>
        </div>
        <div class="qna">
            <h5 class="question">
                2. Apa yang dimaksud dengan kepemimpinan?
            </h5>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11a" name="leadership[1a]"
                    value="Tindakan mengelola orang dan sumber daya dalam suatu organisasi" required>
                <label for="11a">Tindakan mengelola orang dan sumber daya dalam suatu organisasi</label>
                <br>
            </div>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11b" name="leadership[1b]"
                    value="Kemampuan untuk mempengaruhi dan membimbing orang lain untuk mencapai tujuan bersama"
                    required>
                <label for="11b">Kemampuan untuk mempengaruhi dan membimbing orang lain untuk mencapai tujuan
                    bersama</label>
                <br>
            </div>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11c" name="leadership[1c]"
                    value="Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim" required>
                <label for="11c">Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim</label>
                <br>
            </div>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11d" name="leadership[1d]"
                    value="Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim" required>
                <label for="11d">Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim</label>
                <br>
            </div>
        </div>
        <div class="qna">
            <h5 class="question">
                3. Apa yang dimaksud dengan kepemimpinan?
            </h5>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11a" name="leadership[1a]"
                    value="Tindakan mengelola orang dan sumber daya dalam suatu organisasi" required>
                <label for="11a">Tindakan mengelola orang dan sumber daya dalam suatu organisasi</label>
                <br>
            </div>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11b" name="leadership[1b]"
                    value="Kemampuan untuk mempengaruhi dan membimbing orang lain untuk mencapai tujuan bersama"
                    required>
                <label for="11b">Kemampuan untuk mempengaruhi dan membimbing orang lain untuk mencapai tujuan
                    bersama</label>
                <br>
            </div>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11c" name="leadership[1c]"
                    value="Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim" required>
                <label for="11c">Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim</label>
                <br>
            </div>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11d" name="leadership[1d]"
                    value="Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim" required>
                <label for="11d">Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim</label>
                <br>
            </div>
        </div>
    </div>

    <div class="content-task">
        <h3 class="sub-title">BAG : COMMUNICATION</h3>
        <div class="qna">
            <h5 class="question">
                1. Apa yang dimaksud dengan kepemimpinan?
            </h5>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11a" name="leadership[1a]"
                    value="Tindakan mengelola orang dan sumber daya dalam suatu organisasi" required>
                <label for="11a">Tindakan mengelola orang dan sumber daya dalam suatu organisasi</label>
                <br>
            </div>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11b" name="leadership[1b]"
                    value="Kemampuan untuk mempengaruhi dan membimbing orang lain untuk mencapai tujuan bersama"
                    required>
                <label for="11b">Kemampuan untuk mempengaruhi dan membimbing orang lain untuk mencapai tujuan
                    bersama</label>
                <br>
            </div>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11c" name="leadership[1c]"
                    value="Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim" required>
                <label for="11c">Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim</label>
                <br>
            </div>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11d" name="leadership[1d]"
                    value="Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim" required>
                <label for="11d">Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim</label>
                <br>
            </div>
        </div>
        <div class="qna">
            <h5 class="question">
                2. Apa yang dimaksud dengan kepemimpinan?
            </h5>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11a" name="leadership[1a]"
                    value="Tindakan mengelola orang dan sumber daya dalam suatu organisasi" required>
                <label for="11a">Tindakan mengelola orang dan sumber daya dalam suatu organisasi</label>
                <br>
            </div>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11b" name="leadership[1b]"
                    value="Kemampuan untuk mempengaruhi dan membimbing orang lain untuk mencapai tujuan bersama"
                    required>
                <label for="11b">Kemampuan untuk mempengaruhi dan membimbing orang lain untuk mencapai tujuan
                    bersama</label>
                <br>
            </div>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11c" name="leadership[1c]"
                    value="Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim" required>
                <label for="11c">Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim</label>
                <br>
            </div>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11d" name="leadership[1d]"
                    value="Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim" required>
                <label for="11d">Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim</label>
                <br>
            </div>
        </div>
        <div class="qna">
            <h5 class="question">
                3. Apa yang dimaksud dengan kepemimpinan?
            </h5>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11a" name="leadership[1a]"
                    value="Tindakan mengelola orang dan sumber daya dalam suatu organisasi" required>
                <label for="11a">Tindakan mengelola orang dan sumber daya dalam suatu organisasi</label>
                <br>
            </div>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11b" name="leadership[1b]"
                    value="Kemampuan untuk mempengaruhi dan membimbing orang lain untuk mencapai tujuan bersama"
                    required>
                <label for="11b">Kemampuan untuk mempengaruhi dan membimbing orang lain untuk mencapai tujuan
                    bersama</label>
                <br>
            </div>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11c" name="leadership[1c]"
                    value="Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim" required>
                <label for="11c">Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim</label>
                <br>
            </div>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11d" name="leadership[1d]"
                    value="Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim" required>
                <label for="11d">Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim</label>
                <br>
            </div>
        </div>
    </div>

    <div class="content-task">
        <h3 class="sub-title">BAG : TEAM WORK</h3>
        <div class="qna">
            <h5 class="question">
                1. Apa yang dimaksud dengan kepemimpinan?
            </h5>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11a" name="leadership[1a]"
                    value="Tindakan mengelola orang dan sumber daya dalam suatu organisasi" required>
                <label for="11a">Tindakan mengelola orang dan sumber daya dalam suatu organisasi</label>
                <br>
            </div>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11b" name="leadership[1b]"
                    value="Kemampuan untuk mempengaruhi dan membimbing orang lain untuk mencapai tujuan bersama"
                    required>
                <label for="11b">Kemampuan untuk mempengaruhi dan membimbing orang lain untuk mencapai tujuan
                    bersama</label>
                <br>
            </div>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11c" name="leadership[1c]"
                    value="Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim" required>
                <label for="11c">Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim</label>
                <br>
            </div>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11d" name="leadership[1d]"
                    value="Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim" required>
                <label for="11d">Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim</label>
                <br>
            </div>
        </div>
        <div class="qna">
            <h5 class="question">
                2. Apa yang dimaksud dengan kepemimpinan?
            </h5>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11a" name="leadership[1a]"
                    value="Tindakan mengelola orang dan sumber daya dalam suatu organisasi" required>
                <label for="11a">Tindakan mengelola orang dan sumber daya dalam suatu organisasi</label>
                <br>
            </div>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11b" name="leadership[1b]"
                    value="Kemampuan untuk mempengaruhi dan membimbing orang lain untuk mencapai tujuan bersama"
                    required>
                <label for="11b">Kemampuan untuk mempengaruhi dan membimbing orang lain untuk mencapai tujuan
                    bersama</label>
                <br>
            </div>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11c" name="leadership[1c]"
                    value="Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim" required>
                <label for="11c">Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim</label>
                <br>
            </div>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11d" name="leadership[1d]"
                    value="Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim" required>
                <label for="11d">Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim</label>
                <br>
            </div>
        </div>
        <div class="qna">
            <h5 class="question">
                3. Apa yang dimaksud dengan kepemimpinan?
            </h5>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11a" name="leadership[1a]"
                    value="Tindakan mengelola orang dan sumber daya dalam suatu organisasi" required>
                <label for="11a">Tindakan mengelola orang dan sumber daya dalam suatu organisasi</label>
                <br>
            </div>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11b" name="leadership[1b]"
                    value="Kemampuan untuk mempengaruhi dan membimbing orang lain untuk mencapai tujuan bersama"
                    required>
                <label for="11b">Kemampuan untuk mempengaruhi dan membimbing orang lain untuk mencapai tujuan
                    bersama</label>
                <br>
            </div>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11c" name="leadership[1c]"
                    value="Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim" required>
                <label for="11c">Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim</label>
                <br>
            </div>
            <div class="answer" style="margin-left: 25px">
                <input type="radio" id="11d" name="leadership[1d]"
                    value="Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim" required>
                <label for="11d">Proses pengambilan keputusan dan pemecahan masalah dalam sebuah tim</label>
                <br>
            </div>
        </div>
    </div>

    <button type="submit" class="divi-delayed-button-2" style="width:100%">SUBMIT POST
        TEST PUS</button>
</div>
@endsection