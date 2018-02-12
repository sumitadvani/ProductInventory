<?php 
	include_once('../database_files/db_setup.php');
	if(!isset($_POST['email']) or !isset($_POST['password']))
		header('location: user_SignUp.php');
	$data = get_all_data_from_any_table('user');
	$flag = 0;
	$username = mysql_real_escape_string($_POST['username']);
	$email = mysql_real_escape_string($_POST['email']);
	$password = mysql_real_escape_string($_POST['password']);
	if($password == $_POST['c_password'])
	{
		for($i = 0; $i < count($data); $i++)
		{
			if($email == $data[$i]['email'])
				$_SESSION['error'] = "Email already exists";
			else
				$flag++;
		}
		if($flag == count($data))
			new_entry_in_any_table('user',$username,$email,$password);
	}
	else
		$_SESSION['error'] = "Passwords didn't match";
	
	if(isset($_SESSION['error']))
		header('location: user_SignUp.php');
?>