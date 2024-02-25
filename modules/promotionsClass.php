<?php

class Promotions extends database
{
    public function auto_set_hieuluc()
    {
        $getall = $this->connect->prepare("UPDATE ctkm_line SET hieuluc='0' WHERE hieuluc='1';
        UPDATE ctkm_line SET hieuluc = '1'  WHERE  CURDATE() BETWEEN tungay AND denngay;");
        $getall->execute();
    }

    public function load_header($msdv, $tenctkm_search, $loai_filter, $songayhethan, $tronghan, $ctkm_tungay, $ctkm_denngay)
    {
        $filter = '';
        if ($tenctkm_search != '') {
            $filter =  $filter . 'and tenctkm like "%' . $tenctkm_search . '%" and tungay >= ' . $ctkm_tungay . ' and denngay <= ' . $ctkm_denngay . '';
        }
        if ($loai_filter != '') {
            $filter =  $filter . 'and loaikm = "' . $loai_filter . '" and tungay >= "' . $ctkm_tungay . '" and denngay <= "' . $ctkm_denngay . '"';
        }
        if ($songayhethan != '') {
            $filter = $filter . 'and denngay <= DATE_ADD(CURDATE(), INTERVAL ' . $songayhethan . ' DAY) ';
        }

        if ($tronghan == 0) {
            $filter = $filter .  'and hieuluc = 1 and tungay >= "' . $ctkm_tungay . '" and denngay <= "' . $ctkm_denngay . '"';
        } else {
            $filter = $filter .  'and hieuluc = 0 and tungay >= "' . $ctkm_tungay . '" and denngay <= "' . $ctkm_denngay . '"';
        }

        $getall = $this->connect->prepare("SELECT msctkm, tenctkm, loaikm FROM ctkm_line WHERE msdv='$msdv' and khoa=0 $filter  GROUP BY msctkm");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }

    public function load_CTKM($msdv, $msctkm, $loai_filter, $songayhethan, $tronghan, $ctkm_tungay, $ctkm_denngay)
    {

        $getall = $this->connect->prepare("SELECT a.rowid,a.tenctkm, b.mshh, b.tenhh, a.ptgiam, DATE_FORMAT(a.tungay, '%d/%m/%Y')tungay, DATE_FORMAT(a.denngay, '%d/%m/%Y')denngay, a.khoa, a.loaikm, a.mshh_mua, a.sl_mua, a.sl_tang FROM ctkm_line a INNER JOIN hosohanghoa b ON a.mshh=b.mshh  WHERE a.msdv='$msdv' and khoa = 0 AND b.trangthai = 1 and msctkm='$msctkm' and tungay >= '$ctkm_tungay' and denngay <= '$ctkm_denngay' order by tungay desc ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }

    public function add_ctkm_header($msdv, $msdn, $ms_ctkm, $ten_ctkm, $loai_ctkm)
    {
        $getall = $this->connect->prepare("INSERT ctkm_line (lastmodify, msdv, msdn, msctkm, tenctkm,mshh,tungay, denngay, loaikm) VALUES(NOW(), '$msdv', '$msdn', '$ms_ctkm', '$ten_ctkm', '$ms_ctkm',CURDATE(),CURDATE(), '$loai_ctkm')");
        $getall->execute();
    }
    public function edit_CTKM($msdv, $khoa, $rowid)
    {
        $getall = $this->connect->prepare("UPDATE ctkm_line set lastmodify=NOW(), khoa='$khoa' where rowid='$rowid'");
        $getall->execute();
    }
    public function delete_CTKM($msdv, $rowid)
    {
        $getall = $this->connect->prepare("DELETE from ctkm_line WHERE msdv='$msdv'and rowid='$rowid'");
        $getall->execute();
    }
    public function find_hanghoa_tangkem($msdv, $mshh)
    {
        $getall = $this->connect->prepare("SELECT tenhh, mshh from hosohanghoa where mshh='$mshh'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function ktra_ctkm($msctkm)
    {
        $getall = $this->connect->prepare("SELECT msctkm from ctkm_line where msctkm='$msctkm' and mshh='$msctkm'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function ktra_ngay_ctkm($mshh, $mshh_tangkem, $tungay, $denngay)
    {
        $getall = $this->connect->prepare("SELECT count(rowid) rowid from ctkm_line WHERE (mshh='$mshh' or mshh='$mshh_tangkem') AND khoa=0 AND  '$tungay' < '$denngay ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function update_chitiet_ctkm($msdv, $msdn, $msctkm, $mshh, $ptgiam, $sl_mua, $tungay, $denngay)
    {
        $getall = $this->connect->prepare("UPDATE ctkm_line set lastmodify=NOW(), mshh='$mshh',ptgiam='$ptgiam', tungay='$tungay', denngay='$denngay',sl_mua='$sl_mua' where msctkm='$msctkm' and msdv='$msdv' and msdn='$msdn'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function add_chitiet_ctkm($msdv, $msdn, $msctkm, $tenctkm, $mshh, $ptgiam, $tungay, $denngay, $loaikm, $mshh_mua, $sl_mua, $sl_tang)
    {
        $getall = $this->connect->prepare("INSERT ctkm_line (lastmodify, msdv, msdn, msctkm, tenctkm, mshh, ptgiam, tungay, denngay, loaikm, mshh_mua, sl_mua, sl_tang) VALUES(NOW(), '$msdv','$msdn','$msctkm','$tenctkm','$mshh','$ptgiam','$tungay','$denngay','$loaikm','$mshh_mua','$sl_mua','$sl_tang')");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
}
