<?php
	function get_all_data_from_any_table($table)
	{
		$data = array();
		$query = "SELECT * FROM `".$table."` ORDER BY pid DESC";
		if($sql = mysql_query($query))
		{
			while($result = mysql_fetch_assoc($sql))
				$data[] = $result;
		}
		else
		{
			$_SESSION['error'] = "Unable to fetch data from database";
			header('location: body.php');
		}
		return $data;
	}

	function get_data_by_key($key,$value,$table)
	{
		$data = array();
		$query = "SELECT * FROM `".$table."` WHERE `".$key."`='".$value."'";
		if($sql = mysql_query($query))
		{
			while($result = mysql_fetch_assoc($sql))
				$data[] = $result;
		}
		else
		{
			$_SESSION['error'] =  "Unable to fetch data from database";
			header('location: open.php');
		}
		return $data;		
	}

	function login_check($key1,$value1,$value2,$table)
	{
		$data = array();
		$query = "SELECT * FROM `".$table."` where `".$key1."`='".$value1."'";
		if($sql = mysql_query($query))
		{
			while ($result =mysql_fetch_assoc($sql)) 
			{
				$data[] = $result;
				if($value1 == $result['email'])
				{
					$_SESSION['email'] = $value1;
					if($value2 == $result['password'])
					{
						$_SESSION['password'] = $value2;
						header('location: admin_dashboard.php');
					}
					else
						$_SESSION['error'] = "Inavlid Password";
				}
				else
					$_SESSION['error'] = "Inavlid Email";
			}
		}
		else
			$_SESSION['error'] = "No results for this query";
		
		if(isset($_SESSION['error']))
			header('location: main.php');
				
		if(count($data) == 0)
		{
			$_SESSION['error'] = "Empty table";
			header('location: main.php');
		}
	}

	function new_entry_in_admin_table($value1,$value2,$value3)
	{
		$query = "INSERT INTO `admin`(`username`,`email`,`password`) VALUES ('".$value1."','".$value2."','".$value3."')";
		if(mysql_query($query))
		{
			$_SESSION['new_admin'] = "Admin added successfully";
			header('location: main.php');
		}
		else
			echo "<span style='font-size: 20px; font-family: arial;'>Error:</span><br><hr> <p style='font-size: 16px;'>Unable to run Insert query</p>";
	}

	function new_entry_in_product_table($value1,$value2,$value3,$value4,$value5)
	{
			$query = "INSERT INTO `product`(`pname`, `product_details`, `per_person_limit`,`image`,`status`) VALUES ('".$value1."','".$value2."','".$value3."','".$value4."','".$value5."')";
			if(mysql_query($query))
			{
				$_SESSION['new_post'] = "New Item Details added successfully";
				header('location: admin_NewPost.php');
			}
			else
				echo "<span style='font-size: 20px; font-family: arial;'>Error:</span><br><hr> <p style='font-size: 16px;'>Unable to run Insert query</p>";
	}

	function delete_post($id,$table)
	{
		$query = "DELETE FROM `".$table."` WHERE `pid` = '".$id."'";
		if(mysql_query($query))
		{
			$_SESSION['delete_post'] = "Item Deleted successfully";
			header('location: admin_dashboard.php');
		}
		else
			echo "<span style='font-size: 20px; font-family: arial;'>Error:</span><br><hr> <p style='font-size: 16px;'>Unable to run Delete query</p>";
	}

	function check_validation_of_string($str)
	{
		if(preg_match_all('~[^A-Za-z0-9,-,\s]~', $str, $match))
			return '1';
		else
			return '0';
	}

	function update_entry_in_product_table($value1,$value2,$value3,$value4,$value5)
	{
			$query = "UPDATE `product` SET `image`= '".$value1."',`pname`= '".$value2."',`product_details`= '".$value3."',`per_person_limit`= '".$value4."' WHERE `pid`= '".$value5."'";
			if(mysql_query($query))
			{
				$_SESSION['edit_post'] = "Item Details Updated successfully";
				header("location: admin_EditPost.php?id=".$_SESSION['id']);
			}
			else
				echo "<span style='font-size: 20px; font-family: arial;'>Error:</span><br><hr> <p style='font-size: 16px;'>Unable to run Insert query</p>";
	}
?>