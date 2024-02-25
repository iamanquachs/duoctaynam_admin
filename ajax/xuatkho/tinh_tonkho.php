<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/sellerClass.php");

$db = new Seller();
$msdv = $_COOKIE['msdv'];
$db->tinh_tonkho($msdv, date("Y-m-d"), date("Y-m-d"));
