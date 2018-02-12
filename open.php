<?php
	include_once('database_files/db_setup.php');	
	if(!isset($_SESSION['email']) or !isset($_SESSION['password']))
		header('location: index.php');
	else
	{
		$val = $_GET['id'];
		$data = get_data_by_key('pid',$val,'product');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once('head.php'); ?>
	<title>MyShopName | Product Details</title>
	<style>
		.row .column a button
		{
			border: none;
			border-radius: 0px;
			font-size: 20px;
			font-family: georgia;
			outline: none;
			box-shadow: 2px 2px 2px #838383;
		}
		.row .column a button:hover
		{
			border: none;
			border-radius: 0px;
			font-size: 20px;
			font-family: georgia;
			outline: none;
			box-shadow: 0px 0px 0px #c3c3c3;
		}
	</style>
</head>
<body>
	<h1 align="center"><?php echo$data[0]['pname']; ?></h1>
	<hr>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="center">
			<a href="<?php echo $data[0]['image']; ?>"><img src="<?php echo $data[0]['image']; ?>" class="img" width="30%" height="30%"></a>
		</div>
		<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 column" style="padding: 1%; margin-left: 10%; font-size: 20px; font-family: georgia">
			<?php echo $data[0]['product_details'] ?>
			<br>
			<br>
			<span>
				Items in stock: <?php echo $data[0]['per_person_limit']; ?>
			</span>
			<br>
			<br>
			<?php
				if($data[0]['per_person_limit'] != 0)
				{
			?>
					<a href="<?php echo 'change_limit.php?pid='.$val ?>"><button type="button" class="btn btn-primary">Purchase</button></a>
			<?php
				}
			?>
		</div>
	</div>
	<br>
	<?php 
		if(isset($_SESSION['error']))
		{
			echo "<br><div class='container'>
				<div class='row'>
					<div class='col-12' style='color:red; font-size:20px; text-align: center;'>".$_SESSION['error']."
					</div>
				</div>
			</div>";

			session_destroy();
		}
		if(isset($_SESSION['update']))
		{
			echo "<br><div class='container'>
				<div class='row'>
					<div class='col-12' style='color:green; font-size:20px; text-align: center;'>".$_SESSION['update']."
					</div>
				</div>
			</div>";

			session_destroy();
		}
	?>
</body>
</html>