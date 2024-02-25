<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/sellerClass.php");

$db = new Seller();

$msdv = $_COOKIE['msdv'];
$msdn = $_COOKIE['msdn'];
$soct = $_POST['soct'];
$mshh = $_POST['mshh'];
$rowid = $_POST['rowid'];
$msctkm = $_POST['msctkm'];

$db->delete_xuatkho_line($msdv, $soct, $mshh, $rowid, $msctkm);

$layctkm_add_xuatkho = $db->lay_ctkm_them_xuatkho($msdv, $msdn, $soct, $mshh);
