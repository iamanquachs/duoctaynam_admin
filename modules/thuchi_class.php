<?php

class Thuchi extends database
{
    public function load_thuchi($msdv, $valueSearch, $tungay, $denngay, $locloai, $khoanmuc)
    {
        $filter = '';
        if ($valueSearch != '') {
            $filter = $filter . "and (a.noidung like '%$valueSearch%' or a.tenmaso like '%$valueSearch%') group by soct";
        }
        if ($locloai != '') {
            $filter = $filter . "and a.loaichungtu ='$locloai'";
        }
        if ($khoanmuc != '') {
            $filter = $filter . "and a.makhoanmuc ='$khoanmuc'";
        }
        $getall = $this->connect->prepare("SELECT  DATE_FORMAT(a.lastmodify, '%H:%i %d/%m/%Y')lastmodify, a.msdv, a.msdn,a.soct, DATE_FORMAT(a.ngay, '%d/%m/%Y')ngaygio , a.maso, a.tenmaso, a.soct_donhang, a.id_thamchieu, a.sohd, abs(a.sotien) as sotien, a.noidung, a.msnhanvien, a.tennhanvien,a.loaichungtu, a.nganquy,a.makhoanmuc, b.tenloai, b.dieukien2 from thuchi a INNER JOIN dmphanloai b ON a.makhoanmuc = b.msloai WHERE a.msdv='$msdv' and ngay between '$tungay' and '$denngay' " . $filter . " order by a.ngay desc, a.loaichungtu  ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function load_khoanmuc($msdv)
    {
        $getall = $this->connect->prepare("SELECT msloai, tenloai, dieukien2 FROM dmphanloai WHERE dieukien1 <> '' AND phanloai = 'khoanmucthuchi' order by dieukien2");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function load_khoanmuc_all($msdv)
    {
        $getall = $this->connect->prepare("SELECT msloai, tenloai, dieukien2 FROM dmphanloai WHERE  phanloai = 'khoanmucthuchi' order by dieukien2");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function load_nhanvien($msdv)
    {
        $getall = $this->connect->prepare("SELECT msdn, hoten, loai_user FROM hosonhanvien where msdv ='$msdv' order by hoten ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function add_thu($msdv, $msdn, $soct, $ngaythu, $sotienthu, $noidungthu, $msnguoinop, $nguoinop, $nganquythu, $khoanmucthu)
    {
        $getall = $this->connect->prepare("INSERT thuchi(msdv, msdn, soct, ngay, maso, tenmaso, soct_donhang, id_thamchieu, sohd, sotien, noidung, msnhanvien, tennhanvien, loaichungtu, nganquy, makhoanmuc) VALUES('$msdv','$msdn','$soct','$ngaythu','','','','','','$sotienthu','$noidungthu','$msnguoinop','$nguoinop','0','$nganquythu','$khoanmucthu')");
        $getall->execute();
    }
    public function add_chi($msdv, $msdn, $soct, $ngaythu, $sotienthu, $noidungthu, $msnguoinop, $nguoinop, $nganquythu, $khoanmucthu)
    {
        $getall = $this->connect->prepare("INSERT thuchi(msdv, msdn, soct, ngay, maso, tenmaso, soct_donhang, id_thamchieu, sohd, sotien, noidung, msnhanvien, tennhanvien, loaichungtu, nganquy, makhoanmuc) VALUES('$msdv','$msdn','$soct','$ngaythu','','','','','','-$sotienthu','$noidungthu','$msnguoinop','$nguoinop','1','$nganquythu','$khoanmucthu')");
        $getall->execute();
    }
    public function edit_thuchi($msdv, $msdn, $soct, $ngaythu, $sotienthu, $noidungthu, $msnguoinop, $nguoinop, $nganquythu, $khoanmucthu)
    {
        $getall = $this->connect->prepare("UPDATE thuchi set lastmodify=NOW(), ngay='$ngaythu',sotien='$sotienthu', noidung='$noidungthu', msnhanvien='$msnguoinop', tennhanvien='$nguoinop', nganquy='$nganquythu', makhoanmuc='$khoanmucthu' where  soct='$soct' and msdv='$msdv'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function delete_thuchi($soct, $msdv)
    {
        $getall = $this->connect->prepare("DELETE from thuchi where soct='$soct' and msdv='$msdv'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function delete_thubanhang($soct, $msdv, $sotien, $soct_donhang)
    {
        $getall = $this->connect->prepare("DELETE from thuchi where soct='$soct' and msdv='$msdv' ; 
        UPDATE xuatkhoheader SET dathanhtoan = dathanhtoan-Abs($sotien) , sophieuthu = REPLACE(sophieuthu, '|$soct','')  where soct='$soct_donhang' and msdv='$msdv'
        ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function delete_chimuahang($soct, $msdv, $sotien, $soct_donhang)
    {
        $getall = $this->connect->prepare("DELETE from thuchi where soct='$soct' and msdv='$msdv';UPDATE nhapkhoheader SET dathanhtoan = dathanhtoan-Abs($sotien), sophieuchi = REPLACE(sophieuchi, '|$soct','')  where soct='$soct_donhang' and msdv='$msdv'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function dieukien1_khoanmuc($loai)
    {
        $getall = $this->connect->prepare("SELECT dieukien1 from dmphanloai where phanloai='khoanmucthuchi' and dieukien2='$loai'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function add_khoanmuc($msdv, $makhoanmuc, $tenkhoanmuc, $dieukien1, $loai)
    {
        $getall = $this->connect->prepare("INSERT dmphanloai(msdv, msloai, tenloai, phanloai, dieukien1, dieukien2) VALUES ('$msdv', '$makhoanmuc', '$tenkhoanmuc', 'khoanmucthuchi', '$dieukien1' + 1, '$loai')");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function delete_khoanmuc($msdv, $msloai, $dieukien2)
    {
        $getall = $this->connect->prepare("DELETE from dmphanloai where msloai='$msloai' and dieukien2='$dieukien2' and msdv='$msdv'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
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
