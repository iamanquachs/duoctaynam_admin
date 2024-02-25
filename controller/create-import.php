<?php
$msdn = $_COOKIE['msdn'];
$filename = 'Import/create-import';
require('modules/get_dmphanloai_class.php');
require("modules/nhapkho_class.php");
$db = new DMPhanLoai();
$db_nhapkho = new NhapKho();
$phanloai = 'DVT';
$list_dvt = $db->dmphanloai_load_dvt($phanloai);
// $list_nhacungcap = $db->load_nhacungcap();
