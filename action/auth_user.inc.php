<?php
	if ($_SESSION['user'] == ""|| $_SESSION['pass'] == ""){
	$redirect = $_SERVER['PHP_SELF'];
	header("Refresh: 5; URL=index.php?redirect=$redirect");
	echo "You are currently not logged in, we are redirecting you, be patient!" .'<br/>';
	echo "If your browser doesn't support this, <a href=\"index.php?redirect=$redirect\">click here</a>";
	die();
	}
	else {}



?>
