<?php

namespace App\Http\Services;

class PlacementServices {
    public static function getRackList() {
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
			   CSDATA, (COUNT(SEQ) / 4) as TOTAL_SEQ
			FROM (
			    SELECT
			        REGEXP_SUBSTR(A.CODE, '[^.]+', 1, 1) AS CSDATA,
			        REGEXP_SUBSTR(A.CODE, '[^.]+', 1, 2) AS SEQ
			    FROM 
			        CD_CODE A
			    WHERE 
			        A.HEAD_CODE = 'SH19'
			        AND (A.CODE LIKE 'B61%' OR A.CODE LIKE 'B62%' OR A.CODE LIKE 'B63%')
			) tabledata
			GROUP BY tabledata.CSDATA
			ORDER BY tabledata.CSDATA ASC
        ";
        $stid 	= oci_parse($conn, $query);
        oci_execute($stid);

        $coldStorageData = [];
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        	$coldStorage 	= substr($row['CSDATA'], 2, 1);
        	$rackStorage 	= substr($row['CSDATA'], 3, 2);
        	if (!array_key_exists($coldStorage, $coldStorageData)) {
        		$coldStorageData[$coldStorage] = [
        			"NAME"			=> $coldStorage,
        			"TOTAL_ROW"		=> 0
        		];
        	}
        	$coldStorageData[$coldStorage]['TOTAL_ROW'] = $row['TOTAL_SEQ'];
        }

