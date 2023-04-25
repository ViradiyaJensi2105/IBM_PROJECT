<?php
	session_start();
	$uid=$_SESSION['uid'];
	  if($uid=="")
	  {
	  	echo "<script>location.replace('../index.php');</script>";
	  }
	include('db.php');

	if(isset($_POST['sbtn']))
	{
		$old=$_POST['old'];
		$new=$_POST['new'];
		$renew=$_POST['renew'];

		$q1=mysqli_query($connection,"SELECT * FROM user_master WHERE uid='$uid' ");
		$row1=mysqli_fetch_assoc($q1);

		$password=$row1['password'];

		if($password==$old)
		{
			if($new==$renew)
			{
				$update=mysqli_query($connection,"UPDATE user_master SET password='$new' WHERE uid='$uid' ");
				echo "<script>alert('Password Change Successfully...');</script>";
			}
			else
			{
				echo "<script>alert('New Password and Re-typed Password doesnot match...');</script>";	
			}
		}
		else
		{
			echo "<script>alert('Old Password doesnot match...');</script>";
		}
		?>
			<meta http-equiv="refresh" content="0">
		<?php
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="../style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <style>
    	
    </style>
</head>
<body>
	<?php
		include('header.php');
	?>
	<div class="jumbotron" style="margin-top:100px;height: auto;">
		<div style="text-align: center;font-family: cursive;font-size: 28px;color:black;">
			CHANGE PASSWORD
		</div><hr>
		<div style="text-align: center;color:black;">
			<form method="post" style="width:500px;transform: translate(80%);margin-top:30px;">
				<div class="form-group">
					<input type="text" class="form-control" name="old" placeholder="Enter Old Password..." required>
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="new" placeholder="Enter New Password..." required>
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="renew" placeholder="Retype New Password..." required>
				</div>
				<div class="form-group">
					<button type="submit" name="sbtn" class="btn btn-success">Submit</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>