<?php

class Work extends database
{
    public function load_work($msdv, $msdn, $nd_timkiem, $ngaykt, $nhom, $nhanvien, $trangthai)
    {
        $filter = '';
        if ($nd_timkiem != '') {
            $filter = "and (a.ndcongviec LIKE '%" . $nd_timkiem . "%' or a.tenkhachhang LIKE '%" . $nd_timkiem . "%' or a.dienthoai LIKE '%" . $nd_timkiem . "%')";
        }
        if ($nhom != '') {
            $filter = $filter . "and a.msnhom = '$nhom'";
        }
        if ($nhanvien != '') {
            $filter = $filter . "and a.msnhanvien = '$nhanvien'";
        }
        if ($trangthai != '') {
            $filter = $filter . "and a.mstrangthai = '$trangthai'";
        }
        if ($ngaykt != '') {
            $filter = $filter . "and a.ngayketthuc <= DATE_ADD(CURDATE(), INTERVAL $ngaykt DAY)";
        }
        $getall = $this->connect->prepare("SELECT DATE_FORMAT(a.lastmodify, '%H:%i %d/%m/%Y')ngay,a.msdn,a.msdn,a.mscongviec, a.ndcongviec,a.tenkhachhang,a.dienthoai, a.msnhanvien, a.mstrangthai, a.msnhom, DATE_FORMAT(a.ngaybatdau, '%d/%m/%Y')ngaybatdau, DATE_FORMAT(a.ngayketthuc, '%d/%m/%Y')ngayketthuc, a.ghichu, b.tenloai, c.hoten
         FROM hosocongviec a 
         inner join dmphanloai b on a.msnhom=b.msloai 
         inner join hosonhanvien c on a.msnhanvien=c.msdn 
         WHERE a.msdv = '$msdv' and b.phanloai='nhomcv' " . $filter . " order by a.ngayketthuc desc ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }

    //Load nhóm công việc
    public function load_nhomcv()
    {
        $getall = $this->connect->prepare("SELECT msloai, tenloai FROM dmphanloai 
        WHERE phanloai='nhomcv'  order by tenloai");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }

    //Load nhân viên
    public function load_nhanvien($msdv)
    {
        $getall = $this->connect->prepare("SELECT msdn, hoten FROM hosonhanvien 
         WHERE khoa=0 and msdv='$msdv' order by hoten");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }

    //Edit công việc
    public function add_congviec($msdv, $msdn, $mscongviec, $ndcongviec, $tenkhachhang, $dienthoai, $msnhanvien, $mstrangthai, $msnhom, $ngaybatdau, $ngayketthuc, $ghichu)
    {
        $getall = $this->connect->prepare("INSERT hosocongviec (lastmodify, msdv, msdn, mscongviec, ndcongviec, tenkhachhang, dienthoai, msnhanvien, mstrangthai, msnhom, ngaybatdau, ngayketthuc, ghichu) VALUES (NOW(), '$msdv','$msdn','$mscongviec','$ndcongviec','$tenkhachhang','$dienthoai','$msnhanvien','$mstrangthai','$msnhom','$ngaybatdau','$ngayketthuc','$ghichu') ");
        $getall->execute();
    }
    //Edit công việc
    public function edit_congviec($msdv, $mscongviec, $noidung, $tenkh, $dienthoai, $nhanvien, $nhom, $ngaybd, $ngaykt, $trangthai, $ghichu)
    {
        $getall = $this->connect->prepare("UPDATE hosocongviec set ndcongviec='$noidung', tenkhachhang='$tenkh', dienthoai='$dienthoai', msnhanvien='$nhanvien', msnhom='$nhom', ngaybatdau='$ngaybd', ngayketthuc='$ngaykt', mstrangthai='$trangthai', ghichu='$ghichu' where mscongviec='$mscongviec' and msdv='$msdv'");
        $getall->execute();
    }

    public function add_dmcongviec($msdv, $mscongviec, $tencongviec)
    {
        $getall = $this->connect->prepare("INSERT dmphanloai(msdv, msloai, tenloai, phanloai) VALUES ('$msdv', '$mscongviec', '$tencongviec', 'nhomcv' )");
        $getall->execute();
    }
    public function delete_dmcongviec($msdv, $mscongviec)
    {
        $getall = $this->connect->prepare("DELETE from dmphanloai where msdv='$msdv' and msloai='$mscongviec'");
        $getall->execute();
    }
    public function add_nhanvien($msdv, $manhanvien, $tennhanvien)
    {
        $getall = $this->connect->prepare("INSERT hosonhanvien(msdv, msnpp, msdn, mskho, hoten, matkhau, ngaysinh,gioitinh, diachi, msxa,loai_user, email, khoa,ghichu) VALUES ('$msdv', '', '$manhanvien', '', '$tennhanvien', '202cb962ac59075b964b07152d234b70', '', '','','','1','','0','')");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function delete_nhanvien($msdn, $msdv)
    {
        $getall = $this->connect->prepare("DELETE from hosonhanvien where msdn='$msdn' and msdv='$msdv'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
}
