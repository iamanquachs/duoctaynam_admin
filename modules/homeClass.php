<?php

class Home extends database
{
    public function doanhthu($thang, $nam)
    {
        $getall = $this->connect->prepare("SELECT SUM(a.tongcongvat) AS tongxuatkho, b.doanhthu AS tongdoanhthu,ROUND((SUM(a.tongcongvat) / b.doanhthu  * 100 ),0) AS phantram FROM xuatkhoheader a INNER JOIN kehoachkinhdoanh b 
        WHERE b.thang='$thang' AND b.nam='$nam' AND MONTH(a.ngay)='$thang' AND YEAR(a.ngay)='$nam' and b.loai=0");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function loinhuan($thang, $nam)
    {
        $getall = $this->connect->prepare("SELECT sum(a.thanhtienvat - (a.gianhapvat * a.soluong)) AS tongtienxuatkho, b.loinhuan, ROUND((sum(a.thanhtienvat - (a.gianhapvat * a.soluong)) / b.loinhuan  * 100 ),0) as phantram FROM xuatkholine a INNER JOIN kehoachkinhdoanh b  
        WHERE b.thang='$thang' AND b.nam='$nam' AND MONTH(a.ngay)='$thang' AND YEAR(a.ngay)='$nam' and b.loai = 0");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function khachhang($thang, $nam)
    {
        $getall = $this->connect->prepare("SELECT  COUNT(a.mskh) as tongkhachhang, b.khachhangmoi, ROUND((COUNT(a.mskh) / b.khachhangmoi  * 100 ),0) as phantram FROM xuatkhoheader a INNER JOIN kehoachkinhdoanh b on a.msdv=b.msdv
        WHERE b.thang='$thang' AND b.nam='$nam' AND MONTH(a.ngay)='$thang' AND YEAR(a.ngay)='$nam' and b.loai=0");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function donhang($thang, $nam)
    {
        $getall = $this->connect->prepare("SELECT  COUNT(a.soct)as donhang FROM xuatkhoheader a 
        WHERE MONTH(a.ngayhd)='$thang' AND YEAR(a.ngayhd)='$nam'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function donhangchuanhan($thang, $nam)
    {
        $getall = $this->connect->prepare("SELECT COUNT(soct) AS donhangchuanhan FROM dathangheader WHERE trangthaidonhang < 4 and MONTH(ngay)='$thang' AND YEAR(ngay)='$nam'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function congnophaithu($msdv, $thang, $nam)
    {
        $getall = $this->connect->prepare("SELECT  SUM(tongcongvat - dathanhtoan) AS congnophaithu FROM xuatkhoheader where MONTH(ngay)='$thang' AND YEAR(ngay)='$nam' and msdv='$msdv'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function congnophaitra($msdv, $thang, $nam)
    {
        $getall = $this->connect->prepare("SELECT  SUM(tongcongvat - dathanhtoan) AS congnophaitra FROM nhapkhoheader where MONTH(ngaygs)='$thang' AND YEAR(ngaygs)='$nam' and msdv ='$msdv'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function hanghoa_banchay($msdv, $thang, $nam)
    {
        $getall = $this->connect->prepare("SELECT a.tenhh, b.tenhoatchat, SUM(a.soluong)sl, SUM(a.thanhtienvat)tt FROM xuatkholine a inner JOIN hosohanghoa b ON a.mshh=b.mshh WHERE MONTH(a.ngay)='$thang' AND YEAR(a.ngay)='$nam' AND a.msdv='$msdv'
        GROUP BY a.tenhh, b.tenhoatchat ORDER BY SUM(a.soluong) DESC");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function hanghoa_loinhuancao($msdv, $thang, $nam)
    {
        $getall = $this->connect->prepare("SELECT a.tenhh, b.tenhoatchat, SUM(a.thanhtienvat - (a.gianhapvat*a.soluong))LN,  ROUND(((a.giaban - a.gianhapvat) / a.gianhapvat * 100), 0) AS pt FROM xuatkholine a inner JOIN hosohanghoa b ON a.mshh=b.mshh WHERE MONTH(a.ngay)='$thang' AND YEAR(a.ngay)='$nam' AND a.msdv='$msdv'
        GROUP BY a.tenhh, b.tenhoatchat ORDER BY ROUND(((a.giaban - a.gianhapvat) / a.gianhapvat * 100), 0) DESC");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function doanthu_theokhachhang($msdv, $thang, $nam)
    {
        $getall = $this->connect->prepare("SELECT a.mskh, a.tenkhachhang, SUM(a.tongcongvat)dt, ROUND(a.tongcongvat / b.doanhthu * 100,0) AS pt  FROM xuatkhoheader a INNER JOIN kehoachkinhdoanh b ON a.mskh= b.mskh
        WHERE b.loai = 1 and MONTH(a.ngay)='$thang' AND YEAR(a.ngay)='$nam' AND a.msdv='$msdv' AND b.thang='$thang' AND b.nam='$nam' AND b.msdv='$msdv'
                GROUP BY a.mskh, a.tenkhachhang ORDER BY SUM(a.tongcongvat) DESC");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function loinhuan_theokhachhang($msdv, $thang, $nam)
    {
        $getall = $this->connect->prepare("SELECT b.mskh, b.tenkhachhang, SUM(a.thanhtienvat - (a.gianhapvat*a.soluong))ln,   ROUND(((a.giaban - a.gianhapvat) / a.gianhapvat * 100), 0) AS pt FROM xuatkholine a inner JOIN xuatkhoheader b on a.soct = b.soct  WHERE MONTH(a.ngay)='$thang' AND YEAR(a.ngay)='$nam' AND a.msdv='$msdv'
        GROUP BY b.mskh, b.tenkhachhang ORDER BY SUM(a.thanhtienvat - (a.gianhapvat*a.soluong)) DESC");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function tuoino_khachhang($msdv, $thang, $nam)
    {
        $getall = $this->connect->prepare("SELECT a.ngay, a.mskh, a.tenkhachhang, CURDATE() - ngay AS tuoino  from xuatkhoheader a WHERE a.dathanhtoan - a.tongcongvat <= 0 and MONTH(a.ngay)='$thang' AND YEAR(a.ngay)='$nam' AND a.msdv='$msdv'
        GROUP BY a.ngay, a.mskh, a.tenkhachhang ORDER BY  CURDATE() - ngay DESC");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
}
