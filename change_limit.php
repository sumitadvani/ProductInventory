<?php
	include_once('database_files/db_setup.php');
	if(!isset($_SESSION['email']) or !isset($_SESSION['password']))
		header('location: index.php');
	print_r($_GET);
	$val = $_GET['pid'];
	$data = get_data_by_key('pid',$val,'product');
	$limit = $data[0]['per_person_limit'];
	$limit--;
	$query = "UPDATE `product` SET `per_person_limit`='".$limit."' WHERE `pid` = '".$val."'";
	if(mysql_query($query))
	{
		$_SESSION['update'] = "Purchased one item";
		header("location: open.php?id=$val");
	}
	else
	{
		$_SESSION['error'] = "Unable to purchase item";
		header("location: open.php?id=$val");
	}
?>