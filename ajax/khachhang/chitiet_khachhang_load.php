<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/khachhangClass.php');
$db = new KhachHang();
$msdv = $_COOKIE['msdv'];
$mskh = $_POST['mskh'];
$danhsach_khachhang = $db->khachhang_chitiet_load($msdv, $mskh);
$stt = 1;
foreach ($danhsach_khachhang as $r) {
    $list_trangthai = $db->_getname_trangthai_ctkh($msdv, $r->trangthai);
?>
    <tr class="active_items_hover">
        <td class="ctkh_stt_td"><?= $stt ?></td>
        <td style="display: none;" class="ctkh_mskh_td"><?= $r->mskh ?></td>
        <td style="display: none;" class="ctkh_msct_td"><?= $r->msct ?></td>
        <td style="display: none;" class="ctkh_tendv_td"><?= $r->tenkh ?></td>
        <td style="display: none;" class="ctkh_sothangkm_td"><?= $r->sothangkm ?></td>
        <td style="display: none;" class="ctkh_tungay_td"><?= date('d/m/Y', strtotime($r->tungay)) ?></td>
        <td style="display: none;" class="ctkh_denngay_td"><?= date('d/m/Y', strtotime($r->denngay)) ?></td>
        <td style="display: none;" class="ctkh_loaihopdong_td"><?= $r->loaihopdong ?></td>
        <td style="display: none;" class="ctkh_loaiphanmem_td"><?= $r->loaiphanmem ?></td>
        <td><?= date('d/m/y H:i', strtotime($r->lastmodify)) ?></td>
        <td><?= $db->_getname_tennhanvien($msdv, $r->msdn) ?></td>
        <td class="ctkh_yeucau_td"><?= $r->yeucau ?></td>
        <td class="ctkh_note_td"><?= $r->note ?></td>
        <td class="ctkh_noidung_td"><?= $r->noidung ?></td>
        <td class="ctkh_gia_td"><?= str_replace(',', '.', number_format($r->gia)) ?></td>
        <td style="display: none;" class="ctkh_ngay_td"><?= date('d/m/Y', strtotime($r->ngay)) ?></td>
        <td style="display: none;" class="ctkh_trangthai_td"><?= $r->trangthai ?></td>
        <td style="display: none;" class="ctkh_link_td"><?= $r->linktailieu ?></td>
        <?php
        if ($list_trangthai == 'Đã chốt') { ?>
            <td class="trangthai_td" onclick="open_form_chot()" data-toggle="modal" data-target="#form_chot_kh"><?= $db->_getname_trangthai_ctkh($msdv, $r->trangthai) ?> <img src="vendor/img/next_24.png" /></td>
        <?php } else { ?>
            <td class=""><?= $db->_getname_trangthai_ctkh($msdv, $r->trangthai) ?></td>
        <?php }
        ?>
        <?php
        if ($_COOKIE['loaiuser'] == '2' || $_COOKIE['loaiuser'] == '0') { ?>
            <td onclick="open_ctkh_edit(this)" data-toggle="modal" data-target="#form_chitiet_edit"><img src="vendor/img/edit16.png" alt=""></td>
        <?php } else {
            echo '<td></td>';
        }
        ?>
        <?php
        if ($_COOKIE['loaiuser'] == '2' || $_COOKIE['loaiuser'] == '0') { ?>
            <td onclick="open_ctkh_delete(this)" data-toggle="modal" data-target="#form_chitiet_delete"><img src="vendor/img/xoa16.png" alt=""></td>
        <?php } else {
            echo '<td></td>';
        }
        ?>

    </tr>
<?php $stt++;
}
