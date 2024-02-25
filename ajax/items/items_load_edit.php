<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/items_class.php');
$db = new Items();
$mshh = $_POST['mshh'];

$list = $db->item_load_edit($mshh);
header('Content-Type: application/json');
echo json_encode($list);
