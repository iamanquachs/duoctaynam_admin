<?php
include('../../../includes/config.php');
include('../../../includes/database.php');
require('../../../modules/items_class.php');
$db = new Items();
$mshh = $_POST['mshh'];
$msdn = $_COOKIE['msdn'];
$chidinh = str_replace('"', "''", $_POST['chidinh']);
$chongchidinh = str_replace('"', "''", $_POST['chongchidinh']);
$lieudung = str_replace('"', "''", $_POST['lieudung']);
$tacdungphu = str_replace('"', "''", $_POST['tacdungphu']);
$thantrong = str_replace('"', "''", $_POST['thantrong']);
$tuongtacthuoc = str_replace('"', "''", $_POST['tuongtacthuoc']);
$baoquan = str_replace('"', "''", $_POST['baoquan']);
$ktr_mshh = $db->ktra_mshh_mota($mshh);
if (count($ktr_mshh) == 1) {
    $list = $db->edit_mota($msdn, $mshh, $chidinh, $chongchidinh, $lieudung, $tacdungphu, $thantrong, $tuongtacthuoc, $baoquan);
} else {
    $db->add_mota($msdn, $mshh, $chidinh, $chongchidinh, $lieudung, $tacdungphu, $thantrong, $tuongtacthuoc, $baoquan);
}
