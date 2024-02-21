@extends('layouts.master')

@section('title')
Report - Mapping CS
@endsection

@push('css-external')
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/display.css') }}">
<link rel="stylesheet" href="{{ asset('css/w3.css') }}">

<style>
    .select2-container--bootstrap4 .select2-selection--single .select2-selection__rendered {
        padding: 5px 0px;
        padding-left: 0rem;
    }

    .select2-container--bootstrap4 .select2-selection--single {
        height: 43px !important;
    }

    .select2-hidden-accessible {
        width: 100% !important;
    }

    .select2-container {
        width: 100% !important;
        text-align: center
    }

    .placement-item {
        height: 130px;
        overflow-y: auto;
        padding: 0px 20px;
    }

    .placement-item input[type="radio"],
    .placement-item input[type="checkbox"] {
        cursor: pointer;
        outline-style: none;
        position: relative;
        -webkit-appearance: none;
        height: 20px;
        width: 20px;
        margin-bottom: -0.25em;
        margin-right: 5px;
        vertical-align: top;
    }

    th,
    td {
        font-size: 13px !important;
        padding: 0px 15px;
    }

    th {
        font-weight: 600 !important;
        height: 40px !important;
        background: #e9ecef !important;
    }

    td {
        height: 40px !important;
    }

    .placement-item input[type="checkbox"] {
        background-color: #fff;
        border: 1px solid #e8e8e8;
        border-radius: 4px;
        color: #484848;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
    }

    .placement-item input[type="radio"] {
        background-color: #fff;
        border: 1px solid #e8e8e8;
        border-radius: 50px;
        color: #484848;
        outline-style: none;
        -webkit-border-radius: 50px;
        -moz-border-radius: 50px;
    }

    .detail-box ._form-group {
        margin-bottom: 15px;
    }

    .placement-item input[type="checkbox"]:checked:after,
    .placement-item input[type="radio"]:checked:after {
        background: #4a8cff;
        border: solid 1px #4a8cff;
        color: #ffffff;
        font-weight: bold;
        position: absolute;
        text-align: center;
        top: 0;
        right: 0;
        width: 100%;
        height: 100%;

    }

    .placement-item input[type="checkbox"]:checked:after {
        border-radius: 4px;
        content: "\2713";
        font-size: 0.7em;
        line-height: 1.5;
    }

    .placement-item input[type="radio"]:checked:after {
        border-radius: 50px;
        content: "lens";
        font-size: 0.34em;
        line-height: 2.3;
    }

    .placement-item input[type="radio"]:disabled,
    .placement-item input[type="checkbox"]:disabled {
        background: #F2F6F9;
        border: solid 1px #e8e8e8;
        pointer-events: none;
    }

    .placement-item input[type="radio"]:disabled:checked:after,
    .placement-item input[type="checkbox"]:disabled:checked:after {
        color: #cdd3d9;
        background: #f2f6f9;
        border: solid 1px #e8e8e8;
    }

    .placement-item .Checkbox-parent {
        border-top: solid 1px #e8e8e8;
        margin-top: 16px;
        padding-top: 16px;
        height: 40px;
    }

    .placement-item .Checkbox-child {
        margin-bottom: 8px;
    }

    .placement-item ul {
        list-style: none;
        padding-left: 30px !important;
        margin-top: 20px !important;
    }

    .placement-item .Checkbox-child li {
        margin-bottom: 15px;
        font-size: 13px
    }

    label.place-detail {
        margin-bottom: 5px !important;
        font-size: 14px
    }

    /* Accordion */

    .placement-item .Accordion:after {
        content: '\002B';
        color: #4f5766;
        font-weight: bold;
        float: right;
        margin-left: 5px;
    }

    .placement-item .Accordion--active:after {
        content: "\2212";
        color: #4f5766;
    }

    .placement-item .Accordion-panel {
        background-color: white;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.2s ease-out;
    }

    .placement-item .Accordion-panel:last-of-type {
        border-bottom: solid 1px #e8e8e8;
        padding-bottom: 16px;
    }

    .seat label:hover {
        background-color: yellow !important;
        color: #000 !important
    }

    @media(max-width: 940px) {
        .placement-item {
            height: auto;
        }
    }
</style>

