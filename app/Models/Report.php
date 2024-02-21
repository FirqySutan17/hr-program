<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    public function m_get_plant_name2(){
        $get_item       = "SELECT DISTINCT A.PLANT,B.CODE_NAME
        FROM SH_SS_STORAGE_INVENTORY A, CD_CODE B
        WHERE HEAD_CODE = 'AB'
        AND DESC6 = 'Y'
        AND A.PLANT = B.CODE
                ";
            $data = $this->db->query($get_item);
            return $data;
        }
        
            public function m_get_pallet(){
            $get_item       = "SELECT DISTINCT PALLET_NO
                    FROM SH_SS_STORAGE
                    -- WHERE PALLET_NO != 'cjlogo.png'
                    order by to_char(PALLET_NO,'0000')
                ";
            // echo "<pre/>";print_r($get_item);exit;
            $data = $this->db->query($get_item);
            return $data;
    }

    public function m_get_item_name2(){
        $get_item       = "
            SELECT DISTINCT A.ITEM,B.SHORT_NAME
            FROM SH_SS_STORAGE_INVENTORY A,
                 CD_ITEM B
            WHERE A.ITEM = B.ITEM    
            ";
        $data = $this->db->query($get_item);
        return $data;
    }

    public function m_get_pallet() { 
        $get_item       = "
              SELECT DISTINCT PALLET_NO
              FROM SH_SS_STORAGE
              order by to_char(PALLET_NO,'0000')
            ";
        // echo "<pre/>";print_r($get_item);exit;
        $data = $this->db->query($get_item);
        return $data;
    }

    public function m_get_rackno(){
        $get_item       = "SELECT DISTINCT RACK_NO
            FROM SH_SS_STORAGE_INVENTORY
                    ";
          $data = $this->db->query($get_item);
          return $data;
    }

    public function m_get_coldstorage(){
        $get_item       = "SELECT DISTINCT COLD_STORAGE FROM SH_SS_STORAGE_INVENTORY ORDER BY COLD_STORAGE ASC";
        $data = $this->db->query($get_item);
        return $data;
    }

    public function m_wh_report($AS_SDATE,$AS_EDATE,$AS_MATERIAL,$AS_SUPPLIER,$AS_PLANT,$AS_COMPANY,$AS_CS){
        $plantsession = $this->session->userdata('plant');
        $hasil = "
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
        // echo "<pre/>";print_r($hasil);exit;
        $data = $this->db->query($hasil);
        return $data;
    }

    public function m_wh_report_detail($AS_SDATE,$AS_EDATE,$AS_MATERIAL,$AS_SUPPLIER,$AS_PLANT,$AS_COMPANY,$AS_CS){
        $plantsession = $this->session->userdata('plant');
        $hasil = "
          SELECT 
            COMPANY_NAME, PLANT, PLANT_NAME, GOODS_KINDS, GOODS_KIND_NAME, 
            COLD_STORAGE, RACK_NO, PALLET_NO, ITEM, FULL_NAME, PACKING_UNIT, PROD_DATE, TRUNC(SYSDATE  - TO_DATE(PROD_DATE,'YYYYMMDD')) days, 
             (CASE WHEN COLD_STORAGE = 'Queue' 
                  THEN 'Antrian' else
              SUBSTR(RACK_NO,1,1)||'-'||TRIM(TO_CHAR(SUBSTR(RACK_NO,-1),'00'))||'-'||TRIM(TO_CHAR(SUBSTR(RACK_NO,4,INSTR(SUBSTR(RACK_NO,4,10),'.') -1),'00'))||SUBSTR(RACK_NO,2,1) end) RACK_NO_TEXT,
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
        //  echo "<pre/>";print_r($hasil);exit;
        $data = $this->db->query($hasil);
        return $data;
    }
}
