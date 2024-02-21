<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Placement extends Model
{
    use HasFactory;

    public function m_get_data_rack(){
        $today = date("Ymd");
        $batas_stok_tua = 7;
        $get_data       = "
           SELECT DISTINCT regexp_substr(A.CODE, '[^.]+', 1, 1) CS1,
        TO_NUMBER(regexp_substr(A.CODE, '[^.]+', 1, 2)) tes, 
          CASE 
            WHEN regexp_substr(A.CODE, '[^.]+', 1, 1) = 'B61Ab' THEN 1
            WHEN regexp_substr(A.CODE, '[^.]+', 1, 1) = 'B61Aa' THEN 2
            WHEN regexp_substr(A.CODE, '[^.]+', 1, 1) = 'B61Ba' THEN 3
            WHEN regexp_substr(A.CODE, '[^.]+', 1, 1) = 'B61Bb' THEN 4
          END AS position,
          (SELECT COUNT(DISTINCT(RACK_NO)) FROM SH_SS_STORAGE_INVENTORY WHERE COLD_STORAGE = '1' AND RACK_NO LIKE SUBSTR(A.CODE, 4, 5) || '%') as jumlah_data,
          (SELECT MIN(PROD_DATE) as tanggalStok FROM SH_SS_STORAGE_INVENTORY  WHERE COLD_STORAGE = '1' AND RACK_NO LIKE SUBSTR(A.CODE, 4, 5) || '%') as tanggal_tertua
       FROM CD_CODE A,
           ( select plant||cold_storage||RACK_NO CD, ITEM, RACK_NO, PALLET_NO,SUM(QTY) QTY,SUM(BW) BW,SUM(SACK_BAG) SACK_BAG
        from SH_SS_STORAGE_INVENTORY 
         WHERE COMPANY = '01'
            GROUP BY plant||cold_storage||RACK_NO, ITEM, RACK_NO, PALLET_NO
          ) B
      WHERE HEAD_CODE = 'SH11'
       AND A.CODE LIKE 'B61%'
        AND  A.CODE = B.CD(+)
            GROUP BY A.CODE
        ORDER BY tes, position ASC
            ";
        $data = $this->db->query($get_data);
        return $data;
      }
    
      public function m_get_data_rack2(){
        $today = date("Ymd");
        $get_data       = "
           SELECT DISTINCT regexp_substr(A.CODE, '[^.]+', 1, 1) CS1,
        TO_NUMBER(regexp_substr(A.CODE, '[^.]+', 1, 2)) tes, 
          CASE 
            WHEN regexp_substr(A.CODE, '[^.]+', 1, 1) = 'B62Ab' THEN 1
            WHEN regexp_substr(A.CODE, '[^.]+', 1, 1) = 'B62Aa' THEN 2
            WHEN regexp_substr(A.CODE, '[^.]+', 1, 1) = 'B62Ba' THEN 3
            WHEN regexp_substr(A.CODE, '[^.]+', 1, 1) = 'B62Bb' THEN 4
          END AS position,
          (SELECT COUNT(DISTINCT(RACK_NO)) FROM SH_SS_STORAGE_INVENTORY WHERE COLD_STORAGE = '2' AND RACK_NO LIKE SUBSTR(A.CODE, 4, 5) || '%') as jumlah_data,
          (SELECT MIN(PROD_DATE) as tanggalStok FROM SH_SS_STORAGE_INVENTORY  WHERE COLD_STORAGE = '2' AND RACK_NO LIKE SUBSTR(A.CODE, 4, 5) || '%') as tanggal_tertua
       FROM CD_CODE A,
           ( select plant||cold_storage||RACK_NO CD, ITEM, RACK_NO, PALLET_NO,SUM(QTY) QTY,SUM(BW) BW,SUM(SACK_BAG) SACK_BAG
        from SH_SS_STORAGE_INVENTORY 
         WHERE COMPANY = '01'
            GROUP BY plant||cold_storage||RACK_NO, ITEM, RACK_NO, PALLET_NO
          ) B
      WHERE HEAD_CODE = 'SH11'
       AND A.CODE LIKE 'B62%'
        AND  A.CODE = B.CD(+)
            GROUP BY A.CODE
        ORDER BY tes, position ASC
            ";
        $data = $this->db->query($get_data);
        return $data;
      }
    
      public function m_get_data_rack3(){
        $today = date("Ymd");
        $get_data       = "
           SELECT DISTINCT regexp_substr(A.CODE, '[^.]+', 1, 1) CS1,
        TO_NUMBER(regexp_substr(A.CODE, '[^.]+', 1, 2)) tes, 
          CASE 
            WHEN regexp_substr(A.CODE, '[^.]+', 1, 1) = 'B63Ab' THEN 1
            WHEN regexp_substr(A.CODE, '[^.]+', 1, 1) = 'B63Aa' THEN 2
            WHEN regexp_substr(A.CODE, '[^.]+', 1, 1) = 'B63Ba' THEN 3
            WHEN regexp_substr(A.CODE, '[^.]+', 1, 1) = 'B63Bb' THEN 4
          END AS position,
          (SELECT COUNT(DISTINCT(RACK_NO)) FROM SH_SS_STORAGE_INVENTORY WHERE COLD_STORAGE = '3' AND RACK_NO LIKE SUBSTR(A.CODE, 4, 5) || '%') as jumlah_data,
          (SELECT MIN(PROD_DATE) as tanggalStok FROM SH_SS_STORAGE_INVENTORY  WHERE COLD_STORAGE = '3' AND RACK_NO LIKE SUBSTR(A.CODE, 4, 5) || '%') as tanggal_tertua
       FROM CD_CODE A,
           ( select plant||cold_storage||RACK_NO CD, ITEM, RACK_NO, PALLET_NO,SUM(QTY) QTY,SUM(BW) BW,SUM(SACK_BAG) SACK_BAG
        from SH_SS_STORAGE_INVENTORY 
         WHERE COMPANY = '01'
            GROUP BY plant||cold_storage||RACK_NO, ITEM, RACK_NO, PALLET_NO
          ) B
      WHERE HEAD_CODE = 'SH11'
       AND A.CODE LIKE 'B63%'
        AND  A.CODE = B.CD(+)
            GROUP BY A.CODE
        ORDER BY tes, position ASC
            ";
          // echo "<pre/>";print_r($get_data);exit;
        $data = $this->db->query($get_data);
        return $data;
      }
    
        public function m_get_data_cs1(){
          $get_data       = "
                 SELECT DISTINCT(TO_NUMBER(regexp_substr(CODE, '[^.]+', 1, 2))) TES FROM CD_CODE
          WHERE HEAD_CODE = 'SH11'
          AND USE_YN = 'Y'
          AND CODE <> '*'
          AND CODE LIKE 'B61%'
          ORDER BY TES
              ";
          $data = $this->db->query($get_data);
          return $data;
        }
    
        public function m_get_data_cs2(){
          $get_data       = "
                 SELECT DISTINCT(TO_NUMBER(regexp_substr(CODE, '[^.]+', 1, 2))) TES FROM CD_CODE
          WHERE HEAD_CODE = 'SH11'
          AND USE_YN = 'Y'
          AND CODE <> '*'
          AND CODE LIKE 'B62%'
          ORDER BY TES
              ";
          $data = $this->db->query($get_data);
          return $data;
        }
    
        public function m_get_data_cs3(){
          $get_data       = "
                 SELECT DISTINCT(TO_NUMBER(regexp_substr(CODE, '[^.]+', 1, 2))) TES FROM CD_CODE
          WHERE HEAD_CODE = 'SH11'
          AND USE_YN = 'Y'
          AND CODE <> '*'
          AND CODE LIKE 'B63%'
          ORDER BY TES
              ";
          $data = $this->db->query($get_data);
          return $data;
        }
    
        public function get_data_display($cold_storage, $rack_no) {
          $get_data       = "
            SELECT A.*,B.SHORT_NAME, TRUNC(SYSDATE  - TO_DATE(A.PROD_DATE,'YYYYMMDD')) DAYS
              FROM SH_SS_STORAGE_INVENTORY A, CD_ITEM B
            WHERE A.COMPANY = '01'
              AND A.ITEM = B.ITEM
              AND A.COLD_STORAGE = '$cold_storage'
              AND A.RACK_NO LIKE '$rack_no%'
          ";
          // echo "<pre/>";print_r($get_data);exit;
          $data = $this->db->query($get_data);
          // echo "<pre/>";print_r($data);exit;
          return $data;
        }
}
