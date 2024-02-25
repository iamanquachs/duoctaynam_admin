<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/promotionsClass.php");

$db = new Promotions();
$msdv = $_COOKIE['msdv'];
$msctkm = $_POST['msctkm'];
$loai_filter = $_POST['loai_filter'];
$songayhethan = $_POST['songayhethan'];
$tronghan = $_POST['tronghan'];
$ctkm_tungay = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['ctkm_tungay'])));
$ctkm_denngay = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['ctkm_denngay'])));

$list = $db->load_CTKM($msdv, $msctkm, $loai_filter, $songayhethan, $tronghan, $ctkm_tungay, $ctkm_denngay);

$stt = 1;
foreach ($list as $r) {
    switch ($r->khoa) {
        case '0':
            $img = './vendor/img/check16.png';
            $khoa = 1;
            break;
        default:
            $img = './vendor/img/lock16.png';
            $khoa = 0;
            break;
    }

?>
    <tr class="active_items_hover" onclick="add_active(this)">
        <td class="stt_td" style="text-align: center;"><?= $stt++ ?></td>
        <td class="msctkm_td"><?= $r->mshh ?></td>
        <td style="text-align: start;"><?= $r->tenhh ?></td>
        <td><?= $r->ptgiam ?></td>
        <td><?= $r->mshh_mua ?></td>
        <td><?= $r->sl_mua ?></td>
        <td><?= $r->sl_tang ?></td>
        <td><?= $r->tungay ?></td>
        <td><?= $r->denngay ?></td>
        <td>
            <img onclick="edit_CTKM('<?= $khoa ?>','<?= $r->rowid ?>','<?= $msctkm ?>')" src='<?= $img ?>'>
        </td>
        <td onclick="open_delete_form('<?= $r->rowid ?>','<?= $msctkm ?>', this)"><img src='./vendor/img/xoa16.png'></td>
    </tr>
<?php
}
