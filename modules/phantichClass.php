<?php
class phantichClass extends database
{
    public function list_msdv()
    {
        $getall = $this->connect->prepare("SELECT msdv,tendv from ectheodoinhapxuat group by msdv");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    public function list_nhapxuat($msdv, $tungay, $denngay)
    {
        $getall = $this->connect->prepare("SELECT tendv,tenhh,tenhc,gianhap,sum(slnhap)slnhap,giaban,sum(slban)slban,tenncc from ectheodoinhapxuat where msdv = '$msdv' and DATE_FORMAT(lastmodify,'%Y-%m-%d') between '$tungay' and '$denngay' group by mshh,tenhc,msncc");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
}