<style type="text/css">
    #example1 tr:hover {
        background-color: #FFFFAA;
    }

    #example1 tr.selected td {
        background: none repeat scroll 0 0 #FFCF8B;
        color: #000000;
    }

    .wrap-cs {
        border-radius: 10px;
        background: #3c8dbc;
        border: 4px solid #000;
        margin: 0px 0px;
    }

    .wrap-cs h2 {
        text-align: center;
        font-weight: 700;
        color: #fff;
        font-size: 24px
    }

    .row {
        margin-right: 0px;
        margin-left: 0px;
    }

    .exit div:nth-child(2) {
        flex: 0 1 5%;
        background: #3c8dbc;
    }

    .seat {
        height: 80px;
        flex: 1 1 21%;
        padding: 0px
    }

    .seat:nth-child(2) {
        margin-right: 0;
        border-right: 3px solid #fff;
        padding-right: 5px;
    }

    .seat:nth-child(3) {
        padding-left: 5px;
    }

    .seat label {
        border-radius: 0px;
        border: 1px solid #ffffff87;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        flex-wrap: nowrap;
        align-content: center;
    }

    .seat label::before {
        border-radius: 0px;
        background: none;
    }

    .seat label:hover {
        box-shadow: none;
        /* background: #ffffff9e !important; */
        border: 1px solid #fff
    }

    .status-cs {
        margin-top: 5px;
        font-size: 10px
    }

    .bg-green {
        background-color: #00a65a !important;
    }

    .box-header {
        background: #3c8dbc;
        border: 4px solid #000;
        border-radius: 10px 10px 0px 0px;
        padding: 15px 0px;
    }

    .box-title {
        font-size: 24px;
        font-weight: 700;
        text-transform: uppercase;
        color: #fff
    }

    #CS-2,
    #CS-3 {
        display: none
    }

    .x-rack {
        background: #fff;
        color: #000;
        font-weight: 700;
        padding: 0px 20px;
        border: none;
    }
</style>

