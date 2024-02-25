<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/homeClass.php");

$db = new Home();
$msdv = $_COOKIE['msdv'];
$thang = $_POST['thang'];
$nam = $_POST['nam'];
$list = $db->doanthu_theokhachhang($msdv, $thang, $nam);
$stt = 1;
foreach ($list as $r) {
?>
    <tr id="item_nhapkho_header" class="item_nhapkho_header">
        <th scope="row"><?= $stt++ ?></th>
        <td class="soct"><?= $r->mskh ?></td>
        <td><?= $r->tenkhachhang ?></td>
        <td><?= str_replace(',', '.', number_format($r->dt)) ?></td>
        <td><?= $r->pt ?>%</td>
    </tr>
<?php
}
