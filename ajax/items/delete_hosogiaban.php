<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/items_class.php');
$db = new Items();
$msdv = $_COOKIE['msdv'];
$rowid = $_POST['rowid'];
$mshh = $_POST['mshh'];
$list = $db->delete_hosogiaban($msdv, $rowid);
$db->update_giaban_min_max($mshh);
