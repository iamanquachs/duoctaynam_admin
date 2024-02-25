<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/reportClass.php");

$db = new Report();
$msdv = $_COOKIE['msdv'];

$valueSearch = $_POST['valueSearch'];
$list = $db->load_report_sale($msdv, $valueSearch);
$stt = 1;
foreach ($list as $r) {
?>
    <tr class="active_items_hover" onclick="add_active(this)">
        <td style="text-align: center;"><?= $stt++ ?></td>
        <td style="text-align: start;"><?= $r->ngay ?></td>
        <td style="text-align: start;"><?= $r->soct ?></td>
        <td style="text-align: start;"><?= $r->tenkh ?></td>
        <td style="text-align: start;"><?= $r->sanpham ?></td>
        <td style="text-align: end;"><?= $r->solo ?></td>
        <td style="text-align: start;"><?= $r->handung ?></td>
        <td><?= $r->dvt ?></td>
        <td style="text-align: end;"><?= str_replace(',', '.', number_format($r->soluong)) ?></td>
        <td style="text-align: end;"><?= str_replace(',', '.', number_format($r->giaban)) ?></td>
        <td style="text-align: end;"><?= str_replace(',', '.', number_format($r->thanhtienvat)) ?></td>
    </tr>
<?php
}
