<?php

class Home2 extends database
{
    public function tonkho()
    {
        $getall = $this->connect->prepare("SELECT SUM(toncuoi * gianhapcothue) AS tongtientonkho FROM tonkho ");
        $getall->setFetchMode(PDO::FETCH_OBJ);
        $getall->execute();
        return $getall->fetchAll();
    }
    
   
  
}
