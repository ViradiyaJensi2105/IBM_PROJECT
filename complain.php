<?php
	session_start();
	$uid=$_SESSION['uid'];

  if($uid=="")
  {
  	echo "<script>location.replace('index.php');</script>";
  }
?>
<?php
	include('db.php');
	$result=mysqli_query($connection,"SELECT * FROM district");
	while($row=mysqli_fetch_assoc($result))
	{
		$resultset[]=$row;
	}

	if(isset($_POST['comsub']))
	{
		$problem=$_POST['problem'];
		$district=$_POST['district'];
		$city=$_POST['city'];
		$address=$_POST['address'];	
		$probdate=$_POST['probdate'];
		$probdescription=$_POST['probdescription'];

		$fname=$_FILES['file_nm']['name'];
		$target_dir = "upload/";
		$target_file = $target_dir . basename($_FILES["file_nm"]["name"]);

		$cc=date_create($probdate);
		$df=date_format($cc,"d-m-y");
		$crdate=date("d-m-y");
		$d=date('Y-m-d');
	
		if($df<$crdate)
		{
			$vals="";
		 	// Select file type
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			// Valid file extensions
			$extensions_arr = array("jpg","jpeg","png","gif");

			// Check extension
			if(in_array($imageFileType,$extensions_arr))
			{
				$query="insert into complain_master (probtype,district,city,address,fname,probdate,registerdate,probdescription,uid,conf_code)values('$problem','$district','$city','$address','$target_file', '$probdate','$d', '$probdescription','$uid','0')";				
				mysqli_query($connection,$query) or die(mysqli_error($connection));
		        // Upload file
				move_uploaded_file($_FILES['file_nm']['tmp_name'],'upload/'.$fname);

				echo "<script>alert('Complain Registered Successfully...');</script>";
			}
			else
			{
				$val="<br><font color=\"blue\"><div style=\"border:solid;background-color:white; border-color:blue;height:20px; width:290px\">Image $fname extension is not valid...!!</div></font>";
			}
		}
		else
		{
				$vals="<div style='background-color:rgb(295,90,90)'><center><b>Please Enter Valid Date and then Press Enter</b></center></div><br>";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Complain</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	  <link rel="stylesheet" href="style.css">
	  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

	  <style type="text/css">
	  	.jumbotron
	  	{
	  		background-color: rgba( 66, 73, 73 ,0.7);
	  	}
	  </style>

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

			function fun(){
				var x = document.getElementsByName("problem")[0].value;
				if(x=="")
				{
					alert("Problem Statement can not be Empty");
					return false;
				}

				var x = document.getElementsByName("district")[0].value;
				if(x=="")
				{
					alert("District can not be Empty");
					return false;
				}

				var x = document.getElementsByName("city")[0].value;
				if(x=="")
				{
					alert("City can not be Empty");
					return false;
				}

				var x = document.getElementsByName("address")[0].value;
				if(x=="")
				{
					alert("Address can not be Empty");
					return false;
				}

				var x = document.getElementsByName("probdate")[0].value;
				if(x=="")
				{
					alert("Problem Since date can not be Empty");
					return false;
				}

				var x = document.getElementsByName("file_nm")[0].value;
				if(x=="")
				{
					alert("Upload file can not be Empty");
					return false;
				}

				var x = document.getElementsByName("probdescription")[0].value;
				if(x=="")
				{
					alert("Problem Description can not be Empty");
					return false;
				}
			}
	  </script>
</head>
<body>
	<?php
		include('header.php');
	?>

	<div class="container" style="margin-top:90px;">
		<div class="jumbotron">
			<form action="" method="post" enctype="multipart/form-data" onsubmit="return fun()">
			<div class="row">
				<div class="col">
					
					<div class="form-group">
						<label>Problem Statement</label>
						<select name="problem" class="form-control">
							<option value="">--Select Statement--</option>
                            <option value="Dead Animal">Dead Animal</option>
                            <option value="Dustbins not cleaned">Dustbins not cleaned</option>
                            <option value="Garbage Vehicle Not Arrived">Garbage Vehicle Not Arrived</option>
                            <option value="Sweeping Not Done">Sweeping Not Done</option>
                            <option value="Public Toilet Blockage">Public Toilet Blockage</option>
                            <option value="public toilet cleaning">public toilet cleaning</option>
                        </select>
                    </div>

					<label>Address</label>
                    <div class="row">
                    	<div class="col">
		                    <div class="form-group">
		                        
			                        <select name="district" id="district-list" class="form-control" onChange="getCity(this.value);" >
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
						<div class="form-group">
								<select name="city" id="city-list" class="form-control">
									<option value="">--Select City--</option>
								<?php
						            foreach($resultset as $city) 
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

					<div class="form-group">
							<input type="text" name="address" class="form-control" placeholder="Add Landmark">
					</div>

					<div class="form-group">
							<label>Problem Since The Date</label>
               				<input type="date" name="probdate" class="form-control" max="<?php echo date('Y-m-d',time()-86400); ?>" >  
					</div>

					<div class="form-group">
							<label>Upload Photo</label><br>
							<input type="file" name="file_nm" />
					</div>
					
					<div class="form-group">
                    		<label>Problem Description</label>   
							<textarea rows="4" cols="50" name="probdescription" class="form-control"></textarea>
					</div>

							<button type="submit" name="comsub" class="btn btn-primary">Submit</button>
						</div>
					</div>
				</div>
			</div>
		</form>
		</div>
	</div>

</body>	
</html>