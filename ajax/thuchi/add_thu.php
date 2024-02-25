<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/thuchi_class.php");

$db = new Thuchi();
$msdv = $_COOKIE['msdv'];
$msdn = $_COOKIE['msdn'];
$soct = 'ID' . date("dmyHis", time()) . rand(1000, 9999);
$ngaythu = date('Y/m/d', strtotime(str_replace('/', '-',  $_POST['ngaythu'])));
$sotienthu = $_POST['sotienthu'];
$noidungthu = $_POST['noidungthu'];
$msnguoinop = $_POST['msnguoinop'];
$nguoinop = $_POST['nguoinop'];
$nganquythu = $_POST['nganquythu'];
$khoanmucthu = $_POST['khoanmucthu'];
$list = $db->add_thu($msdv, $msdn, $soct, $ngaythu, $sotienthu, $noidungthu, $msnguoinop, $nguoinop, $nganquythu, $khoanmucthu);
