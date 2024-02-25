<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/promotionsClass.php");

$db = new Promotions();
$msdv = $_COOKIE['msdv'];
$tenctkm_search = $_POST['tenctkm_search'];
$loai_filter = $_POST['loai_filter'];
$songayhethan = $_POST['songayhethan'];
$tronghan = $_POST['tronghan'];
$ctkm_tungay = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['ctkm_tungay'])));
$ctkm_denngay = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['ctkm_denngay'])));

$db->auto_set_hieuluc();
$list = $db->load_header($msdv, $tenctkm_search, $loai_filter, $songayhethan, $tronghan, $ctkm_tungay, $ctkm_denngay);
$stt = 1;
foreach ($list as $r) {
?>
    <tr class="active_items_hover" onclick=" load_CTKM('<?= $r->msctkm ?>','<?= $r->tenctkm ?>','<?= $r->loaikm ?>'),add_active(this)">
        <td style="text-align: center;"><?= $stt++ ?></td>
        <td hidden class="msctkm_td"><?= $r->msctkm ?></td>
        <td style="text-align: start;"><?= $r->tenctkm ?></td>
    </tr>
<?php
}
