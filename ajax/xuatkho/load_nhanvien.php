<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/sellerClass.php");

$db = new Seller();

$msdv = $_COOKIE['msdv'];
$sodienthoai = $_POST['sodienthoai'];
$list = $db->load_nhanvien($msdv, $sodienthoai); ?>
<option value=''>Chọn nhân viên</option>
<?php
foreach ($list as $r) { ?>
    <option value='<?= $r->msdn ?>'><?= $r->hoten ?></option>
<?php
}
