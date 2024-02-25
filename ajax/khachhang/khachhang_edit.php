<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/khachhangClass.php');
$db = new KhachHang();
$msdv = $_COOKIE['msdv'];
$tendv = $_COOKIE['tendv'];
$msdn = $_COOKIE['msdn'];
$msctv = '';
$ngay = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['ngay'])));
$mskh = $_POST['mskh'];
$tenkh = $_POST['tenkh'];
$dienthoai = $_POST['dienthoai'];
$diachi = $_POST['diachi'];
$maxa = $_POST['maxa'];
$trangthai = $_POST['trangthai'];
$lydo = $_POST['lydo'];
$db->khachhang_edit($msdv, $tendv, $msdn,  $ngay, $mskh, $tenkh, $dienthoai, $diachi, $maxa, $trangthai, $lydo);
