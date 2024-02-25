<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/nhapkho_class.php");

$db = new NhapKho();
$tenhh = $_POST['tenhh'];

$list = $db->nhapkho_load_hosohanghoa($tenhh);
$stt = 1;
?>
<thead>
    <tr style="background-color: #caf1d3;">
        <th scope="col" style="color: red;">#</th>
        <th scope="col" style="color: red;">Tên thuốc</th>
        <th scope="col" style="color: red;">ĐVT</th>
        <th scope="col" style="color: red;">Số đăng ký</th>
        <th scope="col" style="color: red;">Quy cách</th>
        <th scope="col" style="color: red;">Hàm lượng</th>
    </tr>
</thead>
<tbody id='chitiet_hosohanghoa_line'>

    <?php
    foreach ($list as $r) { ?>
        <tr class="chitiet_hosohanghoa" onclick="chon_hanghoa(this)">
            <th scope="row"><?= $stt++ ?></th>
            <td class="tenhh"><?= $r->tenhh ?></td>
            <td hidden class='mshh'><?= $r->mshh ?></td>
            <td hidden class='giaban'><?= $r->giabanmin ?></td>
            <td hidden class='thuesuat'><?= $r->thuesuat ?></td>
            <td hidden class='gianhap'><?= $r->gianhap ?></td>
            <td hidden class='gianhapvat'><?= $r->gianhapvat ?></td>
            <td hidden class='ptgiaban'><?= $r->ptgiaban ?></td>
            <td class="dvt"><?= $r->dvtmin ?></td>
            <td><?= $r->sodangky ?></td>
            <td><?= $r->quycach ?></td>
            <td><?= $r->hamluong ?></td>
        </tr>
    <?php
    } ?>
</tbody>