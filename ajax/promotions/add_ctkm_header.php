<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/promotionsClass.php");

$db = new Promotions();
$msdv = $_COOKIE['msdv'];
$msdn = $_COOKIE['msdn'];
$ms_ctkm = 'KM' . date("dmyHis", time()) . rand(1000, 9999);
$ten_ctkm = $_POST['ten_ctkm'];
$loai_ctkm = $_POST['loai_ctkm'];
$list = $db->add_ctkm_header($msdv,$msdn, $ms_ctkm,$ten_ctkm, $loai_ctkm);
