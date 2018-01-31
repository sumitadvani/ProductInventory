<?php 
	include_once('../database_files/db_setup.php');
	if(!isset($_SESSION['email']) or !isset($_SESSION['password']))
		header('location: main.php');
	$value = $_GET['id'];
	$_SESSION['id'] = $value;
	$data = get_data_by_key('pid',$value,'product');
	$_SESSION['old_image'] = $data[0]['image'];
	$email = $_SESSION['email'];
	$password = $_SESSION['password'];
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once('../User/head.php'); ?>
	<title>
		Admin Panel | Edit Item
	</title>
</head>
<body>
	<div class="container">
		<h1>Edit Your Item Details</h1>
		<address style="float: right;">
			<b>Product: <?php echo $data[0]['pname']; ?>	</b>
		</address>
		<br>
		<hr>
		<?php 
			if(isset($_SESSION['edit_post']))
			{
				echo "<br><font color='green'>".$_SESSION['edit_post']."</font>";
				session_destroy();
				session_start();
				ob_start();
				$_SESSION['email'] = $email;
				$_SESSION['password'] = $password;

			}
			if(isset($_SESSION['error']))
			{
				foreach ($_SESSION['error'] as $fail) 
				{
					echo "<br><font color='red'>".$fail."</font>";
				}
				session_destroy();
				session_start();
				ob_start();
				$_SESSION['email'] = $email;
				$_SESSION['password'] = $password;
			}
		?>
		<form method="POST" action="admin_EditUpdate.php" enctype="multipart/form-data" role="form">
			<div class="form-group">
				<input class="form-control" type="hidden" name="pid" value="<?php echo $data[0]['pid'] ?>">
				<label>Product Name</label>
				<input type="text" class="form-control input-lg" name="pname" placeholder="Enter name of your Item" value="<?php echo $data[0]['pname'] ?>">
				<br>
				<label>Product details</label>
				<input type="text" class="form-control input-lg" name="product_details" placeholder="Enter brief description of your Item" value="<?php echo $data[0]['product_details'] ?>">
				<label>Per Person Limit</label>
				<input type="number" class="form-control input-lg" name="per_person_limit" placeholder="Enter Per Person Stock details of your post" value="<?php echo $data[0]['per_person_limit'] ?>">
				<br>
				<a href="<?php echo $data[0]['image'] ?>"><img src="<?php echo $data[0]['image'] ?>" style="max-width: 180px; max-height: 180px;"></a>
				<br>
				<br>
				<label>Change Image</label>
				<input class="btn btn-info btn-lg" type="file" name="image">
			</div>
			<button type="submit" class="btn btn-primary">Update</button>
			<button type="reset" class="btn btn-primary">Reset </button>
		</form>
	</div>
	<script>
		CKEDITOR.replace( 'editor1', {
			uiColor: '#CCEAEE'
		} );
	</script>
</body>
</html>