<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/sellerClass.php");

$db = new Seller();

$msdv = $_COOKIE['msdv'];
$soct = $_POST['soct'];
$list = $db->load_tinhtong_thanhtien($msdv, $soct);
header('Content-Type: application/json');
echo json_encode($list);
