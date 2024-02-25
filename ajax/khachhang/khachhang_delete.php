<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/khachhangClass.php');
$db = new KhachHang();
$msdv = $_COOKIE['msdv'];
$mskh = $_POST['mskh'];
$db->khachhang_delete($msdv, $mskh);
