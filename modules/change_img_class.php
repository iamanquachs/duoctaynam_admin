<?php

class ChangeImage extends database
{
    public function load_img_banner()
    {
        $getall = $this->connect->prepare("SELECT lastmodify, vitri, trangthai FROM banner_header where trangthai=0");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function load_img_banner_line($vitri)
    {
        $getall = $this->connect->prepare("SELECT lastmodify,vitri_header, vitri, url_image, path_image, path_pdf FROM banner_line where vitri_header='$vitri'");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function change_banner($vitri, $path_image, $vitri_header, $path_pdf)
    {
        $getall = $this->connect->prepare("UPDATE banner_line set lastmodify=NOW(), path_image='$path_image', path_pdf='$path_pdf' where vitri='$vitri' and vitri_header='$vitri_header' ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function delete_pdf($vitri_header, $vitri_line, $pdf)
    {
        $getall = $this->connect->prepare("UPDATE banner_line set lastmodify=NOW(), path_pdf='$pdf' where vitri='$vitri_line' and vitri_header='$vitri_header' ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
}
