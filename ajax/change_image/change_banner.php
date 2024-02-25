<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/change_img_class.php');
$db_phanloai = new ChangeImage();
$vitri = $_POST['vitri'];
$vitri_header = $_POST['vitri_header'];
$ten_banner = explode('.', $_POST['ten_banner'])[0];
$file = $_FILES['file'];
$file_pdf = $_FILES['file_pdf'];
$path_image = $_POST['ten_banner'];
$path_pdf = $_POST['ten_pdf'];
if ($file != '') {
    $duoi = explode('.', $file['name']); // tách chuỗi khi gặp dấu .
    $duoi = $duoi[(count($duoi) - 1)]; //lấy ra đuôi file
    $path_image = $ten_banner . '.' . $duoi;
    unlink('../../upload/banner/' . $path_image);
    move_uploaded_file($file['tmp_name'], '../../upload/banner/' . $path_image);
}
if ($file_pdf != '') {
    $duoi = explode('.', $file_pdf['name']); // tách chuỗi khi gặp dấu .
    $duoi = $duoi[(count($duoi) - 1)]; //lấy ra đuôi file_pdf
    $path_pdf = $ten_banner . '.' . $duoi;
    unlink('../../upload/pdf/' . $path_pdf);
    move_uploaded_file($file_pdf['tmp_name'], '../../upload/pdf/' . $path_pdf);
}
$list =  $db_phanloai->change_banner($vitri, $path_image, $vitri_header, $path_pdf);
