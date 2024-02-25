<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/items_class.php');
$db = new Items();
$mshh = $_POST['mshh'];
$file = $_FILES['path_image'];
if ($file != '') {
    $duoi = explode('.', $file['name']); // tách chuỗi khi gặp dấu .
    $duoi = $duoi[(count($duoi) - 1)]; //lấy ra đuôi file
    $path_image = $mshh . '.' . $duoi;
    move_uploaded_file($file['tmp_name'], '../../upload/sanpham/' . $path_image);
}
$list = $db->item_edit_img_chinh($mshh, $path_image);
