<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/reportClass.php");

$db = new Report();
$msdv = $_COOKIE['msdv'];
$file = $_FILES['file'];
$soct = $_POST['soct'];
if ($file != '') {
    $duoi = explode('.', $file['name']); // tách chuỗi khi gặp dấu .
    $duoi = $duoi[(count($duoi) - 1)]; //lấy ra đuôi file
    $qrthanhtoan = $soct . '.' . $duoi;
    unlink('../../upload/banner/' . $qrthanhtoan);
    move_uploaded_file($file['tmp_name'], '../../upload/qr_thanhtoan/' . $qrthanhtoan);
}
$list = $db->upload_qr_thanhtoan($qrthanhtoan, $soct, $msdv);

