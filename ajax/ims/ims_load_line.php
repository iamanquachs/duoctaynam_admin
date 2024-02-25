<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/oms_ims_class.php');

$db_donhang = new DonHang();
$soct = $_POST['soct'];
$danhsach_donhang_chitiet = $db_donhang->ims_load_line($soct);
foreach ($danhsach_donhang_chitiet as $r) {
?>
    <tr class="active_items_hover">
        <td class="stt_td"><?= $r->stt ?></td>
        <td class="msnpp_td"><?= $r->msnpp ?></td>
        <td class="mshh_td"> <?= $r->mshh ?></td>
        <td class="left"><?= $r->tenhh ?></td>
        <td class="dvt_td"><?= $r->dvt ?></td>
        <td class="right"><?= $r->soluong ?></td>
        <td class="right"><?= $r->ptgiam ?></td>
        <td class="right"><?= str_replace(',', '.', number_format($r->thanhtienvat)) ?></td>
    </tr>
<?php
}
