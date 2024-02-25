<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/oms_ims_class.php');
$db_donhang = new DonHang();
$tungay = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['tungay'])));
$denngay = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['denngay'])));
$msdv = $_COOKIE['msdv'];
$msdn = $_COOKIE['msdn'];
$loai_xuat = $_POST['loai_xuat'];
$delete_xuatkho_rac = $db_donhang->delete_xuatkho_rac($msdv, $msdn);
$danhsach_donhang = $db_donhang->load_xuatkho_header($tungay, $denngay, $loai_xuat);
foreach ($danhsach_donhang as $r) {
    $dathanhtoan = str_replace(',', '.', number_format($r->dathanhtoan));
    $conno = ($r->tongcongvat) - ($r->dathanhtoan);
?>
    <tr class="donhanglist_tr active_items_hover items_xuatkho_header" onclick="load_xuatkho_line_xuat(this)">>
        <td class="stt_td"> <?= $r->stt ?></td>
        <td class="soct_td" style="display: none;"><?= $r->soct ?></td>
        <td class="mskh_td" style="display: none;"><?= $r->mskh ?></td>
        <td class="conno_td" style="display: none;"><?= str_replace(',', '.', number_format($conno)) ?></td>
        <td class="sohd_td" style="display: none;"><?= $r->sohd ?></td>
        <td class="soctdh_td" style="display: none;"><?= $r->soctdh ?></td>
        <td class="ngay_td"> <?= $r->ngaygio ?></td>
        <td class="ngay_td"> <?= $r->tenkhachhang ?></td>
        <td class="ngay_td"> <?= $r->loaixuat ?></td>
        <td class="right"><?= str_replace(',', '.', number_format($r->tongcongvat)) ?></td>
        <td class="dathanhtoan" style="display: none;"><?= $r->dathanhtoan ?></td>



    </tr>
<?php
}
