<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/items_class.php');
$db = new Items();
$msdv = $_COOKIE['msdv'];
$msdn = $_COOKIE['msdn'];
$rowid = $_POST['rowid'];
$mshh = $_POST['mshh'];
$dvt_ban = $_POST['dvt_ban'];
$sl_bantu = $_POST['sl_bantu'];
$sl_banden = $_POST['sl_banden'];
$giabanvat = $_POST['giabanvat'];
$sl_quydoi = $_POST['sl_quydoi'];
$dvt_egpp = $_POST['dvt_egpp'];
$khoa = $_POST['khoa'];
$sl_caonhat = $_POST['sl_caonhat'];
$max = 0;
if ($sl_caonhat == 'true') {
    $max = 1;
}
$ktr = $db->ktr_giaban($msdv, $mshh);
if (count($ktr) > 0) {
    header('Content-Type: application/json');
    echo json_encode('dacomax');
} else {
    $list = $db->edit_hosogiaban($msdv, $msdn, $rowid, $dvt_ban, $sl_bantu, $sl_banden, $giabanvat, $sl_quydoi, $dvt_egpp, $khoa, $max);
    $db->update_giaban_min_max($mshh);
}
