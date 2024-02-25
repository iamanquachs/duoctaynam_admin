<?php
$msdn = $_COOKIE['msdn'];
$filename = 'import';
require("modules/nhapkho_class.php");

$db = new NhapKho();
$list_nhacungcap = $db->load_nhacungcap();
