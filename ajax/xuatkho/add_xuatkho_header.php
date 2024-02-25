<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/sellerClass.php");

$db = new Seller();
$msdv = $_COOKIE['msdv'];
$msdn = $_COOKIE['msdn'];
$soct = $_POST['soct'];
$loaixuat = $_POST['loaixuat'];
$db->add_xuatkho_header($msdv, $msdn, $soct, $loaixuat);
