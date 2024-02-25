<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/thuchi_class.php");

$db = new Thuchi();
$msdv = $_COOKIE['msdv'];
$soct = $_POST['soct'];
$sotien = $_POST['sotien'];
$soct_donhang = $_POST['soct_donhang'];
$loaithuchi = $_POST['loaithuchi'];
if ($loaithuchi != 'TBH' && $loaithuchi != 'CMH') {
    $db->delete_thuchi($soct, $msdv, $loaithuchi);
}
if ($loaithuchi == 'TBH') {
    $db->delete_thubanhang($soct, $msdv, $sotien, $soct_donhang);
}
if ($loaithuchi == 'CMH') {
    $db->delete_chimuahang($soct, $msdv, $sotien, $soct_donhang);
}
