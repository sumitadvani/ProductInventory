<?php
	include_once('../database_files/db_setup.php');
	if(!isset($_SESSION['email']) or !isset($_SESSION['password']))
		header('location: main.php');
	if(!isset($_POST['id']) or $_POST['id'] == '')
		header('location: admin_dasboard.php');
	if(check_validation_of_string($_POST['pname']) == 0)
		$pname = mysql_real_escape_string($_POST['pname']);
	else
		$_SESSION['error'][] = "Sorry! Limited Special Charactes allowed in Title.";

	$product_details = mysql_real_escape_string($_POST['product_details']);

	$status = $_POST['status'];
	$format = array('jpg','jpeg','png','gif');
	$type = explode('/', $_FILES['image']['type']);
	foreach ($format as $key) 
	{
		if($key == $type[1])
		{
			if($_FILES['image']['name'])
			{
				$target = "../images/".$_FILES['image']['name'];
				if(move_uploaded_file($_FILES['image']['tmp_name'], $target))
					$image = "../images/".$_FILES['image']['name'];
				else
					$_SESSION['error_image'] = "Unable to upload image";
			}
		}
	}

	if(!isset($_SESSION['error']) and !isset($_SESSION['error_image']))
		new_entry_in_product_table($pname,$product_details,$_POST['per_person_limit'],$image,$status);
	else
		header('location: admin_NewPost.php');

?>