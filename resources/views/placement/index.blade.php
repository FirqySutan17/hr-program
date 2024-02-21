@extends('layouts.master')

@section('title')
Placement
@endsection

@push('css-external')
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">


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
        height: 244px;
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

    div:where(.swal2-icon) .swal2-icon-content {
        font-size: 0.75em !important;
    }

    @media(max-width: 940px) {
        .placement-detail {
            height: auto;
        }

        .placement-item {
            height: auto;
        }
    }
</style>
@endpush

@section('content')
<div class="main-content">
    <div class="br-title">
        <h2 class="breadcrumb-title-non"><a href="javascript:void(0)">Placement</a></h2>
        <i class="fa-solid fa-chevron-right"></i>
        <h2 class="breadcrumb-title-active">Cold Storage ({{ $rack_data['cold_storage_name'] }}) - Rak ({{
            $rack_data['rack_position'] }})
            - Baris ({{ $rack_data['sequence'] }})</h2>
    </div>

    <div class="placement-detail">
        <div class="placement-box">
            <h4 class="title-transdet">Form Placement</h4>
            <form action="{{ route('placement.store', $rack_no) }}" method="POST" enctype="multipart/form-data"
                role="alert">
                @csrf
                <input type="hidden" name="status" value="{{ $rack_data['cold_storage'] }}">
                <div class="row d-flex align-items-stretch">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-4" style="display:none">
                                <div class="form-group _form-group">
                                    {{-- <label for="coldstorage">
                                        Cold Storage
                                    </label> --}}
                                    <input id="coldstorage" name="coldstorage" type="hidden" class="form-control"
                                        placeholder="1" value="{{ $rack_data['cold_storage_name'] }}"
                                        style="text-align: center; font-weight: 700;" readonly />
                                </div>
                            </div>
                            <div class="col-4" style="display:none">
                                <div class="form-group _form-group">
                                    {{-- <label for="rak">
                                        Rak
                                    </label> --}}
                                    <input id="rak" name="rak" type="hidden" class="form-control" placeholder="Aa"
                                        value="{{ $rack_data['rack_position'] }}"
                                        style="text-align: center; font-weight: 700;" readonly />
                                </div>
                            </div>
                            <div class="col-4" style="display:none">
                                <div class="form-group _form-group">
                                    {{-- <label for="urutan_rak">
                                        Urutan
                                    </label> --}}
                                    <input id="urutan_rak" name="urutan_rak" type="hidden" class="form-control"
                                        placeholder="12" value="{{ $rack_data['sequence'] }}"
                                        style="text-align: center; font-weight: 700;" readonly />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group _form-group">
                                    <label for="tingkat_rak">
                                        Tingkat
                                    </label>
                                    <select id="select_tingkat" name="tingkat_rak" data-placeholder="Pilih tingkat"
                                        class="custom-select" required>
                                        <!--   <?= empty($existing_data[1]) ? '<option value="1">1</option>' : '' ?>
                                        <?= empty($existing_data[2]) ? '<option value="2">2</option>' : '' ?>
                                        <?= empty($existing_data[3]) ? '<option value="3">3</option>' : '' ?>
                                        <?= empty($existing_data[4]) ? '<option value="4">4</option>' : '' ?> -->
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr style="">
                        <label for="coldstorage" style="font-family: pjsSemiBold;
                        font-size: 14px;
                        color: #0f172a;
                        margin-bottom: 15px;">
                            Item list
                        </label>
                        <div class="placement-item">
                            <?php if (!empty($placement_data)): ?>
                            <?php $no = 1; ?>
                            <?php foreach ($placement_data as $batch_time => $batch): ?>
                            <div class="Checkbox-parent Accordion">
                                <input class="material-icons" type="checkbox" />
                                <label>Batch {{ $no }} ( {{ date('Y-m-d H:i', strtotime($batch['LOGDATE'])) }} ) <strong>TOTAL : {{ count($batch['DATA']) }} DATA</strong></label>
                                </input>

                            </div>
                            <div class="Accordion-panel">
                                <ul class="Checkbox-child">
                                    <?php foreach ($batch['DATA'] as $item): ?>
                                    <li>
                                        <input name="data_placement[]" value="{{ $item['ITEM'].'|'.$item['LOGDATE'].'|'.$item['RFIDNO'] }}"
                                            class="material-icons" type="checkbox" />
                                        <label><b>{{ $item['ITEM'] }} - {{ $item['ITEM_NAME'] }}</b> | <b>{{
                                                $item['WEIGHT'] }} KG</b></label>
                                        </input>

                                    </li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                            <?php $no++; ?>
                            <?php endforeach ?>
                            <?php endif ?>
                        </div>

                        <div class="row" style="margin-top: 30px; margin-bottom: 15px">
                            <div class="col-12">
                                <?php if (!empty($placement_data)): ?>
                                <button type="submit" class="btn-save"
                                    style="text-align: right; float: right">Submit</button>
                                <?php endif ?>
                                <a href="{{ route('home') }}" class="btn-close-modal" aria-label="Close"
                                    style="text-align: right; float: right; margin-right: 10px">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="placement-box detail-box">
            <h4 class="title-transdet">Detail Placement</h4>

            <div class="form-group _form-group">
                <label for="coldstorage" class="place-detail">
                    Tingkat 4
                </label>
                <table class="table">
                    <tr>
                        <th>Nama item</th>
                        <th>Date</th>
                        <th>Qty</th>
                        <th style="text-align: right">BW</th>
                    </tr>
                    <?php if(!empty($existing_data[4])): ?>
                    <?php foreach ($existing_data[4] as $v): ?>
                    <tr>
                        <td>{{ $v['ITEM'] }} - {{ $v['ITEM_NAME'] }}</td>
                        <td>{{ date('Y-m-d H:i', strtotime($v['PROD_DATE'])) }}</td>
                        <td>{{ $v['QTY'] }}</td>
                        <td style="text-align: right">{{ $v['WEIGHT'] }}</td>
                    </tr>
                    <?php endforeach ?>
                    <?php endif ?>
                </table>
            </div>

            <div class="form-group _form-group">
                <label for="coldstorage" class="place-detail">
                    Tingkat 3
                </label>
                <table class="table">
                    <tr>
                        <th>Nama item</th>
                        <th>Date</th>
                        <th>Qty</th>
                        <th style="text-align: right">BW</th>
                    </tr>
                    <?php if(!empty($existing_data[3])): ?>
                    <?php foreach ($existing_data[3] as $v): ?>
                    <tr>
                        <td>{{ $v['ITEM'] }} - {{ $v['ITEM_NAME'] }}</td>
                        <td>{{ date('Y-m-d H:i', strtotime($v['PROD_DATE'])) }}</td>
                        <td>{{ $v['QTY'] }}</td>
                        <td style="text-align: right">{{ $v['WEIGHT'] }}</td>
                    </tr>
                    <?php endforeach ?>
                    <?php endif ?>
                </table>
            </div>

            <div class="form-group _form-group">
                <label for="coldstorage" class="place-detail">
                    Tingkat 2
                </label>
                <table class="table">
                    <tr>
                        <th>Nama item</th>
                        <th>Date</th>
                        <th>Qty</th>
                        <th style="text-align: right">BW</th>
                    </tr>
                    <?php if(!empty($existing_data[2])): ?>
                    <?php foreach ($existing_data[2] as $v): ?>
                    <tr>
                        <td>{{ $v['ITEM'] }} - {{ $v['ITEM_NAME'] }}</td>
                        <td>{{ date('Y-m-d H:i', strtotime($v['PROD_DATE'])) }}</td>
                        <td>{{ $v['QTY'] }}</td>
                        <td style="text-align: right">{{ $v['WEIGHT'] }}</td>
                    </tr>
                    <?php endforeach ?>
                    <?php endif ?>
                </table>
            </div>

            <div class="form-group _form-group">
                <label for="coldstorage" class="place-detail">
                    Tingkat 1
                </label>
                <table class="table">
                    <tr>
                        <th>Nama item</th>
                        <th>Date</th>
                        <th>Qty</th>
                        <th style="text-align: right">BW</th>
                    </tr>
                    <?php if(!empty($existing_data[1])): ?>
                    <?php foreach ($existing_data[1] as $v): ?>
                    <tr>
                        <td>{{ $v['ITEM'] }} - {{ $v['ITEM_NAME'] }}</td>
                        <td>{{ date('Y-m-d H:i', strtotime($v['PROD_DATE'])) }}</td>
                        <td>{{ $v['QTY'] }}</td>
                        <td style="text-align: right">{{ $v['WEIGHT'] }}</td>
                    </tr>
                    <?php endforeach ?>
                    <?php endif ?>
                </table>
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

<script>
    $(function() {
        $('#select_tingkat').select2({
            theme: 'bootstrap4 select-tags',
            language: "{{ app()->getLocale() }}",
            allowClear: true,

        });
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
    $(document).ready(function() {
		$("form[role='alert']").submit(function(event) {
			event.preventDefault();
			Swal.fire({
				title: 'Warning',
				text: 'Anda yakin ingin menyimpan data ini?',
				icon: 'warning',
				allowOutsideClick: false,
				showCancelButton: true,
				cancelButtonText: "Cancel",
				reverseButtons: true,
				confirmButtonText: "Yes",
			}).then((result) => {
				if (result.isConfirmed) {
					// todo: process of deleting categories
					event.target.submit();
				}
			});
		});
	});
</script>
@endpush