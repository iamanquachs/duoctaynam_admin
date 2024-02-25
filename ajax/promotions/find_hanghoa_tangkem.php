<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/promotionsClass.php");

$db = new Promotions();
$msdv = $_COOKIE['msdv'];
$mshh = $_POST['mshh'];

$list = $db->find_hanghoa_tangkem($msdv, $mshh);
header('Content-Type: application/json');
echo json_encode($list);