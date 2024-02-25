<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/voucherClass.php");

$db = new voucher();
$value = $_POST['value'];
$list = $db->filter_kh($value);
header('Content-Type: application/json');
echo json_encode($list);
