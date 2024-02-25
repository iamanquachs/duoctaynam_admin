<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/promotionsClass.php");

$db = new Promotions();
$msdv = $_COOKIE['msdv'];
$rowid = $_POST['rowid'];
$list = $db->delete_CTKM($msdv, $rowid);
