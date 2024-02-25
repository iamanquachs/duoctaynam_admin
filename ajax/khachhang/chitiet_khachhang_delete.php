<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/khachhangClass.php');
$db = new KhachHang();
$msdv = $_COOKIE['msdv'];
$mskh = $_POST['mskh'];
$msct = $_POST['msct'];
$db->khachhang_chitiet_delete($msdv, $mskh, $msct);
