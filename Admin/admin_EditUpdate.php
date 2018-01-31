<?php 
	include_once('../database_files/db_setup.php');
	if(!isset($_SESSION['email']) or !isset($_SESSION['password']))
		header('location: main.php');
	$id = $_POST['pid'];
	if(isset($_POST['pid']) and $_POST['pid'] != '')
	{	
		if(check_validation_of_string($_POST['pname']) == 0)
			$pname = mysql_real_escape_string($_POST['pname']);
		else
			$_SESSION['error'][] = "Sorry! Limited Special Charactes allowed in Title.";

		$product_details = mysql_real_escape_string($_POST['product_details']);
		if($_FILES['image']['error'] == 0)
		{
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
							$_SESSION['error'][] = "Unable to upload image";
					}
				}
			}
		}
		else
			$image = $_SESSION['old_image'];
	}
	else
	{
		$_SESSION['error'] = "Unable to update item details";
		header('location: admin_dashboard.php');
	}

	if(!isset($_SESSION['error']))
		update_entry_in_product_table($image,$pname,$product_details,$_POST['per_person_limit'],$_POST['pid']);
	else
		header("location: admin_EditPost.php?id=$id");
?>