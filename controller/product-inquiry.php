<?php
$msdn = $_COOKIE['msdn'];
$filename = 'product-inquiry';
require("modules/nhapkho_class.php");

$db = new NhapKho();
$list_nhacungcap = $db->load_nhacungcap();
