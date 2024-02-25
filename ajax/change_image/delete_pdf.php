<?php
include('../../includes/config.php');
include('../../includes/database.php');
require('../../modules/change_img_class.php');
$db_phanloai = new ChangeImage();
$vitri_header = $_POST['vitri_header'];
$vitri_line = $_POST['vitri_line'];
$pdf = '';

$list =  $db_phanloai->delete_pdf($vitri_header, $vitri_line, $pdf);
