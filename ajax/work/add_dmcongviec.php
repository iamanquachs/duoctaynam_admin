<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/congviecClass.php");

$db = new Work();
$msdv = $_COOKIE['msdv'];
$mscongviec =date("is", time()) . rand(100, 999);;
$tencongviec = $_POST['tencongviec'];
$db->add_dmcongviec($msdv, $mscongviec, $tencongviec);
