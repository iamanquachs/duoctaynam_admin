<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/items_class.php');
$db = new Items();
$mshh = $_POST['mshh'];
$path_old = $_POST['path_old'];
$file = $_FILES['path_image_child'];

$list_img_child =  $db->Get_image_child($mshh);
$list = $list_img_child[0]->path_image_child;
$items = explode('|', $list);

if ($file != '') {
    $duoi = explode('.', $file['name']); // tách chuỗi khi gặp dấu .
    $duoi = $duoi[(count($duoi) - 1)];
    $path = $mshh . rand(1000, 9999)  . '.' . $duoi;
    $list_path = $list .  $path . '|';
    unlink('../../upload/anhmota/' . $path_old);
    move_uploaded_file($file['tmp_name'], '../../upload/anhmota/' . $path);

    $path_image_child = $list_path;
}

$list = $db->item_update_img_mota($mshh, $path_image_child);
