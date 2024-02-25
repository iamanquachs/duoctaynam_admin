<?php

class KhachHang extends database
{

    //todo filter danh sách khách hàng
    public function khachhang_filter($msdv, $tungay, $denngay, $trangthai, $msdn, $dieukiennv)
    {
        $getall = $this->connect->prepare("SELECT a.tenkh,a.lydo,a.mskh,'' trangthai,a.diachi,a.dienthoai,a.ngay,a.msxa from crm_khachhang a where a.msdv = '$msdv' and a.ngay between '$tungay' and '$denngay' " . $trangthai . $msdn . "  and a.xoa = 0 " . $dieukiennv . "  order by a.rowid DESC");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //todo lấy danh sách khách hàng
    public function khachhang_chitiet_load($msdv, $mskh)
    {
        $getall = $this->connect->prepare("SELECT a.linktailieu,a.msct,a.mskh,a.yeucau,a.trangthai,a.note,a.msdn,a.tenkh,a.msdn,a.lastmodify,a.gia,a.ngay,a.sothangkm,a.loaiphanmem,a.loaihopdong,a.tungay,a.denngay, CONCAT(loaiphanmem, ' ● ', loaihopdong,' ● ', DATE_FORMAT(tungay,'%d/%m/%y'), '-',DATE_FORMAT(denngay,'%d/%m/%y'))noidung from crm_khachhang_chitiet a where a.msdv = '$msdv' and a.mskh='$mskh' and a.xoa = 0 order by a.rowid DESC");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //todo lấy danh sách trạng thái
    public function list_trangthai($msdv)
    {
        $getall = $this->connect->prepare("SELECT msloai,tenloai from dmphanloai where msdv='$msdv' and phanloai='trangthaikhachhang'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }

    //todo lấy danh sách trạng thái chi tiết khách hàng
    public function list_trangthai_ctkh($msdv)
    {
        $getall = $this->connect->prepare("SELECT msloai,tenloai from dmphanloai where msdv='$msdv' and phanloai='trangthai_ctkh'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //todo lấy danh sách lý do
    public function list_lydo($msdv)
    {
        $getall = $this->connect->prepare("SELECT msloai,tenloai from dmphanloai where msdv='$msdv' and phanloai='lydokhachhang'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function list_user($msdv)
    {
        $getall = $this->connect->prepare("SELECT msdn, hoten FROM hosonhanvien where msdv='$msdv' ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //todo thêm khách hàng 
    public function khachhang_add($msdv, $tendv, $msdn, $msctv, $ngay, $mskh, $tenkh, $dienthoai, $diachi, $maxa, $trangthai, $lydo)
    {
        $getall = $this->connect->prepare("INSERT INTO crm_khachhang(lastmodify,msdv,tendv,msdn,msctv,ngay,mskh,tenkh,dienthoai,diachi,msxa,lydo)
        VALUES (NOW(),'$msdv','$tendv','$msdn','$msctv','$ngay','$mskh','$tenkh','$dienthoai','$diachi','$maxa','$lydo'); 
        INSERT INTO crm_khachhang_chitiet(lastmodify, msct,msdv,msdn,mskh,tenkh,note,yeucau,gia,trangthai,linktailieu, tungay, denngay)
         VALUES (NOW(),'$mskh','$msdv','$msdn','$mskh','$tenkh','Thêm mới khách hàng','','0','4','','$ngay','$ngay')
         ");
        $getall->execute();
    }
    //todo kt tồn tại khách hàng
    public function kt_tontai_khachhang($mskh, $denngay)
    {
        $getall = $this->connect->prepare("SELECT rowid from crm_khachhang_chitiet where mskh = '$mskh' and denngay = '$denngay'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //todo chỉnh sửa khách hàng 
    public function khachhang_edit($msdv, $tendv, $msdn, $ngay, $mskh, $tenkh, $dienthoai, $diachi, $maxa, $trangthai, $lydo)
    {
        $getall = $this->connect->prepare("UPDATE crm_khachhang set lastmodify = NOW(),tendv='$tendv',msdn='$msdn',tenkh='$tenkh',dienthoai='$dienthoai',diachi='$diachi',msxa='$maxa',lydo='$lydo' where msdv = '$msdv' and mskh = '$mskh'");
        $getall->execute();
    }
    //todo cập nhật mã số khách hàng khi chuyển egpp
    public function update_mskh($msdv, $mskh_new, $mskh)
    {
        $getall = $this->connect->prepare("UPDATE crm_khachhang set mskh='$mskh_new' where msdv = '$msdv' and mskh = '$mskh';
        UPDATE crm_khachhang_chitiet set mskh='$mskh_new' where msdv = '$msdv' and mskh = '$mskh'
        ");
        $getall->execute();
    }
    //todo xóa khách hàng 
    public function khachhang_delete($msdv, $mskh)
    {
        $getall = $this->connect->prepare("UPDATE crm_khachhang SET xoa=1 where msdv='$msdv' and mskh='$mskh';
        UPDATE crm_khachhang_chitiet SET xoa=1 where msdv= '$msdv' and mskh='$mskh';");
        $getall->execute();
    }
    //todo thêm chi tiết khách hàng 
    public function khachhang_chitiet_add($msdv, $msdn, $msct, $ngay, $mskh, $tenkh, $note, $yeucau, $gia, $tungay, $thangkm, $denngay, $loaiphanmem, $loaihopdong, $trangthai, $linktailieu)
    {
        $getall = $this->connect->prepare("INSERT INTO crm_khachhang_chitiet(lastmodify,msct,msdv,msdn,mskh,tenkh,ngay,note,yeucau,gia,tungay,sothangkm,denngay,loaiphanmem,loaihopdong,trangthai,linktailieu)
         VALUES (NOW(),'$msct','$msdv','$msdn','$mskh','$tenkh',NOW(),'$note','$yeucau','$gia','$tungay','$thangkm','$denngay','$loaiphanmem','$loaihopdong','$trangthai','$linktailieu')");
        $getall->execute();
    }
    //todo chỉnh sửa khách hàng 
    public function khachhang_chitiet_edit($msdv, $msdn, $msct, $ngay, $mskh, $trangthai, $note, $yeucau, $gia, $tungay, $thangkm, $denngay, $loaihopdong, $loaiphanmem, $linktailieu)
    {
        $getall = $this->connect->prepare("UPDATE crm_khachhang_chitiet set lastmodify = NOW(),msdn='$msdn',trangthai='$trangthai',note='$note',yeucau='$yeucau',gia='$gia',tungay='$tungay',sothangkm='$thangkm',denngay='$denngay',loaihopdong='$loaihopdong',loaiphanmem='$loaiphanmem',linktailieu='$linktailieu' where msdv = '$msdv' and mskh = '$mskh' and msct = '$msct'");
        $getall->execute();
    }
    //todo xóa khách hàng 
    public function khachhang_chitiet_delete($msdv, $mskh, $msct)
    {
        $getall = $this->connect->prepare("UPDATE crm_khachhang_chitiet SET xoa=1 where msdv='$msdv' and mskh='$mskh' and msct='$msct';");
        $getall->execute();
    }
    public function _getname_trangthai_ctkh($msdv, $msloai)
    {
        $getall = $this->connect->prepare("SELECT tenloai FROM dmphanloai WHERE msdv ='$msdv' and msloai = '$msloai' and phanloai = 'trangthai_ctkh'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        $result = '';
        foreach ($getall as $value) {
            $result = $value->tenloai;
        }
        return $result;
    }
    //todo lấy tên nhân viên
    public function _getname_tennhanvien($msdv, $msdn)
    {
        $getall = $this->connect->prepare("SELECT hoten FROM hosonhanvien WHERE msdv = '$msdv' and msdn = '$msdn'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        $result = '';
        foreach ($getall as $value) {
            $result = $value->hoten;
        }
        return $result;
    }
    //Lấy danh mục tỉnh
    public function _Get_ListTinh()
    {
        $getall = $this->connect->prepare("SELECT matinh,tentinh  FROM dmtinh group by tentinh order by tentinh asc");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Lấy danh mục huyện
    public function _Get_ListHuyen($matinh, $mahuyen)
    {
        if ($matinh == '') {
            $order = 'mahuyen="' . $mahuyen . '"';
        } else {
            $order = 'matinh="' . $matinh . '"';
        }
        $getall = $this->connect->prepare("SELECT mahuyen,tenhuyen  FROM dmtinh where $order group by tenhuyen ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Lấy danh mục xã
    public function _Get_ListXa($mahuyen, $maxa)
    {
        if ($mahuyen == '') {
            $order = 'maxa="' . $maxa . '"';
        } else {
            $order = 'mahuyen="' . $mahuyen . '"';
        }
        $getall = $this->connect->prepare("SELECT maxa,tenxa  FROM dmtinh where $order group by tenxa ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }

    // Xử lí hình ảnh
    public function load_hinhanh($mskh)
    {
        $getall = $this->connect->prepare("SELECT hinhanh FROM crm_khachhang where mskh='$mskh'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function load_diachi_edit($diachi)
    {
        $getall = $this->connect->prepare("SELECT maxa, tenxa, mahuyen, tenhuyen, matinh, tentinh FROM dmtinh WHERE maxa='$diachi'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function add_hinhanh($mskh, $hinhanh_new)
    {
        $getall = $this->connect->prepare("UPDATE crm_khachhang set hinhanh = '$hinhanh_new' where mskh='$mskh'");
        $getall->execute();
    }
    public function delete_hinhanh($mskh, $hinhanh_new)
    {
        $getall = $this->connect->prepare("UPDATE crm_khachhang set hinhanh='$hinhanh_new' where mskh = '$mskh'");
        $getall->execute();
    }
}
