<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/nhapkho_class.php");

$db = new NhapKho();
$loai = $_POST['loai'];
$tungay = $_POST['tungay'];
$denngay = $_POST['denngay'];

$list = $db->nhapkho_filter($loai, $tungay, $denngay);
$stt = 1;
foreach ($list as $r) {
    $date =   date_create($r->ngayhd);
    $dathanhtoan =  $r->dathanhtoan;
    $conno = str_replace(',', '.', number_format($r->tongcongvat - $r->dathanhtoan));
    $setdathanhtoan = '<td onclick="open_post_thuchi(this)" data-target="#form_post_thuchi" data-toggle="modal"><span style="color:red" >' . str_replace(',', '.', number_format($dathanhtoan)) . '</span></td>';
    if ($r->tongcongvat == $dathanhtoan) {
        $setdathanhtoan = '<td><img  src="vendor/img/check16.png"></td>';
    }
?>
    <tr id="item_nhapkho_header" class="item_nhapkho_header active_items_hover">
        <th scope="row" onclick="load_chitiet_line(this)"><?= $stt++ ?></th>
        <td onclick="load_chitiet_line(this)"><?= date_format($date, "d/m/Y") ?></td>
        <td hidden class="soct"><?= $r->soct ?></td>
        <td hidden class="conno"><?= $conno ?></td>
        <td hidden class="msncc"><?= $r->msncc ?></td>
        <td hidden class="dathanhtoan"><?= $dathanhtoan ?></td>
        <td onclick="load_chitiet_line(this)" class="sohd"><?= $r->sohd ?></td>
        <td onclick="load_chitiet_line(this)" class="ten_ncc"><?= $r->tenncc ?></td>
        <td onclick="load_chitiet_line(this)"><?= str_replace(',', '.', number_format($r->tongcongvat)) ?></td>
        <?= $setdathanhtoan ?>
    </tr>
<?php
}
