<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/oms_ims_class.php');
$db_donhang = new DonHang();
$trangthaidonhang = $_POST['mstrangthai_select'];
$tungay = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['tungay'])));
$denngay = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['denngay'])));
$danhsach_donhang = $db_donhang->oms_header($trangthaidonhang, $tungay, $denngay);
foreach ($danhsach_donhang as $r) {
    $trangthaidonhang = $r->trangthaidonhang;
    $conno = str_replace(',', '.', number_format($r->conno))
?>

    <tr class="donhanglist_tr active_items_hover" onclick="oms_load_line(this)">
        <td class="stt_td"> <?= $r->stt ?></td>
        <td class="soct_td" style="display: none;"><?= $r->soct ?></td>
        <td class="mskh_td" style="display: none;"><?= $r->mskh ?></td>
        <td class="tendaidien_td" style="display: none;"><?= $r->tendaidien ?></td>
        <td class="trangthai_td" style="display: none;"><?= $trangthaidonhang ?></td>
        <td class="diachi_td" style="display: none;"><?= $r->diachi ?></td>
        <td class="ngay_td"> <?= $r->ngaygio ?></td>
        <td class="left"><?= $r->tenkhachhang ?></td>
        <td class="sodienthoai_td"><?= $r->dienthoai ?></td>
        <td class="right"><?= str_replace(',', '.', number_format($r->tongcongvat)) ?></td>
        <td class="conno" style="display: none;"><?= $conno ?></td>
        <td class="conno_td">
            <?php
            if ($conno < 0) {
                echo $conno;
            } else {
                echo ('<img src="vendor/img/check16.png">');
            }
            ?>
        </td>

        <td class="trangthai_td">
            <?php
            switch ($trangthaidonhang) {
                case "0":
                    $hinhanh = "uncheck16.png";
                    $tip = "Chưa xác nhận";
                    break;
                case "1":
                    $hinhanh = "check16.png";
                    $tip = "Đã xác nhận";
                    break;
                case "2":
                    $hinhanh = "ship16.png";
                    $tip = "Đang giao";
                    break;
                case "3":
                    $hinhanh = "ship16.png";
                    $tip = "Đã giao";
                    break;
                case "4":
                    $hinhanh = "box16.png";
                    $tip = "Đã nhận";
                    break;
                case "5":
                    $hinhanh = "xoa16.png";
                    $tip = "Đã hủy";
                    break;
                default:
                    break;
            }
            ?>
            <img src="vendor/img/<?= $hinhanh ?>" title="<?= $tip ?>">
        </td>
    </tr>
<?php
}
