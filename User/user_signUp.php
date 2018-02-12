<?php
	include_once('../database_files/db_setup.php');
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once('../User/head.php'); ?>
	<title>User Panel | Sign Up</title>
</head>
<body>
	<nav class="navbar navbar-inverse">
		<div class="container">
			<a class="navbar-brand" href="index.php">Blog Of Sumit Advani</a>
			<ul class="nav navbar-nav">
				<li class="active">
					<a href="index.php">Home</a>
				</li>
				<li>
					<a href="../Admin/main.php">Admin</a>
				</li>
			</ul>
		</div>
	</nav>
	<div class="container">
		<h1>User Sign Up</h1>
		<hr>
		<form action="user_NewEntry.php" method="POST" role="form">
			<div class="form-group">
				<label>Username</label>
				<input type="text" class="form-control input-lg" name="username" required>
				<br>
				<label>e-mail</label>
				<input type="email" class="form-control input-lg" name="email" required>
				<br>
				<label>Password</label>
				<input type="password" class="form-control input-lg" name="password" required>
				<br>
				<label>Confirm Password</label>
				<input type="password" class="form-control input-lg" name="c_password" required>
			</div>		
			<button type="submit" class="btn btn-primary">Sign Up</button>
		</form>
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
</body>
</html>