<?php
error_reporting(0);
include("../../../includes/config.php");
include("../../../includes/database.php");
require("../../../modules/khachhangClass.php");

$db = new KhachHang();
$file = $_FILES['file'];
$mskh = $_POST['mskh'];

$list_img = $db->load_hinhanh($mskh);
foreach ($list_img as $r) {
    $img = $r->hinhanh;
}
if ($file != "") {

    $duoi = explode('.', $_FILES['file']['name']); // tách chuỗi khi gặp dấu .
    $duoi = $duoi[(count($duoi) - 1)]; //lấy ra đuôi file
    $before_name_img = explode('/', $mskh); // tách chuỗi khi gặp mshh có dấu /
    $after_name_img = join($before_name_img);
    $hinhanh = $after_name_img . '_' . rand(1000, 9999) . '.' . $duoi;
    move_uploaded_file($_FILES['file']['tmp_name'], '../../../upload/khachhang/' . $hinhanh);
    $hinhanh_new = $img  . $hinhanh . '|';
    $db->add_hinhanh($mskh, $hinhanh_new);
} else { ?>
    <p style="color:red">Lỗi tải hình ảnh</p>
<?php
}
