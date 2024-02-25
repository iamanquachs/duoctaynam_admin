<?php
error_reporting(0);
include("../../../includes/config.php");
include("../../../includes/database.php");
require("../../../modules/khachhangClass.php");

$db = new KhachHang();
$url_img = $_POST['url_img'];
$mskh = $_POST['mskh'];

$list_img = $db->load_hinhanh($mskh);
foreach ($list_img as $r) {
    $hinhanh = $r->hinhanh;
}
$tach_img = explode("|", $hinhanh);
foreach ($tach_img as $i) {
    if ($i == $url_img) {
        if ($i != "") {
            $hinhanh_new = str_replace($i . '|', '', $hinhanh);
            $db->delete_hinhanh($mskh, $hinhanh_new);
            unlink("../../../upload/khachhang/$i");
        } else {
        }
    } else {
    }
}
