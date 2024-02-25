<?php
$msdn = $_COOKIE['msdn'];
$filename = 'Export/update-export';
require('modules/get_dmphanloai_class.php');
$db = new DMPhanLoai();
$list_loai_xuat = $db->dmphanloai_load('loai_xuat');
$list_nhacc = $db->dmphanloai_load_ncc();
