<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/reportClass.php");

$db = new Report();
$msdv = $_COOKIE['msdv'];
$valueSearch = $_POST['valueSearch'];
$tungay = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['tungay'])));
$denngay = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['denngay'])));
$list = $db->load_report_import($msdv, $valueSearch, $tungay, $denngay);
$tinh_tonkho = $db_donhang->tinh_tonkho($msdv, date("Y-m-d"), date("Y-m-d"));

$stt = 1;
foreach ($list as $r) {
?>
    <tr class="active_items_hover" onclick="add_active(this)">
        <td style="text-align: center;"><?= $stt++ ?></td>
        <td style="text-align: start;"><?= $r->ngay ?></td>
        <td style="text-align: start;"><?= $r->soct ?></td>
        <td style="text-align: start;"><?= $r->nhacc ?></td>
        <td style="text-align: start;"><?= $r->sanpham ?></td>
        <td style="text-align: end;"><?= $r->solo ?></td>
        <td style="text-align: start;"><?= $r->handung ?></td>
        <td><?= $r->dvt ?></td>
        <td style="text-align: end;"><?= str_replace(',', '.', number_format($r->soluong)) ?></td>
        <td style="text-align: end;"><?= str_replace(',', '.', number_format($r->giaban)) ?></td>
        <td style="text-align: end;"><?= str_replace(',', '.', number_format($r->thanhtiencothue)) ?></td>
    </tr>
<?php
}
