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
$mskh = 'ID' . date("dmyHis", time()) . rand(1000, 9999);
$tenkh = $_POST['tenkh'];
$dienthoai = $_POST['dienthoai'];
$diachi = $_POST['diachi'];
$maxa = $_POST['maxa'];
$trangthai = $_POST['trangthai'];
$lydo = $_POST['lydo'];
$db->khachhang_add($msdv, $tendv, $msdn, $msctv, $ngay, $mskh, $tenkh, $dienthoai, $diachi, $maxa, $trangthai, $lydo);
