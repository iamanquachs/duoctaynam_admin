<?php

class voucher extends database
{
    public function list_voucher($value_filter, $tungay, $denngay, $loaivoucher, $trangthai)
    {
        $filter = '';
        if ($value_filter != '') {
            $filter = $filter . "and tenvoucher like '%$value_filter%'";
        }
        if ($loaivoucher != '') {
            $filter = $filter . "and loai = '$loaivoucher'";
        }
        if ($trangthai != '') {
            $filter = $filter . "and trangthai = '$trangthai'";
        }
        $getall = $this->connect->prepare("SELECT  DATE_FORMAT(lastmodify, '%H:%i %d/%m/%Y')ngay,rowid, mskh, mavoucher, tenvoucher, sotien, mabaomat, loai, trangthai, DATE_FORMAT(thoihan, '%d/%m/%Y')thoihan FROM hosovoucher where thoihan between '$tungay' and '$denngay' $filter  order by rowid desc");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function add_voucher($loaivoucher, $mskh, $mavoucher, $tenvoucher, $sotien, $thoihan)
    {
        $getall = $this->connect->prepare("INSERT INTO hosovoucher(lastmodify,mskh, mavoucher, tenvoucher, sotien, mabaomat, loai, trangthai, thoihan) VALUES (NOW(), '$mskh', '$mavoucher', '$tenvoucher', '$sotien', '', '$loaivoucher', '0', '$thoihan')");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function edit_voucher($loaivoucher, $mskh, $mavoucher, $tenvoucher, $sotien, $thoihan, $mabaomat, $trangthai)
    {
        $getall = $this->connect->prepare("UPDATE set lastmodify=NOW(),mskh='$mskh', tenvoucher='$tenvoucher', sotien='$sotien', mabaomat='$mabaomat', loai='$loaivoucher', trangthai='$trangthai', thoihan='$thoihan' FROM hosovoucher where mavoucher='$mavoucher'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function delete_voucher($rowid)
    {
        $getall = $this->connect->prepare("DELETE FROM hosovoucher where rowid='$rowid'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function load_list_kh()
    {
        $getall = $this->connect->prepare("SELECT msdv FROM thongtinnhanhang WHERE chinh = '1'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function filter_kh($value)
    {
        $getall = $this->connect->prepare("SELECT msdv, tenkhachhang FROM thongtinnhanhang WHERE chinh = '1' and (msdv like '%$value%' or tenkhachhang like'%$value%')");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
}
