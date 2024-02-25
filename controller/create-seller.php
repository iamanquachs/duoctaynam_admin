<?php
$msdn = $_COOKIE['msdn'];
$msdv = $_COOKIE['msdv'];
$filename = 'Seller/create-seller';
require("modules/promotionsClass.php");
$db = new Promotions();
$db->auto_set_hieuluc();
require("modules/apiClass.php");
$db_api = new Api();
$db_api->tinh_tonkho($msdv, date("Y-m-d"), date("Y-m-d"));
