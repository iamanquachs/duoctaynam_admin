<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/sellerClass.php");

$db = new Seller();
$msdv = $_COOKIE['msdv'];
$msdn = $_COOKIE['msdn'];
$soct = $_POST['soct'];
$tenkhachhang = $_POST['tenkhachhang'];
$mskh = $_POST['mskh'];
$sodienthoai = $_POST['sodienthoai'];
$diachi = $_POST['diachi'];
$thanhtoan = $_POST['thanhtoan'];
$ghichu = $_POST['ghichu'];
$nhanvienbanhang = $_POST['nhanvienbanhang'];
$loai_xuat = $_POST['loai_xuat'];
$db->xuatkho_update($msdv, $msdn, $soct, $tenkhachhang, $mskh, $thanhtoan, $ghichu, $nhanvienbanhang, $loai_xuat);
