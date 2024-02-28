@extends('layouts.master')

@section('title')
Report
@endsection

@push('css-external')
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/display.css') }}">
<link rel="stylesheet" href="{{ asset('css/w3.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/bootstrap/dist/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/Ionicons/css/ionicons.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/dist/css/AdminLTE.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/dist/css/skins/_all-skins.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/datatables.net-bs/css/buttons.dataTables.min.css') }}">
@endpush

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

<style>
    table.dataTable th {
        position: relative;
        text-align: center
    }

    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_desc:after,
    table.dataTable thead .sorting_asc_disabled:after,
    table.dataTable thead .sorting_desc_disabled:after {
        position: absolute;
        bottom: 5px;
        right: 5px;
    }

    table.dataTable thead>tr>th.sorting_asc,
    table.dataTable thead>tr>th.sorting_desc,
    table.dataTable thead>tr>th.sorting,
    table.dataTable thead>tr>td.sorting_asc,
    table.dataTable thead>tr>td.sorting_desc,
    table.dataTable thead>tr>td.sorting {
        padding: 10px 20px;
    }

    .table>tbody>tr>td,
    .table>tbody>tr>th,
    .table>tfoot>tr>td,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>thead>tr>th {
        vertical-align: middle;
    }

    select.input-sm {
        height: 40px;
        line-height: 30px;
        text-align: center;
    }

    .box-header {
        background: #3c8dbc;
        border: 4px solid #000;
        border-radius: 10px 10px 0px 0px;
        padding: 25px 0px;
    }

    .box.box-solid.box-primary {
        border-top: none;
        border: 0px solid transparent
    }

    .box-title {
        font-size: 24px;
        font-weight: 700;
        text-transform: uppercase;
        color: #fff;
    }

    .box.box-info {
        border-top-color: transparent;
    }

    .content {
        padding: 0px
    }

    .date-range {
        background-color: #000;
        color: #fff;
        text-align: center;
        width: 100%;
        padding: 8px 16px;
        border-radius: 0px 0px 10px 10px;
        border: 2px solid #000;
        font-weight: 600
    }

    .box-header.with-border {
        border-bottom: 1px solid #f4f4f4;
    }

    select.input-sm {
        height: 30px;
        line-height: 18px !important;
    }
</style>

@section('content')
<div class="main-content pre-posttest">
    <h3 class="card-title">
        HR Program - Report PRE/POST TEST
    </h3>
    <h4>Soft Skill (Leadership, Communication, dan Team Work)</h4>
    <form class="form-horizontal mb-5" action="{{ route('report.index') }}" method="POST">
        @csrf
        <div class="row"
            style="margin-top: 30px; border: 1px solid #000; border-right: 0px solid #000; border-left: 0px solid #000; padding: 20px 0px;">
            <div class="col-md-8 col-sm-12">
                <select name="ujian" class="form-control" style="border-radius: 8px; height: 40px">
                    @foreach ($ujian_data as $ujian)
                    <option {{ $ujian->id == $ujian_id ? 'selected' : '' }} value="{{ $ujian->id }}">{{ $ujian->nama }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 col-sm-6">
                <button type="submit" class="btn btn-primary btn-block" style="height: 40px">FILTER</button>
            </div>
            <div class="col-md-2 col-sm-6">
                <button type="submit" formaction="{{ route('report.export') }}" class="btn btn-primary btn-block"
                    style="height: 40px; background: green">EXPORT</button>
            </div>
        </div>
    </form>
    <table class="table table-bordered table-hover" id="example1">
        <thead>
            <tr>
                <th style="text-align: center;">No</th>
                <th style="text-align: center;">NPK</th>
                <th style="text-align: center;">Nama</th>
                <th style="text-align: center;">Plant</th>
                <th style="text-align: center;">Dept</th>
                <th style="text-align: center;">Point</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ujian_user as $uu)
            <tr>
                <td style="text-align: center; vertical-align: middle">{{ $loop->iteration }}</td>
                <td style="text-align: center; vertical-align: middle">{{ $uu->employee_id }}</td>
                <td style="vertical-align: middle">{{ $uu->name }}</td>
                <td style="text-align: center; vertical-align: middle">{{ $uu->plant_name }}</td>
                <td style="text-align: center; vertical-align: middle">{{ $uu->dept_name }}</td>
                <td style="text-align: center; vertical-align: middle">{{ $uu->score }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('javascript-external')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('vendor/select2/js/' . app()->getLocale() . '.js') }}"></script>
<script src="{{ asset('vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<script>
    $(function () {
      $('#example1').DataTable(
        {"language": {"paginate": { "previous": "&lt","next": "&gt",}}}
        )
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
      })
    })
</script>

@endpush