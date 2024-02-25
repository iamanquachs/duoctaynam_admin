
<?php

setcookie("hoten", "", time() - 30758400, "/");
setcookie("msdv", "", time() - 30758400, "/");
setcookie("msdn", "", time() - 30758400, "/");
setcookie("sodienthoai", "", time() - 30758400, "/");
setcookie("email", "", time() - 30758400, "/");
setcookie("diachi", "", time() - 30758400, "/");
setcookie("loaiuser", "", time() - 30758400, "/");

header("Location: ../../index.html");

$filename = "logout";
