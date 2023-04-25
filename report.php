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
?>


<html>
<head>
		<title>
			Report
		</title>
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

	</head>
<body>
	<?php
		include('sidebar.php');
	?>
	<div class="outter-wp" style="transform: translate(30%);">
		<div class="chrt-bars" style="margin-top: 20px;transform: translate(3%);">
			<div class="col-md-5">
				<table class="table table-bordered">
					<tr>
						<td colspan="2">
							<center><h3>Overall Report Criteria</h3></center>
						</td>
					</tr>
					<tr>
						<td>
							Total User
						</td>
						<td>
							<?php echo $nouser; ?>		
						</td>
					</tr>
					<tr>
						<td>
							Total Worker
						</td>
						<td>
							<?php echo $noworker; ?>
						</td>
					</tr>
					<tr>
						<td>
							Total Complain
						</td>
						<td>
							<?php echo $nocomplain; ?>
						</td>
					</tr>
					<tr>
						<td>
							Total Complain Solved
						</td>
						<td>
							<?php echo $nosolvedcomplain;  ?>
						</td>
					</tr>
					<tr>
						<td>
							Total Complain Remaining  
						</td>
						<td>
							<?php echo $nrcomplain;  ?>	
						</td>
					</tr>
					<tr>
						<td>
							Total Complain Solved [in per.]
						</td>
						<td>
							<?php echo $percentage."%  ";  ?>
							<br>
						</td>
					</tr>
					<tr>
						<td>
							Total Complain Remaining [in per.]
						</td>
						<td>
							<?php echo $percentage1."% ";  ?>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</body>
</html>