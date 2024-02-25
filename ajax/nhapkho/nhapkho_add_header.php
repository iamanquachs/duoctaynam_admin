<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/nhapkho_class.php");

$db = new NhapKho();
$msdv = $_COOKIE['msdv'];
$msdn = $_COOKIE['msdn'];
$soct = $_POST['soct'];
$db->nhapkho_add_header($msdv, $msdn, $soct);
