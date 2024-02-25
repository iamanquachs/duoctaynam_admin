<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/sellerClass.php");

$db = new Seller();

$sodienthoai = $_POST['sodienthoai'];
$list = $db->load_khachhang($sodienthoai);
header('Content-Type: application/json');
echo json_encode($list);
