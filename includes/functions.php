<?php
function _check_matkhau($msdn, $matkhau)
{
    $database = new database();
    $getall = $database->connect->prepare("SELECT * FROM hosonhanvien WHERE msdn = '$msdn' and matkhau = md5('$matkhau') and khoa = '0'");
    $getall->setFetchMode(PDO::FETCH_OBJ);
    $getall->execute(array(md5($matkhau)));
    return $getall->fetchAll();
}

function _check_loai_user($msdn)
{
    $database = new database();
    $getall = $database->connect->prepare("SELECT loai_user FROM hosonhanvien WHERE msdn = '$msdn'");
    $getall->setFetchMode(PDO::FETCH_OBJ);
    $getall->execute();

    return $getall->fetchAll();
}
