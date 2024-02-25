<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/items_class.php');
$db = new Items();
$msdv = $_COOKIE['msdv'];
$mshh = $_POST['mshh'];
$itemshow = $db->load_hosogiaban($msdv, $mshh);
$stt = 1;
foreach ($itemshow as $r) {
    $stt = $stt++;
?>
    <tr class="donhanglist_tr active_items_hover">
        <td class="stt_td"> <?= $stt ?></td>
        <td class="mshh_td" hidden><?= $r->mshh ?></td>
        <td class="tenhh_td left"><?= $r->ngay ?></td>
        <td class="tenhh_td left"><?= $r->dvt_ban ?></td>
        <td class="tenhc_td right"><?= str_replace(',', '.', number_format($r->sl_bantu)) ?></td>
        <td class="tenhc_td right"><?= str_replace(',', '.', number_format($r->sl_banden)) ?></td>
        <td class="hamluong_td right"><?= str_replace(',', '.', number_format($r->giabanvat)) ?></td>
        <td class="hamluong_td right"><?= $r->dvt_egpp ?></td>
        <td class="hamluong_td right"><?= str_replace(',', '.', number_format($r->slquydoi)) ?></td>
        <td class="hamluong_td right"><?= $r->max ?></td>
        <td><img onclick="open_edit_hosogiaban('<?= $r->rowid ?>','<?= $r->dvt_ban ?>','<?= $r->sl_bantu ?>', '<?= $r->sl_banden ?>','<?= $r->giabanvat ?>','<?= $r->dvt_egpp ?>','<?= $r->slquydoi ?>','<?= $r->khoa ?>','<?= $r->max ?>')" src="./vendor/img/edit16.png"></td>
        <td><img onclick="open_delete_hosogiaban('<?= $r->rowid ?>', '<?= $stt ?>', '<?= $mshh ?>')" src="./vendor/img/xoa16.png"></td>
    </tr>
<?php
}
