<?php
	session_start();
	ob_start();
	$host = "localhost";
	$user = "root";
	$pass = "";
	$dbase = "project1";
	if (mysql_connect($host,$user,$pass)) 
	{
		if (mysql_select_db($dbase)) 
		{
			include_once('functions.php');
		}	
		else
			$_SESSION['error'] = "Unable to select database";
	}
	else
		$_SESSION['error'] = "Connection with database failed";
	if(isset($_SESSION['error']))
		header('location: index.php');
?>