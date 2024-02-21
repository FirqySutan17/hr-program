@extends('layouts.master')

@section('title')
Report - Stock Balance
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

    .b-style {
        font-family: pjsBold;
        font-size: 14px;
        color: #0f172a;
        margin-bottom: 0px;
        background: transparent;
        padding: 0px
    }
</style>
@endpush

@section('content')
<div class="main-content">
    <section class="content">
        <!-- Info boxes -->

        <div class="box box-info">
            <div class="box box-primary box-solid">
                <div class="box-header">
                    <center>
                        <h5 class="box-title" style="font-size: 24px">Stock Inventory</h5>
                    </center>
                </div>
                <div class="date-range">
                    <?php echo substr($data['tanggal'], 6, 2)."/".substr($data['tanggal'], 4, 2)."/". substr($data['tanggal'], 0, 4) ?>
                    -
                    <?php echo substr($data['tanggal2'], 6, 2)."/".substr($data['tanggal2'], 4, 2)."/".substr($data['tanggal2'], 0,4) ?>
                </div>
            </div>

           <!--  <section class="content-header" style="padding: 0px">
                <div class="box box-info  box-solid">
                    <div class="box-header with-border" style="padding: 10px;font-size: 16px;border: 0px solid #000;
                    border-radius: 0px 0px 0px 0px;">
                        <h5 class="box-title" style="font-size: 16px">Filter</h5>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-toggle="collapse"
                                data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i
                                    class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="collapse" id="collapseExample">
                        <div class="box-body ">
                            <form class="form-horizontal" action="" method="POST" target="">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon">COMPANY</span>
                                            <select class="form-control" name="AS_COMPANY" id="plant">
                                                <option value="%">All</option>
                                                <option value="01">01. PT SUJA</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon">PLANT</span>

                                            <select name="AS_PLANT" class="form-control" style="width: 100%;">
                                                <option value="%">All</option>
                                                <option value="">
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon">START</span>
                                            <input type="date" name="AS_SDATE" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon">END</span>
                                            <input type="date" name="AS_EDATE" class="form-control" value="">
                                        </div>
                                    </div>

                                </div>
                                <p></p>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon">COLD STORAGE</span>

                                            <select name="AS_PO" class="form-control" style="width: 100%;">
                                                <option value="%">All</option>

                                                <option value="">
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon">PALLET NO</span>
                                            <select name="AS_SUPPLIER" class="form-control" style="width: 100%;">
                                                <option value="%">All</option>

                                                <option value="">
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon">ITEM LIST</span>
                                            <input list="ITEM" name="AS_MATERIAL" id="visit1" placeholder="All"
                                                class="form-control" onchange="myFunction2()"
                                                title="Please Select Rack Number">
                                            <datalist id="ITEM">
                                                <option value=""></option>
                                            </datalist>

                                        </div>
                                    </div>
                                </div>
                                <P></P>
                                <button type="submit" id="btn-filter"
                                    class="btn btn-block btn-sm btn-primary">Filter</button>
                            </form>
                        </div>
                    </div>

                </div>
            </section> -->

            <div class="box-body">
                <div class="" style="overflow: hidden;">
                    <div class="table-responsive">
                        <table border="2" id="example2" class="table table-bordered table-striped"
                            style="width: 1500px">
                            <thead style="text-align: center; width: 100%">
                                <tr style="text-align: center">
                                    <th style="text-align: center; vertical-align: middle;width: 3%" rowspan="2"><input
                                            type="checkbox" style="width: 100%;" class="check-all" name="check_all">
                                    </th>
                                    <th style="text-align: center; vertical-align: middle;width: 47%" rowspan="2">Goods
                                        Item
                                    </th>
                                    <th style="text-align: center; vertical-align: middle;width: 10%" rowspan="2">Unit
                                    </th>
                                    <th style="text-align: center; vertical-align: middle;width: 10%" colspan="3">Begin
                                    </th>
                                    <th style="text-align: center; vertical-align: middle;width: 10%" colspan="3">In
                                    </th>
                                    <th style="text-align: center; vertical-align: middle;width: 10%" colspan="3">Out
                                    </th>
                                    <th style="text-align: center; vertical-align: middle;width: 10%" colspan="3">End
                                    </th>
                                </tr>
                                <tr>
                                    <th style="text-align: center; vertical-align: middle;">Bag</th>
                                    <th style="text-align: center; vertical-align: middle;">Qty</th>
                                    <th style="text-align: center; vertical-align: middle;">BW</th>
                                    <th style="text-align: center; vertical-align: middle;">Bag</th>
                                    <th style="text-align: center; vertical-align: middle;">Qty</th>
                                    <th style="text-align: center; vertical-align: middle;">BW</th>
                                    <th style="text-align: center; vertical-align: middle;">Bag</th>
                                    <th style="text-align: center; vertical-align: middle;">Qty</th>
                                    <th style="text-align: center; vertical-align: middle;">BW</th>
                                    <th style="text-align: center; vertical-align: middle;">Bag</th>
                                    <th style="text-align: center; vertical-align: middle;">Qty</th>
                                    <th style="text-align: center; vertical-align: middle;">BW</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $totalBG_BAG = 0; $totalBG_QTY = 0; $totalBG_BW = 0;
                                $totalIN_BAG = 0; $totalIN_QTY = 0; $totalIN_BW = 0;
                                $totalOUT_BAG = 0; $totalOUT_QTY = 0; $totalOUT_BW = 0;
                                $totalEND_BAG = 0; $totalEND_QTY = 0; $totalEND_BW = 0;
                                ?>
                                <?php $no=1; foreach ($data['Report'] as $baris):?>
                                <?php
                                $totalBG_BAG += $baris["BG_SACK_BAG"]; $totalBG_QTY += $baris["BG_QTY"]; $totalBG_BW += $baris["BG_BW"];
                                $totalIN_BAG += $baris["IN_SACK_BAG"]; $totalIN_QTY += $baris["IN_QTY"]; $totalIN_BW += $baris["IN_BW"];
                                $totalOUT_BAG += $baris["OUT_SACK_BAG"]; $totalOUT_QTY += $baris["OUT_QTY"]; $totalOUT_BW += $baris["OUT_BW"];
                                $totalEND_BAG += $baris["END_SACK_BAG"]; $totalEND_QTY += $baris["END_QTY"]; $totalEND_BW += $baris["END_BW"];
                                ?>
                                <tr id="data-<?= $no ?>">
                                    <td><input type="checkbox" style="width: 100%;" name="check_row" class="check-row"
                                            id="<?= $no ?>"
                                            value="<?= $baris['END_SACK_BAG'].'-'.$baris['END_QTY'].'-'.$baris['END_BW'] ?>">
                                    </td>
                                    <td style="text-align: left;">
                                        <?php echo $baris["ITEM"];?> -
                                        <?php echo $baris["FULL_NAME"];?>
                                    </td>
                                    <td style="text-align: center">KG</td>
                                    <td style="text-align:center;">
                                        <?php echo number_format($baris["BG_SACK_BAG"]);?>
                                    </td>
                                    <td style="text-align:center;">
                                        <?php echo number_format($baris["BG_QTY"]);?>
                                    </td>
                                    <td style="text-align:center;">
                                        <?php echo number_format($baris["BG_BW"], 2);?>
                                    </td>
                                    <td style="text-align:center;">
                                        <?php echo number_format($baris["IN_SACK_BAG"]);?>
                                    </td>
                                    <td style="text-align:center;">
                                        <?php echo number_format($baris["IN_QTY"]);?>
                                    </td>
                                    <td style="text-align:center;">
                                        <?php echo number_format($baris["IN_BW"], 2);?>
                                    </td>
                                    <td style="text-align:center;">
                                        <?php echo number_format($baris["OUT_SACK_BAG"]);?>
                                    </td>
                                    <td style="text-align:center;">
                                        <?php echo number_format($baris["OUT_QTY"]);?>
                                    </td>
                                    <td style="text-align:center;">
                                        <?php echo number_format($baris["OUT_BW"], 2);?>
                                    </td>
                                    <td style="text-align:center;">
                                        <?php echo number_format($baris["END_SACK_BAG"]);?>
                                    </td>
                                    <td style="text-align:center;">
                                        <?php echo number_format($baris["END_QTY"]);?>
                                    </td>
                                    <td style="text-align:center;">
                                        <?php echo number_format($baris["END_BW"], 2);?>
                                    </td>
                                </tr>
                                <?php $no++; endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="text-align: right; vertical-align: middle;" colspan="3"><strong>Grand
                                            Total</strong></th>
                                    <th style="text-align: right; vertical-align: middle;"><strong>
                                            <?= number_format($totalBG_BAG) ?>
                                        </strong></th>
                                    <th style="text-align: right; vertical-align: middle;"><strong>
                                            <?= number_format($totalBG_QTY) ?>
                                        </strong></th>
                                    <th style="text-align: right; vertical-align: middle;"><strong>
                                            <?= number_format($totalBG_BW, 2) ?>
                                        </strong></th>
                                    <th style="text-align: right; vertical-align: middle;"><strong>
                                            <?= number_format($totalIN_BAG) ?>
                                        </strong></th>
                                    <th style="text-align: right; vertical-align: middle;"><strong>
                                            <?= number_format($totalIN_QTY) ?>
                                        </strong></th>
                                    <th style="text-align: right; vertical-align: middle;"><strong>
                                            <?= number_format($totalIN_BW, 2) ?>
                                        </strong></th>
                                    <th style="text-align: right; vertical-align: middle;"><strong>
                                            <?= number_format($totalOUT_BAG) ?>
                                        </strong></th>
                                    <th style="text-align: right; vertical-align: middle;"><strong>
                                            <?= number_format($totalOUT_QTY) ?>
                                        </strong></th>
                                    <th style="text-align: right; vertical-align: middle;"><strong>
                                            <?= number_format($totalOUT_BW, 2) ?>
                                        </strong></th>
                                    <th style="text-align: right; vertical-align: middle;"><strong>
                                            <?= number_format($totalEND_BAG) ?>
                                        </strong></th>
                                    <th style="text-align: right; vertical-align: middle;"><strong>
                                            <?= number_format($totalEND_QTY) ?>
                                        </strong></th>
                                    <th style="text-align: right; vertical-align: middle;"><strong>
                                            <?= number_format($totalEND_BW, 2) ?>
                                        </strong></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>


                    <div class="row" style="margin-top: 20px">
                        <div class="col-lg-6">
                            <h4 style="font-weight: 600">Total Checked</h4>
                            <table border="2" class="table table-bordered table-striped">
                                <thead style="text-align: center; width: 100%">
                                    <!-- <tr style="text-align: center">
                          <th style="text-align: center; vertical-align: middle;width: 10%" colspan="3">Begin</th>
                          <th style="text-align: center; vertical-align: middle;width: 10%" colspan="3">In</th>
                          <th style="text-align: center; vertical-align: middle;width: 10%" colspan="3">Out</th>
                          <th style="text-align: center; vertical-align: middle;width: 10%" colspan="3">End</th>
                        </tr> -->
                                    <tr>
                                        <!-- <th style="text-align: center; vertical-align: middle;">Bag</th>
                          <th style="text-align: center; vertical-align: middle;">Qty</th>
                          <th style="text-align: center; vertical-align: middle;">BW</th>
                          <th style="text-align: center; vertical-align: middle;">Bag</th>
                          <th style="text-align: center; vertical-align: middle;">Qty</th>
                          <th style="text-align: center; vertical-align: middle;">BW</th>
                          <th style="text-align: center; vertical-align: middle;">Bag</th>
                          <th style="text-align: center; vertical-align: middle;">Qty</th>
                          <th style="text-align: center; vertical-align: middle;">BW</th> -->
                                        <th style="text-align: center; vertical-align: middle;">Bag</th>
                                        <th style="text-align: center; vertical-align: middle;">Qty</th>
                                        <th style="text-align: center; vertical-align: middle;">BW</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <!-- <td style="text-align: center; vertical-align: middle;" id="BEG_BAG">0</td>
                          <td style="text-align: center; vertical-align: middle;" id="BEG_QTY">0</td>
                          <td style="text-align: center; vertical-align: middle;" id="BEG_BW">0</td>
                          <td style="text-align: center; vertical-align: middle;" id="IN_BAG">0</td>
                          <td style="text-align: center; vertical-align: middle;" id="IN_QTY">0</td>
                          <td style="text-align: center; vertical-align: middle;" id="IN_BW">0</td>
                          <td style="text-align: center; vertical-align: middle;" id="OUT_BAG">0</td>
                          <td style="text-align: center; vertical-align: middle;" id="OUT_QTY">0</td>
                          <td style="text-align: center; vertical-align: middle;" id="OUT_BW">0</td> -->
                                        <td style="text-align: center; vertical-align: middle;" id="END_BAG">0</td>
                                        <td style="text-align: center; vertical-align: middle;" id="END_QTY">0</td>
                                        <td style="text-align: center; vertical-align: middle;" id="END_BW">0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <!-- /.row -->



    </section>
