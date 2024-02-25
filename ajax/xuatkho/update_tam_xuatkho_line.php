<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/sellerClass.php");

$db = new Seller();
$msdv = $_COOKIE['msdv'];
$soct = $_POST['soct'];
$db->update_tam_xuatkho_line($msdv, $soct);
