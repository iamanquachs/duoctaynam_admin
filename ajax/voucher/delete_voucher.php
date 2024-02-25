<?php

include("../../includes/config.php");
include("../../includes/database.php");
require("../../modules/voucherClass.php");

$db = new voucher();
$rowid = $_POST['rowid'];
$db->delete_voucher($rowid);
