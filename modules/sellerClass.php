<?php

class Seller extends database
{
    //Load tổng tồn kho
    public function tinh_tonkho($msdv, $tungay, $denngay)
    {
        $getall = $this->connect->prepare("CALL LayTonKhoBaoCao('$msdv', '$tungay', '$denngay');");
        $getall->execute();
    }
    public function tinh_soluong_trukho($mshh, $soluong)
    {
        $getall = $this->connect->prepare("CALL TinhSoLuongTruKho($soluong, '$mshh');");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function add_xuatkho_header($msdv, $msdn, $soct, $loaixuat)
    {
        $getall = $this->connect->prepare("INSERT INTO xuatkhoheader(lastmodify, msdv, msdn, soctdh, soct, loaixuat,nguon) VALUES (NOW(), '$msdv', '$msdn', '$soct', '$soct', '$loaixuat', 'XTT');");
        $getall->execute();
    }

    public function xuatkho_update($msdv, $msdn, $soct, $tenkhachhang, $mskh, $thanhtoan, $ghichu, $nhanvienbanhang, $loai_xuat)
    {
        $getall = $this->connect->prepare("UPDATE xuatkhoheader SET lastmodify=NOW(), msdn='$msdn',ngay=NOW(), ngayhd=NOW(), tongcongvat='$thanhtoan', loaixuat='$loai_xuat', mskh='$mskh', tenkhachhang='$tenkhachhang', msnvbh = '$nhanvienbanhang', ghichu='$ghichu' WHERE msdv='$msdv' AND soct='$soct'; UPDATE xuatkholine set tam=0, loaixuat='$loai_xuat' where msdv='$msdv' and soct='$soct'");
        $getall->execute();
    }
    public function find_hosohanghoa($tenhh)
    {
        $getall = $this->connect->prepare("SELECT b.rowid AS rowid_tonkho, a.mshh, a.tenhh, a.dvtmin, a.tenhoatchat, sum(b.toncuoi) toncuoi, a.thuesuat, a.pttichluy, a.msnpp
        FROM hosohanghoa a INNER JOIN tonkho b ON a.mshh=b.mshh 
        where trangthai = 1 AND (a.tenhh like '%$tenhh%' OR a.mshh like '%$tenhh%') AND b.toncuoi > 0 and b.handung > CURRENT_DATE GROUP BY a.mshh
        ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }

    public function find_soluong_hosohanghoa($msdv, $mshh, $soluong)
    {
        $getall = $this->connect->prepare("SELECT a.giabanvat AS giagoc, ifnull(b.ptgiam ,0)ptgiam, ifnull(b.msctkm ,'')msctkm , (a.giabanvat - (a.giabanvat * ifnull(b.ptgiam, 0))/100)giaban 
        FROM hoso_giaban a 
        left join ctkm_line b on a.mshh = b.mshh 
        AND CURRENT_DATE BETWEEN IFNULL( b.tungay,CURRENT_DATE)  AND IFNULL(b.denngay, CURRENT_DATE) AND b.khoa = 0 and b.hieuluc='1' AND b.loaikm = 1 
         WHERE a.mshh='$mshh' AND a.khoa = '0' AND a.msdv= '$msdv' AND $soluong BETWEEN a.sl_bantu AND a.sl_banden ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function add_xuatkho_line($rowid_tonkho, $msdv, $msdn, $msnpp, $soct, $mshh, $tenhh, $dvt, $solo, $handung, $soluong, $msctkm, $gianhapcothue, $giagoc, $ptgiam, $giaban, $thuesuat, $pttichluy, $loai_xuat)
    {
        $getall = $this->connect->prepare("INSERT INTO xuatkholine(rowid_tonkho, lastmodify, msdv, msdn, msnpp, ngay, soct, mshh, tenhh, dvt, ngaysx, solo, handung, soluong, msctkm, gianhapvat, giagoc, ptgiam, giaban, thuesuat, thanhtien, thanhtienvat, tam, loaixuat, ghichu, pttichluy ) VALUES($rowid_tonkho,  NOW(),'$msdv','$msdn','$msnpp', NOW(),'$soct','$mshh','$tenhh','$dvt','','$solo','$handung','$soluong','$msctkm','$gianhapcothue','$giagoc','$ptgiam','$giaban','$thuesuat', $soluong * $giaban, $soluong * $giaban, '1', '$loai_xuat', '', '$pttichluy')");
        $getall->execute();
    }
    //! Lấy ctkm thêm vào xuất kho
    public function lay_ctkm_them_xuatkho($msdv, $msdn, $soct, $mshh)
    {
        $getall = $this->connect->prepare("CALL LayCTKM_ThemXuatKho('$soct', '$mshh', '$msdn', '$msdv')");
        $getall->execute();
    }
    public function load_xuatkho_line($msdv, $soct)
    {
        $getall = $this->connect->prepare("SELECT rowid ,soct, mshh, tenhh, solo,ptgiam,  dvt,DATE_FORMAT(handung, '%d/%m/%Y')handung, soluong, msctkm, giaban, thanhtienvat, auto_post from xuatkholine where msdv='$msdv' and soct='$soct' order by auto_post, msctkm,rowid desc ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function delete_xuatkho_line($msdv, $soct, $mshh, $rowid, $msctkm)
    {
        $getall = $this->connect->prepare("DELETE from xuatkholine where msdv='$msdv' and soct='$soct' and mshh='$mshh' and rowid='$rowid';
DELETE FROM xuatkholine WHERE msctkm = '$msctkm' AND auto_post = '1' AND msdv = '$msdv' AND soct = '$soct' AND msctkm <> '';
        
        ");
        $getall->execute();
    }
    public function load_tinhtong_thanhtien($msdv, $soct)
    {
        $getall = $this->connect->prepare("SELECT  SUM(soluong * giagoc)thanhtien , (SUM(soluong * giagoc) - SUM(thanhtienvat))khuyenmai, SUM(thanhtienvat)thanhtoan FROM xuatkholine WHERE msdv ='$msdv' AND soct='$soct' ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function load_khachhang($sodienthoai)
    {
        $getall = $this->connect->prepare("SELECT msdv, hotennguoinhan, sodienthoai,  diachi FROM thongtinnhanhang WHERE chinh = 1 AND (sodienthoai LIKE '%$sodienthoai%' OR hotennguoinhan LIKE '%$sodienthoai%')");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function load_nhanvien($msdv, $sodienthoai)
    {
        $getall = $this->connect->prepare("SELECT msdn,hoten FROM hosonhanvien  WHERE msdv='1' AND loai_user < 90 AND khoa=0 AND msdn <> 'CPL' ORDER by hoten  ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function load_xuatkho_chua_luu($msdv)
    {
        $getall = $this->connect->prepare("SELECT a.soct FROM xuatkhoheader a inner join xuatkholine b on a.soct = b.soct where b.tam='1' and a.msdv='$msdv' and b.msdv='$msdv' group by a.soct");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function load_xuatkho_chua_luu_export($msdv)
    {
        $getall = $this->connect->prepare("SELECT a.soct FROM xuatkhoheader a inner join xuatkholine b on a.soct = b.soct where a.loaixuat<>'XBB' and b.tam='1' and a.msdv='$msdv' and b.msdv='$msdv' group by a.soct");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function huy_xuatkho($msdv, $msdn, $soct)
    {
        $getall = $this->connect->prepare("DELETE from xuatkhoheader where msdv='$msdv' and soct='$soct'; DELETE FROM xuatkholine where msdv='$msdv' and soct='$soct';DELETE From xuatkhoheader where soct not in (select soct from xuatkholine where msdv='$msdv') and msdn = '$msdn' and msdv='$msdv'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function update_tam_xuatkho_line($msdv, $soct)
    {
        $getall = $this->connect->prepare("UPDATE xuatkholine set tam='1' where msdv='$msdv' and soct='$soct'");
        $getall->execute();
    }
    public function load_xuatkhoheader_chitiet($msdv, $soct)
    {
        $getall = $this->connect->prepare("SELECT a.mskh, b.hoten, a.msnvbh, c.hotennguoinhan, c.sodienthoai, c.diachi, a.ghichu FROM xuatkhoheader a 
        INNER JOIN hosonhanvien b ON a.msnvbh=b.msdn 
        INNER JOIN thongtinnhanhang c ON a.mskh=c.msdv 
        WHERE a.soct='$soct' AND a.msdv='$msdv'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }

    //!--------------------------------------------------- Xuất kho
    public function load_xuattra($msdv, $tenhh)
    {
        $getall = $this->connect->prepare("SELECT a.tenhh, a.dvt, a.solo, DATE_FORMAT(a.handung, '%d/%m/%Y')handung, a.gianhapcothue, a.soluong, b.sohd, DATE_FORMAT(b.ngayhd, '%d/%m/%Y')ngayhd,b.tenncc, a.mshh
        FROM nhapkholine a 
        INNER JOIN nhapkhoheader b ON a.soct=b.soct AND a.msdv=b.msdv 
        WHERE a.msdv='$msdv' and (a.tenhh like '%$tenhh%' or a.mshh like '%$tenhh%') order by a.tenhh");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function get_tonkho_xuat($msdv, $mshh, $solo, $handung)
    {
        $getall = $this->connect->prepare("SELECT b.rowid AS rowid_tonkho,  b.toncuoi, a.thuesuat, a.pttichluy, a.msnpp
        FROM hosohanghoa a INNER JOIN tonkho b ON a.mshh=b.mshh 
        where a.trangthai = 1 AND  a.mshh = '$mshh' AND b.toncuoi > 0 and b.solo = '$solo' and b.handung='$handung' 
        ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function load_xuat_hube_hethan($msdv, $tenhh)
    {
        $getall = $this->connect->prepare("SELECT b.rowid AS rowid_tonkho, a.mshh, a.tenhh,a.dvtmin as dvt, b.solo, DATE_FORMAT(b.handung, '%d/%m/%Y')handung, b.gianhapcothue, b.toncuoi, ''tenncc, ''soluong,''sohd, ''ngayhd FROM hosohanghoa a INNER JOIN tonkho b ON a.mshh=b.mshh 
        WHERE b.msdv='$msdv' AND (a.tenhh LIKE '%$tenhh%' or a.mshh like '%$tenhh%') and a.trangthai='1' and b.toncuoi > 0 order by a.tenhh");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }

    //Show đơn hàng
    public function ims_header($tungay, $denngay)
    {
        $getall = $this->connect->prepare("SELECT (@row_number:=@row_number + 1) AS stt, DATE_FORMAT(lastmodify, '%I:%i %d/%m/%y')ngaygio, soct, tongcongvat, dathanhtoan, mskh, tenkhachhang, soctdh, sohd, nguon FROM xuatkhoheader, (SELECT @row_number:=0) AS temp 
         where ngay between '$tungay' and '$denngay' order by rowid desc");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Show đơn hàng
    public function load_nhacc_loaixuat_export($msdv, $soct)
    {
        $getall = $this->connect->prepare("SELECT loaixuat, mskh FROM xuatkhoheader
         where msdv='$msdv' and soct='$soct'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
}
