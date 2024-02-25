<?php

class DMPhanLoai extends database
{
    //Show Danh mục phân loại
    public function dmphanloai_load($phanloai)
    {
        $getall = $this->connect->prepare("SELECT msloai, tenloai from dmphanloai where phanloai='$phanloai' order by dieukien1");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Show trạng thái hàng hóa trạng thái hàng hóa
    public function dmphanloai_load_trangthaihh($phanloai)
    {
        $getall = $this->connect->prepare("SELECT msloai, tenloai from dmphanloai where phanloai='$phanloai' order by dieukien1");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Show Danh mục phân loại bán theo đơn
    public function dmphanloai_load_bantheodon($phanloai)
    {
        $getall = $this->connect->prepare("SELECT msloai, tenloai from dmphanloai where phanloai='$phanloai' order by dieukien1 desc");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Show Danh mục phân loại nhóm sản phẩm
    public function dmphanloai_load_nhomsp($phanloai)
    {
        $getall = $this->connect->prepare("SELECT msloai, tenloai from dmphanloai where phanloai='$phanloai' order by tenloai asc, dieukien1");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Show Danh mục phân loại tiêu chuẩn
    public function dmphanloai_load_tieuchuan($phanloai)
    {
        $getall = $this->connect->prepare("SELECT msloai, tenloai from dmphanloai where phanloai='$phanloai' order by dieukien1");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Show Danh mục phân loại đơn vị tính
    public function dmphanloai_load_dvt($phanloai)
    {
        $getall = $this->connect->prepare("SELECT msloai, tenloai from dmphanloai where phanloai='$phanloai' order by  tenloai asc");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function dmphanloai_load_ncc()
    {
        $getall = $this->connect->prepare("SELECT msnsx, tennsx from hoso_ncc_hsx where loai='ncc'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
}
