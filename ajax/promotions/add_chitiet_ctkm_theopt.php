<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/promotionsClass.php");

$db = new Promotions();
$msdv = $_COOKIE['msdv'];
$msdn = $_COOKIE['msdn'];
$msctkm = $_POST['msctkm'];
$tenctkm = $_POST['tenctkm'];
$loaikm = $_POST['loaikm'];
$mshh = $_POST['mshh'];
$sl_mua = '';
$mshh_tangkem = '';
$sl_tangkem = '';
$pt_tangkem = $_POST['pt_tangkem'];
$tungay = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['tungay'])));
$denngay = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['denngay'])));
$ktr_ngay = $db->ktra_ngay_ctkm($mshh, $mshh_tangkem, $tungay);
$ktr = $db->ktra_ctkm($msctkm);
if ($ktr_ngay[0]->rowid == 0) {
    if (count($ktr) == 1) {
        $update = $db->update_chitiet_ctkm($msdv, $msdn, $msctkm, $mshh, $pt_tangkem, $sl_mua, $tungay, $denngay);
    } else {
        $list = $db->add_chitiet_ctkm($msdv, $msdn, $msctkm, $tenctkm, $mshh, $pt_tangkem, $tungay, $denngay, $loaikm, '', $sl_mua, 0);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode('error');
}
