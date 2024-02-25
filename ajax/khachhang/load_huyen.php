<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/khachhangClass.php');
$db = new KhachHang();
$matinh = $_POST['matinh'];
$list = $db->_Get_ListHuyen($matinh,$mahuyen);
foreach ($list as $r) { ?>
    <option value="<?= $r->mahuyen ?>"><?= $r->tenhuyen ?></option>
<?php }
