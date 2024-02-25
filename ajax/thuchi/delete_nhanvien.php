<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/thuchi_class.php");

$db = new Thuchi();
$msdv = $_COOKIE['msdv'];
$msdn = $_POST['msdn'];
$db->delete_nhanvien($msdn, $msdv);
