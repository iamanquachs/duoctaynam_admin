<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/voucherClass.php");

$db = new voucher();
$loaikh = $_POST['loaikh'];
$mavoucher = 'VC' . date("dmyHis", time()) . rand(1000, 9999);
$loaivoucher = $_POST['loaivoucher'];
$mskh = $_POST['mskh'];
$tenvoucher = $_POST['tenvoucher'];
$sotien = $_POST['sotien'];
$thoihan = date('Y/m/d', strtotime(str_replace('/', '-',  $_POST['thoihan'])));
$list_kh = $db->load_list_kh();
if ($loaikh == 0) {
    foreach ($list_kh as $r) {
        $db->add_voucher($loaivoucher, $r->msdv, $mavoucher, $tenvoucher, $sotien, $thoihan);
    }
} else {
    $db->add_voucher($loaivoucher, $mskh, $mavoucher, $tenvoucher, $sotien, $thoihan);
}