<style>
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 100;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
        -webkit-animation-name: fadeIn;
        /* Fade in the background */
        -webkit-animation-duration: 0.4s;
        animation-name: fadeIn;
        animation-duration: 0.4s
    }

    /* Modal Content */
    .modal-content {
        position: fixed;
        bottom: 0;
        background-color: #fefefe;
        width: 100%;
        -webkit-animation-name: slideIn;
        -webkit-animation-duration: 0.4s;
        animation-name: slideIn;
        animation-duration: 0.4s;
        border-radius: 15px 15px 0px 0px !important;
    }

    /* The Close Button */
    .close {
        color: #000;
        float: right;
        margin-right: 10px;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    /* The Close Button */
    .close-x {
        color: #000;
        float: right;
        margin-right: 10px;
        font-size: 28px;
        font-weight: bold;
    }

    .close-x:hover,
    .close-x:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-header {
        padding: 2px 16px;
        background-color: #5cb85c;
        color: white;
    }

    .modal-body {
        padding: 2px 16px;
    }

    .modal-footer {
        padding: 2px 16px;
        background-color: #5cb85c;
        color: white;
    }

    /* Add Animation */
    @-webkit-keyframes slideIn {
        from {
            bottom: -300px;
            opacity: 0
        }

        to {
            bottom: 0;
            opacity: 1
        }
    }

    @keyframes slideIn {
        from {
            bottom: -300px;
            opacity: 0
        }

        to {
            bottom: 0;
            opacity: 1
        }
    }

    @-webkit-keyframes fadeIn {
        from {
            opacity: 0
        }

        to {
            opacity: 1
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0
        }

        to {
            opacity: 1
        }
    }

    .title-transdet {
        margin: 0px;
        border-bottom: 1px solid #0f172a;
        padding: 20px 0px;
        border-radius: 10px;
        padding-left: 15px;
        margin-bottom: 20px;
    }

    h5.place-detail {
        margin-bottom: 5px !important;
        font-size: 14px;
        font-weight: 500
    }
</style>
@endpush

@section('content')
<div class="main-content">
    <div class="wrapper">
        <div class="content-wrapper" style="margin-left: 0px">
            <div class="container-fluid" style="padding: 0">
                <div class="box box-primary box-solid">
                    <div class="box-header with-border">
                        <center>
                            <h5 class="box-title">Mapping Cold Storage</h5>
                        </center>
                    </div>
                    <div class="w3-bar w3-black" style="border-radius: 0px 0px 10px 10px;">
                        <button class="w3-bar-item w3-button tablink w3-red" onclick="openCs(event,'CS-1')">CS
                            1</button>
                        <button class="w3-bar-item w3-button tablink" onclick="openCs(event,'CS-2')">CS 2</button>
                        <button class="w3-bar-item w3-button tablink" onclick="openCs(event,'CS-3')">CS 3</button>
                    </div>
                    <br>
                </div>
                <div class="row">
                    <?php foreach ($placement as $plc): ?>
                    <div id="CS-{{ $plc['NAME'] }}" class="col-md-12 wrap-cs storage" style="margin-bottom: 20px">
                        <h2>COLD STORAGE <br> {{ $plc['NAME'] }}</h2>
                        <div class="train">
                            <div class="exit front train-body">
                                <div>A</div>
                                <div><button id="myBtnx" class="x-rack" data-coldstorage="{{ $plc['NAME'] }}">X</button></div>
                                <div>B</div>
                            </div>
                            <ol class="wagon train-body">
                                <?php for ($i = 1; $i <= $plc['TOTAL_ROW']; $i++): ?>
                                <?php $no_rack = $i < 10 ? "0".$i : $i; ?>
                                <li class="row">
                                    <ol class="seats">
                                        <?php 
                                            $rackno     = "2".$plc['NAME']."Ab".$no_rack;
                                            $total_data = $coldStorageData[$plc['NAME']][$i]['Ab'];
                                            $bg_class   = "bg-green";
                                            $style      = "";
                                            if ($total_data > 0 && $total_data < 4) {
                                                $bg_class = "bg-warning";
                                            } elseif ($total_data >= 4) {
                                                $bg_class   = "bg-danger";
                                            }
                                        ?>
                                        <li id="openDetail" style="{{ $style }}" class="seat"
                                            data-rackno="{{ $rackno }}">
                                            <label class="{{ $bg_class }}">
                                                {{ $i }}b
                                                <br>
                                                {{ $total_data }}/4
                                            </label>
                                        </li>
                                        <?php 
                                            $rackno = "2".$plc['NAME']."Aa".$no_rack;
                                            $total_data = $coldStorageData[$plc['NAME']][$i]['Aa'];
                                            $bg_class   = "bg-green";
                                            $style      = "";
                                            if ($total_data > 0 && $total_data < 4) {
                                                $bg_class = "bg-warning";
                                            } elseif ($total_data >= 4) {
                                                $bg_class = "bg-danger";
                                            }
                                        ?>
                                        <li id="openDetail" style="{{ $style }}" class="seat"
                                            data-rackno="{{ $rackno }}">
                                            <label class="{{ $bg_class }}">
                                                {{ $i }}a
                                                <br>
                                                {{ $total_data }}/4
                                            </label>
                                        </li>
                                        <?php 
                                            $rackno = "2".$plc['NAME']."Ba".$no_rack;
                                            $total_data = $coldStorageData[$plc['NAME']][$i]['Ba'];
                                            $bg_class   = "bg-green";
                                            $style      = "";
                                            if ($total_data > 0 && $total_data < 4) {
                                                $bg_class = "bg-warning";
                                            } elseif ($total_data >= 4) {
                                                $bg_class = "bg-danger";
                                            }
                                        ?>
                                        <li id="openDetail" style="{{ $style }}" class="seat"
                                            data-rackno="{{ $rackno }}">
                                            <label class="{{ $bg_class }}">
                                                {{ $i }}a
                                                <br>
                                                {{ $total_data }}/4
                                            </label>
                                        </li>
                                        <?php 
                                            $rackno = "2".$plc['NAME']."Bb".$no_rack;
                                            $total_data = $coldStorageData[$plc['NAME']][$i]['Bb'];
                                            $bg_class   = "bg-green";
                                            $style      = "";
                                            if ($total_data > 0 && $total_data < 4) {
                                                $bg_class = "bg-warning";
                                            } elseif ($total_data >= 4) {
                                                $bg_class   = "bg-danger";
                                            }
                                        ?>
                                        <li id="openDetail" style="{{ $style }}" class="seat"
                                            data-rackno="{{ $rackno }}">
                                            <label class="{{ $bg_class }}">
                                                {{ $i }}b
                                                <br>
                                                {{ $total_data }}/4
                                            </label>
                                        </li>
                                    </ol>
                                </li>
                                <?php endfor ?>
                            </ol>
                            <div class="exit back train-body">
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>

                </div>
            </div>
            <!-- /.box-body -->

        </div>
    </div>
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="row">
                <div class="col-lg-12">
                    <!-- <h4 class="title-transdet">Detail Placement - CS (<span id="display_title_cs"></span>) - Rak (<span id="display_title_rack"></span>) - Baris (<span id="display_title_row"></span>) <span
                            class="close">&times;</span></h4> -->
                    <h4 class="title-transdet">Detail Placement - <strong><span id="display_title"></span></strong> <span
                            class="close">&times;</span></h4>
                    <h5 class="place-detail">
                        Tingkat 4
                        <span style="font-size: 14px; margin-left: 10px;float:right" id="rack_name_level_4"></span>
                        <span style="font-size: 14px; float:right" id="pallet_name_level_4"></span>
                    </h5>
                    <table border="2" class="table table-bordered table-striped" style="white-space: nowrap;">
                        <thead style="text-align: center">
                            <tr>
                                <th>Nama item</th>
                                <th>Date</th>
                                <th>Qty</th>
                                <th style="text-align: right">BW</th>
                            </tr>
                        </thead>
                        <tbody class="display_rack" id="display_rack_4"></tbody>
                    </table>
                </div>
                <div class="col-lg-12">
                    <h5 class="place-detail">
                        Tingkat 3
                        <span style="font-size: 14px; margin-left: 10px;float:right" id="rack_name_level_3"></span>
                        <span style="font-size: 14px; float:right" id="pallet_name_level_3"></span>
                    </h5>
                    <table border="2" class="table table-bordered table-striped" style="white-space: nowrap;">
                        <thead style="text-align: center">
                            <tr>
                                <th>Nama item</th>
                                <th>Date</th>
                                <th>Qty</th>
                                <th style="text-align: right">BW</th>
                            </tr>
                        </thead>
                        <tbody class="display_rack" id="display_rack_3"></tbody>
                    </table>
                </div>
                <div class="col-lg-12">
                    <h5 class="place-detail">
                        Tingkat 2
                        <span style="font-size: 14px; margin-left: 10px;float:right" id="rack_name_level_2"></span>
                        <span style="font-size: 14px; float:right" id="pallet_name_level_2"></span>
                    </h5>
                    <table border="2" class="table table-bordered table-striped" style="white-space: nowrap;">
                        <thead style="text-align: center">
                            <tr>
                                <th>Nama item</th>
                                <th>Date</th>
                                <th>Qty</th>
                                <th style="text-align: right">BW</th>
                            </tr>
                        </thead>
                        <tbody class="display_rack" id="display_rack_2"></tbody>
                    </table>
                </div>
                <div class="col-lg-12">
                    <h5 class="place-detail">
                        Tingkat 1
                        <span style="font-size: 14px; margin-left: 10px;float:right" id="rack_name_level_1"></span>
                        <span style="font-size: 14px; float:right" id="pallet_name_level_1"></span>
                    </h5>
                    <table border="2" class="table table-bordered table-striped" style="white-space: nowrap;">
                        <thead style="text-align: center">
                            <tr>
                                <th>Nama item</th>
                                <th>Date</th>
                                <th>Qty</th>
                                <th style="text-align: right">BW</th>
                            </tr>
                        </thead>
                        <tbody class="display_rack" id="display_rack_1"></tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div id="myModalx" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="row">
                <div class="col-lg-12">
                    <!-- <h4 class="title-transdet">Detail Placement - CS (<span id="display_title_cs"></span>) - Rak (<span id="display_title_rack"></span>) - Baris (<span id="display_title_row"></span>) <span
                            class="close">&times;</span></h4> -->
                    <h4 class="title-transdet">Placement - <strong><span id="display_title_x"></span></strong> <span
                            class="close-x">&times;</span></h4>
                </div>
                <div class="col-lg-12">
                     <table border="2" class="table table-bordered table-striped" style="white-space: nowrap;">
                        <thead style="text-align: center">
                            <tr>
                                <th style="text-align: left;">RFID</th>
                                <th style="text-align: left;">Nama</th>
                                <th style="text-align: center;">Date</th>
                                <th style="text-align: center;">Qty</th>
                                <th style="text-align: center">BW</th>
                            </tr>
                        </thead>
                        <tbody class="display_rack" id="display_rack_X"></tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection


@push('javascript-external')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('vendor/select2/js/' . app()->getLocale() . '.js') }}"></script>
<script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>

