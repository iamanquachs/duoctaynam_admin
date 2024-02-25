<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/homeClass.php");

$db = new Home();
$msdv = $_COOKIE['msdv'];
$thang = $_POST['thang'];
$nam = $_POST['nam'];
$list = $db->hanghoa_loinhuancao($msdv, $thang, $nam);
$stt = 1;
foreach ($list as $r) {
     ?>
    <tr id="item_nhapkho_header" class="item_nhapkho_header">
        <th scope="row"><?= $stt++ ?></th>
        <td class="soct"><?= $r->tenhh ?></td>
        <td><?= $r->tenhoatchat ?></td>
        <td><?= str_replace(',', '.', number_format($r->LN)) ?></td>
        <td><?= $r->pt?>%</td>
    </tr>
<?php
}

