<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/sellerClass.php");

$db = new Seller();
$msdv = $_COOKIE['msdv'];
$msdn = $_COOKIE['msdn'];
$soct = $_POST['soct'];
$mshh = $_POST['mshh'];
$soluong = $_POST['soluong'];
$pttichluy = $_POST['pttichluy'];
$tenhh = $_POST['tenhh'];
$dvt = $_POST['dvtmin'];
$thuesuat = $_POST['thuesuat'];
$ptgiam = $_POST['ptgiam'];
$giagoc = $_POST['giagoc'];
$giaban = $_POST['giaban'];
$msctkm = $_POST['msctkm'];
$msnpp = $_POST['msnpp'];
$loai_xuat = $_POST['loai_xuat'];
$list_tonkho = $db->tinh_soluong_trukho($mshh, $soluong);
$tonkho_item = explode('|', $list_tonkho[0]->KQ);

for ($i = 0; $i < count($tonkho_item); $i++) {
    if ($tonkho_item[$i] != '') {
        $item =  explode(',', $tonkho_item[$i]);
        $rowid_tonkho = explode(':', $item[0])[1];
        $soluong = (explode(':', $item[1])[1]);
        $solo = (explode(':', $item[2])[1]);
        $handung = (explode(':', $item[3])[1]);
        $gianhapcothue = (explode(':', $item[4])[1]);
        $db->add_xuatkho_line($rowid_tonkho, $msdv, $msdn, $msnpp, $soct, $mshh, $tenhh, $dvt, $solo, $handung, $soluong, $msctkm, $gianhapcothue, $giagoc, $ptgiam, $giaban, $thuesuat, $pttichluy, $loai_xuat);
    }
}
