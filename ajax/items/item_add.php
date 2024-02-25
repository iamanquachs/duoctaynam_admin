<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/items_class.php");

$db = new Items();
function locdautiengviet($str)
{
    $unicode = array(
        'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
        'd' => 'đ',
        'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        'i' => 'í|ì|ỉ|ĩ|ị',
        'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
        'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
        'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'D' => 'Đ',
        'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
        'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
    );
    foreach ($unicode as $nonUnicode => $uni) {
        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
    }
    $str = str_replace(' ', '-', $str);
    return $str;
}
// $mshh = 'ID' . date("dmyHis", time()) . rand(1000, 9999);

$msdv = $_COOKIE['msdv'];
$msdn = $_COOKIE['msdn'];
$mshh = $_POST['mshh'];
$nhasx = $_POST['nhasx'];
$nuocsx = $_POST['nuocsx'];
$tieuchuan = $_POST['tieuchuan'];
$msnhom = $_POST['msnhom'];
$msncc = $_POST['msncc'];
$msncchh = $_POST['msncchh'];
$msnpp = $_POST['msnpp'];
$mshhnpp = $_POST['mshhnpp'];
$dvt = $_POST['dvt'];
$tenhh = $_POST['tenhh'];
$tenhc = str_replace('"', "''", $_POST['tenhc']);
$ghichu = str_replace('"', "''", $_POST['ghichu']);
$tenbd = $_POST['tenbd'];
$hamluong = $_POST['hamluong'];
$thuesuat = $_POST['thuesuat'];
$tonkhotoithieu = $_POST['tonkhotoithieu'];
$loaihh = $_POST['loaihh'];

//Quy đổi nhỏ nhất
$file = $_FILES['file'];
$filemota1 = $_FILES['filemota1'];
$filemota2 = $_FILES['filemota2'];
$filemota3 = $_FILES['filemota3'];
$filemota4 = $_FILES['filemota4'];
$bantheodon = $_POST['bantheodon'];
$trangthaihh = $_POST['trangthaihh'];
$nhomnoibat = $_POST['nhomnoibat'];
if ($filemota1 != null) {
    $duoi = explode('.', $filemota1['name']); // tách chuỗi khi gặp dấu .
    $duoi = $duoi[(count($duoi) - 1)]; //lấy ra đuôi file
    $ten_img_mota1 = $mshh  . rand(1000, 9999) . '.' . $duoi;
    $path_image_mota = $ten_img_mota1 . '|';
    move_uploaded_file($filemota1['tmp_name'], '../../upload/anhmota/' . $ten_img_mota1);
    if ($filemota2 != null) {
        $duoi = explode('.', $filemota2['name']); // tách chuỗi khi gặp dấu .
        $duoi = $duoi[(count($duoi) - 1)]; //lấy ra đuôi file
        $ten_img_mota2 = $mshh  . rand(1000, 9999) . '.' . $duoi;
        $path_image_mota = $ten_img_mota1 . '|' . $ten_img_mota2;
        move_uploaded_file($filemota2['tmp_name'], '../../upload/anhmota/' . $ten_img_mota2);
        if ($filemota3 != null) {
            $duoi = explode('.', $filemota3['name']); // tách chuỗi khi gặp dấu .
            $duoi = $duoi[(count($duoi) - 1)]; //lấy ra đuôi file
            $ten_img_mota3 = $mshh  . rand(1000, 9999) . '.' . $duoi;
            $path_image_mota = $ten_img_mota1 . '|' . $ten_img_mota2 . '|' . $ten_img_mota3;
            move_uploaded_file($filemota3['tmp_name'], '../../upload/anhmota/' . $ten_img_mota3);
            if ($filemota4 != null) {
                $duoi = explode('.', $filemota4['name']); // tách chuỗi khi gặp dấu .
                $duoi = $duoi[(count($duoi) - 1)]; //lấy ra đuôi file
                $ten_img_mota4 = $mshh  . rand(1000, 9999) . '.' . $duoi;
                $path_image_mota = $ten_img_mota1 . '|' . $ten_img_mota2 . '|' . $ten_img_mota3 . '|' . $ten_img_mota4;
                move_uploaded_file($filemota4['tmp_name'], '../../upload/anhmota/' . $ten_img_mota4);
            }
        }
    }
}
if ($file != '') {
    $duoi = explode('.', $file['name']); // tách chuỗi khi gặp dấu .
    $duoi = $duoi[(count($duoi) - 1)]; //lấy ra đuôi file
    $path_image = $mshh . '.' . $duoi;
    move_uploaded_file($file['tmp_name'], '../../upload/sanpham/' . $path_image);
}
$url_hanghoa = locdautiengviet($tenhh) . '.html';

$db->item_add($msdv, $msdn, $nhasx, $nuocsx, $tieuchuan, $msnhom, $msncc, $msncchh, $msnpp, $mshhnpp, $dvt, $mshh, $tenhh, $tenhc, $tenbd, $hamluong, $thuesuat,  $tonkhotoithieu, $loaihh, $bantheodon, $trangthaihh, $path_image, $path_image_mota, $url_hanghoa, $nhomnoibat, $ghichu);
$db->update_giaban_min_max($mshh);
