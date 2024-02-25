<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/oms_ims_class.php");

$db = new DonHang();
$soct = $_POST['soct'];
$trangthai = $_POST['trangthai'];
if ($trangthai == 2) {
    $db->capnhat_donhang_danggiao($soct, $trangthai);
} else {
    $db->capnhat_donhang_danhan($soct, $trangthai);
}
