<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/sellerClass.php");

$db = new Seller();

$msdv = $_COOKIE['msdv'];
$mshh = $_POST['mshh'];
$soluong = $_POST['soluong'];
$list = $db->find_soluong_hosohanghoa($msdv, $mshh, $soluong);
header('Content-Type: application/json');
echo json_encode($list);
