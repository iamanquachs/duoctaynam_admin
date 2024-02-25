<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/sellerClass.php");

$db = new Seller();
$msdv = $_COOKIE['msdv'];
$tenhh = $_POST['tenhh'];
$loai = $_POST['loai'];
$stt = 1;
if ($loai == 'XTC') {
    $list = $db->load_xuattra($msdv, $tenhh);
} else {
    $list = $db->load_xuat_hube_hethan($msdv, $tenhh);
} ?>
<thead>
    <tr>
        <th style="color:red" scope="col">#</th>
        <th style="color:red" scope="col">Tên thuốc</th>
        <th style="color:red" scope="col">ĐVT</th>
        <th style="color:red" scope="col">Số lô</th>
        <th style="color:red" scope="col">Hạn dùng</th>
        <th style="color:red" scope="col">Giá nhập VAT</th>
        <th style="color:red" scope="col">SL</th>
        <th style="color:red" scope="col">Số HD</th>
        <th style="color:red" scope="col">Ngày HD</th>
        <th style="color:red" scope="col">Tên NCC</th>
    </tr>
</thead>
<tbody>
    <?php
    foreach ($list as $r) { ?>
        <tr class="active_items_hover" onclick="add_hanghoa_xuat('<?= $r->mshh ?>','<?= $r->tenhh ?>','<?= $r->dvt ?>','<?= $r->solo ?>','<?= $r->handung ?>','<?= $r->gianhapcothue ?>','<?= $r->sohd ?>', '<?= $r->ngayhd ?>', '<?= $r->tenncc ?>')">
            <td scope="col"><?= $stt++ ?></td>
            <td class="mshh_td" hidden><?= $r->mshh ?></td>
            <td style="text-align: left;" class="tenhh_td"><?= $r->tenhh ?></td>
            <td class="dvt_td"><?= $r->dvt ?></td>
            <td class="solo_td"><?= $r->solo ?></td>
            <td style="text-align: right;" class="handung_td" scope="col"><?= $r->handung ?></td>
            <td class="gianhapcothue_td" scope="col"><?= str_replace(',', '.', number_format($r->gianhapcothue)) ?></td>
            <td class="sohd_td" scope="col"><?= $r->soluong ?></td>
            <td class="sohd_td" scope="col"><?= $r->sohd ?></td>
            <td class="ngayhd_td" scope="col"><?= $r->ngayhd ?></td>
            <td style="text-align: left;" class="tenncc_td" scope="col"><?= $r->tenncc ?></td>
        </tr>
    <?php
    } ?>
</tbody>