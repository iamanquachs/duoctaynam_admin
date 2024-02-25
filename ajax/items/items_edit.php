<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/items_class.php');
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
$msdv = $_COOKIE['msdv'];
$msdn = $_COOKIE['msdn'];
$nhasx = $_POST['nhasx'];
$nuocsx = $_POST['nuocsx'];
$tieuchuan = $_POST['tieuchuan'];
$msnhom = $_POST['msnhom'];
$dvt = $_POST['dvt'];
$msncc = $_POST['msncc'];
$msncchh = $_POST['msncchh'];
$msnpp = $_POST['msnpp'];
$mshhnpp = $_POST['mshhnpp'];
$mshh = $_POST['mshh'];
$tenhh = $_POST['tenhh'];
$tenhc = str_replace('"', "''",  $_POST['tenhc']);
$ghichu = str_replace('"', "''",  $_POST['ghichu']);
$tenbd = $_POST['tenbd'];
$hamluong = $_POST['hamluong'];
$thuesuat = $_POST['thuesuat'];
$tonkhotoithieu = $_POST['tonkhotoithieu'];
$loaihh = $_POST['loaihh'];
$bantheodon = $_POST['bantheodon'];
$trangthaihh = $_POST['trangthaihh'];

$nhomnoibat = $_POST['nhomnoibat'];
$url_hanghoa = locdautiengviet($tenhh) . '.html';

$list = $db->item_edit($msdv, $msdn, $nhasx, $nuocsx, $tieuchuan, $msnhom, $msncc, $msncchh, $msnpp, $mshhnpp, $dvt,  $mshh, $tenhh, $tenhc, $tenbd, $hamluong, $thuesuat,  $tonkhotoithieu, $loaihh, $bantheodon, $trangthaihh,  $url_hanghoa, $nhomnoibat, $ghichu);
$db->update_giaban_min_max($mshh);
