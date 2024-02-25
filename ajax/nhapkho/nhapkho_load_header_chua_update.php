<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/nhapkho_class.php");

$db = new NhapKho();
$msdn = $_COOKIE['msdn'];
$msdv = $_COOKIE['msdv'];
$db->delete_nhapkho_load_header_chua_update($msdn, $msdv);
$list = $db->nhapkho_load_header_chua_update();
header('Content-Type: application/json');
echo json_encode($list);
