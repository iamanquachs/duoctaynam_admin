<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/congviecClass.php");

$db = new Work();
$msdv = $_COOKIE['msdv'];
$noidung = $_POST['noidung'];
$tenkh = $_POST['tenkh'];
$dienthoai = $_POST['dienthoai'];
$ngaybd = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['ngaybd'])));
if ($ngaybd == '1970/01/01') {
    $ngaybd = '0000/00/00';
}
$ngaykt = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['ngaykt'])));
if ($ngaykt == '1970/01/01') {
    $ngaykt = '0000/00/00';
}
$ghichu = $_POST['ghichu'];
$nhanvien = $_POST['nhanvien'];
$trangthai = $_POST['trangthai'];
$nhom = $_POST['nhom'];
$mscongviec = $_POST['mscongviec'];
$list = $db->edit_congviec($msdv, $mscongviec, $noidung, $tenkh, $dienthoai, $nhanvien, $nhom, $ngaybd, $ngaykt, $trangthai, $ghichu);
