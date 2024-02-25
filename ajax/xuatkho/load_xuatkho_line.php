<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/sellerClass.php");

$db = new Seller();

$msdv = $_COOKIE['msdv'];
$soct = $_POST['soct'];
$list = $db->load_xuatkho_line($msdv, $soct);
$stt = 1;
foreach ($list as $r) { ?>
    <tr class="active_items_hover">
        <td scope="col"><?= $stt++ ?></td>
        <td class="mshh_line_td" hidden><?= $r->mshh ?></td>
        <td class="msctkm_line_td" hidden><?= $r->msctkm ?></td>
        <td class="tenhh_line_td" style="text-align: left;" scope="col"><?= $r->auto_post ? "<span style='color:red'>(KM thêm) </span>" . $r->tenhh : $r->tenhh ?></td>
        <td class="dvt_line_td" scope="col"><?= $r->dvt ?></td>
        <td class="solo_line_td" style="text-align: right;" scope="col"><?= $r->solo ?></td>
        <td class="dvt_line_td" scope="col"><?= $r->handung ?></td>
        <td class="ptgiam_line_td" scope="col"><?= $r->ptgiam ?></td>
        <td class="giaban_line_td" style="text-align: right;" scope="col"><?= str_replace(',', '.', number_format($r->giaban)) ?></td>
        <td class="soluong_line_td" scope="col"><?= $r->soluong ?></td>
        <td class="thanhtien_line_td" style="text-align: right;" scope="col"><?= str_replace(',', '.', number_format($r->thanhtienvat)) ?></td>
        <td onclick="open_modal_delete('<?= $r->mshh ?>', '<?= $r->rowid ?>', '<?= $r->tenhh ?>', '<?= $r->msctkm ?>')" scope="col"><img src='./vendor/img/xoa16.png'></td>
    </tr>
<?php
}
