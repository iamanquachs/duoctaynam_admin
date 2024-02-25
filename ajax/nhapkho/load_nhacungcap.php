<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/nhapkho_class.php");

$db = new NhapKho();

$list = $db->load_nhacungcap();
header('Content-Type: application/json');
echo json_encode($list);
