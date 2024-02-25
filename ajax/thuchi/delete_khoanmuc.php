<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/thuchi_class.php");

$db = new Thuchi();
$msdv = $_COOKIE['msdv'];
$msloai = $_POST['msloai'];
$dieukien2 = $_POST['dieukien2'];
$db->delete_khoanmuc($msdv, $msloai, $dieukien2);
