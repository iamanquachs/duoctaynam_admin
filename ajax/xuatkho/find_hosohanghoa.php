<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/sellerClass.php");

$db = new Seller();

$tenhh = $_POST['tenhh'];
$list = $db->find_hosohanghoa($tenhh);
$stt = 1;

foreach ($list as $r) { ?>
    <tr class="active_items_hover" onclick="add_hanghoa('<?= $r->mshh ?>','<?= $r->rowid_tonkho ?>','<?= $r->thuesuat ?>','<?= $r->pttichluy ?>','<?= $r->toncuoi ?>','<?= $r->tenhh ?>','<?= $r->dvtmin ?>', '<?= $r->msnpp ?>')">
        <td scope="col"><?= $stt++ ?></td>
        <td class="mshh_td" hidden><?= $r->mshh ?></td>
        <td class="rowid_tonkho_td" hidden><?= $r->rowid_tonkho ?></td>
        <td class="thuesuat_td" hidden><?= $r->thuesuat ?></td>
        <td class="pttichluy_td" hidden><?= $r->pttichluy ?></td>
        <td class="toncuoi_td" hidden scope="col"><?= $r->toncuoi ?></td>
        <td class="tenhh_td" scope="col"><?= $r->tenhh ?></td>
        <td class="tenhoatchat_td" scope="col"><?= $r->tenhoatchat ?></td>
        <td class="dvt_td" scope="col"><?= $r->dvtmin ?></td>
    </tr>
<?php
}
