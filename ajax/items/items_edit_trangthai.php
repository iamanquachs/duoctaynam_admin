<?php
include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/items_class.php");

$db = new Items();
$mshh = $_POST['mshh'];
$trangthai = $_POST['trangthai'];
$db->item_update_trangthai($mshh, $trangthai);
