<?php
$msdn = $_COOKIE['msdn'];
$filename = 'details/items-add';
require('modules/get_dmphanloai_class.php');
$db = new DMPhanLoai();
$List_DMPhanLoai_nhasx = $db->dmphanloai_load('producer');
$List_DMPhanLoai_nuocsx = $db->dmphanloai_load('country');
$List_DMPhanLoai_trangthaihh = $db->dmphanloai_load_trangthaihh('trangthaihh');
$List_DMPhanLoai_bantheodon = $db->dmphanloai_load_bantheodon('bantheodon');
$List_DMPhanLoai_nhomsp = $db->dmphanloai_load_nhomsp('groupproduct');
$List_DMPhanLoai_tieuchuan = $db->dmphanloai_load_tieuchuan('standard');
$List_DMPhanLoai_dvt = $db->dmphanloai_load_dvt('DVT');
$List_DMPhanLoai_loaihh = $db->dmphanloai_load_dvt('loaihh');
