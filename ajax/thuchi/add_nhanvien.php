<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/thuchi_class.php");

$db = new Thuchi();
$msdv = $_COOKIE['msdv'];
$manhanvien = $_POST['manhanvien'];
$tennhanvien = $_POST['tennhanvien'];

$list = $db->add_nhanvien($msdv, $manhanvien, $tennhanvien);
