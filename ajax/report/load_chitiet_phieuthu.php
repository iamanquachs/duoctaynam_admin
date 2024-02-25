<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/reportClass.php");

$db = new Report();
$msdv = $_COOKIE['msdv'];
$sophieuthu = $_POST['sophieuthu'];
$list = $db->load_chitiet_phieuthu($msdv, $sophieuthu);
header('Content-Type: application/json');
echo json_encode($list);
