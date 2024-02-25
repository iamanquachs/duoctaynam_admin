<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/congviecClass.php");

$db = new Work();
$msdv = $_COOKIE['msdv'];
$list = $db->load_nhanvien($msdv);
header('Content-Type: application/json');
echo json_encode($list);