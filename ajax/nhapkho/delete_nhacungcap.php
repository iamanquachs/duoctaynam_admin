<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/nhapkho_class.php");

$db = new NhapKho();
$msnsx=$_POST['msnsx'];
$db->delete_nhacungcap($msnsx);
