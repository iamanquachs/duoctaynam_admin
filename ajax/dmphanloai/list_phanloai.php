<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/get_dmphanloai_class.php');
$db_phanloai = new DMPhanLoai();
$phanloai = $_POST['PhanLoai'];
$List_MSLyDo = $db_phanloai->dmphanloai_load($phanloai);
?>
<?php echo ('<option value="0">Vui lòng chọn</option>') ?>
<?php
foreach ($List_MSLyDo as $r) { ?>
    <option value="<?= $r->msloai ?>"><?= $r->tenloai ?></option>
<?php }
?>