</div>
@endsection


@push('javascript-external')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
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
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      })
    })
</script>
<script type="text/javascript">
    $(".check-row").change(function() {
      calculateTotal();
    });
  
    $(".check-all").change(function() {
      if ($(this).prop('checked')) {
        $(`.check-row`).prop('checked', true);
        $(`.check-row`).addClass('bg-blue');
      } else {
        $(`.check-row`).prop('checked', false);
        $(`.check-row`).removeClass('bg-blue');
      }
      calculateTotal();
    });
    function calculateTotal() {
      var all_checkbox = $(".check-row");
      var checked_box = $(".check-row:checked");
  
      console.log("TOTAL CHECKBOX", all_checkbox.length);
      console.log("TOTAL CHECKED BOX", checked_box.length);
  
      var totalBag  = 0;
      var totalQty  = 0;
      var totalBW   = 0;
      $.each(all_checkbox, function() {
        var id = $(this).attr('id');
        if ($(this).prop('checked')) {
          if (!$(`#data-${id}`).hasClass('bg-blue')) {
            $(`#data-${id}`).addClass('bg-blue');
          }
          var value = $(this).val();
          var split = value.split("-");
          var bag = parseInt(split[0]);
          var qty = parseInt(split[1]);
          var bw = parseInt(split[2]);
  
          totalBag += bag;
          totalQty += qty;
          totalBW  += bw;
        } else {
          if ($(`#data-${id}`).hasClass('bg-blue')) {
            $(`#data-${id}`).removeClass('bg-blue');
          }
        }
  
      });
  
      $("#END_BAG").text(totalBag);
      $("#END_QTY").text(totalQty);
      $("#END_BW").text(totalBW);
    }
    $("#example1 tr").click(function(){
      if ($(this).hasClass("selected")){
          $(this).removeClass("selected");
      }else{
          $(this).addClass("selected").siblings().removeClass("selected");
      }
    });
</script>
@endpush