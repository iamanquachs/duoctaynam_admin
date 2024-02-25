<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/oms_ims_class.php");

$db = new DonHang();
$msdv = $_COOKIE['msdv'];
$msdn = $_COOKIE['msdn'];
$soct = 'ID' . date("dmyHis", time()) . rand(1000, 9999);
$maso = $_POST['maso'];
$tenmaso = $_POST['tenmaso'];
$soct_donhang = $_POST['soct_donhang'];
$soctdathang = $_POST['soctdathang'];
$sohd = $_POST['sohd'];
$sotienthu = $_POST['sotienthu'];
$noidungthu = 'Thu bán hàng ' . $maso . ' | ' . $tenmaso;
$msnguoinop = '';
$nguoinop = '';
$nganquythu = $_POST['nganquythu'];
$khoanmucthu = 'TBH';
$dathanhtoan = $_POST['dathanhtoan'] + $sotienthu;
$list = $db->xuatkho_post_thuchi($msdv, $msdn, $soct, $maso, $tenmaso, $soct_donhang, $soctdathang, $sohd, $sotienthu, $noidungthu, $msnguoinop, $nguoinop, $nganquythu, $khoanmucthu, $dathanhtoan);
