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

	$res=mysqli_query($connection,"SELECT * FROM work_cmp WHERE uid='$uid' AND conf_code=0");
	$no=mysqli_num_rows($res);
	if($no!=0)
	{
		$row=mysqli_fetch_assoc($res);
		
			$wcid=$row['wcid'];
			$uid=$row['uid'];
			$comid=$row['comid'];
			$beforepic=$row['beforepic'];

		$res1=mysqli_query($connection,"SELECT * FROM user_master WHERE uid=(SELECT uid FROM complain_master WHERE comid='$comid')");
		$row1=mysqli_fetch_assoc($res1);

			$name=$row1['fname']." ".$row1['mname']." ".$row1['lname'];
			$email=$row1['email'];

		$res2=mysqli_query($connection,"SELECT * FROM complain_master WHERE comid='$comid' ");
		$row2=mysqli_fetch_assoc($res2);

			$probtype=$row2['probtype'];
			$district=$row2['district'];
			$city=$row2['city'];
			$address=$row2['address'];
			$probdate=$row2['probdate'];
			$probdescription=$row2['probdescription'];

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
	<?php
		include('header.php');
	?>

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
		<div class="container" style="margin-top: 200px;">
 			<?php 
 				if($no==0) 
 				{ 
 					echo "<center><div style='height:auto;background-color:lightgray'><h2>You have no pending complains...!!!<br>Please Select and solve complain first..!!</h2></div></center>"; 
 				}
 				else
 				{ 
 			?>
  					<table class="table table-bordered" style="color: black;">
    					<tbody> 
							<tr>
								<td rowspan="3" style="width:30%">
									<div style="height:130px;float:left">
										<img width="250px" height="130px" src="../<?php echo $beforepic; ?>" />
									</div>
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
									<b>Address</b> : <?php echo $address.", ".$city.", ".$district; ?>
								</td>
							</tr>
							<tr>
								<td>
									<b>Problem Statement</b>: <?php echo $probtype; ?>
								</td>
								<td>
									<b>Problem Since From : </b><?php echo $probdate; ?>
								</td>
							</tr>
							<tr>
								<td>
									<a href="#" data-toggle="tooltip" title="<?php echo $probdescription; ?>">Problem Description [User]</a>
								</td>
								<td align="left">
									<b>Problem Description [Worker] : </b><textarea rows="1" cols="50" name="msg" required></textarea>
								</td>
							</tr>
							<tr>
								<td>
									<b>Choose Solved Complain Photo :</b>
								</td>
								<td>
									<input type="file" name="filenm" style="width:200px" required>
									<input type="hidden" name="comid" value="<?php echo $comid; ?>">
									<input type="submit" class="btn btn-success" style="float:right" name="confirm" value="Complete Complain">
								</td>		
							</tr>
						</tbody>
					</table>
 			<?php 
 				} 
 			?>
 		</div>
 	</form>
</body>
</html>

<?php
	if(isset($_POST['confirm']))
	{
		$comid=$_POST['comid'];
		$description=$_POST['msg'];
		$filename=$_FILES['filenm']['name'];
		$target_dir = "../upload/";
		$target_file = $target_dir . basename($_FILES["filenm"]["name"]);
		
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		$extensions_arr = array("jpg","jpeg","png","gif");
		
		$d=date("Y-m-d");
		
		if(in_array($imageFileType,$extensions_arr))
		{
			$query=mysqli_query($connection,"UPDATE work_cmp SET afterpic='upload/$filename', description='$description', date='$d', conf_code=1 WHERE comid='$comid' ");
			move_uploaded_file($_FILES['filenm']['tmp_name'],'../upload/'.$filename);

			$qqq=mysqli_query($connection,"UPDATE worker_time SET conf_code=2 WHERE uid='$uid' AND comid='$comid' ");
		}
		else
		{
			echo "<br><font color=\"blue\"><div style=\"border:solid;background-color:white; border-color:blue;height:20px; width:290px\">Image $filename extension is not valid...!!</div></font>";
		}

		?>
			<meta http-equiv="refresh" content="0">
		<?php
	}
?>