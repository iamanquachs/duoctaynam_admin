<?php
include('../../../includes/config.php');
include('../../../includes/database.php');
require('../../../modules/items_class.php');
$db = new Items();
$msloai = $_POST['msloai'];
$phanloai = $_POST['phanloai'];
$list = $db->delete_phanloai($msloai, $phanloai);
