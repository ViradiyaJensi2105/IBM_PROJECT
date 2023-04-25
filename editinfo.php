<?php
	session_start();
	$uid=$_SESSION['uid'];
?>

<?php
	include('db.php');
	$result=mysqli_query($connection,"SELECT * FROM district");
	while($row1=mysqli_fetch_assoc($result))
	{
		$resultset[]=$row1;
	}

	$res=mysqli_query($connection,"SELECT * FROM user_master WHERE uid='$uid'");

	while($row=mysqli_fetch_assoc($res))
	{
		$fname=$row['fname'];
		$mname=$row['mname'];
		$lname=$row['lname'];
		$dob=$row['bdate'];
		$gender=$row['gender'];
		$address=$row['address'];
		$district=$row['district'];
		$city=$row['city'];
		$mobileno=$row['mobileno'];
		$email=$row['email'];
		$imgname=$row['imgname'];
		$imgpath=$row['imgpath'];
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

</head>
<body>
	<div class="container-fluid">
	<div class="jumbotron">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" onsubmit="return fun()">
		<div class="row">
			<div class="col">

		<div class="row">
			<div class="col">
  				<div class="input-group form-group">
    				<span class="input-group-text groupinput">First Name</span>
    				<input type="text" class="form-control" name="fname" value="<?php echo $fname; ?>">
  				</div>
			</div>

			<div class="col">
  				<div class="input-group form-group">
    				<span class="input-group-text groupinput">Middle Name</span>
    				<input type="text" class="form-control" name="mname" value="<?php echo $mname; ?>">
  				</div>
			</div>

			<div class="col">
  				<div class="input-group form-group">
    				<span class="input-group-text groupinput">Last Name</span>
    				<input type="text" class="form-control" name="lname" value="<?php echo $lname; ?>">
  				</div>
			</div>
		</div>

		<div class="row">
			<div class="col">
  				<div class="input-group form-group">
    				<span class="input-group-text groupinput">DOB</span>
    				<input type="date" class="form-control" name="bdate" value="<?php echo $dob; ?>" max="<?php echo date('Y-m-d',time()-86400); ?>">
  				</div>
			</div>

			<div class="col">
  				<div class="input-group form-group">
    				<span class="input-group-text groupinput">Gender</span>
    				<select class="form-control" name="gender">

  						<option value="male"     					
  						<?php
    						if($gender=="male")
    						{
    							echo "selected";
    						}
    					?> >Male</option>
  						<option value="female"   					
  						<?php
    						if($gender=="female")
    						{
    							echo "selected";
    						}
    					?> >Female</option>
  					</select>
  				</div>
			</div>
		</div>


  		<div class="input-group form-group">
   			<span class="input-group-text groupinput">Address</span>
   			<input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
  		</div>

		<div class="row">
			<div class="col">
  				<div class="input-group form-group">
    				<span class="input-group-text groupinput">District</span>
			        <select name="district" id="district-list" class="form-control" onChange="getCity(this.value)">
							<option value="">--Select District--</option>
								
					<?php
							foreach($resultset as $district1) 
							{
					?>
								<option value="<?php echo $district1["did"]; ?>"><?php echo $district1["dname"]; ?></option>
					<?php
							}
					?>
					</select>
  				</div>
			</div>

			<div class="col">
  				<div class="input-group form-group">
    				<span class="input-group-text groupinput">City</span>
    				<select name="city" id="city-list" class="form-control">
							<option value="">--Select City--</option>
					</select>
  				</div>
			</div>
		</div>
 		
  		<div class="input-group form-group">
   			<span class="input-group-text groupinput">Mobile No.</span>
   			<input type="text" class="form-control" name="mobileno" value="<?php echo $mobileno; ?>">
  		</div>

  		<div class="input-group form-group">
   			<span class="input-group-text groupinput">Email</span>
   			<input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
  		</div>

  		<div class="input-group form-group">
   			<span class="input-group-text groupinput">Update Profile</span>
   			<input type="file" class="form-control" name="file_nm">
  		</div>

				<div class="form-group">
  					<button type="submit" class="btn btn-primary" name="subbtn" style="position: relative;left: 42%;transform: translate(0,60%);">Update Info.</button> 
  				</div>
			</div>
		</div>
	</form>
	</div>
	</div>
</body>
</html>

<?php
	if(isset($_POST['subbtn']))
	{
		$fname=$_POST['fname'];
		$mname=$_POST['mname'];
		$lname=$_POST['lname'];
		$dob=$_POST['bdate'];
		$gender=$_POST['gender'];
		$address=$_POST['address'];
		$district=$_POST['district'];
		$city=$_POST['city'];
		$mobileno=$_POST['mobileno'];
		$email=$_POST['email'];

		$name=$_FILES['file_nm']['name'];
		$target_dir = "../profileupload/";
		$target_file = $target_dir . basename($_FILES["file_nm"]["name"]); 
		
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		$extensions_arr = array("jpg","jpeg","png","gif");

		if($name!="" && $target_file!="")
		{
			if(in_array($imageFileType,$extensions_arr))
			{
				$res=mysqli_query($connection,"UPDATE user_master SET fname='$fname',mname='$mname',lname='$lname',bdate='$dob',gender='$gender',address='$address',district='$district',city='$city',mobileno='$mobileno',email='$email',imgname='$name',imgpath='$target_file' WHERE uid='$uid' ");
				move_uploaded_file($_FILES['file_nm']['tmp_name'],'../profileupload/'.$name);
			}			
		}
		else
		{
			$res=mysqli_query($connection,"UPDATE user_master SET fname='$fname',mname='$mname',lname='$lname',bdate='$dob',gender='$gender',address='$address',district='$district',city='$city',mobileno='$mobileno',email='$email' WHERE uid='$uid' ");
		}

		if($res!="")
		{
			echo "<script>location.replace('profile.php');</script>";
		}
		else
		{
			echo "<script>alert('error');</script>";
		}
	}
?>