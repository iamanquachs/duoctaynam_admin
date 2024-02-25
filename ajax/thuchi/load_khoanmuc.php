<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/thuchi_class.php");

$db = new Thuchi();
$msdv = $_COOKIE['msdv'];
$list = $db->load_khoanmuc($msdv );
header('Content-Type: application/json');
echo json_encode($list);
