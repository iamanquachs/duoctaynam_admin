<?php
include("../../includes/config.php");
include("../../includes/database.php");
include("../../includes/functions.php");

$msdn = $_POST['msdn'];
$matkhau = $_POST['matkhau'];
$check_user = _check_matkhau($msdn, $matkhau);
if (count($check_user) == 1) {
    foreach ($check_user as $r) {
        $hoten = $r->hoten;
        $msdv = $r->msdv;
        $msdn = $r->msdn;
        $email = $r->email;
        $diachi = $r->diachi;
        $sodienthoai = $r->sodienthoai;
        $loaiuser = $r->loai_user;
        setcookie("hoten", $hoten, time() + 30758400, "/");
        setcookie("msdv", $msdv, time() + 30758400, "/");
        setcookie("msdn", $msdn, time() + 30758400, "/");
        setcookie("sodienthoai", $sodienthoai, time() + 30758400, "/");
        setcookie("diachi", $diachi, time() + 30758400, "/");
        setcookie("email", $email, time() + 30758400, "/");
        setcookie("loaiuser", $loaiuser, time() + 30758400, "/");
    }
}
