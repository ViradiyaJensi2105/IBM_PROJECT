<?php
	include('db.php');
	$q1=mysqli_query($connection,"SELECT * FROM user_master WHERE utype='user' ");
	$nouser=mysqli_num_rows($q1);

	$q2=mysqli_query($connection,"SELECT * FROM user_master WHERE utype='worker' ");
	$noworker=mysqli_num_rows($q2);

	$q3=mysqli_query($connection,"SELECT * FROM complain_master");
	$nocomplain=mysqli_num_rows($q3);

	$q4=mysqli_query($connection,"SELECT * FROM work_cmp WHERE conf_code=2");
	$nosolvedcomplain=mysqli_num_rows($q4);

	$percentage=round(($nosolvedcomplain*100)/$nocomplain);
	$percentage1=round(100-$percentage);

	$nrcomplain=$nocomplain-$nosolvedcomplain;

	$q5=mysqli_query($connection,"SELECT * FROM user_master WHERE utype='user' ");
	$nuser=mysqli_num_rows($q5);

	$q6=mysqli_query($connection,"SELECT * FROM user_master WHERE utype='worker' AND conf_code=2");
	$nworker=mysqli_num_rows($q6);

	$q7=mysqli_query($connection,"SELECT * FROM complain_master");
	$ncomplain=mysqli_num_rows($q7);

	$q8=mysqli_query($connection,"SELECT * FROM complain_master WHERE conf_code=4");
	$nscomplain=mysqli_num_rows($q8);

	$q9=mysqli_query($connection,"SELECT * FROM city");
	$ncity=mysqli_num_rows($q9);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
</head>
<body>
	<?php
		include('sidebar.php');
	?>

	<div class="outter-wp" style="margin-left: 250px;">
		<div class="custom-widgets">
			<div class="row-one">
				<div class="col-md-3 widget" style="float: left;margin-left:150px;">
					<div class="stats-left">
						<h5>Total</h5>	
						<h4> Users</h4>
					</div>	
					<div class="stats-right">
						<label><?php echo $nuser; ?></label>
					</div>
					<div class="clearfix"></div>	
				</div>
				<div class="col-md-3 widget" style="float: right;margin-right:150px;">
					<div class="stats-left">
						<h5>Total</h5>
						<h4>Worker</h4>
					</div>
					<div class="stats-right">
						<label> <?php echo $nworker; ?></label>
					</div>
					<div class="clearfix"></div>	
				</div><br><br><br><br><br><br><br><br>
				<div class="col-md-3 widget" style="float: left;margin-left:150px;">
					<div class="stats-left">
						<h5>Total</h5>
						<h4>Tasks</h4>
					</div>
					<div class="stats-right">
						<label><?php echo $ncomplain; ?></label>
					</div>
					<div class="clearfix"> </div>	
				</div>
				<div class="col-md-3 widget" style="float:right;margin-right:150px;">
					<div class="stats-left">
						<h5>Solved</h5>
						<h4>Problem</h4>
					</div>
					<div class="stats-right">
						<label><?php echo $nscomplain; ?></label>
					</div>
					<div class="clearfix"> </div>	
				</div><br><br><br><br><br><br><br><br>
				<div class="col-md-3 widget" style="transform: translate(160%);">
					<div class="stats-left">
						<h5>Total</h5>
						<h4>City</h4>
					</div>
					<div class="stats-right">
						<label><?php echo $ncity; ?></label>
					</div>
					<div class="clearfix"> </div>	
				</div>
				<div class="clearfix"> </div>	
			</div>
		</div>
	</div>
</body>
</html>