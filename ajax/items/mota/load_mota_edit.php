<?php
include('../../../includes/config.php');
include('../../../includes/database.php');
require('../../../modules/items_class.php');
$db = new Items();
$mshh=$_POST['mshh'];
$list = $db->load_mota_edit($mshh);
header('Content-Type: application/json');
echo json_encode($list);
