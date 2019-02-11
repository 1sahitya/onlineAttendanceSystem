<?php
	$server="localhost";
	$user="root";
	$pass="";
	$db="attendance";
	$conn = mysqli_connect($server,$user,$pass,$db);
	if(!$conn){
	die("Connection failed:");
	}
?>