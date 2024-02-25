<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/nhapkho_class.php");

$db = new NhapKho();
$soct = $_POST['soct'];

$list = $db->nhapkho_load_line($soct);
$stt = 1;
foreach ($list as $r) {
    $date = date_create($r->handung); ?>
    <tr class="active_items_hover" id='item_nhapkho'>
        <th scope="row"><?= $stt++ ?></th>
        <td class="tenhh_line"><?= $r->tenhh ?></td>
        <td hidden class='soct'><?= $r->soct ?></td>
        <td hidden class='rowid'><?= $r->rowid ?></td>
        <td hidden class='mshh' id='mshh_line'><?= $r->mshh ?></td>
        <td class="dvt_line"><?= $r->dvt ?></td>
        <td class="solo_line"><?= $r->solo ?></td>
        <td class="handung_line"><?= date_format($date, "d/m/Y") ?></td>
        <td class="gianhap_line"><?= str_replace(',', '.', number_format($r->gianhapchuack)) ?></td>
        <td class="chietkhau_line"><?= str_replace(',', '.', number_format($r->tienchietkhau)) . '(' . $r->chietkhau . '%)' ?></td>
        <td class="vat_line"><?= $r->thuesuat ?></td>
        <td class="soluong_line"><?= $r->soluong ?></td>
        <td class="thanhtien_line"><?= str_replace(',', '.', number_format($r->gianhapcothue * $r->soluong)) ?></td>
    </tr>
<?php
}
