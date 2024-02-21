@extends('layouts.master')

@section('title')
Report - Stock Balance
@endsection

@push('css-external')
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/display.css') }}">
<link rel="stylesheet" href="{{ asset('css/w3.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/datatables.net-bs/css/buttons.dataTables.min.css') }}">
@endpush

@section('content')
<div class="main-content">
    <section class="content-header">
        <div class="box box-info  box-solid">
            <div class="box-header with-border">
                <h5 class="box-title">Filter</h5>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <?php echo $this->session->flashdata('message');?>
            <div class="box-body">
                <?php echo $this->session->flashdata('successinsert');?>
                <?php echo $this->session->flashdata('GAGAL');?>
                <form class="form-horizontal" action="" method="POST" target="">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">COMPANY</span>
                                <select class="form-control" name="AS_COMPANY" id="plant">
                                    <option <?php if ($this->session->userdata('plant') == "0102") {echo "selected";}?>
                                        value="%">All</option>
                                    <option <?php if ($this->session->userdata('plant') == "0401") {echo "selected";}?>
                                        value="01">01. PT SUJA</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">PLANT</span>
                                <?php 
                      if (isset($_POST['AS_PLANT'])) {
                        $DATA_AS_PLANT = $_POST['AS_PLANT'];
                      }
                      else {
                        $DATA_AS_PLANT = "";
                      }
                    ?>
                                <select name="AS_PLANT" class="form-control" style="width: 100%;">
                                    <option value="%">All</option>
                                    <?php $no=1; foreach ($List_Plant->result() as $baris):?>
                                    <option <?php if ($DATA_AS_PLANT==$baris->PLANT) {echo "selected";}?> value="
                                        <?php echo substr($baris->PLANT, 0, 30)?>">
                                        <?php echo substr($baris->CODE_NAME, 0, 30)?>
                                    </option>
                                    <?php $no++; endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">START</span>
                                <?php 
                      if (isset($_POST['AS_SDATE'])) {
                        $DATA_AS_SDATE = $_POST['AS_SDATE'];
                      }
                      else {
                        $DATA_AS_SDATE = date('Y-m-d');
                      }
                    ?>
                                <input type="date" name="AS_SDATE" class="form-control"
                                    value="<?php echo $DATA_AS_SDATE; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">END</span>

                                <?php 
                      if (isset($_POST['AS_EDATE'])) {
                        $DATA_AS_EDATE = $_POST['AS_EDATE'];
                      }
                      else {
                        $DATA_AS_EDATE = date('Y-m-d');
                      }
                    ?>
                                <input type="date" name="AS_EDATE" class="form-control"
                                    value="<?php echo $DATA_AS_EDATE; ?>">
                            </div>
                        </div>

                    </div>
                    <p></p>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">COLD STORAGE</span>
                                <?php 
                      if (isset($_POST['AS_PO'])) {
                        $DATA_AS_PO = $_POST['AS_PO'];
  
                      }
                      else {
                        $DATA_AS_PO = "";
                      }
                    ?>
                                <select name="AS_PO" class="form-control" style="width: 100%;">
                                    <option value="%">All</option>
                                    <?php $no=1; foreach ($List_coldstorage->result() as $baris):?>
                                    <option <?php if ($DATA_AS_PO==$baris->COLD_STORAGE) {echo "selected";}?> value="
                                        <?php echo $baris->COLD_STORAGE;?>">
                                        <?php echo $baris->COLD_STORAGE;?>
                                    </option>
                                    <?php $no++; endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">PALLET NO</span>
                                <?php 
                      if (isset($_POST['AS_SUPPLIER'])) {
                        $DATA_AS_SUPPLIER = $_POST['AS_SUPPLIER'];
                      }
                      else {
                        $DATA_AS_SUPPLIER = "";
                      }
                    ?>
                                <select name="AS_SUPPLIER" class="form-control" style="width: 100%;">
                                    <option value="%">All</option>
                                    <?php $no=1; foreach ($List_Pallet->result() as $baris):?>
                                    <option <?php if ($DATA_AS_SUPPLIER==$baris->PALLET_NO) {echo "selected";}?> value="
                                        <?php echo $baris->PALLET_NO;?>">
                                        <?php echo $baris->PALLET_NO;?>
                                    </option>
                                    <?php $no++; endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">ITEM LIST</span>
                                <?php 
                      if (isset($_POST['AS_MATERIAL'])) {
                        $DATA_AS_MATERIAL = $_POST['AS_MATERIAL'];
  
                      }
                      else {
                        $DATA_AS_MATERIAL = "";
                      }
                    ?>
                                <input list="ITEM" name="AS_MATERIAL" id="visit1" placeholder="All" class="form-control"
                                    onchange="myFunction2()" title="Please Select Rack Number"
                                    style="border-radius: 20px !important;">
                                <datalist id="ITEM">
                                    <?php $no=1; foreach ($List_Item->result() as $baris):?>
                                    <option value="<?php echo $baris->ITEM;?>">
                                        <?php echo $baris->SHORT_NAME;?>
                                    </option>
                                    <?php $no++; endforeach; ?>
                                </datalist>

                            </div>
                        </div>
                    </div>
                    <P></P>
                    <button type="submit" id="btn-filter" class="btn btn-block btn-sm btn-primary">Filter</button>
                </form>
            </div>
        </div>
    </section>
    <section class="content">
        <!-- Info boxes -->

        <div class="box box-info">
            <?php $D_PLANT = $DATA_AS_PLANT;$D_PO = $DATA_AS_PO;$D_SUPPLIER = $DATA_AS_SUPPLIER;
            if (($DATA_AS_PLANT == '%') or ($DATA_AS_PLANT == '')) {$D_PLANT = 'N';};
            if (($DATA_AS_PO == '%') or ($DATA_AS_PO == '')) {$D_PO = 'N';};
            if (($DATA_AS_SUPPLIER == '%') or ($DATA_AS_SUPPLIER == '')) {$D_SUPPLIER = 'N';};
            ?>
            <div class="box-header"><a id="downloadLink"
                    href="<?= base_url();?>warehouse/rawdata/01/<?=$D_PLANT?>/<?=$DATA_AS_SDATE?>/<?=$DATA_AS_EDATE?>/<?=$D_PO?>/<?=$D_SUPPLIER?>/<?php if (is_null($DATA_AS_MATERIAL)) {echo($DATA_AS_MATERIAL);} else echo("
                    N"); ?>"><button type="button" class="btn btn-success">Export to excel</button></a></div>
            <div class="box-header" style="text-align: center;">

                <h2 class="box-title"><B>RPA Warehouse Inventory</B></h2><br>
                <span class="label label-default">
                    <?php echo substr($tanggal, 6, 2)."/".substr($tanggal, 4, 2)."/". substr($tanggal, 0, 4) ?>
                    -
                    <?php echo substr($tanggal2, 6, 2)."/".substr($tanggal2, 4, 2)."/".substr($tanggal2, 0,4) ?>
                </span>
            </div>
            <div class="box-body">
                <div style="overflow: auto;">
                    <table border="2" id="example2" class="table table-bordered table-striped">
                        <thead style="text-align: center; width: 100%">
                            <tr style="text-align: center">
                                <th style="text-align: center; vertical-align: middle;width: 3%" rowspan="2"><input
                                        type="checkbox" style="width: 100%;" class="check-all" name="check_all"></th>
                                <th style="text-align: center; vertical-align: middle;width: 47%" rowspan="2">Goods Item
                                </th>
                                <th style="text-align: center; vertical-align: middle;width: 10%" rowspan="2">Unit</th>
                                <th style="text-align: center; vertical-align: middle;width: 10%" colspan="3">Begin</th>
                                <th style="text-align: center; vertical-align: middle;width: 10%" colspan="3">In</th>
                                <th style="text-align: center; vertical-align: middle;width: 10%" colspan="3">Out</th>
                                <th style="text-align: center; vertical-align: middle;width: 10%" colspan="3">End</th>
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
                            <?php $no=1; foreach ($Report as $baris):?>
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
                                <td style="text-align: right">
                                    <?php echo number_format($baris["BG_SACK_BAG"]);?>
                                </td>
                                <td style="text-align: right">
                                    <?php echo number_format($baris["BG_QTY"]);?>
                                </td>
                                <td style="text-align: right">
                                    <?php echo number_format($baris["BG_BW"], 2);?>
                                </td>
                                <td style="text-align: right">
                                    <?php echo number_format($baris["IN_SACK_BAG"]);?>
                                </td>
                                <td style="text-align: right">
                                    <?php echo number_format($baris["IN_QTY"]);?>
                                </td>
                                <td style="text-align: right">
                                    <?php echo number_format($baris["IN_BW"], 2);?>
                                </td>
                                <td style="text-align: right">
                                    <?php echo number_format($baris["OUT_SACK_BAG"]);?>
                                </td>
                                <td style="text-align: right">
                                    <?php echo number_format($baris["OUT_QTY"]);?>
                                </td>
                                <td style="text-align: right">
                                    <?php echo number_format($baris["OUT_BW"], 2);?>
                                </td>
                                <td style="text-align: right">
                                    <?php echo number_format($baris["END_SACK_BAG"]);?>
                                </td>
                                <td style="text-align: right">
                                    <?php echo number_format($baris["END_QTY"]);?>
                                </td>
                                <td style="text-align: right">
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

                    <div class="row" style="margin-top: 50px;">
                        <div class="col-lg-6">
                            <h3>Total Checked</h3>
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