<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/items_class.php');
$db = new Items();

$list = $db->dmphanloai_load_nhasx();
header('Content-Type: application/json');
echo json_encode($list);
