<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/reportClass.php");

$db = new Report();
$msdv = $_COOKIE['msdv'];
$valueSearch = $_POST['valueSearch'];
$tungay = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['tungay'])));
$denngay = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['denngay'])));
$list_nhacc = $db->load_nhacc($msdv, $tungay);
$stt = 1;
foreach ($list_nhacc as $r) {
    $dauky = $r->dauky;
    $cuoiky = 0;
    $msncc = $r->msncc_bandau;
    $tenncc = $r->tenncc_bandau;
    $list = $db->load_report_detail_pay($msdv, $msncc, $valueSearch, $tungay, $denngay);
?>
    <tr>
        <td style="text-align: start; color: green; font-weight: 700; text-transform: uppercase;" colspan="6">
            <?= $msncc . ' | ' . $tenncc ?>
        </td>
        <td colspan="1" style="font-weight: 700; text-align: end; ">Đầu kỳ</td>
        <td style="text-align: end; font-weight: 700;" colspan='1'><?= str_replace(',', '.', number_format($r->dauky)) ?></td>
        <td style="text-align: end;" colspan='1'><?= str_replace(',', '.', number_format($r->dauky)) ?></td>
    </tr>
    <?php
    foreach ($list as $e) {
        $dauky =  $dauky + $e->conno;
    ?>
        <tr class="active_items_hover" onclick="add_active(this)">
            <td style="text-align: center;"><?= $stt++ ?></td>
            <td style="text-align: start;"><?= $e->ngay ?></td>
            <td class="msncc_td" hidden><?= $msncc ?></td>
            <td class="tenncc_td" hidden><?= $tenncc ?></td>
            <td class="soct_td" style="text-align: start;"><?= $e->soct ?></td>
            <td class="sohd_td"><?= $e->sohd ?></td>
            <td style="text-align: end;"><?= str_replace(',', '.', number_format($e->tongcongvat)) ?></td>

            <?php if ($e->tongcongvat == $e->dathanhtoan) {
            ?>
                <td style="text-align: end;" class="dathanhtoan"><?= str_replace(',', '.', number_format($e->dathanhtoan)) ?></td>
            <?php } else { ?>
                <td style="text-align: end; text-decoration:underline;" class="dathanhtoan" onclick="open_post_thuchi(this)"><?= str_replace(',', '.', number_format($e->dathanhtoan)) ?></td>

            <?php
            } ?>
            <td style="text-decoration:underline;" onclick="open_form_chitet_phieuthu('<?= $e->sophieuchi ?>', this)"><?= $e->sophieuchi ?></td>
            <?php if ($e->conno == 0) {
            ?>
                <td style="text-align: end;" class="conno_td"><?= str_replace(',', '.', number_format($e->conno)) ?> </td>

            <?php
            } else { ?>
                <td style="text-align: end;" class="conno_td"><?= str_replace(',', '.', number_format($e->conno)) ?></td>

            <?php } ?>
            <td style="text-align: end;"><span><?= str_replace(',', '.', number_format($dauky)) ?></span></td>
            <td style=" display: flex; align-items: center; justify-content: center;"><span><?= $e->tuoino ?></span></td>
        </tr>
    <?php }

    ?>

<?php
} ?>