<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/yeucau_class.php");

$db = new YeuCau();
$list = $db->load_yeucau();
$stt = 1;
foreach ($list as $r) {
    if ($r->url != '') {
        $hinhanh = '<img src="./vendor/img/edit16.png">';
    } else {
        $hinhanh = '<img src="./vendor/img/check16.png">';
    }
?>

    <tr class="active_items_hover" onclick="add_active(this)">
        <td><?= $stt++ ?></td>
        <td class="rowid_yeucau" hidden><?= $r->rowid ?></td>
        <td class="msdn_yeucau" hidden><?= $r->msdn ?></td>
        <td class="msdv_yeucau" hidden><?= $r->msdv ?></td>
        <td><?= $r->ngaygio ?></td>
        <td><?= $r->tenhh ?></td>
        <td><?= $r->tenhc ?></td>
        <td><?= $r->hamluong ?></td>
        <td><?= $r->nhasx ?></td>
        <td><?= $r->ghichu ?></td>
        <td><?= $r->url ?></td>
        <td><?= $r->url_lastmodify ?></td>
        <td data-target="#form_edit_yeucau" onclick="open_edit_yeucau(this)" data-toggle="modal"><?= $hinhanh ?></td>
        <td data-target="#form_delete_yeucau" onclick="open_delete_yeucau(this)" data-toggle="modal"><img src="./vendor/img/xoa16.png"></td>
    </tr>
<?php
}
