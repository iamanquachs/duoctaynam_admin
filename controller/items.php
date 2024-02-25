<?php
$msdn = $_COOKIE['msdn'];
$filename = 'items';
require('modules/get_dmphanloai_class.php');
$db = new DMPhanLoai();
$List_DMPhanLoai_trangthaihh = $db->dmphanloai_load_trangthaihh('trangthaihh');
$List_DMPhanLoai_nhasx = $db->dmphanloai_load('producer');
$List_DMPhanLoai_bantheodon = $db->dmphanloai_load_bantheodon('bantheodon');
$List_DMPhanLoai_nhomsp = $db->dmphanloai_load_nhomsp('groupproduct');
$List_DMPhanLoai_tieuchuan = $db->dmphanloai_load_tieuchuan('standard');
$List_DMPhanLoai_loaihh = $db->dmphanloai_load_dvt('loaihh');
$List_DMPhanLoai_ncc = $db->dmphanloai_load_ncc();



// require('modules/items_class.php');
// $db_i = new Items();
// $list_ac = $db_i->ac();
// foreach ($list_ac as $r) {
//     $db_i->update_giaban_min_max($r->mshh);
// }
