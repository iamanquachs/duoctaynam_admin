<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/reportClass.php");

$db = new Report();
$msdv = $_COOKIE['msdv'];
$tungay = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['tungay'])));
$denngay = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['denngay'])));
$valueSearch = $_POST['valueSearch'];
$list = $db->load_report_summary_receivable($msdv,  $valueSearch, $tungay, $denngay);
$stt = 1;
$nodauky = 0;
$phatsinh = 0;
$dathanhtoan = 0;
$notrongky = 0;
$nocuoiky = 0;
foreach ($list as $r) {
    $nodauky = $nodauky + $r->dauky;
    $phatsinh = $phatsinh + $r->phatsinh;
    $dathanhtoan = $dathanhtoan + $r->dathanhtoan;
    $notrongky = $notrongky + $r->notrongky;
    $nocuoiky = $nocuoiky + $r->nocuoiky;
?>
    <tr class="active_items_hover"  onclick="add_active(this)">
        <td style="text-align: center;"><?= $stt++ ?></td>
        <td style="text-align: start;"><?= $r->khachhang ?></td>
        <td style="text-align: end;"><?= str_replace(',', '.', number_format($r->dauky)) ?></td>
        <td style="text-align: end;"><?= str_replace(',', '.', number_format($r->phatsinh)) ?></td>
        <td style="text-align: end;"><?= str_replace(',', '.', number_format($r->dathanhtoan)) ?></td>
        <td style="text-align: end;"><?= str_replace(',', '.', number_format($r->notrongky)) ?></td>
        <?php if ($r->nocuoiky != 0) { ?>
            <td style="text-align: end; color: red;"><?= str_replace(',', '.', number_format($r->nocuoiky)) ?></td>
        <?php } else {
        ?>
            <td style="text-align: end;"><?= str_replace(',', '.', number_format($r->nocuoiky)) ?></td>
        <?php } ?>
    </tr>

<?php
} ?>
<tr>
    <td style="text-align: end;font-weight: 700;" colspan="2">Tổng cộng</td>
    <td style="text-align: end;font-weight: 700;" colspan="1"><?= str_replace(',', '.', number_format($nodauky)) ?></td>
    <td style="text-align: end;font-weight: 700;" colspan="1"><?= str_replace(',', '.', number_format($phatsinh)) ?></td>
    <td style="text-align: end;font-weight: 700;" colspan="1"><?= str_replace(',', '.', number_format($dathanhtoan)) ?></td>
    <td style="text-align: end;font-weight: 700;" colspan="1"><?= str_replace(',', '.', number_format($notrongky)) ?></td>
    <td style="text-align: end;font-weight: 700;" colspan="1"><?= str_replace(',', '.', number_format($nocuoiky)) ?></td>
</tr>