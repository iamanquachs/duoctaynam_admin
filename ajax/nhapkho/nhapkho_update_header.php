<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/nhapkho_class.php");

$db = new NhapKho();
$soct = $_POST['soct'];
$msdv = $_COOKIE['msdv'];
$sohoadon = $_POST['sohoadon'];
$ngay = explode('/', $_POST['ngayhd']);
$ngayhd =  $ngay[2] . '/' . $ngay[1] . '/' . $ngay[0];
$msncc = $_POST['msncc'];
$tenncc = $_POST['tenncc'];
if ($msncc == '') {
    $tenncc = 'Chưa chọn';
}
$tongcong = $_POST['tongcong'];
$db->nhapkho_update_header($msdv, $soct, $sohoadon, $ngayhd, $msncc, $tenncc, $tongcong);
