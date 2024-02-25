<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/reportClass.php");

$db = new Report();
$msdv = $_COOKIE['msdv'];
$soct = $_POST['soct'];
$path_img_qr = $_POST['path_img_qr'];
$qrthanhtoan = '';
unlink('../../upload/banner/' . $path_img_qr);
$list = $db->upload_qr_thanhtoan($qrthanhtoan, $soct, $msdv);
