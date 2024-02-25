<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/items_class.php');
$db = new Items();
$msnhom = $_POST['msnhom'];
$msncc = $_POST['msncc'];
$tieuchuan = $_POST['tieuchuan'];
$msnsx = $_POST['msnsx'];
$loaihh = $_POST['loaihh'];
$trangthai = $_POST['trangthai'];
$group_sp = $_POST['group_sp'];

$itemshow = $db->item_show($msnhom, $msncc, $tieuchuan, $msnsx, $loaihh, $trangthai, $group_sp);

foreach ($itemshow as $r) {
    $trangthai = $r->trangthai;
    $nhomnoibat = $r->group_sp;
?>
    <tr class="donhanglist_tr active_items_hover" onclick="item_get_mshh(this)">
        <td class="stt_td"> <?= $r->stt ?></td>
        <td class="mshh_td"><?= $r->mshh ?></td>
        <td class="rowid_td" style="display: none;"><?= $r->rowid ?></td>
        <td class="tenhh_td left" style="color: darkgreen;"><?= $r->tenhh ?></td>
        <td class="tenhc_td left"><?= $r->tenhoatchat ?></td>
        <td class="hamluong_td"><?= $r->hamluong ?></td>
        <td class="gianhapvat_td"><?= str_replace(',', '.', number_format($r->gianhapvat)) ?></td>

        <td class="giaban_td" style="color: red;"><?= ($r->giaban) ?></td>
        <td class="quycachdg_td"><?= $r->quycach ?></td>
        <td class="tieuchuan_td"><?= $r->standard ?></td>
        <td class="msncc_td"><?= $r->msncc ?></td>
        <td class="msnhasx_td"><?= $r->producer ?></td>
        <td class="msnhom_td"><?= $r->groupproduct ?></td>
        <td class="nhomnoibat_td"> <?php
                                    switch ($nhomnoibat) {
                                        case "0": ?>
                    <p>Không</p>
                <?php
                                            break;
                                        case "1": ?>
                    <p style="color: red; font-weight: 600;">Có</p>

            <?php
                                            break;
                                        case "99":
                                            $hinhanh = "lock16.png";
                                            $tip = "Đang khóa";
                                            break;
                                        default:
                                            break;
                                    }
            ?>
        </td>
        <td>
            <a href="items-edit?<?= $r->mshh ?>">
                <img src="vendor/img/edit16.png">
            </a>
        </td>
        <td class="trangthai_edit" style="display: none;"><?= $r->trangthai ?></td>
        <td class="trangthai_td" data-target="#form_xacnhan" data-toggle="modal" onclick="open_modal_xacnhan(this)">
            <?php
            switch ($trangthai) {
                case "0":
                    $hinhanh = "uncheck16.png";
                    $tip = "Chờ kích hoạt";
                    break;
                case "1":
                    $hinhanh = "check16.png";
                    $tip = "Đang kích hoạt";
                    break;
                case "99":
                    $hinhanh = "lock16.png";
                    $tip = "Đang khóa";
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
