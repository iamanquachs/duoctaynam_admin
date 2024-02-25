<?php
$msdn = $_COOKIE['msdn'];
$filename = 'Seller/update-seller';
require("modules/promotionsClass.php");
$db = new Promotions();
$db->auto_set_hieuluc();
require("modules/sellerClass.php");
$db_seller = new Seller();
$list_nhanvien = $db_seller->load_nhanvien($msdv, $sodienthoai);
