<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/congviecClass.php");

$db = new Work();
$msdv = $_COOKIE['msdv'];
$mscongviec = $_POST['mscongviec'];
$db->delete_dmcongviec($msdv, $mscongviec);
