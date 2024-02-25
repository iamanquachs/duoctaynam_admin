<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/oms_ims_class.php');
require('../../modules/sellerClass.php');
$db_donhang = new DonHang();
$db_seller = new Seller();
$nghiepvu = $_POST['nghiepvu'];
$msdv = $_COOKIE['msdv'];
$msdn = $_COOKIE['msdn'];
$soct = $_POST['soct'];
$soctxk = 'XK' . date("dmyHis", time()) . rand(1000, 9999);
$trangthaidonhang = $_POST['ttdonhang'];
$mslydo = $_POST['mslydo'];
$db_seller->tinh_tonkho($msdv, date("Y-m-d"), date("Y-m-d"));
switch ($nghiepvu) {
    case "oms_xacnhan_duyetdon": //xác nhận đặt hàng
        $db_donhang->oms_xacnhan_duyetdon($msdn, $soct, $trangthaidonhang, $soctxk);
        break;
    case "oms_xuatkho": //Hủy đặt hàng
        $list_dathang_line = $db_donhang->oms_list_dathang_line($soct);
        foreach ($list_dathang_line as $r) {
            $mshh=$r->mshh;
            $tach_lo = $db_seller->tinh_soluong_trukho($r->mshh, $r->soluong);
            $list_tru_tonkho = explode('|', $tach_lo[0]->KQ);
            for ($i = 0; $i < count($list_tru_tonkho); $i++) {
                if ($list_tru_tonkho[$i] != '') {
                    $item =  explode(',', $list_tru_tonkho[$i]);
                    $rowid_tonkho = explode(':', $item[0])[1];
                    $soluong = (explode(':', $item[1])[1]);
                    $solo = (explode(':', $item[2])[1]);
                    $handung = (explode(':', $item[3])[1]);
                    $gianhapcothue = (explode(':', $item[4])[1]);
                    $db_donhang->oms_xuatkho_line($rowid_tonkho, $msdv, $msdn, $soct, $soctxk, $soluong, $solo, $handung, $gianhapcothue, $mshh);
                }
            }
        }
        $db_donhang->oms_xuatkho($msdv, $msdn, $soct, $trangthaidonhang, $soctxk);
        break;
    case "oms_huy": //Hủy đặt hàng
        $db_donhang->oms_huy($msdn, $soct, $mslydo);
        break;
    default:
        break;
}