<script type="text/javascript">
    $(".seat").on('click', function() {
        var rackno  = $(this).data('rackno');
        $(".display_rack").empty();
        if (rackno !== "") {
            $.ajax({
                url: "{{ route('mappingcs.detail') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "rackNo": rackno
                },
                success: function(response) {
                    const data = response.data;

                    $.each(data, function(i, item) {
                        console.log(item);
                        let html = `
                            <tr>
                                <td>${item.SHORT_NAME}</td>
                                <td>${item.PROD_DATE}</td>
                                <td>${item.QTY}</td>
                                <td>${item.BW}</td>
                            </tr>
                        `;
                        $(`#display_rack_${item.TINGKAT}`).append(html);
                    });
                    $("#display_title").text(rackno);
                    $("#myModal").show();
                },
                error: function(error) {
                    
                }
            })
        }
    });
</script>
<script>
    $(".Checkbox-parent input").on('click',function(){
    var _parent=$(this);
    var nextli=$(this).parent().next().children().children();
    
    if(_parent.prop('checked')){
        console.log('Checkbox-parent checked');
        nextli.each(function(){
        $(this).children().prop('checked',true);
        });
        
    }
    else{
        console.log('Checkbox-parent un checked');
        nextli.each(function(){
        $(this).children().prop('checked',false);
        });
    
    }
    });

    $(".Checkbox-child input").on('click',function(){
    
    var ths=$(this);
    var parentinput=ths.closest('div').prev().children();
    var sibblingsli=ths.closest('ul').find('li');
    
    if(ths.prop('checked')){
        console.log('Checkbox-child checked');
        parentinput.prop('checked',true);
    }
    else{
        console.log('Checkbox-child unchecked');
        var status=true;
        sibblingsli.each(function(){
        console.log('sibb');
        if($(this).children().prop('checked')) status=false;
        });
        if(status) parentinput.prop('checked',false);
    }
    });

    // show hide accordion

    var acc = document.getElementsByClassName("Accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("Accordion--active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight){
        panel.style.maxHeight = null;
        } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
        } 
    });
    }
