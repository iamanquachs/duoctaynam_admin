<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/khachhangClass.php');
$db_khachhang = new KhachHang();
$msdv = $_COOKIE['msdv'];
$msdn = $_COOKIE['msdn'];
$tungay = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['tungay'])));
$denngay = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['denngay'])));
$trangthai_post = $_POST['trangthai'];
$loaiuser = $_COOKIE['loaiuser'];
$trangthai = "";
$dieukiennv = "";
if ($loaiuser == '2') {
    $dieukiennv = " and a.msdn = '$msdn' ";
}


if ($trangthai_post != "") {
    $trangthai = " AND a.trangthai = '$trangthai_post' ";
}
$msdn = "";
$msdn_post = $_POST['msdn'];

if ($msdn_post != "") {
    $msdn = " AND a.msdn = '$msdn_post' ";
}
$list = $db_khachhang->khachhang_filter($msdv, $tungay, $denngay, $trangthai, $msdn, $dieukiennv);
$stt = 1;
foreach ($list as $r) {
    $dienthoai_before = str_replace('.', '', $r->dienthoai);
    $dienthoai_format =  substr($dienthoai_before, 0, 4) . '.' . substr($dienthoai_before, 4, 3) . '.' . substr($dienthoai_before, 7, 6); ?>
    <tr class="khachhang_tr" onclick="chitiet_khachhang_load('<?= $r->mskh ?>','<?= $r->tenkh ?>',this)">
        <td><?= $stt ?></td>
        <td style="display: none;" class="mskh_td"><?= $r->mskh ?></td>
        <td style="display: none;" class="trangthai_td"><?= $r->trangthai ?></td>
        <td style="display: none;" class="diachi_td"><?= $r->diachi ?></td>
        <td style="display: none;" class="lydo_td"><?= $r->lydo ?></td>
        <td style="display: none;" class="msxa_td"><?= $r->msxa ?></td>
        <td style="display: none;" class="ngay_td"><?= date('d/m/Y', strtotime($r->ngay)) ?></td>
        <td style="display: none;" class="dienthoai_td search_key"><?= $r->dienthoai ?></td>
        <td style="display: none;" class="tenkh_td"><?= $r->tenkh ?></td>
        <td class="left search_key"><?= $r->tenkh ?></td>
        <td class="center"><?= $dienthoai_format ?></td>
        <td><?= $r->trangthai ?></td>
        <?php
        if ($_COOKIE['loaiuser'] == '2' || $_COOKIE['loaiuser'] == '0') { ?>
            <td onclick="open_khachhang_edit(this)" data-target="#form_edit" data-toggle="modal"><img src="vendor/img/edit16.png"></td>
        <?php } else {
            echo '<td></td>';
        } ?>

        <?php
        if ($_COOKIE['loaiuser'] == '2' || $_COOKIE['loaiuser'] == '0') { ?>
            <td onclick="open_khachhang_delete(this)" data-target="#form_delete" data-toggle="modal"><img src="vendor/img/xoa16.png"></td>
        <?php } else {
            echo '<td></td>';
        } ?>

    </tr>
<?php $stt++;
}
?>