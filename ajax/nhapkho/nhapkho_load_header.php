<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/nhapkho_class.php");

$db = new NhapKho();

$list = $db->nhapkho_load_header();
$stt = 1;
foreach ($list as $r) {
    $date =   date_create($r->ngayhd) ?>
    <tr id="item_nhapkho_header" onclick="load_chitiet_line(this)">
        <th scope="row"><?= $stt++ ?></th>
        <td><?= date_format($date, "d/m/Y")?></td>
        <td hidden class="soct"><?= $r->soct ?></td>
        <td><?= $r->sohd ?></td>
        <td><?= $r->tenncc ?></td>
        <td><?= str_replace(',', '.', number_format($r->tongcongvat)) ?></td>
    </tr>
<?php
}
