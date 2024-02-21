<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Services\PlacementServices;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function stock_balance(Request $request)
    {
        $AS_SDATE       = str_replace('-', '', $request->AS_SDATE);
        $AS_EDATE       = str_replace('-', '', $request->AS_EDATE);
        $AS_MATERIAL    = !empty($request->AS_MATERIAL) ? $request->AS_MATERIAL : "%";
        $AS_SUPPLIER    = !empty($request->AS_SUPPLIER) ? $request->AS_SUPPLIER : "%";
        $AS_COMPANY     = !empty($request->AS_COMPANY) ? $request->AS_COMPANY : "%";
        $AS_PLANT       = !empty($request->AS_PLANT) ? $request->AS_PLANT : "%";
        $AS_CS          = !empty($request->AS_PO) ? $request->AS_PO : "%";

		$report = [];
		$report_data_raw = [];
		// $data['List_Plant'] = $this->M_Warehouse->m_get_plant_name2();
		// $data['List_Item'] = $this->M_Warehouse->m_get_item_name2();
		// $data['List_Pallet'] = $this->M_Warehouse->m_get_pallet();
		// $data['List_rackno'] = $this->M_Warehouse->m_get_rackno();
		// $data['List_coldstorage'] = $this->M_Warehouse->m_get_coldstorage();          
        if ($AS_SDATE=="") {
            $AS_SDATE = date('Ymd');
            $AS_EDATE = date('Ymd');
        }
        $data['tanggal'] = $AS_SDATE; $data['tanggal2'] = $AS_EDATE;
        // $report_data_raw = $this->M_Warehouse->m_wh_report($AS_SDATE,$AS_EDATE,$AS_MATERIAL,$AS_SUPPLIER,$AS_PLANT,$AS_COMPANY,$AS_CS)->result();
        $report_data_raw = PlacementServices::getStockBalanceList($AS_SDATE,$AS_EDATE,$AS_MATERIAL,$AS_SUPPLIER,$AS_PLANT,$AS_COMPANY,$AS_CS);
        
		if (!empty($report_data_raw)) {
			foreach ($report_data_raw as $vl) {
				$item = $vl['ITEM'];
				try {
					$curr_data = [
						"ITEM"	=> trim($item),
						"FULL_NAME"	=> trim($vl['FULL_NAME']),
						"BG_SACK_BAG"	=> trim($vl['BG_SACK_BAG']),
						"IN_SACK_BAG"	=> trim($vl['IN_SACK_BAG']),
						"OUT_SACK_BAG"	=> trim($vl['OUT_SACK_BAG']),
						"END_SACK_BAG"	=> trim($vl['END_SACK_BAG']),
						"BG_QTY"	=> trim($vl['BG_QTY']),
						"IN_QTY"	=> trim($vl['IN_QTY']),
						"OUT_QTY"	=> trim($vl['OUT_QTY']),
						"END_QTY"	=> trim($vl['END_QTY']),
						"BG_BW"	=> trim($vl['BG_BW']),
						"IN_BW"	=> trim($vl['IN_BW']),
						"OUT_BW"	=> trim($vl['OUT_BW']),
						"END_BW"	=> trim($vl['END_BW']),
					];
					if (
						$vl['BG_SACK_BAG'] == 0 && $vl['IN_SACK_BAG'] == 0 && $vl['OUT_SACK_BAG'] == 0 && $vl['END_SACK_BAG'] == 0 
						&& $vl['BG_QTY'] == 0 && $vl['IN_QTY'] == 0 && $vl['OUT_QTY'] == 0 && $vl['END_QTY'] == 0 
						&& $vl['BG_BW'] == 0 && $vl['IN_BW'] == 0 && $vl['OUT_BW'] == 0 && $vl['END_BW'] == 0
					) {
						// do nothing
					} else {
						if (!array_key_exists($item, $report)) {
							$report[$item] = $curr_data;
						} else {
							$report[$item]["BG_SACK_BAG"] += $curr_data["BG_SACK_BAG"];
							$report[$item]["IN_SACK_BAG"] += $curr_data["IN_SACK_BAG"];
							$report[$item]["OUT_SACK_BAG"] += $curr_data["OUT_SACK_BAG"];
							$report[$item]["END_SACK_BAG"] += $curr_data["END_SACK_BAG"];
							$report[$item]["BG_QTY"] += $curr_data["BG_QTY"];
							$report[$item]["IN_QTY"] += $curr_data["IN_QTY"];
							$report[$item]["OUT_QTY"] += $curr_data["OUT_QTY"];
							$report[$item]["END_QTY"] += $curr_data["END_QTY"];
							$report[$item]["BG_BW"] += $curr_data["BG_BW"];
							$report[$item]["IN_BW"] += $curr_data["IN_BW"];
							$report[$item]["OUT_BW"] += $curr_data["OUT_BW"];
							$report[$item]["END_BW"] += $curr_data["END_BW"];
						}
					}
				} catch (Exception $e) {
					echo "<pre/>";print_r($e->getMessage());print_r($vl);exit;
				}
			}
		}
		$data['Report'] = $report;
		// dd($data);
        return view('report.stock-balance', compact('data'));
    }

    public function detail_balance()
    {
        error_reporting(0);
  		ini_set('display_errors', 0);
        $AS_SDATE       = str_replace('-', '', $request->AS_SDATE);
		$AS_EDATE       = str_replace('-', '', $request->AS_EDATE);
		$AS_MATERIAL    = !empty($request->AS_MATERIAL) ? $request->AS_MATERIAL : '%';
		$AS_SUPPLIER    = !empty($request->AS_PALLET) ? $request->AS_PALLET : '%';
		$AS_COMPANY     = !empty($request->AS_COMPANY) ? $request->AS_COMPANY : '%';
		$AS_PLANT       = !empty($request->AS_PLANT) ? $request->AS_PLANT : '%';
		$AS_CS          = !empty($request->AS_PO) ? $request->AS_PO : '%';

		// $data['List_Plant'] = $this->M_Warehouse->m_get_plant_name2();
		// $data['List_Item'] = $this->M_Warehouse->m_get_item_name2();
		// $data['List_Pallet'] = $this->M_Warehouse->m_get_pallet();
		// $data['List_rackno'] = $this->M_Warehouse->m_get_rackno();
		// $data['List_coldstorage'] = $this->M_Warehouse->m_get_coldstorage();

		if ($AS_SDATE =="") {
		$AS_SDATE = date('Ymd');
		$AS_EDATE = date('Ymd');
		}
		$data['tanggal'] = $AS_SDATE; $data['tanggal2'] = $AS_EDATE;

		$report = PlacementServices::getDetailBalanceList($AS_SDATE,$AS_EDATE,$AS_MATERIAL,$AS_SUPPLIER,$AS_PLANT,$AS_COMPANY,$AS_CS);
		$data['Report'] = $report;
		// $data['Report'] = $this->M_Warehouse->m_wh_report_detail($AS_SDATE,$AS_EDATE,$AS_MATERIAL,$AS_SUPPLIER,$AS_PLANT,$AS_COMPANY,$AS_CS)->result();
		// echo "<pre/>";print_r($data["Report"]);exit;
        return view('report.detail-balance', compact('data'));
    }

    public function mapping_cs()
    {
        $placement 			= PlacementServices::getRackList();
		$coldStorageData 	= [
			"1"	=> PlacementServices::getRackData(1),
			"2"	=> PlacementServices::getRackData(2),
			"3"	=> PlacementServices::getRackData(3),
		];

        return view('report.mapping-cs', compact('placement', 'coldStorageData'));
    }

    public function detail_mapping_cs(Request $request)
    {
    	$rackNo 		= $request->rackNo;
    	if ($rackNo == 'X') {
    		$coldStorage = $request->coldStorage;
    	} else {
	    	$coldStorage 	= $rackNo[1];

	    	$rackNoData 	= substr($rackNo, 2, 2);
	    	$barisData 		= (int) substr($rackNo, 4, 2);

	    	// unset($rackNo[0]);
	    	$rackNo = $rackNoData.".".$barisData.".";
    	}
        $placementDetail 	= PlacementServices::getDetailRack($coldStorage, $rackNo);

        $return = [
        	"data"	=> $placementDetail
        ];
        return response()->json($return);
    }

    public function detail_mapping() {
        $cold_storage_name = $rack_no[1];
    	$cold_storage 	= $rack_no[0].$rack_no[1];
    	$rack_position	= $rack_no[2].$rack_no[3];
    	$sequence 		= $rack_no[4].$rack_no[5];

    	if ($sequence < 10) {
    		$sequence 	= $rack_no[5];
    	}

    	$rack_data = [
    		"cold_storage_name"	=> $cold_storage_name,
    		"cold_storage" 	=> $cold_storage,
    		"rack_position"	=> $rack_position,
    		"sequence"		=> $sequence
    	];

        $username   = "suja";
        $password   = "suja";
        $database   = "//10.137.26.67:1521/BRS";
        $conn   = oci_connect($username, $password, $database);
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        } 

        $query 	= "
        	SELECT
        		a.ITEM,
        		b.FULL_NAME as ITEM_NAME,
        		a.RFIDNO,
        		a.RACK_NO,
        		a.LOGDATE,
        		a.QTY,
        		a.WEIGHT,
        		a.PROD_DATE
        	FROM 
        		SH_PD_ABF_RESULT a, CD_ITEM b 
        	WHERE 
        		a.ITEM = b.ITEM
        		AND a.EPCNO IS NOT NULL
        		AND a.DEL_DATE IS NULL
        		AND a.STATUS = '".$cold_storage."'
        	ORDER BY a.LOGDATE ASC
        ";
        $stid 	= oci_parse($conn, $query);
        oci_execute($stid);

        $existing_data 	= [
        	1 => [],
        	2 => [],
        	3 => [],
        	4 => []
        ];
        $placement_data = [];
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        	$timestamp = strtotime($row['LOGDATE']);

        	if ($row['RACK_NO'] == 'X') {
	        	if (!array_key_exists($timestamp, $placement_data)) {
	        		$placement_data[$timestamp] = [
	        			"LOGDATE" 	=> $row['LOGDATE'],
	        			"DATA"		=> []
	        		];
	        	}
	        	$placement_data[$timestamp]["DATA"][] = $row;
        	} else {
        		$pecah_rack = explode(".", $row['RACK_NO']);
        		$sequence_data = $pecah_rack[2];
        		$existing_data[$sequence_data][] = $row;
        	}

        }
    }
 
}
