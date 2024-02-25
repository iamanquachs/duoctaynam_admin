<?php
include("../../includes/config.php");
include("../../includes/database.php");
include("../../includes/functions.php");

$msdn = $_COOKIE['msdn'];
$r = _check_loai_user($msdn);
header('Content-Type: application/json');
echo json_encode($r);
