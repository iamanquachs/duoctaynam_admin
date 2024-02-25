<?php
$filename = 'phantich';
require('modules/phantichClass.php');
$db = new phantichClass();
$list_msdv = $db->list_msdv();
