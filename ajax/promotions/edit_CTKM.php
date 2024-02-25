<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/promotionsClass.php");

$db = new Promotions();
$msdv = $_COOKIE['msdv'];
$khoa = $_POST['khoa'];
$rowid = $_POST['rowid'];
$list = $db->edit_CTKM($msdv,$khoa, $rowid);
