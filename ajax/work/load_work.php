<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/congviecClass.php");

$db = new Work();
$msdv = $_COOKIE['msdv'];
$msdn = $_COOKIE['msdn'];
$nd_timkiem = $_POST['nd_timkiem'];
$ngaykt = $_POST['ngaykt'];
$nhom = $_POST['nhom'];
$nhanvien = $_POST['nhanvien'];
$trangthai = $_POST['trangthai'];

$list = $db->load_work($msdv, $msdn, $nd_timkiem, $ngaykt, $nhom, $nhanvien, $trangthai);
$stt = 1;
foreach ($list as $r) {

?>
    <tr class="active_items_hover"  onclick="add_active(this)">
        <td scope="col"><?= $stt++ ?></td>
        <td scope="col" class="ngay"><?= $r->ngay ?></td>
        <td scope="col" class="td_msnhom" hidden><?= $r->msnhom ?></td>
        <td scope="col" class="td_mstrangthai" hidden><?= $r->mstrangthai ?></td>
        <td scope="col" class="td_msnhanvien" hidden><?= $r->msnhanvien ?></td>
        <td scope="col" class="td_mscongviec" hidden><?= $r->mscongviec ?></td>
        <td scope="col" class="td_tenkh"><?= $r->tenkhachhang ?></td>
        <td scope="col" class="td_ndcongviec"><?= $r->ndcongviec ?></td>
        <td scope="col" class="td_dienthoai"><?= $r->dienthoai ?></td>
        <td scope="col" class="td_ngaybatdau"><?= $r->ngaybatdau ?></td>
        <td scope="col" class="td_ngayketthuc"><?= $r->ngayketthuc ?></td>
        <td scope="col" class="td_ghichu"><?= $r->ghichu ?></td>
        <td scope="col"><?= $r->tenloai ?></td>
        <td scope="col"><?= $r->hoten ?></td>
        <td scope="col">
            <?php
            switch ($r->mstrangthai) {
                case "0":
                    $hinhanh = "check16.png";
                    $tip = "Chờ kích hoạt";
                    break;
                case "1":
                    $hinhanh = "uncheck16.png";
                    $tip = "Đang kích hoạt";
                    break;
                default:
                    break;
            }
            ?>
            <img src="vendor/img/<?= $hinhanh ?>" title="<?= $tip ?>">
        </td>
        <td scope="col" data-target="#form_edit_congviec" data-toggle="modal" onclick="open_form_edit(this)"><img src="vendor/img/edit16.png" title="Xóa"></td>
    </tr>
<?php } ?>