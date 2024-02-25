<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/oms_ims_class.php');

$db_donhang = new DonHang();
$soct = $_POST['soct'];
$msdv = $_COOKIE['msdv'];
$danhsach_donhang_chitiet = $db_donhang->oms_load_line($soct);
$tinh_tonkho = $db_donhang->tinh_tonkho($msdv, date("Y-m-d"), date("Y-m-d"));
foreach ($danhsach_donhang_chitiet as $r) {
    $soluong = $r->soluong;
    $mshh = $r->mshh;
    $kt_toncuoi = $db_donhang->oms_kt_toncuoi($mshh, $msdv);
    $toncuoi = '';
    foreach ($kt_toncuoi as $kt) {
        $toncuoi = $kt->toncuoi;
    }
    if ($soluong > $toncuoi) {
        $hinhanh = "warning16.png";
        $tip = "Không đủ tồn kho";
        $loai = 'khong';
    } else {
        $hinhanh = "check16.png";
        $tip = "Đủ tồn kho";
        $loai = "du";
    }
?>
    <tr class="active_items_hover">
        <td class="stt_td"><?= $r->stt ?></td>
        <td class="msnpp_td"><?= $r->msnpp ?></td>
        <td class="rowid_tonkho_td" style="display: none;"><?= $r->rowid_tonkho ?></td>
        <td class="mshh_td left" id="loai_dathang" data-loai="<?= $loai ?>"><?= $r->mshh ?>
            <img src="vendor/img/<?= $hinhanh ?>" title="<?= $tip ?>">
        </td>
        <td class="left"><?= $r->tenhh ?></td>
        <td class="dvt_td"><?= $r->dvt ?></td>
        <td class="right"><?= $r->soluong ?></td>
        <td class="right"><?= $r->ptgiam ?></td>
        <td class="right"><?= str_replace(',', '.', number_format($r->thanhtienvat)) ?></td>
    </tr>
<?php
}
