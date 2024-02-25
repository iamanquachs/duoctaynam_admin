<?php
include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/items_class.php");

$db = new Items();
$mshh = $_POST['mshh'];
$id_img = explode('?', $_POST['id_img'])[0];
$all_img = $_POST['all_img'];
$item_img = explode('|', $all_img);
$path_image_child = '';
for ($i = 0; $i < count($item_img); $i++) {
    if ($id_img != $item_img[$i]) {
        if ($item_img[$i] != '') {
            $path_image_child = $path_image_child . $item_img[$i] . '|';
        }
    } else {
        unlink('../../upload/anhmota/' . $item_img[$i]);
    }
};

$db->item_update_img_mota($mshh, $path_image_child);
