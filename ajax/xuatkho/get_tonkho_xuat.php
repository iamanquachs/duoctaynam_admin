<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/sellerClass.php");

$db = new Seller();

$msdv = $_COOKIE['msdv'];
$mshh = $_POST['mshh'];
$solo = $_POST['solo'];
$handung = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['handung'])));
$list = $db->get_tonkho_xuat($msdv, $mshh, $solo, $handung);
header('Content-Type: application/json');
echo json_encode($list);
