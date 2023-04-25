<?php
	session_start();
	$uid=$_SESSION['uid'];
	  if($uid=="")
	  {
	  	echo "<script>location.replace('../index.php');</script>";
	  }
?>
<?php
	include('db.php');

	$res=mysqli_query($connection,"SELECT district FROM user_master WHERE uid='$uid' ");
	$row=mysqli_fetch_assoc($res);
	$dis=$row['district'];

	$row1=mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM district WHERE did='$dis' "));
	$dname=$row1['dname'];
	$did=$row1['did'];
	$d=date('Y-m-d');

	if(isset($_POST['confirm']))
		{
			$qq=mysqli_query($connection,"SELECT * FROM work_cmp WHERE uid='$uid' and conf_code=0");
			$cnt=mysqli_num_rows($qq);

			if($cnt==0)
			{
				$ccomid=$_POST['confirm'];

				$q6=mysqli_query($connection,"SELECT fname FROM complain_master WHERE comid='$ccomid' ");
				$res1=mysqli_fetch_assoc($q6);
				$image=$res1['fname'];

				$update1=mysqli_query($connection,"UPDATE complain_master SET conf_code=3 WHERE comid='$ccomid' ");
				$update2=mysqli_query($connection,"INSERT INTO work_cmp (uid,comid,beforepic) VALUES ('$uid','$ccomid','$image')");
				$update3=mysqli_query($connection,"INSERT INTO worker_time (uid,comid,selectdate,conf_code) VALUES ('$uid','$ccomid','$d',1)");
			}
			else
			{
				$select="<div style='background-color:#e25b48;width:100%;height:120px;margin-top:5.8%;text-align:center;'><br><h1>You cannot select more than one complaint first you solve older one..</h1></div>";
			}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	  <link rel="stylesheet" href="../style.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

       	<script>
			function getCity(val) {
				$.ajax({
				type: "POST",
				url: "get_city.php",
				data:'city_id='+val,
				success: function(data){
					$("#city-list").html(data);
				}
				});
			}
	  </script> 
</head>
<body>
	<?php
		include('header.php');
	?>

	<form method="post">	
		<div class="about" style="margin-top:100px;">
	    	<div class="container" style="left:50%;">
				<div class="form-group">
					<div class="row">
						<div class="col">
			  				<div class="input-group form-group">
			    				<span class="input-group-text groupinput">District</span>
						        <select name="district" id="district-list" class="form-control" onChange="getCity(this.value);">
						        	<option value="">--Select District--</option>
									<option value="<?php echo $did; ?>"><?php echo $dname; ?></option>
								</select>
			  				</div>
						</div>

						<div class="col">
			  				<div class="input-group form-group">
			    				<span class="input-group-text groupinput">City</span>
			    				<select name="city" id="city-list" class="form-control">
									<option value="">--Select City--</option>		
					            <?php
						         	foreach($results as $city) 
							        {
					            ?>
								    <option value="<?php echo $city["cid"]; ?>"><?php echo $city["cname"]; ?></option>
					            <?php
						        	}
					            ?>
								</select>
			  				</div>
						</div>
						</div>

						<div class="col">
							<button type="submit" class="btn btn-success" name="sbtn">Search</button>
						</div>
					</div>
				</div>
	      	</div>
	  	</div>
	</form>

</body>
</html>

<?php
	if(isset($_POST['sbtn']))
	{
		$d=$_POST['district'];
		$c=$_POST['city'];

		$res=mysqli_query($connection,"SELECT * FROM complain_master WHERE district='$d' and city='$c' and conf_code=1");
		$no=mysqli_num_rows($res);
		if($no==0)
		{
			?>
				<center>
				<div style="height:50px;width:80%;color:black;margin-top:150px;"><h2>Right now there is no any complain available.</h2></div>
				</center>
			<?php
		}
		else
		{
			while($row=mysqli_fetch_assoc($res))
			{
				$comid=$row['comid'];
				$probtype=$row['probtype'];
				$district=$row['district'];
				$city=$row['city'];
				$address=$row['address'];
				$fname=$row['fname'];
				$probdate=$row['probdate'];
				$registerdate=$row['registerdate'];
				$probdescription=$row['probdescription'];
				$userid=$row['uid'];

					$q1=mysqli_query($connection,"SELECT dname from district WHERE did='$district' ");
					$q2=mysqli_query($connection,"SELECT cname from city WHERE cid='$city' ");

					while($row=mysqli_fetch_assoc($q1))
					{
						$district=$row['dname'];
					}
					while($row=mysqli_fetch_assoc($q2))
					{
						$city=$row['cname'];
					}

				$q4=mysqli_query($connection,"SELECT fname,mname,lname,email FROM user_master WHERE uid='$userid' ");
				$row1=mysqli_fetch_assoc($q4);
				$name=$row1['fname']." ".$row1['mname']." ".$row1['lname'];
				$email=$row1['email'];

				$qq1=mysqli_query($connection,"SELECT * FROM worker_time WHERE comid='$comid' AND uid='$uid' ");
				$rr1=mysqli_fetch_assoc($qq1);
				$cc=$rr1['conf_code'];

				?>

					<div style="height:30%;width:48%;float:left;padding-bottom:0%;margin-left:1%;margin-top:1%;">									  
						<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" <?php if($cc==3){echo "style='opacity:0.5;' ";} ?>>					
							<div>
								<table class="table table-bordered" style="color:black;">					 
									<tbody> 
										<tr>
											<td rowspan="3" style="width:40%">
												<div style="height:130px;float:left"><img width="250px" height="130px" src="../<?php echo $fname; ?>" /></div>
											</td>
											<td>
												<b>Name</b> : <?php echo $name; ?>
											</td>
										</tr>
										<tr>
											<td>
												<b>E-mail </b> : <?php echo $email; ?>
											</td>
										</tr>
										<tr>
											<td>
												<b>Pincode City District</b> : <?php echo $city.", ".$district; ?>
											</td>
										</tr>
										<tr>
											<td>
												<b>Problem Statement</b>: <br><?php echo $probtype; ?>
											</td>
											<td>
												<b>Problem Since From : </b><?php echo $probdate; ?>
											</td>
										</tr>
										<tr>
											<td>
												<a href="#" data-toggle="tooltip" title="<?php echo $probdescription;; ?>">Project Description</a>
											</td>
											<td align="center">
												<button class="btn btn-success" style="float:center" data-toggle="modal" data-target="#myModal" name="confirm" value="<?php echo $comid; ?>" 
													<?php
														if($cc==3)
														{
															echo "disabled";
														} 
													?>>Select Complain</button>
											</td>
										</tr>
									</tbody> 
								</table> 
							</div>
						</form>
					</div>
				<?php
			}
		}
	}
?>
