<?php
require('modules/get_dmphanloai_class.php');
require('modules/items_class.php');

$db = new DMPhanLoai();
$db_items = new Items();
$msdn = $_COOKIE['msdn'];
$url = parse_url("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", PHP_URL_QUERY);
$list_sanpham = $db_items->item_load_edit($url);
$sl_min = $list_dvt[0]->slquydoi;
$sl_max = $list_dvt[1]->slquydoi;
$dvt = $list_dvt[0]->dvt;

foreach ($list_sanpham as $r) {
    $tieuchuan = $r->standard;
    $tenhh = $r->tenhh;
    $mshh = $r->mshh;
    $mshhncc = $r->mshhncc;
    $mshhnpp = $r->mshhnpp;
    $msnpp = $r->msnpp;
    $msncc = $r->msncc;
    $ptgiagoc = $r->ptgiagoc;
    $dvtmin = $r->dvtmin;
    $giabanmin = $r->giabanmin;
    $dvtmax = $r->dvtmax;
    $giabanmax = $r->giabanmax;
    $quycach = $r->quycach;
    $slquydoi = $r->slquydoi;
    $tenhoatchat = $r->tenhoatchat;
    $tenbietduoc = $r->tenbietduoc;
    $hamluong = $r->hamluong;
    $thuesuat = $r->thuesuat;
    $tonkhott = $r->tonkhott;
    $msnhom = $r->groupproduct;
    $nuocsx = $r->country;
    $nhasx = $r->producer;
    $loaihh = $r->loaihh;
    $bantheodon = $r->bantheodon;
    $trangthai = $r->trangthai;
    $ghichu = $r->ghichu;
}
$List_DMPhanLoai_nhasx = $db->dmphanloai_load('producer');
$List_DMPhanLoai_nuocsx = $db->dmphanloai_load('country');
$List_DMPhanLoai_trangthaihh = $db->dmphanloai_load_trangthaihh('trangthaihh');
$List_DMPhanLoai_bantheodon = $db->dmphanloai_load_bantheodon('bantheodon');
$List_DMPhanLoai_nhomsp = $db->dmphanloai_load_nhomsp('groupproduct');
$List_DMPhanLoai_tieuchuan = $db->dmphanloai_load_tieuchuan('standard');
$List_DMPhanLoai_dvt = $db->dmphanloai_load_dvt('DVT');
$List_DMPhanLoai_loaihh = $db->dmphanloai_load_dvt('loaihh');

$filename = 'details/items-edit';
