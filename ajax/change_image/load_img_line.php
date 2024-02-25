<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/change_img_class.php');
$db_phanloai = new ChangeImage();
$vitri = $_POST['vitri'];
$list =  $db_phanloai->load_img_banner_line($vitri);
$link_pdf = 'https://erp.duoctaynam.vn/upload/pdf/';
foreach ($list as $r) {
    $vitri_line = $r->vitri;
    switch ($vitri_line) {
        case 'slider_1':
            $loai =  'Slider 1';
            break;
        case 'slider_2':
            $loai = 'Slider 2';
            break;
        case 'slider_3':
            $loai = 'Slider 3';
            break;
        case 'img_r_top':
            $loai = 'Ảnh bên phải phía trên';
            break;
        case 'img_r_bottom':
            $loai = 'Ảnh bên phải phía dưới';
            break;
    }

?>
    <tr>
        <td hidden class="vitri_header"><?= $vitri ?></td>
        <td class="msnpp_td">
            <?= $loai ?>
        </td>
        <td style="display: flex; justify-content:center ;">
            <div style="max-width: 500px;">
                <img style="width: 100%;" src='<?= $r->url_image . $r->path_image . '?v=' . $r->lastmodify ?> ' />
            </div>
        </td>
        <td class="msnpp_td" style="position:relative; ">
            <a href="<?= $link_pdf . $r->path_pdf . '?v=' . $r->lastmodify ?>" target="_blank">
                <?= $r->path_pdf ? '<img src="./vendor/img/pdf.png">
             ' : '' ?>
            </a>
            <?= $r->path_pdf ? '<img onclick="delete_pdf(' . '`' . "$vitri_line" . '`' . ',' . '`' . "$r->path_pdf" . '`' . ',' . '`' . "$r->vitri_header" . '`' . ')" style="position:absolute; top:0px; right:0px; z-index:99" src="./vendor/img/xoa16.png">' : '' ?>
        </td>
        <td onclick="open_change_image(this, '<?= $vitri_line ?>', '<?= $r->path_image ?>', '<?= $r->path_pdf ?>')"><img src="./vendor/img/edit16.png"></td>
    </tr>
<?php
}
