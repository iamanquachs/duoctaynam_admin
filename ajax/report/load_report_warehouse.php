<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/reportClass.php");

$db = new Report();
$msdv = $_COOKIE['msdv'];
$tungay = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['tungay'])));
$denngay = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['denngay'])));
$valueSearch = $_POST['valueSearch'];
$db->tinh_tonkho($msdv, $tungay, $denngay);
$list = $db->load_warehouse($msdv, $valueSearch, $tungay, $denngay);
$stt = 1;
foreach ($list as $r) {
    switch ($r->tinhtrang) {
        case '1':
            $style = 'background-color:orange; border-radius:20px;color:#fff; text-align:end;padding:0px 10px';
            $title = 'Quá hạn';
            break;
        case '2':
            $style = 'background-color:red; border-radius:20px;color:#fff; text-align:end;padding:0px 10px';
            $title = 'Nợ xấu';
            break;
        default:
            $style = '';
            $title = 'Bình thường';
            break;
    }
    if ($r->loai == 0) {
?>
        <tr>
            <td style="text-align: start;font-weight: 700;" colspan="6">Số lượng sản phẩm: <span><?= $r->soluong ?></span></td>
            <td style="text-align: end; font-weight: 700;" colspan="1"><?= str_replace(',', '.', number_format($r->tondau)) ?></td>
            <td style="text-align: end;font-weight: 700;" colspan="1"><?= str_replace(',', '.', number_format($r->tttondau)) ?></td>
            <td style="text-align: end;font-weight: 700;" colspan="1"><?= str_replace(',', '.', number_format($r->tongnhap)) ?></td>
            <td style="text-align: end;font-weight: 700;" colspan="1"><?= str_replace(',', '.', number_format($r->tongxuat)) ?></td>
            <td style="text-align: end;font-weight: 700;" colspan="1"><?= str_replace(',', '.', number_format($r->toncuoi)) ?></td>
            <td style="text-align: end;font-weight: 700;" colspan="1"><?= str_replace(',', '.', number_format($r->tttoncuoi)) ?></td>
        </tr>
    <?php
    } else { ?>
        <tr class="active_items_hover" onclick="add_active(this)">
            <td style="text-align: center;"><?= $stt++ ?></td>
            <td style="text-align: start;"><?= $r->hanghoa ?></td>
            <td style="text-align: center;"><?= $r->dvtmin ?></td>
            <td style="text-align: center;"><?= $r->solo ?></td>
            <td><span style="<?= $style ?>" title='<?= $title ?>' s><?= $r->handung ?></span></td>
            <td style="text-align: end;"><?= str_replace(',', '.', number_format($r->gianhapcothue)) ?></td>
            <td style="text-align: end;"><?= str_replace(',', '.', number_format($r->tondau)) ?></td>
            <td style="text-align: end;"><?= str_replace(',', '.', number_format($r->tttondau)) ?></td>
            <td style="text-align: end;"><?= str_replace(',', '.', number_format($r->tongnhap)) ?></td>
            <td style="text-align: end;"><?= str_replace(',', '.', number_format($r->tongxuat)) ?></td>
            <td style="text-align: end;"><?= str_replace(',', '.', number_format($r->toncuoi)) ?></td>
            <td style="text-align: end;"><?= str_replace(',', '.', number_format($r->tttoncuoi)) ?></td>
        </tr>
<?php
    }
}
