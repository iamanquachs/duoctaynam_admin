<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/khachhangClass.php');
$db = new KhachHang();
$msdv = $_COOKIE['msdv'];
$mskh_new = $_POST['mskh_new'];
$mskh = $_POST['mskh'];
$db->update_mskh($msdv, $mskh_new, $mskh);
