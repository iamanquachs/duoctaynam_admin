<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/homeClass.php");

$db = new Home();
$msdv = $_COOKIE['msdv'];
$thang = $_POST['thang'];
$nam = $_POST['nam'];
$list = $db->tuoino_khachhang($msdv, $thang, $nam);
$stt = 1;
foreach ($list as $r) {
    $date =   date_create($r->ngay) ?>
    <tr id="item_nhapkho_header" class="item_nhapkho_header">
        <th scope="row"><?= $stt++ ?></th>
        <td><?= date_format($date, "d/m/Y") ?></td>
        <td  class="soct"><?= $r->mskh ?></td>
        <td><?= $r->tenkhachhang ?></td>
        <td><?= $r->tuoino ?></td>
    </tr>
<?php
}
