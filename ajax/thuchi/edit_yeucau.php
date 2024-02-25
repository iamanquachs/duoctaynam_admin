<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/yeucau_class.php");

$db = new YeuCau();
$msdn = $_POST['msdn'];
$msdv = $_POST['msdv'];
$rowid = $_POST['rowid'];
$link = $_POST['link'];
$list = $db->edit_yeucau($msdv, $msdn, $rowid, $link);
