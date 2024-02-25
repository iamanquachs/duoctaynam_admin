<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/yeucau_class.php");

$db = new YeuCau();
$msdn = $_POST['msdn'];
$msdv = $_POST['msdv'];
$rowid = $_POST['rowid'];
$list = $db->delete_yeucau($msdv, $msdn, $rowid);
