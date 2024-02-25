
<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/congviecClass.php");

$db = new Work();
$msdv = $_COOKIE['msdv'];
$msdn = $_POST['msdn'];
$db->delete_nhanvien($msdn, $msdv);
