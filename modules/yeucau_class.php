<?php

class YeuCau extends database
{
    public function load_yeucau()
    {
        $getall = $this->connect->prepare("SELECT rowid,DATE_FORMAT(lastmodify, '%I:%i %d/%m/%y')ngaygio ,msdv, msdn,`url`,DATE_FORMAT(url_lastmodify, '%I:%i %d/%m/%y')url_lastmodify, tenhh, tenhc, hamluong, nhasx, ghichu from yeucauhanghoa ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function edit_yeucau($msdv, $msdn, $rowid, $link)
    {
        $getall = $this->connect->prepare("UPDATE yeucauhanghoa set `url`='$link', url_lastmodify=NOW() where msdv='$msdv' and msdn='$msdn' and rowid='$rowid'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function delete_yeucau($msdv, $msdn, $rowid)
    {
        $getall = $this->connect->prepare("DELETE from yeucauhanghoa where msdv='$msdv' and msdn='$msdn' and rowid='$rowid'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
}
