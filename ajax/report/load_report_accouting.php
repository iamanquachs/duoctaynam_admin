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
$list = $db->load_report_accouting($msdv, $valueSearch, $tungay, $denngay);
$stt = 1;
$dauky = 0;
foreach ($list as $r) {
    if ($r->loai == 1) {
        $dauky = $r->dauky;
?>
        <tr>
            <td style="text-align: end;font-weight: 700;" colspan="9">Đầu kỳ </td>
            <td style="text-align: end;font-weight: 700;" colspan="1"><?= str_replace(',', '.', number_format($dauky)) ?></td>
        </tr>
    <?php
    } else {
        $thu = $r->thu;
        $chi = $r->chi;
        $dauky = ($dauky) + ($thu) - ($chi);
    ?>

        <tr class="active_items_hover" onclick="add_active(this)">
            <td style="text-align: center;"><?= $stt++ ?></td>
            <td style="text-align: start;"><?= $r->ngay ?></td>
            <td style="text-align: start;"><?= $r->soct ?></td>
            <td style="text-align: start;"><?= $r->hoten ?></td>
            <td style="text-align: start;"><?= $r->noidung ?></td>
            <td style="text-align: start;"><?= $r->tenloai ?></td>
            <td style="text-align: start;"><?= $r->tennhanvien ?></td>
            <td style="text-align: end;"><?= str_replace(',', '.', number_format($thu)) ?></td>
            <td style="text-align: end;"><?= str_replace(',', '.', number_format($chi)) ?></td>
            <td style="text-align: end;"><?= str_replace(',', '.', number_format($dauky)) ?></td>
        </tr>
<?php
    }
}
