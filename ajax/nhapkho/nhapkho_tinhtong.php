<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/nhapkho_class.php");

$db = new NhapKho();
$soct = $_POST['soct'];
$list = $db->nhapkho_tinhtong($soct);
header('Content-Type: application/json');
echo json_encode($list);
