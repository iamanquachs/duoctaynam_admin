<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/nhapkho_class.php");

$db = new NhapKho();
$msdv = $_COOKIE['msdv'];
$msdn = $_COOKIE['msdn'];
$soct = 'ID' . date("dmyHis", time()) . rand(1000, 9999);
$maso = $_POST['maso'];
$tenmaso = $_POST['tenmaso'];
$soct_donhang = $_POST['soct_donhang'];
$sohd = $_POST['sohd'];
$sotienthu = $_POST['sotienthu'];
$noidungthu = 'Chi mua hàng ' . $tenmaso;
$msnguoinop = '';
$nguoinop = '';
$nganquythu = $_POST['nganquythu'];
$khoanmucthu = 'CMH';
$dathanhtoan = $_POST['dathanhtoan'] + $sotienthu;
$list = $db->nhapkho_post_thuchi($msdv, $msdn, $soct, $maso, $tenmaso, $soct_donhang, $sohd, $sotienthu, $noidungthu, $msnguoinop, $nguoinop, $nganquythu, $khoanmucthu, $dathanhtoan);
