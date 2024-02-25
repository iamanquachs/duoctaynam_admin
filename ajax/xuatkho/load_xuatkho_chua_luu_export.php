<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/sellerClass.php");

$db = new Seller();
$msdv = $_COOKIE['msdv'];
$list = $db->load_xuatkho_chua_luu_export($msdv);
header('Content-Type: application/json');
echo json_encode($list);
