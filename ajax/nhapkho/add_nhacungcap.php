<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/nhapkho_class.php");

$db = new NhapKho();
$tenncc = $_POST['tenncc'];
$msncc = $_POST['msncc'];
$tenviettat = $_POST['tenviettat'];
$dienthoai = $_POST['dienthoai'];
$diachi = $_POST['diachi'];
$msdn = $_COOKIE['msdn'];
$db->add_nhacungcap($msdn, $msncc, $tenncc, $tenviettat, $diachi, $dienthoai);
