<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/khachhangClass.php');
$db = new KhachHang();
$diachi = $_POST['diachi'];
$list = $db->load_diachi_edit($diachi);
header('Content-Type: application/json');
echo json_encode($list);

