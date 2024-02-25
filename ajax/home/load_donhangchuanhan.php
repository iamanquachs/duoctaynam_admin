<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/homeClass.php");

$db = new Home();
$thang = $_POST['thang'];
$nam = $_POST['nam'];
$list = $db->donhangchuanhan($thang, $nam);
header('Content-Type: application/json');
echo json_encode($list);
