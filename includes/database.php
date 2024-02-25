<?php
session_start();
// (host, tai khoan, mat khau, ten bang db)
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
mysqli_set_charset($con, "utf8");
class database
{
	public $connect;
	public function __construct()
	{
		try {
			// (host, dbname, charset, tai khoan, matkhau)
			$this->connect = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
			$this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		} catch (PDOException $EX) {
			echo $EX->getMessage();
		}
	}
	public function __destruct()
	{
		$this->connect = null;
	}
}
$database = new database();
