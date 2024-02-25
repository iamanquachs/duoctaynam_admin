<?php
class DonHang extends database
{
    //Show đặt hàng
    public function oms_header($trangthaidonhang, $tungay, $denngay)
    {
        $dieukien = " and ngay between '$tungay' and '$denngay' and trangthaidonhang='$trangthaidonhang' ";
        if ($trangthaidonhang == "99") {
            $dieukien = " and ngay between '$tungay' and '$denngay'";
        }
        if ($trangthaidonhang == "0") {
            $dieukien = " and trangthaidonhang= '$trangthaidonhang'";
        }
        $getall = $this->connect->prepare("SELECT (@row_number:=@row_number + 1) AS stt, DATE_FORMAT(lastmodify, '%I:%i %d/%m/%y')ngaygio, soct, tongcongvat, (dathanhtoan - tongcongvat) as conno,mskh, tenkhachhang, tendaidien, dienthoai, diachi, trangthaidonhang FROM dathangheader, (SELECT @row_number:=0) AS temp 
        where 1 = 1  " . $dieukien . " order by (dathanhtoan - tongcongvat), rowid");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Load tổng tồn kho
    public function tinh_tonkho($msdv, $tungay, $denngay)
    {
        $getall = $this->connect->prepare("CALL LayTonKhoBaoCao('$msdv', '$tungay', '$denngay')");
        $getall->execute();
    }
    public function oms_load_line($soct)
    {
        $getall = $this->connect->prepare("SELECT (@row_number:=@row_number + 1) AS stt, a.msnpp, a.mshh, a.tenhh, a.dvt, a.soluong, a.thanhtienvat, concat(a.ptgiam,'%')ptgiam, a.rowid_tonkho, a.trangthaidonhang, a.loaixuat from dathangline a, (SELECT @row_number:=0) AS temp where a.soct = '$soct' and loaixuat='XBB' order by mshh, rowid; ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Kiểm tra tồn cuối
    public function oms_kt_toncuoi($mshh, $msdv)
    {
        $getall = $this->connect->prepare("SELECT sum(toncuoi)toncuoi from tonkho where mshh = '$mshh' AND handung > CURRENT_DATE() and msdv='$msdv'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Hủy đặt hàng
    public function oms_huy($msdn, $soct, $mslydo)
    {
        $getall = $this->connect->prepare("UPDATE dathangline SET trangthaidonhang ='5' where soct='$soct';
        UPDATE dathangheader SET trangthaidonhang ='5', mslydohuy='$mslydo', time_huy = now(), msdn_huy = '$msdn' where soct='$soct' ");
        $getall->execute();
    }
    //Xuất kho
    public function oms_xuatkho($msdv, $msdn, $soct, $trangthaidonhang, $soctxk)
    {
        $getall = $this->connect->prepare(
            //Cập nhật trạng thái, Post XuatKho
            "UPDATE dathangheader set trangthaidonhang='$trangthaidonhang', msnvxn = '$msdn', time_xacnhan = now() where soct='$soct';
        UPDATE dathangline set trangthaidonhang='$trangthaidonhang', msnvxn = '$msdn', time_xacnhan = now() where soct='$soct';

    INSERT INTO xuatkhoheader(lastmodify, msdv, msdn, soctdh, soct, sohd, ngay, ngayhd, tongcongvat, loaixuat, mskh, tenkhachhang, msnvbh, dathanhtoan, sophieuthu, nganquy, ghichu, nguon)
    SELECT now(), '$msdv', '$msdn', soct, '$soctxk','', current_date, current_date , tongcongvat, 'XBB', mskh, tenkhachhang, msnvbh, dathanhtoan, mathamchieutt, loaithanhtoan, '','WEB' from dathangheader where soct='$soct';

    INSERT INTO xuatkholine(rowid_tonkho, lastmodify, msdv, mskho, msdn, msnpp, mshhnpp, ngay, soct, mshh, tenhh, dvt, ngaysx, solo, handung, soluong, msctkm, gianhapvat, giagoc, ptgiam, giaban, thuesuat, thanhtien, thanhtienvat, tam,loaixuat, ghichu) 
    SELECT a.rowid_tonkho, now(), '$msdv', '', '$msdn', a.msnpp, a.mshhnpp, current_date,'$soctxk', a.mshh, a.tenhh, a.dvt, '', '', '', a.soluong, a.msctkm, a.gianhap,a.giagoc, a.ptgiam, a.giaban, a.thuesuat, a.thanhtien, a.thanhtienvat, '0',loaixuat, '' FROM dathangline a  where a.soct='$soct' and a.loaixuat='XVC';

    DELETE from tien_tichluy where  soct='$soct' AND msdv='$msdv' and sotien > 0;

    INSERT INTO tien_tichluy(lastmodify, msdv, msdn, sotien, mskh, soct) 
    SELECT NOW(),'$msdv','$msdn',SUM(a.thanhtien * pttichluy/100), b.mskh,b.soctdh FROM xuatkholine a 
    INNER JOIN xuatkhoheader b ON a.soct=b.soct WHERE a.soct='$soctxk' AND a.msdv='$msdv' GROUP BY mskh
    "
        );
        $getall->execute();
    }
    //Xuất kho
    public function oms_list_dathang_line($soct)
    {
        $getall = $this->connect->prepare(
            //Cập nhật trạng thái, Post XuatKho
            "SELECT mshh, soluong FROM dathangline where soct='$soct';"
        );
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Xuất kho line
    public function oms_xuatkho_line($rowid_tonkho, $msdv, $msdn, $soct, $soctxk, $soluong, $solo, $handung, $gianhapcothue,$mshh)
    {
        $getall = $this->connect->prepare(
            //Cập nhật trạng thái, Post XuatKho
            "INSERT INTO xuatkholine(rowid_tonkho, lastmodify, msdv, mskho, msdn, msnpp, mshhnpp, ngay, soct, mshh, tenhh, dvt, ngaysx, solo, handung, soluong, msctkm, gianhapvat, giagoc, ptgiam, giaban, thuesuat, thanhtien, thanhtienvat, tam,loaixuat, ghichu, pttichluy) 
            SELECT '$rowid_tonkho', now(), '$msdv', '', '$msdn', a.msnpp, a.mshhnpp, current_date,'$soctxk', a.mshh, a.tenhh, a.dvt, '', '$solo', '$handung', '$soluong', a.msctkm, '$gianhapcothue',a.giagoc, a.ptgiam, a.giaban, a.thuesuat, a.thanhtien, a.thanhtienvat, '0',loaixuat, '', pttichluy FROM dathangline a  where a.mshh='$mshh' and a.soct='$soct';
            "
        );
        $getall->execute();
    }
    //Xác nhận đơn hàng
    public function oms_xacnhan_duyetdon($msdn, $soct, $trangthaidonhang, $soctxk)
    {
        $getall = $this->connect->prepare(
            //Cập nhật trạng thái, Post XuatKho
            "UPDATE dathangheader set trangthaidonhang='$trangthaidonhang', msnvxn = '$msdn', time_xacnhan = now() where soct='$soct';
        UPDATE dathangline set trangthaidonhang='$trangthaidonhang', msnvxn = '$msdn', time_xacnhan = now() where soct='$soct';
    "
        );
        $getall->execute();
    }
    //Cập nhật thông tin đặt hàng
    public function oms_capnhat_thongtin_khachhang($mskh, $soct, $tenkhachhang, $tendaidien, $dienthoai, $dienthoai_old)
    {
        $getall = $this->connect->prepare("UPDATE dathangheader SET tenkhachhang ='$tenkhachhang', tendaidien='$tendaidien', dienthoai = '$dienthoai' where soct='$soct' ; UPDATE thongtinnhanhang set tenkhachhang='$tenkhachhang', hotennguoinhan='$tendaidien', sodienthoai='$dienthoai' where msdv='$mskh' and sodienthoai='$dienthoai_old' ");
        $getall->execute();
    }
    //Show đơn hàng
    public function ims_header($tungay, $denngay)
    {
        $getall = $this->connect->prepare("SELECT (@row_number:=@row_number + 1) AS stt, DATE_FORMAT(lastmodify, '%I:%i %d/%m/%y')ngaygio, soct, tongcongvat, dathanhtoan, mskh, tenkhachhang, soctdh, sohd, nguon FROM xuatkhoheader, (SELECT @row_number:=0) AS temp 
        where loaixuat='XBB' and ngay between '$tungay' and '$denngay' order by rowid desc");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Show đơn hàng
    public function load_xuatkho_header($tungay, $denngay, $loai_xuat)
    {
        $filter = '';
        if ($loai_xuat != '') {
            $filter = "and loaixuat='$loai_xuat'";
        }
        $getall = $this->connect->prepare("SELECT (@row_number:=@row_number + 1) AS stt, DATE_FORMAT(lastmodify, '%I:%i %d/%m/%y')ngaygio, soct, tongcongvat, dathanhtoan, mskh, tenkhachhang, soctdh, sohd, nguon, tenkhachhang, loaixuat FROM xuatkhoheader, (SELECT @row_number:=0) AS temp 
        where loaixuat<>'XBB' $filter and ngay between '$tungay' and '$denngay' order by rowid desc");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Show đơn hàng
    public function delete_xuatkho_rac($msdv, $msdn)
    {
        $getall = $this->connect->prepare("DELETE From xuatkhoheader where soct not in (select soct from xuatkholine where msdv='$msdv' and msdn = '$msdn') and msdn = '$msdn' and msdv='$msdv'");
        $getall->execute();
    }
    //Show chi tiết đơn hàng
    public function ims_load_line($soct)
    {
        $getall = $this->connect->prepare("SELECT (@row_number:=@row_number + 1) AS stt, a.msnpp, a.mshh, a.tenhh, a.dvt, a.soluong, a.thanhtienvat, concat(a.ptgiam,'%')ptgiam from xuatkholine a, (SELECT @row_number:=0) AS temp where a.soct = '$soct' order by mshh, rowid");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Kiểm tra trước khi hủy đơn hàng
    public function ims_kiemtra_huy($soctdh)
    {
        $getall = $this->connect->prepare("SELECT count(rowid)kq from dathangheader where soct = '$soctdh' and trangthaidonhang < 2");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }

    //Load trạng thái đơn hàng dathangheader
    public function load_trangthaiDH_header($soctdh)
    {
        $getall = $this->connect->prepare("SELECT trangthaidonhang from dathangheader where soct = '$soctdh'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    
    //Hủy đơn hàng
    public function ims_huy($msdn, $soct, $soctdh)
    {
        $getall = $this->connect->prepare("UPDATE dathangline SET trangthaidonhang ='0', msdn='$msdn' where soct='$soctdh'; UPDATE dathangheader SET trangthaidonhang ='0', msdn='$msdn' where soct='$soctdh' ;
        DELETE from xuatkhoheader where soct='$soct'; DELETE from xuatkholine where soct='$soct'; 
         ");
        $getall->execute();
    }
    public function xuatkho_post_thuchi($msdv, $msdn, $soct, $maso, $tenmaso, $soct_donhang, $soctdathang, $sohd, $sotienthu, $noidungthu, $msnguoinop, $nguoinop, $nganquythu, $khoanmucthu, $dathanhtoan)
    {
        $getall = $this->connect->prepare("INSERT thuchi(msdv, msdn, soct, ngay, maso, tenmaso, soct_donhang, id_thamchieu, sohd, sotien, noidung, msnhanvien, tennhanvien, loaichungtu, nganquy, makhoanmuc) VALUES('$msdv','$msdn','$soct',NOW(),'$maso','$tenmaso','$soct_donhang','','$sohd','$sotienthu','$noidungthu','$msnguoinop','$nguoinop','0','$nganquythu','$khoanmucthu');
        UPDATE xuatkhoheader set dathanhtoan='$dathanhtoan', sophieuthu = concat(sophieuthu,'|','$soct') 
        where soct='$soct_donhang' and msdv='$msdv'; UPDATE dathangheader set trangthaithanhtoan='2'  where soct='$soctdathang'");
        $getall->execute();
    }
    public function capnhat_donhang_danggiao($soct, $trangthai)
    {
        $getall = $this->connect->prepare("UPDATE dathangheader set trangthaidonhang='$trangthai', time_giao = NOW()  where soct='$soct'");
        $getall->execute();
    }
    public function capnhat_donhang_danhan($soct, $trangthai)
    {
        $getall = $this->connect->prepare("UPDATE dathangheader set trangthaidonhang='$trangthai', time_nhan = NOW()  where soct='$soct'");
        $getall->execute();
    }
}
