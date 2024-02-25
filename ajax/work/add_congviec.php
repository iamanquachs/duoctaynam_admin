<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/congviecClass.php");

$db = new Work();
$msdv = $_COOKIE['msdv'];
$msdn = $_COOKIE['msdn'];
$ndcongviec = $_POST['ndcongviec'];
$tenkhachhang = $_POST['tenkhachhang'];
$dienthoai = $_POST['dienthoai'];
$ngaybatdau = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['ngaybatdau'])));
if ($ngaybatdau == '1970/01/01') {
    $ngaybatdau = '0000/00/00';
}
$ngayketthuc = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['ngayketthuc'])));
if ($ngayketthuc == '1970/01/01') {
    $ngayketthuc = '0000/00/00';
}
$ghichu = $_POST['ghichu'];
$msnhanvien = $_POST['msnhanvien'];
$mstrangthai = $_POST['mstrangthai'];
$msnhom = $_POST['msnhom'];
$mscongviec = 'ID' . date("dmyHis", time()) . rand(1000, 9999);
$list = $db->add_congviec($msdv, $msdn, $mscongviec, $ndcongviec, $tenkhachhang, $dienthoai, $msnhanvien, $mstrangthai, $msnhom, $ngaybatdau, $ngayketthuc, $ghichu);
