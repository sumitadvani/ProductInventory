<?php
	include_once('database_files/db_setup.php');
	if(!isset($_POST['email']) or !isset($_POST['password']))
		header('location: main.php');
	$value1 = mysql_real_escape_string($_POST['email']);
	$value2 = $_POST['password'];
	login_check('email',$value1,$value2,'admin');
?>