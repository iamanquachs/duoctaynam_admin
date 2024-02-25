<?php

class Api extends database
{
    public function Login($user, $pass)
    {
        $getall = $this->connect->prepare("SELECT msdn,msdn,hoten,loainv FROM hosonhanvien WHERE msdn = '$user' AND matkhau = '$pass'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    // public function push_token($msdn, $msdn, $token, $date_expires)
    // {
    //     $getall = $this->connect->prepare("UPDATE hosonhanvien set token = '$token',date_expires = '$date_expires' where msdn = '$msdn' and msdn = '$msdn'");
    //     $getall->execute();
    // }
    // public function Login_Check($msdn, $msdn, $token, $date_expires)
    // {
    //     $getall = $this->connect->prepare("SELECT rowid FROM hosonhanvien WHERE msdn = '$msdn' and msdn = '$msdn' and token = '$token' and CURRENT_DATE <= '$date_expires'");
    //     $getall->setFetchMode(PDO::FETCH_OBJ);
    //     $getall->execute();
    //     return count($getall->fetchAll());
    // }
    //Load tổng tồn kho
    public function tinh_tonkho($msdv, $tungay, $denngay)
    {
        $getall = $this->connect->prepare("CALL LayTonKhoBaoCao('$msdv', '$tungay', '$denngay');");
        $getall->execute();
    }
}
