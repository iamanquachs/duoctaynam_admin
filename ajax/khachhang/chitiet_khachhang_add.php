<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/khachhangClass.php');
$db = new KhachHang();
$msct = 'ID' . date("dmyHis", time()) . rand(1000, 9999);
$msdv = $_COOKIE['msdv'];
$msdn = $_COOKIE['msdn'];
$mskh = $_POST['mskh'];
$tenkh = $_POST['tenkh'];
$note = $_POST['ghichu'];
$yeucau = $_POST['yeucau'];
$gia = $_POST['gia'];
$tungay = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['tungay'])));
$thangkm = $_POST['thangkm'];
$denngay = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['denngay'])));
$loaiphanmem = $_POST['loaiphanmem'];
$loaihopdong = $_POST['loaihopdong'];
$trangthai = $_POST['trangthai'];
$linktailieu = $_POST['linktailieu'];
if (count($db->kt_tontai_khachhang($mskh, $denngay)) > 0) {
    echo '404';
} else {
    $db->khachhang_chitiet_add($msdv, $msdn, $msct, $ngay, $mskh, $tenkh, $note, $yeucau, $gia, $tungay, $thangkm, $denngay, $loaiphanmem, $loaihopdong, $trangthai, $linktailieu);
}
