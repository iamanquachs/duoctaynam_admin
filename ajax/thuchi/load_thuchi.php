<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/thuchi_class.php");

$db = new Thuchi();
$msdv = $_COOKIE['msdv'];
$tungay = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['tungay'])));
$denngay = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['denngay'])));
$valueSearch = $_POST['valueSearch'];
$locloai = $_POST['locloai'];
$khoanmuc = $_POST['khoanmuc'];
$list = $db->load_thuchi($msdv, $valueSearch, $tungay, $denngay, $locloai, $khoanmuc);
header('Content-Type: application/json');
echo json_encode($list);
