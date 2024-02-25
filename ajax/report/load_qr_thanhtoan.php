<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/reportClass.php");

$db = new Report();
$msdv = $_COOKIE['msdv'];
$soct = $_POST['soct'];
$list = $db->load_qr_thanhtoan($soct);
header('Content-Type: application/json');
echo json_encode($list);