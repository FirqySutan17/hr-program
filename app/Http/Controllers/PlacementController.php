<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\PlacementServices;
use RealRashid\SweetAlert\Facades\Alert;

class PlacementController extends Controller
{
    public function index($rack_no, Request $request) {
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

    	$username   = "CJCMS";
        $password   = "admin99";
        $database   = "RPA_SVR/RPA";
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
        $all_data = [];
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
            $all_data[] = $row;
        }
        // dd($rack_no, $rack_data, $placement_data, $existing_data, $all_data);
        return view('placement.index', compact('rack_no', 'rack_data', 'placement_data', 'existing_data'));
    }

	public function mapping_placement(Request $request) {
		$placement 			= PlacementServices::getRackList();
		$coldStorageData 	= [
			"1"	=> PlacementServices::getRackData(1),
			"2"	=> PlacementServices::getRackData(2),
			"3"	=> PlacementServices::getRackData(3),
		];
		return view('placement.mapping', compact('placement', 'coldStorageData'));
	} 

    public function store($rack_no, Request $request) {

    	$data_placement = $request->data_placement;
    	$rack_no_data	= $request->rak.".".$request->urutan_rak.".".$request->tingkat_rak;
        // dd($rack_no_data, $data_placement);
    	if (!empty($data_placement)) {
    		foreach ($data_placement as $v) {
    			$explode 	= explode("|", $v);
    			$item 		= $explode[0];
    			$log_date 	= $explode[1];
                $rfid       = $explode[2];

    			$query_update = "UPDATE SH_PD_ABF_RESULT SET RACK_NO = '".$rack_no_data."' WHERE ITEM = '".$item."' AND LOGDATE = '".$log_date."' AND RACK_NO = 'X' AND RFIDNO = '".$rfid."'";


    			$username   = "CJCMS";
		        $password   = "admin99";
		        $database   = "RPA_SVR/RPA";
		        $conn   = oci_connect($username, $password, $database);
		        if (!$conn) {
		            $e = oci_error();
		            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		        } 
    			$stmt = oci_parse($conn, $query_update);
				$result = oci_execute($stmt, OCI_DEFAULT);
				if (!$result) {
				  dd(oci_error());   
				} else {
					oci_commit($conn);
				}
    		}

			// Alert::success('Berhasil', 'Data berhasil tersimpan!');
    	} else {
			// Alert::success('Gagal', 'Data gagal tersimpan!');
    	}
    	return redirect()->route('mapping', $rack_no);
    }

    // public function message(Request $request) {
    //     return view('message.index');
    // }
}
