<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/change_img_class.php');
$db_phanloai = new ChangeImage();
$list =  $db_phanloai->load_img_banner();
foreach ($list as $r) {
    $vitri = $r->vitri;
    $trangthai = $r->trangthai;
    switch ($vitri) {
        case 'TOP_L':
            $loai =  'Slider top left';
            $img = "<img src='vendor/img/icon_banner_header_left.png'>";
            break;
        case 'TOP_R':
            $loai = 'Image top right';
            $img = "<img src='vendor/img/icon_banner_header_right.png'>";
            break;
        case 'MID_L':
            $loai = 'Slider midle left';
            $img = "<img src='vendor/img/icon_banner_header_left.png'>";
            break;
        case 'MID_R':
            $loai = 'Image midle right';
            $img = "<img src='vendor/img/icon_banner_header_right.png'>";
            break;
    }

?>
    <tr class="item_banner" id="item_banner"  onclick="load_hinhanh_phu('<?= $vitri ?>', this)">
        <td class="msnpp_td">
            <?= $loai ?>
            <?= $img ?>
        </td>
        <td hidden class="left"><?= $trangthai ?></td>
        <td><img src="./vendor/img/edit16.png"></td>
    </tr>
<?php
}
