<?php

class NhapKho extends database
{
    //Add sản phảm mới tạm
    public function nhapkho_add_header($msdv, $msdn, $soct)
    {
        $getall = $this->connect->prepare("INSERT INTO nhapkhoheader(lastmodify, msdv, msdn,soct)
         VALUES (NOW(), '$msdv', '$msdn','$soct')");
        $getall->execute();
    }
    //Nhập kho load line
    public function nhapkho_load_header_taophieu($soct)
    {
        $getall = $this->connect->prepare("SELECT sohd,ngaygs,ngayhd,msncc,tenncc FROM nhapkhoheader
         WHERE soct = '$soct'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Nhập kho load line
    public function nhapkho_load_header()
    {
        $getall = $this->connect->prepare("SELECT soct,sohd,ngaygs,ngayhd,msncc,tenncc,tongcongvat FROM nhapkhoheader");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Nhập kho load header chưa update
    public function nhapkho_load_header_chua_update()
    {
        $getall = $this->connect->prepare("SELECT a.soct FROM nhapkhoheader a inner join nhapkholine b on a.soct =b.soct where b.tam='1' group by a.soct");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Nhập kho load header chưa update
    public function delete_nhapkho_load_header_chua_update($msdn, $msdv)
    {
        $getall = $this->connect->prepare("DELETE From nhapkhoheader where soct not in (select soct from nhapkholine where msdv='$msdv') and msdn = '$msdn' and msdv='$msdv'");
        $getall->execute();
    }
    //Add sản phảm mới tạm
    public function nhapkho_add_line($msdv, $soct, $mshh, $tenthuoc, $dvt, $solo, $handung, $gianhap, $chietkhau, $tienchietkhau, $gianhapchuathue, $vat, $tienthue, $gianhapcothue, $soluong,  $thanhtiencothue, $ptgiaban, $giaban)
    {
        $getall = $this->connect->prepare("INSERT INTO nhapkholine(lastmodify,msdv,soct, mshh,tenhh,dvt,solo,handung,gianhapchuack, chietkhau,tienchietkhau,gianhapchuathue,thuesuat,tienthue, gianhapcothue,soluong, thanhtiencothue,ptgiaban, giaban,tam)
         VALUES (NOW(),'$msdv','$soct', '$mshh', '$tenthuoc', '$dvt','$solo', '$handung', '$gianhap', '$chietkhau', '$tienchietkhau','$gianhapchuathue', '$vat','$tienthue', '$gianhapcothue', '$soluong', '$thanhtiencothue','$ptgiaban','$giaban','1')");
        $getall->execute();
    }
    //Add sản phảm mới tạm
    public function nhapkho_edit_line($soct, $mshh, $tenthuoc, $dvt, $solo, $handung, $gianhap, $chietkhau, $tienchietkhau, $gianhapchuathue, $vat, $tienthue, $gianhapcothue, $soluong,  $thanhtiencothue, $ptgiaban, $giaban)
    {
        $getall = $this->connect->prepare("UPDATE nhapkholine set tenhh='$tenthuoc',dvt='$dvt',solo='$solo',handung='$handung',gianhapchuack='$gianhap',chietkhau='$chietkhau',tienchietkhau='$tienchietkhau',gianhapchuathue='$gianhapchuathue',thuesuat='$vat',tienthue='$tienthue',gianhapcothue='$gianhapcothue',soluong='$soluong',thanhtiencothue='$thanhtiencothue',ptgiaban='$ptgiaban',giaban='$giaban' WHERE soct='$soct' and mshh='$mshh'");
        $getall->execute();
    }
    //Nhập kho load line
    public function nhapkho_load_line($soct)
    {
        $getall = $this->connect->prepare("SELECT rowid, soct,mshh, tenhh, dvt, solo, handung, chietkhau, gianhapchuack, thuesuat,tienchietkhau, soluong, thanhtiencothue, gianhapcothue,ptgiaban,giaban FROM nhapkholine
        WHERE soct = '$soct'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //update header
    public function nhapkho_update_header($msdv, $soct, $sohoadon, $ngayhd, $msncc, $tenncc, $tongcong)
    {
        $getall = $this->connect->prepare("UPDATE nhapkhoheader set sohd='$sohoadon', ngaygs=NOW(), ngayhd='$ngayhd', tongcongvat='$tongcong', loaiphieu='1', msncc='$msncc', tenncc='$tenncc' where soct='$soct'  AND msdv='$msdv';
        UPDATE nhapkholine set ngaygs=NOW(), ngayhd='$ngayhd', tam='0' where soct='$soct'  AND msdv='$msdv';
        UPDATE  hosohanghoa a 
        INNER JOIN nhapkholine b ON a.mshh=b.mshh
        INNER JOIN nhapkhoheader c ON c.soct = b.soct
        SET a.giabanmin = b.giaban, a.ptgiaban = b.ptgiaban, a.msncc = c.msncc, a.gianhap=b.gianhapchuathue, a.gianhapvat= b.gianhapcothue, a.thuesuat=b.thuesuat
        WHERE b.soct='$soct' AND b.msdv='$msdv'
        ");
        $getall->execute();
    }
    //Nhập kho tính tổng thanh toan và tổng cộng vat
    public function nhapkho_tinhtong($soct)
    {
        $getall = $this->connect->prepare("SELECT SUM(gianhapchuathue * soluong) as thanhtienchuathue, SUM(thanhtiencothue) as thanhtiencothue, SUM(tienchietkhau) as tienchietkhau FROM nhapkholine
        WHERE soct = '$soct'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }

    //Nhập kho delete Line
    public function nhapkho_delete_line($soct, $rowid)
    {
        $getall = $this->connect->prepare("DELETE FROM nhapkholine where soct='$soct' and rowid='$rowid'");
        $getall->execute();
    }
    //Nhập kho load danh sách từ hosohanghoa
    public function nhapkho_load_hosohanghoa($tenhh)
    {
        $getall = $this->connect->prepare("SELECT mshh,tenhh,thuesuat,gianhap, gianhapvat, dvtmin,ptgiaban, giabanmin, sodangky, quycach,hamluong FROM hosohanghoa
        WHERE tenhh LIKE '%$tenhh%' OR mshh like '%$tenhh%' and trangthai=1");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Nhập kho delete header
    public function nhapkho_delete_header($soct)
    {
        $getall = $this->connect->prepare("DELETE FROM nhapkhoheader where soct='$soct';DELETE FROM nhapkholine where soct='$soct'");
        $getall->execute();
    }
    //Nhập kho filter
    public function nhapkho_filter($loai, $tungay, $denngay)
    {
        if ($loai == 'theoHD') {
            $loai = 'ngayhd';
        } else {
            $loai = 'ngaygs';
        }
        $getall = $this->connect->prepare("SELECT soct,sohd,ngaygs,ngayhd,msncc,tenncc,tongcongvat, dathanhtoan FROM nhapkhoheader WHERE  $loai  BETWEEN '$tungay' AND '$denngay'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Nhập kho search
    public function nhapkho_search($value)
    {
        $getall = $this->connect->prepare("SELECT soct,sohd,ngaygs,ngayhd,msncc,tenncc,tongcongvat, dathanhtoan FROM nhapkhoheader WHERE  sohd LIKE '%$value%' OR tenncc LIKE '%$value%' ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Nhập kho search
    public function huy_nhapkho($soct)
    {
        $getall = $this->connect->prepare("DELETE FROM nhapkholine where soct='$soct';DELETE FROM nhapkhoheader where soct='$soct'");
        $getall->execute();
    }

    //Mở cập nhật nhập kho thì update thành 1
    public function open_capnhatkho($soct)
    {
        $getall = $this->connect->prepare("UPDATE nhapkholine set tam='1' where soct='$soct'");
        $getall->execute();
    }
    //Add nhà cung cấp
    public function add_nhacungcap($msdn, $msncc, $tenncc, $tenviettat, $diachi, $dienthoai)
    {
        $getall = $this->connect->prepare("INSERT INTO hoso_ncc_hsx(lastmodify, msdn, msnsx,tennsx, tenviettat,diachi, dienthoai,loai,khoa)
         VALUES (NOW(), '$msdn','$msncc', '$tenncc', '$tenviettat','$diachi', '$dienthoai', 'ncc','0')");
        $getall->execute();
    }
    public function load_nhacungcap()
    {
        $getall = $this->connect->prepare("SELECT msnsx, tennsx,tenviettat, diachi, dienthoai from hoso_ncc_hsx where loai='ncc'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function delete_nhacungcap($msnsx)
    {
        $getall = $this->connect->prepare("DELETE from hoso_ncc_hsx where msnsx='$msnsx'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function nhapkho_post_thuchi($msdv, $msdn, $soct, $maso, $tenmaso, $soct_donhang, $sohd, $sotienthu, $noidungthu, $msnguoinop, $nguoinop, $nganquythu, $khoanmucthu, $dathanhtoan)
    {
        $getall = $this->connect->prepare("INSERT thuchi(msdv, msdn, soct, ngay, maso, tenmaso, soct_donhang, id_thamchieu, sohd, sotien, noidung, msnhanvien, tennhanvien, loaichungtu, nganquy, makhoanmuc) VALUES('$msdv','$msdn','$soct',NOW(),'$maso','$tenmaso','$soct_donhang','','$sohd','-$sotienthu','$noidungthu','$msnguoinop','$nguoinop','1','$nganquythu','$khoanmucthu');
         UPDATE nhapkhoheader set dathanhtoan='$dathanhtoan', sophieuchi = concat(sophieuchi,'|','$soct') where soct='$soct_donhang' and msdv='$msdv'");
        $getall->execute();
    }
}
