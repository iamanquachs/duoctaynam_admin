<?php
class Items extends database
{
    //Show Items
    public function item_show($msnhom, $msncc, $tieuchuan, $msnsx, $loaihh, $trangthai, $group_sp)
    {
        $dieukien = "";
        if ($msnhom != "") {
            $dieukien = $dieukien . " and groupproduct = '$msnhom' ";
        }
        if ($msncc != '') {
            $dieukien = $dieukien . " and msncc = '$msncc' ";
        }
        if ($tieuchuan != '') {
            $dieukien = $dieukien . " and `standard` = '$tieuchuan' ";
        }
        if ($msnsx != '') {
            $dieukien = $dieukien . " and producer = '$msnsx' ";
        }

        if ($loaihh != '') {
            $dieukien = $dieukien . " and loaihh = '$loaihh' ";
        }
        if ($group_sp != '') {
            $dieukien = $dieukien . " and group_sp = '$group_sp' ";
        }
        if ($trangthai != '') {
            $dieukien = $dieukien . " and trangthai = '$trangthai' ";
        }


        $getall = $this->connect->prepare("SELECT (@row_number:=@row_number + 1) AS stt, a.rowid, a.trangthai,a.msncc, a.msnpp, a.mshhnpp, a.mshh, a.tenhh, a.tenhoatchat, a.hamluong,
        a.`standard`, a.groupproduct, a.producer, a.ptgiagoc, a.dvtmin, ifnull(b.giaban,0)giaban, a.gianhapvat,a.ptgiaban, a.slquydoi, a.dvtmax, a.giabanmax, a.country,
         a.thuesuat, a.url_image, a.path_image, a.loaihh, a.bantheodon, a.tonkhott,  ifnull(CONCAT(b.dvt_ban,' ',b.slquydoi,' ', b.dvt_egpp), '')quycach, a.group_sp FROM 
       hosohanghoa a 
       LEFT JOIN
               (
               SELECT mshh, dvt_ban, slquydoi, dvt_egpp, CONCAT(REPLACE(FORMAT(MIN(giabanvat)  , 'vn_VN'),',','.'),'-', REPLACE(FORMAT(MAX(giabanvat)  , 'vn_VN'),',','.'))AS giaban
               FROM hoso_giaban WHERE MAX=0 AND khoa = 0 GROUP BY mshh
               ) b
       ON a.mshh = b.mshh 
         WHERE 1 = 1  $dieukien order by a.trangthai, a.tenhh

       ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Show Items
    public function item_fillter_trangthai($trangthai)
    {
        $dieukien = "";
        if ($trangthai != "") {
            $dieukien = " and a.trangthai = '$trangthai' ";
        }

        $getall = $this->connect->prepare("SELECT (@row_number:=@row_number + 1) AS stt, a.rowid, a.trangthai,a.msncc, a.msnpp, a.mshhnpp, a.mshh, a.tenhh, a.tenhoatchat, a.hamluong,
        a.`standard`, a.groupproduct, a.producer, a.ptgiagoc, a.dvtmin, ifnull(b.giaban,0)giaban, a.gianhapvat,a.ptgiaban, a.slquydoi, a.dvtmax, a.giabanmax, a.country,
         a.thuesuat, a.url_image, a.path_image, a.loaihh, a.bantheodon, a.tonkhott,  ifnull(CONCAT(b.dvt_ban,' ',b.slquydoi,' ', b.dvt_egpp), '')quycach, a.group_sp FROM 
       hosohanghoa a 
       LEFT JOIN
               (
               SELECT mshh, dvt_ban, slquydoi, dvt_egpp, CONCAT(REPLACE(FORMAT(MIN(giabanvat)  , 'vn_VN'),',','.'),'-', REPLACE(FORMAT(MAX(giabanvat)  , 'vn_VN'),',','.'))AS giaban
               FROM hoso_giaban WHERE MAX=0 AND khoa = 0 GROUP BY mshh
               ) b
       ON a.mshh = b.mshh 
        WHERE 1 = 1  " . $dieukien . "  order by a.trangthai, a.tenhh");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Show Items
    public function item_search($value)
    {
        $getall = $this->connect->prepare("SELECT (@row_number:=@row_number + 1) AS stt, a.rowid, a.trangthai,a.msncc, a.msnpp, a.mshhnpp, a.mshh, a.tenhh, a.tenhoatchat, a.hamluong,
        a.`standard`, a.groupproduct, a.producer, a.ptgiagoc, a.dvtmin, ifnull(b.giaban,0)giaban, a.gianhapvat,a.ptgiaban, a.slquydoi, a.dvtmax, a.giabanmax, a.country,
         a.thuesuat, a.url_image, a.path_image, a.loaihh, a.bantheodon, a.tonkhott,  ifnull(CONCAT(b.dvt_ban,' ',b.slquydoi,' ', b.dvt_egpp), '')quycach, a.group_sp FROM 
       hosohanghoa a 
       LEFT JOIN
               (
               SELECT mshh, dvt_ban, slquydoi, dvt_egpp, CONCAT(REPLACE(FORMAT(MIN(giabanvat)  , 'vn_VN'),',','.'),'-', REPLACE(FORMAT(MAX(giabanvat)  , 'vn_VN'),',','.'))AS giaban
               FROM hoso_giaban WHERE MAX=0 AND khoa = 0 GROUP BY mshh
               ) b
       ON a.mshh = b.mshh 
        WHERE 1 = 1  AND (a.tenhh LIKE '%$value%' OR a.tenhoatchat LIKE '%$value%') order by a.trangthai, a.tenhh");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }


    //Load thongo tin sản phẩm chỉnh sửa
    public function item_load_edit($url)
    {
        $getall = $this->connect->prepare("SELECT (@row_number:=@row_number + 1) AS stt, rowid, lastmodify, trangthai, msncc, msnpp, mshhnpp, mshh, tenhh, tenhoatchat,tenbietduoc, hamluong, quycach, `standard`, groupproduct, producer, ptgiagoc, dvtmin, giabanmin, slquydoi, dvtmax, giabanmax, country, thuesuat, mshhncc, url_image, path_image, path_image_child, loaihh, bantheodon, tonkhott, quycach, group_sp, ghichu FROM hosohanghoa , (SELECT @row_number:=0) AS temp 
        WHERE mshh='$url'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }

    //Edit hàng hóa
    public function item_edit($msdv, $msdn, $nhasx, $nuocsx, $tieuchuan, $msnhom, $msncc, $msncchh, $msnpp, $mshhnpp,  $dvt, $mshh, $tenhh, $tenhc, $tenbd, $hamluong, $thuesuat,  $tonkhotoithieu, $loaihh, $bantheodon, $trangthaihh,  $url_hanghoa, $nhomnoibat, $ghichu)
    {
        $getall = $this->connect->prepare("UPDATE hosohanghoa set lastmodify = NOW(),msdn='$msdn', producer='$nhasx', country='$nuocsx', `standard`='$tieuchuan', groupproduct='$msnhom', msncc='$msncc', mshhncc='$msncchh', msnpp='$msnpp', mshhnpp='$mshhnpp', dvtmin='$dvt', giabanmin='', dvtmax='', giabanmax='', quycach='', slquydoi='', tenhh='$tenhh', tenhoatchat='$tenhc', tenbietduoc='$tenbd',hamluong='$hamluong', thuesuat='$thuesuat', ptgiagoc='',tonkhott='$tonkhotoithieu', loaihh='$loaihh',bantheodon='$bantheodon', trangthai='$trangthaihh', `url`='$url_hanghoa', group_sp='$nhomnoibat', ghichu='$ghichu' where mshh='$mshh';
        DELETE FROM hoso_giaban where mshh not in (select mshh from hosohanghoa where  msdv='$msdv') and msdn='$msdn
        ");
        $getall->execute();
    }

    //Add sản phảm mới
    public function item_add($msdv, $msdn, $nhasx, $nuocsx, $tieuchuan, $msnhom, $msncc, $msncchh, $msnpp, $mshhnpp, $dvt, $mshh, $tenhh, $tenhc, $tenbd, $hamluong, $thuesuat,  $tonkhotoithieu, $loaihh, $bantheodon, $trangthaihh, $path_image, $path_image_mota, $url_hanghoa, $nhomnoibat, $ghichu)
    {
        $getall = $this->connect->prepare("INSERT INTO hosohanghoa(lastmodify, msdn,producer, country, `standard`,groupproduct, msncc, mshhncc,msnpp, mshhnpp, dvtmin,giabanmin, dvtmax, giabanmax,quycach, slquydoi, mshh,tenhh, tenhoatchat, tenbietduoc,hamluong, thuesuat, ptgiagoc,tonkhott, loaihh,bantheodon, trangthai,path_image,path_image_child,`url`,tim_start, group_sp, ghichu)
        VALUES (NOW(),'$msdn','$nhasx', '$nuocsx', '$tieuchuan','$msnhom', '$msncc', '$msncchh', '$msnpp', '$mshhnpp', '$dvt', '', '', '', '', '', '$mshh', '$tenhh', '$tenhc', '$tenbd', '$hamluong', '$thuesuat', '', '$tonkhotoithieu', '$loaihh', '$bantheodon', '$trangthaihh', '$path_image', '$path_image_mota','$url_hanghoa', (FLOOR(1 + RAND() * 999)), '$nhomnoibat', '$ghichu');
        DELETE FROM hoso_giaban where mshh not in (select mshh from hosohanghoa where  msdv='$msdv') and msdn='$msdn'
        ");
        $getall->execute();
    }

    //update trạng thái
    public function item_update_trangthai($mshh, $trangthai)
    {
        $getall = $this->connect->prepare("UPDATE hosohanghoa set trangthai = '$trangthai' WHERE mshh='$mshh'");
        $getall->execute();
    }

    //update hình ảnh mô tả
    public function item_update_img_mota($mshh, $path_image_child)
    {
        $getall = $this->connect->prepare("UPDATE hosohanghoa set lastmodify = NOW(), path_image_child = '$path_image_child' WHERE mshh='$mshh'");
        $getall->execute();
    }
    //update hình ảnh mô tả
    public function item_edit_img_chinh($mshh, $path_image)
    {
        $getall = $this->connect->prepare("UPDATE hosohanghoa set path_image = '$path_image' WHERE mshh='$mshh'");
        $getall->execute();
    }
    //update hình ảnh mô tả
    public function Get_image_child($mshh)
    {
        $getall = $this->connect->prepare("SELECT path_image_child from hosohanghoa WHERE mshh='$mshh'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Load mô tả sản phẩm
    public function ktra_mshh_mota($mshh)
    {
        $getall = $this->connect->prepare("SELECT mshh from motahanghoa where mshh='$mshh'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Thêm mô tả sản phẩm
    public function add_mota($msdn, $mshh, $chidinh, $chongchidinh, $lieudung, $tacdungphu, $thantrong, $tuongtacthuoc, $baoquan)
    {
        $getall = $this->connect->prepare("INSERT motahanghoa(lastmodify,msdn, mshh, chidinh, chongchidinh, lieudung, tacdungphu, thantrong, tuongtacthuoc, baoquan) VALUES(NOW(),'$msdn','$mshh','$chidinh','$chongchidinh','$lieudung','$tacdungphu','$thantrong','$tuongtacthuoc','$baoquan' )");
        $getall->execute();
    }
    //Thêm chỉnh mô tả sản phẩm
    public function edit_mota($msdn, $mshh, $chidinh, $chongchidinh, $lieudung, $tacdungphu, $thantrong, $tuongtacthuoc, $baoquan)
    {
        $getall = $this->connect->prepare("UPDATE motahanghoa set lastmodify=NOW(),chidinh='$chidinh', chongchidinh='$chongchidinh', lieudung='$lieudung', tacdungphu='$tacdungphu', thantrong='$thantrong', tuongtacthuoc='$tuongtacthuoc', baoquan='$baoquan' where mshh='$mshh'");
        $getall->execute();
    }
    //Thêm phân loại
    public function add_phanloai($msdv, $msloai, $tenloai, $phanloai, $dieukien2)
    {
        $getall = $this->connect->prepare("INSERT dmphanloai(msdv, msloai, tenloai, phanloai, dieukien2) VALUES('$msdv','$msloai','$tenloai','$phanloai', '$dieukien2')");
        $getall->execute();
    }
    //Show Danh mục phân loại nhóm sản phẩm
    public function dmphanloai_load_nhomsp()
    {
        $getall = $this->connect->prepare("SELECT msloai, tenloai from dmphanloai where phanloai='groupproduct' order by tenloai asc, dieukien1");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Show Danh mục phân loại tiêu chuẩn
    public function dmphanloai_load_tieuchuan()
    {
        $getall = $this->connect->prepare("SELECT msloai, tenloai from dmphanloai where phanloai='standard' order by tenloai");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Show Danh mục phân loại đơn vị tính
    public function dmphanloai_load_loaihh()
    {
        $getall = $this->connect->prepare("SELECT msloai, tenloai from dmphanloai where phanloai='loaihh' order by  tenloai");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function dmphanloai_load_nuocsx()
    {
        $getall = $this->connect->prepare("SELECT msloai, tenloai from dmphanloai where phanloai='country' order by  tenloai");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Show Danh mục phân loại
    public function dmphanloai_load_nhasx()
    {
        $getall = $this->connect->prepare("SELECT msloai, tenloai from dmphanloai where phanloai='producer' order by tenloai");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Show Danh mục phân loại đơn vị tính
    public function dmphanloai_load_dvt()
    {
        $getall = $this->connect->prepare("SELECT msloai, tenloai from dmphanloai where phanloai='dvt' order by  tenloai");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //delete nha san xuat
    public function delete_phanloai($msloai, $phanloai)
    {
        $getall = $this->connect->prepare("DELETE from dmphanloai where msloai='$msloai' and phanloai='$phanloai'");
        $getall->execute();
    }
    //Show Danh mục phân loại đơn vị tính
    public function load_mota_edit($mshh)
    {
        $getall = $this->connect->prepare("SELECT chidinh, chongchidinh, lieudung, tacdungphu, thantrong, tuongtacthuoc, baoquan  from motahanghoa where mshh='$mshh' ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function ktr_msloai($msloai, $phanloai)
    {
        $getall = $this->connect->prepare("SELECT msloai from dmphanloai where phanloai='$phanloai' and msloai='$msloai' ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }

    // Kiểm tra giá bán
    public function ktr_giaban($msdv, $mshh)
    {
        $getall = $this->connect->prepare("SELECT mshh FROM hoso_giaban WHERE msdv='$msdv' and mshh='$mshh' and max=1");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }

    //Thêm giá bán
    public function add_hosogiaban($msdv, $msdn, $mshh, $dvt_ban, $sl_bantu, $sl_banden, $giabanvat, $sl_quydoi, $dvt_egpp, $max)
    {
        $getall = $this->connect->prepare("INSERT INTO hoso_giaban(lastmodify,msdv, msdn, mshh, stt, dvt_egpp, sl_bantu, sl_banden, dvt_ban, slquydoi, giabanvat, max)
        values (NOW(),'$msdv','$msdn','$mshh', '0',
        '$dvt_egpp','$sl_bantu','$sl_banden','$dvt_ban','$sl_quydoi','$giabanvat','$max')");
        $getall->execute();
    }
    public function load_hosogiaban($msdv, $mshh)
    {
        $getall = $this->connect->prepare("SELECT rowid,DATE_FORMAT(lastmodify, '%H:%i %d/%m/%y') as ngay, mshh, dvt_egpp, sl_bantu, sl_banden, dvt_ban, slquydoi, giabanvat, khoa, max FROM hoso_giaban WHERE msdv='$msdv' and mshh='$mshh'   ORDER BY max,giabanvat");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function edit_hosogiaban($msdv, $msdn, $rowid, $dvt_ban, $sl_bantu, $sl_banden, $giabanvat, $sl_quydoi, $dvt_egpp, $khoa, $max)
    {
        $getall = $this->connect->prepare("UPDATE hoso_giaban set lastmodify=NOW(), msdn='$msdn', dvt_ban='$dvt_ban', sl_bantu='$sl_bantu', sl_banden='$sl_banden', giabanvat='$giabanvat', slquydoi='$sl_quydoi', dvt_egpp='$dvt_egpp', khoa='$khoa', max='$max' where rowid='$rowid' and msdv='$msdv' ");
        $getall->execute();
    }
    //Thêm Xóa hồ sơ giá bán
    public function delete_hosogiaban($msdv, $rowid)
    {
        $getall = $this->connect->prepare("DELETE FROM hoso_giaban where rowid='$rowid' and msdv='$msdv'");
        $getall->execute();
    }
    //Thêm Xóa hồ sơ giá bán
    public function get_giaban_min_max($mshh)
    {
        $getall = $this->connect->prepare("SELECT  concat(dvt_ban,' ', slquydoi, ' ', dvt_egpp) AS quycach, (SELECT giabanvat  FROM hoso_giaban WHERE mshh='$mshh' AND khoa=0  ORDER BY giabanvat LIMIT 1) AS giabanmin, 
         (SELECT giabanvat  FROM hoso_giaban WHERE mshh='$mshh' AND khoa=0  ORDER BY giabanvat desc LIMIT 1) AS giabanmax, dvt_ban
       FROM hoso_giaban WHERE mshh='$mshh' AND khoa=0  ORDER BY giabanvat LIMIT 1");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    //Update giá bán từ hoso_giaban vào hosohanghoa
    public function update_giaban_min_max($mshh)
    {
        $list = $this->get_giaban_min_max($mshh);
        foreach ($list as $r) {
            $quycach = $r->quycach;
            $dvtmin = $r->dvt_ban;
            $giabanmin = $r->giabanmin;
            $giabanmax = $r->giabanmax;
        }
        $getall = $this->connect->prepare("UPDATE hosohanghoa set dvtmin='$dvtmin', quycach='$quycach', giabanmin='$giabanmin', giabanmax='$giabanmax' where mshh ='$mshh'");
        $getall->execute();
    }
    //! update toàn bộ hàng hóa 
    // public function ac()
    // {
    //     $getall = $this->connect->prepare("SELECT mshh
    //    FROM hosohanghoa ");
    //     $getall->setFetchMode(PDO::FETCH_OBJ);
    //     $getall->execute();
    //     return $getall->fetchAll();
    // }
}
