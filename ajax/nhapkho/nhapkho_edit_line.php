<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/nhapkho_class.php");

$db = new NhapKho();
$soct = $_POST['soct'];
$mshh = $_POST['mshh'];
$tenthuoc = $_POST['tenhh'];
$dvt = $_POST['dvt'];
$solo = $_POST['solo'];
$han = explode('/', $_POST['handung']);
$handung =  $han[2] . '/' . $han[1] . '/' . $han[0];
$gianhap = $_POST['gianhap'];
$chietkhau = $_POST['chietkhau'];
$tienchietkhau = $_POST['tienchietkhau'];
$gianhapchuathue = $_POST['gianhapchuathue'];
$vat = $_POST['vat'];
$tienthue = $_POST['tienthue'];
$soluong = $_POST['soluong'];
$gianhapcothue = $_POST['gianhapvat'];
$tienthue = $_POST['tienthue'];
$ptgiaban = $_POST['ptgiaban'];
$giaban = $_POST['giaban'];
$thanhtiencothue = $_POST['thanhtien'];
$db->nhapkho_edit_line($soct, $mshh, $tenthuoc, $dvt, $solo, $handung, $gianhap, $chietkhau, $tienchietkhau, $gianhapchuathue, $vat, $tienthue, $gianhapcothue, $soluong,  $thanhtiencothue, $ptgiaban, $giaban);
