<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/congviecClass.php");

$db = new Work();

$list = $db->load_nhomcv();
header('Content-Type: application/json');
echo json_encode($list);
