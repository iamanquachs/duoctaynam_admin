<?php

class Report extends database
{
    //Khách hàng - Sản phẩm
    public function load_report_cus_item($msdv, $loaiSearch, $valueSearch, $tungay, $denngay)
    {
        $filter = '';
        if ($valueSearch != '') {
            if ($loaiSearch == 'tenkh') {
                $filter = 'and b.tenkhachhang like "%' . $valueSearch . '%"';
            }
            if ($loaiSearch == 'sdt') {

                $filter = 'and c.sodienthoai like "%' . $valueSearch . '%"';
            }
            if ($loaiSearch == 'tenhh') {
                $filter = 'and a.tenhh like "%' . $valueSearch . '%"';
            }
            if ($loaiSearch == 'mshh') {
                $filter = 'and a.mshh like "%' . $valueSearch . '%"';
            }
        }
        $getall = $this->connect->prepare("SELECT ''tenkh, ''sanpham, 0 soluong, (select SUM(thanhtienvat) FROM xuatkholine  where msdv = '$msdv' and ngay BETWEEN '$tungay' and '$denngay' ) as thanhtien,
         (select SUM((thanhtienvat) - (gianhapvat * soluong) ) FROM  xuatkholine where msdv = '$msdv' and ngay BETWEEN '$tungay' and '$denngay' ) as loinhuan,
         ''tentinh, 1 loai
        UNION ALL SELECT concat(b.mskh, ' | ', b.tenkhachhang) AS tenkh, concat(a.mshh,' | ', a.tenhh) sanpham, sum(a.soluong) AS soluong, SUM(a.thanhtienvat) AS thanhtien, 
        SUM((a.thanhtienvat) - (a.gianhapvat * a.soluong)) AS loinhuan , d.tentinh, 0 loai FROM xuatkholine a 
        INNER JOIN xuatkhoheader b ON a.msdv = b.msdv AND a.soct=b.soct
        INNER JOIN thongtinnhanhang c ON b.mskh = c.msdv
        INNER JOIN dmtinh d ON c.maxa = d.maxa 
        where b.msdv='$msdv' and a.msdv='$msdv' $filter and (b.ngay between '$tungay' and '$denngay' )  GROUP BY  concat(b.mskh, ' | ', b.tenkhachhang), concat(a.mshh,' | ', a.tenhh)  ORDER BY loai , tenkh, sanpham
        ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Chi tiết xuất kho
    public function load_report_sale($msdv, $valueSearch)
    {
        $filter = '';
        if ($valueSearch != '') {
            $filter = 'and (b.mskh like "%' . $valueSearch . '%" OR b.tenkhachhang like "%' . $valueSearch . '%" OR a.mshh like "%' . $valueSearch . '%" OR a.soct like "%' . $valueSearch . '%" OR a.solo like "%' . $valueSearch . '%")';
        }
        $getall = $this->connect->prepare(" SELECT  DATE_FORMAT(b.ngay, '%d/%m/%Y')ngay, b.soct, concat(b.mskh, ' | ', b.tenkhachhang) AS tenkh,  concat(a.mshh,' | ', a.tenhh) sanpham, a.solo, DATE_FORMAT(a.handung, '%d/%m/%Y')handung, a.dvt, a.soluong, a.giaban, a.thanhtienvat        
        FROM xuatkholine a INNER JOIN xuatkhoheader b ON a.soct=b.soct AND a.msdv = b.msdv where a.msdv='$msdv' $filter and b.msdv='$msdv'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Chi tiết Công nợ 
    public function load_report_detail_receivable($msdv, $mskh, $valueSearch, $tungay, $denngay)
    {
        $filter = '';
        if ($valueSearch != '') {
            $filter = 'and (a.soct like "%' . $valueSearch . '%" OR a.sohd like "%' . $valueSearch . '%" OR a.mskh like "%' . $valueSearch . '%" OR a.tenkhachhang like "%' . $valueSearch . '%" OR a.sophieuthu like "%' . $valueSearch . '%")';
        }
        $getall = $this->connect->prepare("SELECT DATE_FORMAT(a.ngay, '%d/%m/%Y')ngay, a.soctdh, a.soct, a.sohd, a.tongcongvat, a.dathanhtoan, a.sophieuthu, a.tongcongvat - a.dathanhtoan AS conno, DATEDIFF(CURDATE(),a.ngay) tuoino ,
        if(DATEDIFF(CURDATE(), a.ngay) >= b.tuoino AND DATEDIFF(CURDATE(), a.ngay) < b.tuoino * 2, '1', if(DATEDIFF(CURDATE(), a.ngay) >=b.tuoino * 2, '2', '0')) tinhtrang, b.dinhmucno
         FROM xuatkhoheader a inner join thongtinnhanhang b ON a.mskh = b.msdv
           WHERE a.tongcongvat - a.dathanhtoan >= 0 AND a.mskh='$mskh' AND b.chinh= 1  $filter AND a.ngay  BETWEEN '$tungay' and '$denngay' 
           ORDER BY tuoino desc
        ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Tổng hợp Công nợ
    public function load_report_summary_receivable($msdv, $valueSearch, $tungay, $denngay)
    {
        $filter = '';
        if ($valueSearch != '') {
            $filter = 'and (mskh like "%' . $valueSearch . '%" OR tenkhachhang like "%' . $valueSearch . '%" )';
        }

        $getall = $this->connect->prepare("  SELECT concat(a.mskh_bandau,' | ', a.tenkhachhang_bandau)khachhang, ifnull(b.dauky, 0) AS dauky, ifnull(c.tongcongvat,0) as phatsinh, ifnull(c.dathanhtoan,0) as dathanhtoan, 
        ifnull(c.notrongky, 0) AS notrongky, (ifnull(b.dauky,0) + ifnull(c.tongcongvat,0)  - ifnull(c.dathanhtoan, 0))  AS nocuoiky FROM 
        (SELECT mskh as mskh_bandau, tenkhachhang AS tenkhachhang_bandau FROM xuatkhoheader WHERE msdv='$msdv' $filter GROUP BY mskh) a
        LEFT join
        (SELECT  mskh, sum(tongcongvat - dathanhtoan) AS dauky FROM xuatkhoheader WHERE tongcongvat <> dathanhtoan AND ngay < '$tungay' AND msdv='$msdv' GROUP BY mskh) b
        ON a.mskh_bandau = b.mskh
        LEFT join
       (SELECT mskh, tenkhachhang, sum(ifnull(tongcongvat,0)) tongcongvat, SUM(ifnull(dathanhtoan,0)) dathanhtoan, SUM(ifnull(tongcongvat,0) - ifnull(dathanhtoan,0)) AS notrongky
       FROM xuatkhoheader
       WHERE msdv='$msdv'  AND ngay  BETWEEN '$tungay' and '$denngay' AND msdv='$msdv' GROUP BY mskh) c
         ON a.mskh_bandau = c.mskh
         ORDER BY nocuoiky desc
        
        ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function load_warehouse($msdv, $valueSearch, $tungay, $denngay)
    {
        $filter = '';
        if ($valueSearch != '') {
            $filter = 'and (b.mshh like "%' . $valueSearch . '%" OR b.tenhh like "%' . $valueSearch . '%" OR a.solo like "%' . $valueSearch . '%" )';
        }

        $getall = $this->connect->prepare("SELECT ''hanghoa, ''dvtmin, ''solo, '0000-00-00'handung, '0'gianhapcothue, 
        (SELECT count(mshh ) FROM tonkho WHERE msdv='$msdv')soluong, 
        (SELECT SUM(tondau ) FROM tonkho WHERE msdv='$msdv')tondau, 
        (SELECT SUM(tondau * gianhapcothue) FROM tonkho WHERE msdv='$msdv')tttondau, 
        (SELECT SUM(tongnhap * gianhapcothue) FROM tonkho WHERE msdv='$msdv')tongnhap, 
        (SELECT SUM(tongxuat * gianhapcothue) FROM tonkho WHERE msdv='$msdv')tongxuat, 
        '0'toncuoi, 
        (SELECT SUM(toncuoi * gianhapcothue) FROM tonkho WHERE msdv='$msdv')tttoncuoi, ''tinhtrang, 0 AS loai
        UNION ALL
        SELECT CONCAT(b.mshh, ' | ',b.tenhh)hanghoa, b.dvtmin, a.solo, a.handung, a.gianhapcothue, 0 as soluong, a.tondau, 
        (a.gianhapcothue * a.tondau) tttondau, a.tongnhap, a.tongxuat,a.toncuoi, (a.gianhapcothue * a.toncuoi) tttoncuoi,
        CASE
            WHEN DATEDIFF(a.handung,CURRENT_DATE) < 90  THEN '1'
            WHEN a.handung < CURDATE()  THEN '2'
            ELSE '0'
        END AS tinhtrang, 1 loai
        FROM tonkho a INNER JOIN hosohanghoa b ON a.mshh =b.mshh 
        WHERE a.msdv='$msdv'  $filter
        ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }

    //Lấy đầu kỳ
    public function load_khachhang($msdv, $tungay)
    {
        $getall = $this->connect->prepare("SELECT a.mskh_bandau, a.tenkhachhang_bandau,  IFNULL(b.dauky,0)dauky  from
        (SELECT mskh as mskh_bandau, tenkhachhang AS tenkhachhang_bandau FROM xuatkhoheader WHERE msdv='$msdv' GROUP BY mskh) a
        LEFT join
        (SELECT  mskh, sum(tongcongvat - dathanhtoan) AS dauky FROM xuatkhoheader WHERE ngay < '$tungay' AND msdv='$msdv' GROUP BY mskh) b
        ON a.mskh_bandau = b.mskh
        ORDER BY mskh_bandau DESC
        ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Lấy tổng cộng
    public function load_tong_phaithu($msdv, $tungay, $denngay)
    {
        $getall = $this->connect->prepare("SELECT SUM(IFNULL(b.dauky,0))sumdauky, sum(c.tongcongvat)tongcongvat, sum(c.dathanhtoan)dathanhtoan, (SUM(IFNULL(b.dauky,0)) + sum(c.tongcongvat) - sum(c.dathanhtoan)) AS tongno  from
         (SELECT mskh as mskh_bandau, tenkhachhang AS tenkhachhang_bandau FROM xuatkhoheader WHERE msdv='$msdv' GROUP BY mskh) a
         LEFT JOIN
         (SELECT mskh, sum(tongcongvat - dathanhtoan) AS dauky FROM xuatkhoheader WHERE ngay < '$tungay' AND msdv='$msdv' GROUP BY mskh)
         b ON a.mskh_bandau = b.mskh
         LEFT JOIN
         (SELECT mskh, sum(tongcongvat)tongcongvat, SUM(dathanhtoan)dathanhtoan  FROM xuatkhoheader WHERE ngay between '$tungay' and '$denngay'  AND msdv='$msdv' GROUP BY mskh)
         c ON a.mskh_bandau = c.mskh ORDER BY c.mskh DESC
         ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Lấy tổng cộng
    public function load_tong_phaitra($msdv, $tungay, $denngay)
    {
        $getall = $this->connect->prepare("SELECT SUM(IFNULL(b.dauky,0))sumdauky, sum(c.tongcongvat)tongcongvat, sum(c.dathanhtoan)dathanhtoan, (SUM(IFNULL(b.dauky,0)) + sum(c.tongcongvat) - sum(c.dathanhtoan)) AS tongno  from
            (SELECT msncc as msncc_bandau, tenncc AS tenncc_bandau FROM nhapkhoheader WHERE msdv='$msdv' GROUP BY msncc) a
            LEFT JOIN
            (SELECT msncc, sum(tongcongvat - dathanhtoan) AS dauky FROM nhapkhoheader WHERE ngaygs < '$tungay' AND msdv='$msdv' GROUP BY msncc)
            b ON a.msncc_bandau = b.msncc
            LEFT JOIN
            (SELECT msncc, sum(tongcongvat)tongcongvat, SUM(dathanhtoan)dathanhtoan  FROM nhapkhoheader WHERE ngaygs between '$tungay' and '$denngay'  AND msdv='$msdv' GROUP BY msncc)
            c ON a.msncc_bandau = c.msncc ORDER BY c.msncc DESC
             ");
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
    public function load_chitiet_phieuthu($msdv, $sophieuthu)
    {
        $getall = $this->connect->prepare("SELECT DATE_FORMAT(lastmodify, '%H:%i %d/%m/%Y')ngay , sotien,nganquy,msnhanvien, tennhanvien FROM thuchi WHERE soct='$sophieuthu' and msdv='$msdv'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }

    //load nhà cung cấp - sản phẩm
    public function load_report_supplier_item($msdv, $loaiSearch, $valueSearch, $tungay, $denngay)
    {
        $filter = '';
        if ($valueSearch != '') {
            if ($loaiSearch == 'tencc') {
                $filter = 'and b.tenncc like "%' . $valueSearch . '%"';
            }
            if ($loaiSearch == 'msncc') {
                $filter = 'and b.msncc like "%' . $valueSearch . '%"';
            }
            if ($loaiSearch == 'soct') {
                $filter = 'and v.soct like "%' . $valueSearch . '%"';
            }
        }
        $getall = $this->connect->prepare("SELECT ''nhacc, ''sanpham, 0 soluong, (SELECT SUM(thanhtiencothue) FROM nhapkholine where msdv = '$msdv' and ngaygs BETWEEN '$tungay' and '$denngay' ) as thanhtien, 1 loai
            UNION ALL SELECT concat(b.msncc, ' | ', b.tenncc) AS nhacc, concat(a.mshh,' | ', a.tenhh) sanpham, sum(a.soluong) AS soluong, SUM(a.thanhtiencothue) AS thanhtien, 0 loai
        FROM nhapkholine a INNER JOIN nhapkhoheader b ON a.msdv = b.msdv AND a.soct=b.soct 
        where b.msdv='$msdv' and a.msdv='$msdv' $filter and (a.ngaygs between '$tungay' and '$denngay' ) 
        GROUP BY  concat(b.msncc, ' | ', b.tenncc), concat(a.mshh,' | ', a.tenhh)
		   ORDER BY loai, nhacc, sanpham
        ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Chi tiết nhập kho
    public function load_report_import($msdv, $valueSearch, $tungay, $denngay)
    {
        $filter = '';
        if ($valueSearch != '') {
            $filter = 'and (b.msncc like "%' . $valueSearch . '%" OR b.tenncc like "%' . $valueSearch . '%" OR a.mshh like "%' . $valueSearch . '%" OR a.tenhh like "%' . $valueSearch . '%" OR b.soct like "%' . $valueSearch . '%")';
        }
        $getall = $this->connect->prepare(" SELECT  DATE_FORMAT(b.ngaygs, '%d/%m/%Y')ngay, b.soct, concat(b.msncc, ' | ', b.tenncc) AS nhacc,  concat(a.mshh,' | ', a.tenhh) sanpham, a.solo,
        DATE_FORMAT(a.handung, '%d/%m/%Y')handung, a.dvt, a.soluong, a.giaban, a.thanhtiencothue  
        FROM nhapkholine a INNER JOIN nhapkhoheader b ON a.soct=b.soct AND a.msdv = b.msdv  where a.msdv='$msdv' $filter and b.msdv='$msdv' and (b.ngaygs between '$tungay' and '$denngay' ) ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }


    //Lấy đầu kỳ nhà cung cấp
    public function load_nhacc($msdv, $tungay)
    {
        $getall = $this->connect->prepare("SELECT a.msncc_bandau, a.tenncc_bandau,  IFNULL(b.dauky,0)dauky  from
           (SELECT msncc as msncc_bandau, tenncc AS tenncc_bandau FROM nhapkhoheader WHERE msdv='1' GROUP BY msncc) a
           LEFT join
           (SELECT  msncc, sum(tongcongvat - dathanhtoan) AS dauky FROM nhapkhoheader WHERE ngaygs < '$tungay' AND msdv='$msdv' GROUP BY msncc) b
           ON a.msncc_bandau = b.msncc
           ORDER BY msncc_bandau DESC
           ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Chi tiết phải thu 
    public function load_report_detail_pay($msdv, $msncc, $valueSearch, $tungay, $denngay)
    {
        $filter = '';
        if ($valueSearch != '') {
            $filter = 'and (a.soct like "%' . $valueSearch . '%" OR a.sohd like "%' . $valueSearch . '%" OR a.msncc like "%' . $valueSearch . '%" OR a.tenncc like "%' . $valueSearch . '%" OR a.sophieuchi like "%' . $valueSearch . '%")';
        }
        $getall = $this->connect->prepare("SELECT DATE_FORMAT(a.ngaygs, '%d/%m/%Y')ngay, a.soct, a.sohd, a.tongcongvat, a.dathanhtoan, a.sophieuchi, a.tongcongvat - a.dathanhtoan AS conno, DATEDIFF(CURDATE(),a.ngaygs) tuoino
        FROM nhapkhoheader a 
          WHERE a.tongcongvat - a.dathanhtoan >= 0 AND a.msncc='$msncc' and a.msdv='$msdv' $filter AND a.ngaygs  BETWEEN '$tungay' and '$denngay' 
          ORDER BY tuoino desc
        ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Chi tiết phải thu 
    public function load_report_accouting($msdv, $valueSearch, $tungay, $denngay)
    {
        $filter = '';
        if ($valueSearch != '') {
            $filter = 'and (b.hoten like "%' . $valueSearch . '%" OR a.noidung like "%' . $valueSearch . '%" OR c.tenloai like "%' . $valueSearch . '%" OR a.tennhanvien like "%' . $valueSearch . '%")';
        }
        $getall = $this->connect->prepare("SELECT ''ngay, ''soct, ''hoten, ''noidung, ''tenloai, ''tennhanvien,''msdv, ''thu, ''chi, (SELECT SUM(sotien)dauky FROM thuchi  WHERE msdv='$msdv' AND ngay <'$tungay') as dauky, '1'loai
         UNION ALL
         SELECT DATE_FORMAT(a.lastmodify, '%H:%i %d/%m/%Y')ngay,a.soct, b.hoten, a.noidung, c.tenloai, a.tennhanvien, a.msdv,
         case when  a.loaichungtu = 0 then a.sotien ELSE 0 END 'thu',
         case when a.loaichungtu = 1 then abs(a.sotien) ELSE 0 END 'chi', ''dauky,'0'loai
         FROM thuchi a
         INNER JOIN hosonhanvien b ON a.msdn = b.msdn
         INNER JOIN dmphanloai c ON a.makhoanmuc = c.msloai
         WHERE a.msdv='$msdv' $filter AND a.ngay BETWEEN '$tungay' AND '$denngay'
         AND c.phanloai='khoanmucthuchi' AND c.msdv='$msdv' ORDER BY loai DESC, ngay DESC
         ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    // Load QR thanh toans
    public function load_qr_thanhtoan($soct)
    {
        $getall = $this->connect->prepare("SELECT qrthanhtoan from xuatkhoheader where soct='$soct'
         ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    // Upload QR thanh toans
    public function upload_qr_thanhtoan($qrthanhtoan, $soct, $msdv)
    {
        $getall = $this->connect->prepare("UPDATE xuatkhoheader set qrthanhtoan='$qrthanhtoan' where soct='$soct' and msdv='$msdv'
          ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
}
