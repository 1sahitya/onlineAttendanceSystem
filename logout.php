<?php
	require_once('topArea.php');
	unset($_COOKIE['suser']);
	setcookie('suser', '', time() - 3600);
	header('Location:index.php');
?>