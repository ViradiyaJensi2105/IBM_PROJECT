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
		$utype=$row['utype'];
		$imgname=$row['imgname'];
		$imgpath=$row['imgpath'];
	}

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

			function fun(){
					var x = document.getElementsByName("fname")[0].value;
					if(x=="")
					{
						alert("First Name can not be Empty");
						return false;
					}

					var x = document.getElementsByName("mname")[0].value;
					if(x=="")
					{
						alert("Middle Name can not be Empty");
						return false;
					}

					var x = document.getElementsByName("lname")[0].value;
					if(x=="")
					{
						alert("Last Name can not be Empty");
						return false;
					}

					var x = document.getElementsByName("bdate")[0].value;
					if(x=="")
					{
						alert("Birthdate can not be Empty");
						return false;
					}

					var x = document.getElementsByName("gender")[0].value;
					if(x=="")
					{
						alert("Gender can not be Empty");
						return false;
					}

					var x = document.getElementsByName("address")[0].value;
					if(x=="")
					{
						alert("Address can not be Empty");
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

					var x = document.getElementsByName("email")[0].value;
					if(x=="")
					{
						alert("Email Address can not be Empty");
						return false;
					}

					var x = document.getElementsByName("mobileno")[0].value;
					if(x.length!=10)
					{
						alert("Mobile Number must be 10 digits");
						return false;
					}
					else if(isNaN(x))
					{
						alert("Mobile Number must have Numeric value");
						return false;
					}
					else if(x=="")
					{
						alert("Mobile Number can not be Empty");
						return false;
					}
			}
	  </script>

	  <style type="text/css">
	  	tr{
	  		color: black;
	  		text-align: center;
	  		font-family:Century Gothic;
	  		font-size: 16px;
	  	}
	  </style>
</head>
<body>
	<?php
		include('header.php');
	?>
	<div class="container" style="margin-top:120px;">
		<div class="row">
			<div class="col">

				<div style="background-color: #419251;float:left;margin-left:1%;font-family: cursive;">
					<center>
						<?php 
							if($gender=="male" && $imgname=="")
							{
						?>		
								<img src="../images/male.png" class="img-thumbnail" height="270" width="300">
						<?php 
							}
							else if($gender=="female" && $imgname=="")
							{
						?>
								<img src="../images/female.png" class="img-thumbnail"  height="270" width="300">
						<?php 
							}
							else if($imgname!="" && $imgpath!="")
							{
						?>
				 				<img src="<?php echo $imgpath; ?>" height="270" width="300">
						<?php 
							}
						?>
							<!-- <input type="file" name="img"> -->
						<?php 
							echo "<h3>".$fname." ".$lname."</h3>"; 
						?>	
							<h4><?php echo "[ ".$utype." ]"; ?></h4>
					</center>
				</div>

				<div class="table-responsive" style="height:600px;width:600px;float:right;">
					<table class="table table-striped">
						<tr>
							<th colspan=2 style="font-size:36px;padding-top: 20px;font-family: cursive;">Personal Information
							<button style="float:right;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" data-value="<?php echo $uid; ?>" onclick="datamodel('<?php echo $uid; ?>')">Edit</button></th>
						</tr>
						<tr>
							<td>Name</td>
							<td><?php echo $fname." ".$mname." ".$lname; ?></td>
						</tr>
						<tr>
							<td>Gender</td>
							<td><?php echo $gender; ?></td>
						</tr>
						<tr>
							<td>DOB</td>
							<td><?php echo $dob; ?></td>
						</tr>
						<tr>
							<td>Address</td>
							<td><?php echo $address; ?></td>
						</tr>
						<tr>
							<td>District</td>
							<td><?php echo $district; ?></td>
						</tr>
						<tr>
							<td>City</td>
							<td><?php echo $city; ?></td>
						</tr>
						<tr>
							<td>Mobile no.</td>
							<td><?php echo $mobileno; ?></td>
						</tr>
						<tr>
							<td>Email</td>
							<td><?php echo $email; ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="transform:translate(-13%,0%);">
		<div class="modal-dialog" role="document">
			<div class="modal-content" style="height:700px;width:900px;">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Edit Info.</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				</div>
				<div class="modal-body"  style="height:800px;width:900px;color:black" id="modeldata"></div>
			</div>
		</div>
	</div>

	<script>
	function datamodel(str)
	{
		if(window.XMLHttpRequest)
		{
			
			abc = new XMLHttpRequest();
		}
		else
		{
			abc = new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		abc.open("POST","editinfo.php?done="+str,true);
		abc.send();
		
		abc.onreadystatechange = function()
		{
		    if(abc.readyState==4)
			{
				document.getElementById("modeldata").innerHTML=abc.responseText;
			}	
		}
	}
</script>
</body>
</html>