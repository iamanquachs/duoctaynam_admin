<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/nhapkho_class.php");

$db = new NhapKho();
$soct = $_POST['soct'];
$rowid = $_POST['rowid'];
$db->nhapkho_delete_line($soct, $rowid);