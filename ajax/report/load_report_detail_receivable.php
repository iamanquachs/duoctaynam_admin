<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/reportClass.php");

$db = new Report();
$msdv = $_COOKIE['msdv'];
$valueSearch = $_POST['valueSearch'];
$tungay = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['tungay'])));
$denngay = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['denngay'])));
$list_khachhang = $db->load_khachhang($msdv, $tungay);
$stt = 1;
foreach ($list_khachhang as $r) {
    $dauky = $r->dauky;
    $cuoiky = 0;
    $mskh = $r->mskh_bandau;
    $tenkhachhang = $r->tenkhachhang_bandau;
    $list = $db->load_report_detail_receivable($msdv, $mskh, $valueSearch, $tungay, $denngay);
?>
    <tr>
        <td style="text-align: start; color: green; font-weight: 700; text-transform: uppercase;" colspan="6">
            <?= $mskh . ' | ' . $tenkhachhang ?>
        </td>
        <td colspan="1" style="font-weight: 700; text-align: end; ">Đầu kỳ</td>
        <td style="text-align: end; font-weight: 700;" colspan='1'><?= str_replace(',', '.', number_format($r->dauky)) ?></td>
        <td style="text-align: end;" colspan='1'><?= str_replace(',', '.', number_format($r->dauky)) ?></td>
    </tr>
    <?php
    foreach ($list as $e) {
        $cuoiky = $cuoiky + $dauky + $e->tongcongvat - $e->dathanhtoan;
        switch ($e->tinhtrang) {
            case '1':
                $style = 'background-color:orange; border-radius: 50%;padding:0; width:20px; height:20px; text-align:center;color:#fff';
                $title = 'Quá hạn';
                break;
            case '2':
                $style = 'background-color:red; border-radius: 50%;padding:0; width:20px; height:20px; text-align:center;color:#fff';
                $title = 'Nợ xấu';
                break;
            default:
                $style = '';
                $title = 'Bình thường';
                break;
        }
        if ($cuoiky >= $e->dinhmucno) {
            $sty_cuoiky = 'background-color:red; border-radius:20px;color:#fff; text-align:end;padding:0px 10px';
        } else {
            $sty_cuoiky = '';
        }

    ?>
        <tr class="active_items_hover" onclick="add_active(this)">
            <td style="text-align: center;"><?= $stt++ ?></td>
            <td style="text-align: start;"><?= $e->ngay ?></td>
            <td class="mskh_td" hidden><?= $mskh ?></td>
            <td class="tenkh_td" hidden><?= $tenkhachhang ?></td>
            <td class="soct_td" style="text-align: start;"><?= $e->soct ?></td>
            <td class="soctdh_td" hidden style="text-align: start;"><?= $e->soctdh ?></td>
            <td class="sohd_td"><?= $e->sohd ?></td>
            <td style="text-align: end;"><?= str_replace(',', '.', number_format($e->tongcongvat)) ?></td>

            <?php if ($e->tongcongvat == $e->dathanhtoan) {
            ?>
                <td style="text-align: end;" class="dathanhtoan"><?= str_replace(',', '.', number_format($e->dathanhtoan)) ?></td>
            <?php } else { ?>
                <td style="text-align: end; text-decoration:underline;" class="dathanhtoan" onclick="open_modal_thanhtoan(this);load_qr_thanhtoan('<?= $e->soct ?>')"><?= str_replace(',', '.', number_format($e->dathanhtoan)) ?></td>

            <?php
            } ?>
            <td style="text-decoration:underline;" onclick="open_form_chitet_phieuthu('<?= $e->sophieuthu ?>', this)"><?= $e->sophieuthu ?></td>
            <?php if ($e->conno == 0) {
            ?>
                <td style="text-align: end;" class="conno_td"><?= str_replace(',', '.', number_format($e->conno)) ?> </td>

            <?php
            } else { ?>
                <td style="text-align: end;" class="conno_td"><?= str_replace(',', '.', number_format($e->conno)) ?></td>

            <?php } ?>
            <td style="text-align:end;"><span style="<?= $sty_cuoiky ?>"><?= str_replace(',', '.', number_format($cuoiky)) ?></span></td>
            <td style=" display: flex; align-items: center; justify-content: center;"><span style="<?= $style ?>" title="<?= $title ?>"><?= $e->tuoino ?></span></td>
        </tr>
    <?php }

    ?>

<?php
} ?>