        return $coldStorageData;
    }

    public static function getRackData($coldStorage) {
    	$username   = "CJCMS";
        $password   = "admin99";
        $database   = "RPA_SVR/RPA";
        $conn   = oci_connect($username, $password, $database);
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $coldStorageCode = "B6".$coldStorage;
        $query 	= "
        	SELECT 
        		DISTINCT regexp_substr(A.CODE, '[^.]+', 1, 1) CSDATA,
        		TO_NUMBER(regexp_substr(A.CODE, '[^.]+', 1, 2)) BARIS, 
				CASE 
					WHEN regexp_substr(A.CODE, '[^.]+', 1, 1) = '".$coldStorageCode."Ab' THEN 1
					WHEN regexp_substr(A.CODE, '[^.]+', 1, 1) = '".$coldStorageCode."Aa' THEN 2
					WHEN regexp_substr(A.CODE, '[^.]+', 1, 1) = '".$coldStorageCode."Ba' THEN 3
					WHEN regexp_substr(A.CODE, '[^.]+', 1, 1) = '".$coldStorageCode."Bb' THEN 4
				END AS POSITION,
				(SELECT COUNT(DISTINCT(RACK_NO)) FROM SH_SS_STORAGE_INVENTORY WHERE COLD_STORAGE = '".$coldStorage."' AND RACK_NO LIKE SUBSTR(A.CODE, 4, 5) || '%') as JUMLAH_DATA,
				(SELECT MIN(PROD_DATE) as tanggalStok FROM SH_SS_STORAGE_INVENTORY  WHERE COLD_STORAGE = '".$coldStorage."' AND RACK_NO LIKE SUBSTR(A.CODE, 4, 5) || '%') as TANGGAL_TERTUA
			FROM 
				CD_CODE A,
				( 
					select plant||cold_storage||RACK_NO CD, ITEM, RACK_NO, PALLET_NO,SUM(QTY) QTY,SUM(BW) BW,SUM(SACK_BAG) SACK_BAG
					from SH_SS_STORAGE_INVENTORY 
				WHERE COMPANY = '01'
				GROUP BY plant||cold_storage||RACK_NO, ITEM, RACK_NO, PALLET_NO
				) B
			WHERE 
				HEAD_CODE = 'SH19'
				AND A.CODE LIKE '".$coldStorageCode."%'
				AND  A.CODE = B.CD(+)
			GROUP BY A.CODE
			ORDER BY POSITION ASC
        ";
        // echo "<pre/>";print_r($query);exit();
        $stid 	= oci_parse($conn, $query);
        oci_execute($stid);

        $rackStorage = [];
        $positionArray = [ 1 => "Ab", 2 => "Aa", 3 => "Ba", 4 => "Bb"];
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        	$baris = $row['BARIS'];
        	$position = $positionArray[$row['POSITION']];
        	$jumlah_data = (int) $row['JUMLAH_DATA'];
        	if (!array_key_exists($baris, $rackStorage)) {
        		$rackStorage[$baris] = [
        			"Ab" 	=> 0,
        			"Aa"	=> 0,
        			"Ba"	=> 0,
        			"Bb"	=> 0
        		];
        	}

        	if ($jumlah_data > 0) {
        		$rackStorage[$baris][$position] = $jumlah_data;
        	}
        }
        return $rackStorage;
    }

    public static function getStockBalanceList($AS_SDATE,$AS_EDATE,$AS_MATERIAL,$AS_SUPPLIER,$AS_PLANT,$AS_COMPANY,$AS_CS) {
    	$username   = "CJCMS";
        $password   = "admin99";
        $database   = "RPA_SVR/RPA";
        $conn   = oci_connect($username, $password, $database);
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        $query 	= "
        	SELECT COMPANY_NAME,PLANT,PLANT_NAME,GOODS_KINDS,ITEM,FULL_NAME,PACKING_UNIT,
		              SUM(BG_SACK_BAG) BG_SACK_BAG,
		              SUM(BG_QTY) AS BG_QTY,
		              SUM(IN_SACK_BAG) AS IN_SACK_BAG,
		              SUM(OUT_SACK_BAG) AS OUT_SACK_BAG,
		              (SUM(BG_SACK_BAG) + SUM(IN_SACK_BAG) ) - SUM(OUT_SACK_BAG) AS END_SACK_BAG,
		              SUM(IN_QTY) AS IN_QTY,
		              SUM(OUT_QTY) AS OUT_QTY,
		              (SUM(BG_QTY) + SUM(IN_QTY) ) - SUM(OUT_QTY) AS END_QTY,
		              SUM(BG_BW) AS BG_BW,
		              SUM(IN_BW) AS IN_BW,
		              SUM(OUT_BW) AS OUT_BW,
		              (SUM(BG_BW) + SUM(IN_BW) ) - SUM(OUT_BW) AS END_BW
		      FROM (       
		          SELECT FN_CODE_NAME('AA',A.COMPANY)                  AS COMPANY_NAME,
		                         A.PLANT,
		                         FN_CODE_NAME('AB',A.PLANT)       AS PLANT_NAME,
		                         C.GOODS_KINDS,
		                         FN_CODE_NAME('GK',C.GOODS_KINDS)           AS GOODS_KIND_NAME,
		                         A.ITEM ,
		                         C.FULL_NAME,C.PACKING_UNIT,
		                        SUM((CASE WHEN TRANS_IO ='I' THEN SACK_BAG ELSE 0 END )) - SUM((CASE WHEN TRANS_IO ='I' THEN 0 ELSE SACK_BAG END )) BG_SACK_BAG,
		                        SUM((CASE WHEN TRANS_IO ='I' THEN QTY ELSE 0 END )) - SUM((CASE WHEN TRANS_IO ='I' THEN 0 ELSE QTY END )) BG_QTY,
		                         0 AS IN_SACK_BAG,
		                         0 AS OUT_SACK_BAG,
		                         0 AS IN_QTY,
		                         0 AS OUT_QTY,
		                         SUM((CASE WHEN TRANS_IO ='I' THEN BW ELSE 0 END )) - SUM((CASE WHEN TRANS_IO ='I' THEN 0 ELSE BW END )) BG_BW,
		                         0 AS IN_BW,
		                         0 AS OUT_BW
		          FROM   SH_SS_STORAGE A, 
		                      CD_ITEM C     
		           WHERE C.ITEM            = A.ITEM  
		             AND A.COMPANY LIKE '$AS_COMPANY'|| '%'
		             AND A.PLANT LIKE '$AS_PLANT'|| '%'
		             AND A.TRANS_DATE < $AS_SDATE
		             AND A.COLD_STORAGE LIKE '$AS_CS'||'%'
		             AND A.ITEM LIKE '$AS_MATERIAL'|| '%'
		             AND A.PALLET_NO LIKE '$AS_SUPPLIER'|| '%'
		           GROUP BY A.COMPANY, C.GOODS_KINDS,A.ITEM, C.FULL_NAME,PLANT,C.PACKING_UNIT
		           UNION ALL 
		          SELECT FN_CODE_NAME('AA',A.COMPANY)                  AS COMPANY_NAME,
		                         A.PLANT,
		                         FN_CODE_NAME('AB',A.PLANT)       AS PLANT_NAME,
		                         C.GOODS_KINDS,
		                         FN_CODE_NAME('GK',C.GOODS_KINDS)           AS GOODS_KIND_NAME,
		                         A.ITEM, 
		                         C.FULL_NAME,C.PACKING_UNIT,
		                         0 BG_QTY,
		                         0 BG_SACK_BAG,
		                         SUM((CASE WHEN TRANS_IO ='I' THEN SACK_BAG ELSE 0 END ))AS IN_SACK_BAG,
		                         SUM((CASE WHEN TRANS_IO ='O' THEN SACK_BAG ELSE 0 END ))AS OUT_SACK_BAG,
		                         SUM((CASE WHEN TRANS_IO ='I' THEN QTY ELSE 0 END ))AS IN_QTY,
		                         SUM((CASE WHEN TRANS_IO ='O' THEN QTY ELSE 0 END ))AS OUT_QTY,
		                           0 BG_BW,
		                         SUM((CASE WHEN TRANS_IO ='I' THEN BW ELSE 0 END ))AS IN_BW,
		                         SUM((CASE WHEN TRANS_IO ='O' THEN BW ELSE 0 END ))AS OUT_BW
		          FROM   SH_SS_STORAGE A, 
		                      CD_ITEM C     
		           WHERE C.ITEM            = A.ITEM  
		             AND A.COMPANY LIKE '$AS_COMPANY'|| '%'
		             AND A.PLANT LIKE '$AS_PLANT'|| '%'
		             AND A.ITEM LIKE '$AS_MATERIAL'|| '%'
		             AND A.PALLET_NO LIKE '$AS_SUPPLIER'|| '%'
		             AND A.COLD_STORAGE LIKE '$AS_CS'||'%'
		             AND A.TRANS_DATE BETWEEN $AS_SDATE AND '$AS_EDATE'
		           GROUP BY A.COMPANY, C.GOODS_KINDS,A.ITEM, C.FULL_NAME,PLANT,C.PACKING_UNIT
		      )     
		      GROUP BY COMPANY_NAME,PLANT,PLANT_NAME,GOODS_KINDS,GOODS_KIND_NAME,ITEM,FULL_NAME,PACKING_UNIT
		      ORDER BY  COMPANY_NAME,PLANT,PLANT_NAME,GOODS_KINDS,GOODS_KIND_NAME,ITEM
        ";
        // echo "<pre/>";print_r($query);exit();
        $stid 	= oci_parse($conn, $query);
        oci_execute($stid);

        $data = [];
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        	$data[] = $row;
        }
        return $data;
    }

    public static function getDetailBalanceList($AS_SDATE,$AS_EDATE,$AS_MATERIAL,$AS_SUPPLIER,$AS_PLANT,$AS_COMPANY,$AS_CS) {
    	$username   = "CJCMS";
        $password   = "admin99";
        $database   = "RPA_SVR/RPA";
        // $database   = "10.137.26.67:1521/BRS";
        $conn   = oci_connect($username, $password, $database);
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        $query 	= "
        	SELECT 
		      COMPANY_NAME, PLANT, PLANT_NAME, GOODS_KINDS, GOODS_KIND_NAME, 
		      COLD_STORAGE, RACK_NO, PALLET_NO, ITEM, FULL_NAME, PACKING_UNIT, PROD_DATE, TRUNC(SYSDATE  - TO_DATE(PROD_DATE,'YYYYMMDD')) days,
		              SUM(BG_SACK_BAG) BG_SACK_BAG,
		              SUM(IN_SACK_BAG) AS IN_SACK_BAG,
		              SUM(OUT_SACK_BAG) AS OUT_SACK_BAG,
		              (SUM(BG_SACK_BAG) + SUM(IN_SACK_BAG) ) - SUM(OUT_SACK_BAG) AS END_SACK_BAG,
		      SUM(BG_QTY) AS BG_QTY, SUM(IN_QTY) AS IN_QTY,
		      SUM(OUT_QTY) AS OUT_QTY, (SUM(BG_QTY) + SUM(IN_QTY) ) - SUM(OUT_QTY) AS END_QTY,
		      SUM(BG_BW) AS BG_BW, SUM(IN_BW) AS IN_BW, SUM(OUT_BW) AS OUT_BW, (SUM(BG_BW) + SUM(IN_BW) ) - SUM(OUT_BW) AS END_BW
		    FROM (       
		      SELECT 
		        FN_CODE_NAME('AA',A.COMPANY) AS COMPANY_NAME, A.PLANT,
		        FN_CODE_NAME('AB',A.PLANT) AS PLANT_NAME, C.GOODS_KINDS,
		        FN_CODE_NAME('GK',C.GOODS_KINDS) AS GOODS_KIND_NAME, COLD_STORAGE, 
		        RACK_NO, PALLET_NO, A.ITEM,  C.FULL_NAME,C.PACKING_UNIT,A.PROD_DATE,
		                  SUM((CASE WHEN TRANS_IO ='I' THEN SACK_BAG ELSE 0 END )) - SUM((CASE WHEN TRANS_IO ='I' THEN 0 ELSE SACK_BAG END )) BG_SACK_BAG,
		        SUM((CASE WHEN TRANS_IO ='I' THEN QTY ELSE 0 END )) - SUM((CASE WHEN TRANS_IO ='I' THEN 0 ELSE QTY END )) BG_QTY,
		                   0 AS IN_SACK_BAG,
		                   0 AS OUT_SACK_BAG,
		        0 AS IN_QTY, 0 AS OUT_QTY,
		        SUM((CASE WHEN TRANS_IO ='I' THEN BW ELSE 0 END )) - SUM((CASE WHEN TRANS_IO ='I' THEN 0 ELSE BW END )) BG_BW,
		        0 AS IN_BW, 0 AS OUT_BW
		      FROM SH_SS_STORAGE A, CD_ITEM C     
		      WHERE 
		        C.ITEM = A.ITEM AND
		        A.COMPANY LIKE '$AS_COMPANY'|| '%' AND
		        A.PLANT LIKE '$AS_PLANT'|| '%' AND
		        A.TRANS_DATE < $AS_SDATE AND
		        A.COLD_STORAGE LIKE '$AS_CS'||'%' AND
		        A.ITEM LIKE '$AS_MATERIAL'|| '%'  AND
		        A.PALLET_NO LIKE '$AS_SUPPLIER'|| '%' 
		      GROUP BY 
		        A.COMPANY, C.GOODS_KINDS,A.ITEM, C.FULL_NAME,PLANT,
		        COLD_STORAGE, RACK_NO, PALLET_NO, C.PACKING_UNIT, A.PROD_DATE     
		      UNION ALL 
		      SELECT 
		        FN_CODE_NAME('AA',A.COMPANY) AS COMPANY_NAME, A.PLANT,
		        FN_CODE_NAME('AB',A.PLANT) AS PLANT_NAME, C.GOODS_KINDS,
		        FN_CODE_NAME('GK',C.GOODS_KINDS) AS GOODS_KIND_NAME,
		        COLD_STORAGE, RACK_NO, PALLET_NO, A.ITEM,  C.FULL_NAME, C.PACKING_UNIT, A.PROD_DATE,         
		                   0 BG_SACK_BAG,
		        0 BG_QTY,
		                   SUM((CASE WHEN TRANS_IO ='I' THEN SACK_BAG ELSE 0 END ))AS IN_SACK_BAG,
		                   SUM((CASE WHEN TRANS_IO ='O' THEN SACK_BAG ELSE 0 END ))AS OUT_SACK_BAG,
		        SUM((CASE WHEN TRANS_IO ='I' THEN QTY ELSE 0 END ))AS IN_QTY,
		        SUM((CASE WHEN TRANS_IO ='O' THEN QTY ELSE 0 END ))AS OUT_QTY, 0 BG_BW,
		        SUM((CASE WHEN TRANS_IO ='I' THEN BW ELSE 0 END ))AS IN_BW,
		        SUM((CASE WHEN TRANS_IO ='O' THEN BW ELSE 0 END ))AS OUT_BW
		      FROM SH_SS_STORAGE A, CD_ITEM C     
		      WHERE 
		        C.ITEM = A.ITEM AND 
		        A.COMPANY LIKE '$AS_COMPANY'|| '%' AND 
		        A.PLANT LIKE '$AS_PLANT'|| '%' AND
		        A.ITEM LIKE '$AS_MATERIAL'|| '%' AND
		        A.PALLET_NO LIKE '$AS_SUPPLIER'|| '%' AND
		        A.COLD_STORAGE LIKE '$AS_CS'||'%' AND 
		        A.TRANS_DATE BETWEEN '$AS_SDATE' AND '$AS_EDATE'
		      GROUP BY 
		        A.COMPANY, C.GOODS_KINDS,A.ITEM, C.FULL_NAME,PLANT,C.PACKING_UNIT,
		        A.SACK_BAG, COLD_STORAGE, RACK_NO, PALLET_NO, A.PROD_DATE
		    )     
		    WHERE BG_SACK_BAG + IN_SACK_BAG  + OUT_SACK_BAG + BG_QTY + IN_QTY + OUT_QTY + BG_BW + IN_BW + OUT_BW <> 0
		    GROUP BY 
		      COMPANY_NAME,PLANT,PLANT_NAME,GOODS_KINDS,GOODS_KIND_NAME,ITEM,
		      COLD_STORAGE, RACK_NO, PALLET_NO,FULL_NAME,PACKING_UNIT,PROD_DATE
		    ORDER BY 
		      COMPANY_NAME,PLANT,PLANT_NAME,GOODS_KINDS,ITEM, COLD_STORAGE, RACK_NO, PALLET_NO,PROD_DATE
        ";
        // echo "<pre/>";print_r($query);exit();
        $stid 	= oci_parse($conn, $query);
        oci_execute($stid);

        $data = [];
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        	$data[] = $row;
        }
        return $data;
    }

    public static function getDetailRack($coldStorage, $rackNo) {
    	$username   = "CJCMS";
        $password   = "admin99";
        $database   = "RPA_SVR/RPA";
        $conn   = oci_connect($username, $password, $database);
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $query 	= "
        	SELECT A.*,B.SHORT_NAME, TRUNC(SYSDATE  - TO_DATE(A.PROD_DATE,'YYYYMMDD')) DAYS, CASE WHEN RACK_NO = 'X' THEN 'X' ELSE REGEXP_SUBSTR(A.RACK_NO, '[^.]+', 1, 3) END AS TINGKAT
	        FROM SH_SS_STORAGE_INVENTORY A, CD_ITEM B
	        WHERE A.COMPANY = '01'
	          AND A.ITEM = B.ITEM
	          AND A.COLD_STORAGE = '".$coldStorage."'
	          AND A.RACK_NO LIKE '".$rackNo."%'
        ";
        // echo "<pre/>";print_r($query);exit();
        $stid 	= oci_parse($conn, $query);
        oci_execute($stid);

        $data = [
        	"1" => [],
        	"2"	=> [],
        	"3"	=> [],
        	"4"	=> [],
        	"X"	=> []
        ];
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        	if (!array_key_exists($row['ITEM'], $data[$row['TINGKAT']])) {
        		$data[$row['TINGKAT']][$row['ITEM']] = [];
        	}

        	if (!array_key_exists($row['PROD_DATE'], $data[$row['TINGKAT']][$row['ITEM']])) {
        		$data[$row['TINGKAT']][$row['ITEM']][$row['PROD_DATE']] = $row;
        	} else {
        		$data[$row['TINGKAT']][$row['ITEM']][$row['PROD_DATE']]['QTY'] += $row['QTY'];
        		$data[$row['TINGKAT']][$row['ITEM']][$row['PROD_DATE']]['BW'] += $row['BW'];
        	}
        }

        $result = [];
        $index = 0;
        foreach ($data as $tingkat => $item) {
        	foreach ($item as $prod_date => $item_proddate) {
        		foreach ($item_proddate as $i => $v) {
        			$result[$index] = $v;
        			$result[$index]["BW"] = round($result[$index]["BW"], 3);
        			$index++;
        		}
        	}
        }
        return $result;
    }

}