</script>

<script>
    function openCs(evt, cityName) {
      var i, x, tablinks;
      x = document.getElementsByClassName("storage");
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablink");
      for (i = 0; i < x.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " w3-red";
    }
</script>

<script type="text/javascript">
    $(".x-rack").on('click', function() {
        var rackno  = 'X';
        var coldStorage = $(this).data('coldstorage');
        $(".display_rack").empty();
        if (rackno !== "") {
            $.ajax({
                url: "{{ route('mappingcs.detail') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "coldStorage": coldStorage,
                    "rackNo": rackno
                },
                success: function(response) {
                    const data = response.data;

                    $.each(data, function(i, item) {
                        console.log(item);
                        let html = `
                            <tr>
                                <td style="text-align: left;">${item.PALLET_NO}</td>
                                <td style="text-align: left;">${item.SHORT_NAME}</td>
                                <td style="text-align: center;">${item.PROD_DATE}</td>
                                <td style="text-align: center;">${item.QTY}</td>
                                <td style="text-align: center;">${item.BW}</td>
                            </tr>
                        `;
                        $(`#display_rack_${item.TINGKAT}`).append(html);
                    });
                    $("#display_title_x").text(rackno);
                    $("#myModalx").show();
                },
                error: function(error) {
                    
                }
            })
        }
    });
</script>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
      modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
</script>

<script>
    // Get the modal
    var modalx = document.getElementById("myModalx");

    // Get the button that opens the modal
    var btnx = document.getElementById("myBtnx");

    // Get the <span> element that closes the modal
    var spanx = document.getElementsByClassName("close-x")[0];

    // When the user clicks the button, open the modal 
    btnx.onclick = function() {
      modalx.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    spanx.onclick = function() {
      modalx.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modalx.style.display = "none";
      }
    }
</script>
@endpush