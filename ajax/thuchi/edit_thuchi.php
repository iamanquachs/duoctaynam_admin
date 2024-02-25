<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/thuchi_class.php");

$db = new Thuchi();
$msdv = $_COOKIE['msdv'];
$msdn = $_COOKIE['msdn'];
$soct = $_POST['soct'];
$ngaythu = date('Y/m/d', strtotime(str_replace('/', '-',  $_POST['ngaythu'])));
$sotienthu = $_POST['sotienthu'];
$noidungthu = $_POST['noidungthu'];
$msnguoinop = $_POST['msnguoinop'];
$nguoinop = '';
if ($msnguoinop != '') {
    $nguoinop = $_POST['nguoinop'];
}
$nganquythu = $_POST['nganquythu'];
$khoanmucthu = $_POST['khoanmucthu'];
$list = $db->edit_thuchi($msdv, $msdn, $soct, $ngaythu, $sotienthu, $noidungthu, $msnguoinop, $nguoinop, $nganquythu, $khoanmucthu);
