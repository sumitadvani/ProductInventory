<?php 
	include_once('../database_files/db_setup.php'); 
	if(!isset($_SESSION['email']) or !isset($_SESSION['password']))
		header('location: index.php');
	else
	{
		$data = get_all_data_from_any_table('product');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once('head.php'); ?>
	<title>MyShopName | Mains</title>
</head>
<body>
	<nav class="navbar navbar-inverse">
		<div class="container">
			<a class="navbar-brand" href="#">My Shop Name</a>
			<ul class="nav navbar-nav">
				<li class="active">
					<a href="#">Home</a>
				</li>
				<li>
					<a href="../admin/main.php">Admin</a>
				</li>
			</ul>
		</div>
	</nav>
	<div class="container">
		<div class="row alert-danger">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h1 align="center">My Shop Name</h1>
				<hr>	
			</div>
		</div>
		<br>
		<div class="container">
			<h2>Product Updates</h2>
			<br>
			<div class="row">
			<?php
				for($i = 0; $i < count($data); $i++)
				{
					if($data[$i]['status'] != 0)
					{
			?>
				<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2" style="height: 200px;">
					<a href="open.php?id=<?php echo $data[$i]['pid']; ?>"><img src="<?php echo $data[$i]['image']; ?>" class="img img-thumbnail" width="100%"></a>
				</div>
				<div class="col-xs-12 col-sm-10 col-md-10 col-lg-4" style="height: 200px;">
					<a href="open.php?id=<?php echo $data[$i]['pid']; ?>"><?php echo $data[$i]['pname'] ?></a>
					<br>
					<?php echo $data[$i]['product_details'] ?>
				</div>
			
			<?php
					}
				}
			?>
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
			?>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="center">
				<a href="user_LogOut.php"><button type="button" class="btn btn-lg btn-primary">Log Out</button></a>
			</div>
		</div>
	</div>
</body>
</html>