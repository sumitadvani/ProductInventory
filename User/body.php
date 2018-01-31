<?php
	$data = get_all_data_from_any_table('product');
?>
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
			echo "<br><div class='container'>
				<div class='row'>
					<div class='col-12' style='color:red; font-size:20px; text-align: center;'>".$_SESSION['error']."
					</div>
				</div>
			</div>";

			session_destroy();
	?>
</div>