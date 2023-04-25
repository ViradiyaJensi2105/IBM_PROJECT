<?php
	session_start();
?>

<?php
	include('db.php');
	$result=mysqli_query($connection,"SELECT * FROM district");
	while($row=mysqli_fetch_assoc($result))
	{
		$resultset[]=$row;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign up</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
				var z = document.getElementsByName("subbtn")[0].value;
				if(z=="login")
				{
					var x = document.getElementsByName("username")[0].value;
					if(x=="")
					{
						alert("Username can not be Empty");
						return false;
					}

					var x = document.getElementsByName("password")[0].value;
					if(x=="")
					{
						alert("Password can not be Empty");
						return false;
					}
					else if(x.length<3)
					{
						alert("Password length must be greater than 3");
						return false;
					}
				}

				if(z=="signup")
				{
					var x = document.getElementsByName("username")[0].value;
					if(x=="")
					{
						alert("Username can not be Empty");
						return false;
					}

					var x = document.getElementsByName("password")[0].value;
					if(x=="")
					{
						alert("Password can not be Empty");
						return false;
					}
					else if(x.length<3)
					{
						alert("Password length must be greater than 3");
						return false;
					}

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
			}
	</script>
	  <style type="text/css">
body
{
	background:white;
	padding: 0;
	margin: 0;
}
.container-fluid
{
	width:40%;
	padding:0;
	position: relative;
	top:50%;
	transform: translate(0%,40%);
}
.signup
{
	color:#873600;
	font-family:Century Gothic;
	font-size:250%;
	position:relative;
	left:50%;
	transform:translate(-50%,-50%); 	
}
.btn-primary
{
	position: relative;
	left:50%;
	transform:translate(-50%,75%);
}

.btn-default
{
	color: rgba( 135, 54, 0);
	position: relative;
	left:50%;
	transform:translate(-50%,100%);
}

.groupinput
{
	width:130px;
	font-weight: bold;
	font-family: Maiandra GD;
	text-align: center;
}

.input-group-text
{
	background-color:rgba(135, 54, 0,0.1);
}

.jumbotron
{
	background-color:rgba(7, 33, 49 ,0.1);
	height: auto;
}
	  </style>
</head>
<body>
	<div class="container-fluid">
	<div class="jumbotron">
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" onsubmit="return fun()">
		<div class="row">
			<div class="col">
  				<label class="signup">LOG IN</label>

  					<div class="input-group form-group">
    					<span class="input-group-text groupinput"><i class="fas fa-user"></i>&nbsp;Username</span>
    					<input type="text" class="form-control" name="username">
  					</div>

  					<div class="input-group form-group">
    					<span class="input-group-text groupinput"><i class="fas fa-unlock"></i>&nbsp;Password</span>
    					<input type="password" class="form-control" name="password">
  					</div>

		<div class="hide" style="display: none;">

		<div class="row">
			<div class="col">
  				<div class="input-group form-group">
    				<span class="input-group-text groupinput">First Name</span>
    				<input type="text" class="form-control" name="fname">
  				</div>
			</div>

			<div class="col">
  				<div class="input-group form-group">
    				<span class="input-group-text groupinput">Middle Name</span>
    				<input type="text" class="form-control" name="mname">
  				</div>
			</div>

			<div class="col">
  				<div class="input-group form-group">
    				<span class="input-group-text groupinput">Last Name</span>
    				<input type="text" class="form-control" name="lname">
  				</div>
			</div>
		</div>

		<div class="row">
			<div class="col">
  				<div class="input-group form-group">
    				<span class="input-group-text groupinput">DOB</span>
    				<input type="date" class="form-control" name="bdate" max="<?php echo date('Y-m-d',time()-86400); ?>">
  				</div>
			</div>

			<div class="col">
  				<div class="input-group form-group">
    				<span class="input-group-text groupinput">Gender</span>
    				<select class="form-control" name="gender">
  						<option value="male">Male</option>
  						<option value="female">Female</option>
  					</select>
  				</div>
			</div>
		</div>


  		<div class="input-group form-group">
   			<span class="input-group-text groupinput"><i class="fas fa-map-marker-alt"></i>&nbsp;Address</span>
   			<input type="text" class="form-control" name="address">
  		</div>

		<div class="row">
			<div class="col">
  				<div class="input-group form-group">
    				<span class="input-group-text groupinput">District</span>
			        <select name="district" id="district-list" class="form-control" onChange="getCity(this.value);">
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

  		<div class="input-group form-group">
   			<span class="input-group-text groupinput"><i class="fas fa-mobile-alt"></i>&nbsp;Mobile No.</span>
   			<input type="text" class="form-control" name="mobileno">
  		</div>

  		<div class="input-group form-group">
   			<span class="input-group-text groupinput"><i class="fas fa-envelope"></i>&nbsp;Email</span>
   			<input type="email" class="form-control" name="email">
  		</div>

		<div class="input-group form-group">
    		<span class="input-group-text groupinput">Signup as</span>
    			<select class="form-control" name="utype">
  					<option value="user">User</option>
  					<option value="worker">Worker</option>
  				</select>
  			</div>
	</div>

				<div class="form-group">
  					<button type="submit" class="btn btn-primary loginbtn" name="subbtn" value="login">Log in</button> 
  				</div>

				<div class="form-group">
  					<button type="button" class="btn btn-default logintext" style="display:none;border: none;">Already have account ? Log in</button> 
  				</div>

				<div class="form-group">
  					<button type="button" class="btn btn-default signtext" style="border: none">Do not have Account ? Sign up</button> 
  				</div>
			</div>
		</div>
	</form>
	</div>
	</div>

	<script type="text/javascript">

		$(document).ready(function()
		{
			$(".logintext").click(function()
			{
				$(".hide").css('display','none');
				$(".signup").text('LOG IN');
				$(".signtext").css('display','block');
				$(".logintext").css('display','none');
				$(".container-fluid").css('width','40%');
				$(".container-fluid").css('transform','translate(0%,40%)');
				$(".loginbtn").val('login');
				$(".loginbtn").text('Log in');
			});
		});

		$(document).ready(function()
		{
			$(".signtext").click(function()
			{
				$(".hide").css('display','block');
				$(".signup").text('SIGN UP');
				$(".logintext").css('display','block');
				$(".signtext").css('display','none');
				$(".container-fluid").css('width','60%');
				$(".container-fluid").css('transform','translate(0%,0%)');
				$(".loginbtn").val('signup');
				$(".loginbtn").text('Sign up');
			});
		});
	</script>
</body>
</html>

<?php
	if(isset($_POST['subbtn']))	
	{
		if($_POST['subbtn']=="login")
		{
			$username=$_POST['username'];
			$password=$_POST['password'];
			$flag=false;

			include('db.php');

			$res=mysqli_query($connection,"SELECT uid,username,password,utype FROM user_master");

			while($result=mysqli_fetch_assoc($res))
			{
				$suid=$result['uid'];
				$susername=$result['username'];
				$spassword=$result['password'];
				$sutype=$result['utype'];

				if($username==$susername && $password==$spassword)
				{
					$flag=true;
					if($sutype=="user")
					{
						$_SESSION['uid']=$suid;
						echo "<script>location.replace('home.php');</script>";			
					}
					else
					{
						$_SESSION['uid']=$suid;
						echo "<script>location.replace('worker/home.php');</script>";
					}
				}
			}

			if($flag==false)
			{
				if($username=="admin" && $password=="admin")
				{
					$_SESSION['uid']=$suid;
					echo "<script>location.replace('admin/dashboard.php');</script>";
				}
				else
				{
					echo "<script>alert('Invalid Username or password...!');</script>";
				}
			}
		}

		if($_POST['subbtn']=="signup")
		{
			$username=$_POST['username'];
			$password=$_POST['password'];
			$fname=$_POST['fname'];
			$mname=$_POST['mname'];
			$lname=$_POST['lname'];
			$bdate=$_POST['bdate'];
			$gender=$_POST['gender'];
			$address=$_POST['address'];
			$district=$_POST['district'];
			$city=$_POST['city'];
			$mobileno=$_POST['mobileno'];
			$email=$_POST['email'];
			$utype=$_POST['utype'];

			include('db.php');
			$extra=false;

			$res=mysqli_query($connection,"SELECT username FROM user_master");
			while($row=mysqli_fetch_assoc($res))
			{
				$suname=$row['username'];

				if($suname==$username)
				{
					$extra=true;
					echo "<script>alert('Username has already taken...');</script>";
				}
			}

			if($extra==false)
			{
				if($utype=="user")
				{
					$res=mysqli_query($connection,"INSERT INTO user_master (username,password,fname,mname,lname,bdate,gender,address,district,city,mobileno,email,utype) VALUES ('$username','$password','$fname','$mname','$lname','$bdate','$gender','$address','$district','$city','$mobileno','$email','$utype')");	
				}
				else
				{
					$res=mysqli_query($connection,"INSERT INTO user_master (username,password,fname,mname,lname,bdate,gender,address,district,city,mobileno,email,utype,conf_code) VALUES ('$username','$password','$fname','$mname','$lname','$bdate','$gender','$address','$district','$city','$mobileno','$email','$utype',1)");
				}

				if($res!="")
				{
					echo "<script>location.replace('index.php');</script>";
				}
				else
				{
					echo "<script>alert('Error...!');</script>";
				}
			}
		}
	}
?>