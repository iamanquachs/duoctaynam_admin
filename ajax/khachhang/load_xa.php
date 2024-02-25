<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/khachhangClass.php');
$db = new KhachHang();
$mahuyen = $_POST['mahuyen'];
$list = $db->_Get_ListXa($mahuyen, $maxa);
foreach ($list as $r) { ?>
    <option value="<?= $r->maxa ?>"><?= $r->tenxa ?></option>
<?php }
