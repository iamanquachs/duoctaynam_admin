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
$msloai = $_POST['msloai'];
$tenloai = $_POST['tenloai'];
$phanloai = $_POST['phanloai'];
$dieukien2 = '';
if ($phanloai == 'groupproduct') {
    $dieukien2 = locdautiengviet($tenloai);
}
$ktr_msloai = $db->ktr_msloai($msloai, $phanloai);

if ($phanloai == 'dvt') {
    $msloai = 'ID' . date("dmyHis", time()) . rand(10000, 99999);
}
if (count($ktr_msloai) == 0) {
    $db->add_phanloai($msdv, $msloai, $tenloai, $phanloai, $dieukien2);
} else {
    header('Content-Type: application/json');
    echo json_encode("err");
}
