<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/homeClass.php");

$db = new Home();
$msdv = $_COOKIE['msdv'];
$thang = $_POST['thang'];
$nam = $_POST['nam'];
$list = $db->congnophaitra($msdv, $thang, $nam);
header('Content-Type: application/json');
echo json_encode($list);
