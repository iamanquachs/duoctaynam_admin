<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/oms_ims_class.php');
$db_donhang = new DonHang();
$nghiepvu = $_POST['nghiepvu'];
$msdn = $_COOKIE['msdn'];
$soct = $_POST['soct'];
$soctdh = $_POST['soctdh'];
switch ($nghiepvu) {
    case "ims_huydonhang": //hủy đơn hàng
        $kiemtratrangthai = $db_donhang->ims_kiemtra_huy($soctdh);
        foreach ($kiemtratrangthai as $e) {
            echo $trangthai = $e->kq;
        }
        break;
    case "ims_xacnhan_huydonhang": //Hủy đặt hàng
        $db_donhang->ims_huy($msdn, $soct, $soctdh);
        break;
    default:
        break;
}
