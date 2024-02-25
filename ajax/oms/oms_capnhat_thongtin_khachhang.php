<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/oms_ims_class.php');
$db_donhang = new DonHang();
$soct = $_POST['soct'];
$mskh = $_POST['mskh'];
$tenkhachhang = $_POST['tenkhachhang'];
$tendaidien = $_POST['tendaidien'];
$dienthoai = $_POST['dienthoai'];
$dienthoai_old = $_POST['dienthoai_old'];
$db_donhang->oms_capnhat_thongtin_khachhang($mskh, $soct, $tenkhachhang, $tendaidien, $dienthoai, $dienthoai_old);
