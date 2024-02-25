<?php
if ($filename == "api") {
	require_once VIEWS . $filename . ".php";
} else {
	require_once VIEWS . "header.php";
	require_once VIEWS . $filename . ".php";
	require_once VIEWS . "footer.php";
}
