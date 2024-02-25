<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/thuchi_class.php");

$db = new Thuchi();
$msdv = $_COOKIE['msdv'];
$makhoanmuc = 'ID' . date("dmyHis", time()) . rand(1000, 9999);
$tenkhoanmuc = $_POST['tenkhoanmuc'];
$loai = $_POST['loai'];
$list_dieukien1 = $db->dieukien1_khoanmuc($loai);
$sl = count($list_dieukien1) - 1;
$dieukien1 = $list_dieukien1[$sl]->dieukien1;

$list = $db->add_khoanmuc($msdv, $makhoanmuc, $tenkhoanmuc, $dieukien1, $loai);
