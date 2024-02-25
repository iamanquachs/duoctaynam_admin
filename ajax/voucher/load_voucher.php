<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/voucherClass.php");

$db = new voucher();
$tungay = date('Y/m/d', strtotime(str_replace('/', '-',  $_POST['tungay'])));;
$denngay = date('Y/m/d', strtotime(str_replace('/', '-',  $_POST['denngay'])));;
$value_filter = $_POST['value'];
$loaivoucher = $_POST['loaivoucher'];
$trangthai = $_POST['trangthai'];
$list = $db->list_voucher($value_filter, $tungay, $denngay, $loaivoucher, $trangthai);
$stt = 1;
foreach ($list as $r) { ?>
    <tr>
        <td class="stt" style="text-align: center;"><?= $stt++ ?></td>
        <td class="stt" style="text-align: start;"><?= $r->ngay ?></td>
        <td class="mavoucher" hidden><?= $r->mavoucher ?></td>
        <td class="rowid_td" hidden><?= $r->rowid ?></td>
        <td class="tenvoucher" style="text-align: start;"><?= $r->tenvoucher ?></td>
        <td class="mskh"><?= $r->mskh ?></td>
        <td class="sotien" style="text-align: end;"><?= str_replace(',', '.', number_format($r->sotien)) ?></td>
        <td class="mabaomat" hidden><?= $r->mabaomat ?></td>
        <td class="loai"><?= $r->loai == 'FS' ? 'Free ship' : 'Giảm giá' ?></td>
        <td class="thoihan"><?= $r->thoihan ?></td>
        <td class="trangthai"><?= $r->trangthai == '1' ? 'Đã dùng' : 'Chưa dùng' ?></td>
        <td onclick="open_delete_voucher('<?= $r->rowid ?>', '<?= $r->mskh ?>')"><img src='./vendor/img/xoa16.png'></td>
    </tr>
<?php }
