<?php
include("../../../includes/config.php");
include("../../../includes/database.php");
require("../../../modules/khachhangClass.php");

$db_sanpham = new KhachHang();
$mskh = $_POST['mskh'];

$list_img = $db_sanpham->load_hinhanh($mskh);
foreach ($list_img as $r) {
    $image = explode("|", $r->hinhanh);
    foreach ($image as $x) {
        if ($x != '') {
            $url_hinhanh = explode(".", $x)[1];
        }
        if ($x != "" && $url_hinhanh != 'pdf') {
?>
            <div class="img_item col-3">
                <a class="__img" data-img="<?= $x ?>" href="upload/khachhang/<?= $x ?>" target="_blank">
                    <img style="width: 100%;" data-img="<?= $x ?>" src="upload/khachhang/<?= $x ?>">
                </a>
                <img class="img_xoa" onclick="delete_hinhanh(this)" src="vendor/img/xoa16.png">
            </div>

        <?php
        } else if ($x != "" && $url_hinhanh == 'pdf') { ?>
            <div class="img_item col-3">
                <a class="__img" data-img="<?= $x ?>" href="upload/khachhang/<?= $x ?>" target="_blank">
                    <img style="height: 67px;" src="vendor/img/img_pdf.png" />
                </a>
                <img class="img_xoa" onclick="delete_hinhanh(this)" src="vendor/img/xoa16.png">
            </div>
<?php } else {
        }
    }
}
