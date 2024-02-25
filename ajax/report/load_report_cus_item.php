<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/reportClass.php");

$db = new Report();
$msdv = $_COOKIE['msdv'];
$tungay = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['tungay'])));
$denngay = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['denngay'])));
$valueSearch = $_POST['valueSearch'];
$loaiSearch = $_POST['loaiSearch'];
$list = $db->load_report_cus_item($msdv, $loaiSearch, $valueSearch, $tungay, $denngay);
$stt = 1; ?>
<?php
foreach ($list as $r) {
    if ($r->loai == 1) { ?>
        <tr>
            <td colspan="4" style="text-align: end; font-weight: 700;">Tổng cộng</td>
            <td colspan="1" style="text-align: end; font-weight: 700;"><?= str_replace(',', '.', number_format($r->thanhtien)) ?></td>
            <td colspan="1" style="text-align: end; font-weight: 700;"><?= str_replace(',', '.', number_format($r->loinhuan)) ?></td>
        </tr>
    <?php } else {
    ?>
        <tr class="active_items_hover" onclick="add_active(this)">
            <td style="text-align: center;"><?= $stt++ ?></td>
            <td style="text-align: start;"><?= $r->tenkh ?></td>
            <td style="text-align: start;"><?= $r->sanpham ?></td>
            <td style="text-align: end;"><?= str_replace(',', '.', number_format($r->soluong ))?></td>
            <td style="text-align: end;"><?= str_replace(',', '.', number_format($r->thanhtien)) ?></td>
            <td style="text-align: end;"><?= str_replace(',', '.', number_format($r->loinhuan)) ?></td>
            <td style="text-align: start;"><?= $r->tentinh ?></td>
        </tr>
<?php
    }
}
