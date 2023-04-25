<?php
	include('sidebar.php');

	include('db.php');

	$res=mysqli_query($connection,"SELECT * FROM work_cmp WHERE conf_code=1");
	$no=mysqli_num_rows($res);

	if($no!=0)
	{
		while($row=mysqli_fetch_assoc($res))
		{
			$comid=$row['comid'];
			$wuid=$row['uid'];
			$beforepic=$row['beforepic'];
			$afterpic=$row['afterpic'];
			$solveddate=$row['date'];
			$description=$row['description'];

			$res2=mysqli_query($connection,"SELECT fname,mname,lname,email,mobileno,gender FROM user_master WHERE uid='$wuid' ");
			$row2=mysqli_fetch_assoc($res2);

				$wname=$row2['fname']." ".$row2['mname']." ".$row2['lname'];
				$wemail=$row2['email'];
				$wmobileno=$row2['mobileno'];
				$wgender=$row2['gender'];

			$res1=mysqli_query($connection,"SELECT * FROM complain_master WHERE comid='$comid' ");
			$row1=mysqli_fetch_assoc($res1);

				$uuid=$row1['uid'];
				$district=$row1['district'];
				$city=$row1['city'];
				$probtype=$row1['probtype'];
				$probdate=$row1['probdate'];
				$probdescription=$row1['probdescription'];

					$res3=mysqli_query($connection,"SELECT fname,mname,lname,email,mobileno,gender FROM user_master WHERE uid='$uuid' ");
					$row3=mysqli_fetch_assoc($res3);

						$uname=$row3['fname']." ".$row3['mname']." ".$row3['lname'];
						$uemail=$row3['email'];
						$umobileno=$row3['mobileno'];
						$ugender=$row3['gender'];

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
	}
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<?php
		if($no==0)
		{
	?>
			<div style="margin-top:10%;background-color:green;margin-left: 400px;margin-right:150px;" class="outter-wp">
				<center><h1 style="color:#fff;font-family:cursive;">Task is in progress..!!</h1></center>
			</div>
	<?php
		}
		else
		{
	?>
			<div class="outter-wp" style="margin-left:250px;">
				<h3 class="inner-tittle two">Complaints</h3>
				<div class="graph">
					<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">					
						<div class="tables">
							<table class="table table-bordered">
								<tbody> 
									<tr style="background-color: #1BBD36;">
										<td>
											<div style="background-color:#1BBD36;color:white"><center>BEFORE</center></div>
										</td>
										<td>
											<div style="background-color:#1BBD36;color:white"><center>AFTER</center></div>
										</td>
									</tr>
									<tr>
										<td style="width:50%">
											<img width="500px" height="200px" src="../<?php echo $beforepic; ?>" />
										</td>
										<td>
											<img width="500px" height="200px" src="../<?php echo $afterpic; ?>" />
										</td>
									</tr>
									<tr style="background-color: #1BBD36;">
										<td>
											<div style="background-color:#1BBD36;color:white"><center>USER</center></div>
										</td>
										<td>
											<div style="background-color:#1BBD36;color:white"><center>Worker</center></div>
										</td>
									</tr>
									<tr>
										<td>
											<b>Name</b> : <?php echo $uname; ?>
										</td>	
										<td>
											<b>Name</b> : <?php echo $wname; ?>
										</td>
									</tr>
									<tr>
										<td>
											<b>E-mail </b> : <?php echo $uemail; ?>
										</td>
										<td>
											<b>E-mail </b> : <?php echo $wemail; ?>
										</td>
									</tr>
									<tr>
										<td>
											<b>Pincode City District</b> : <?php echo $pincode.", ".$city.", ".$district; ?>
										</td>
										<td>
											<b>Contact</b> : <?php echo $umobileno; ?>
										</td>
									</tr>
									<tr>
										<td>
											<b>Problem Statement</b>: <?php echo $probtype; ?>
										</td>
										<td>
											<b>Gender</b>: <?php echo $ugender; ?>
										</td>
									</tr>
									<tr>
										<td>
											<b>Problem Since date : </b><?php echo $probdate; ?>
										</td>
										<td>
											<b>Problem Solved date : </b><?php echo $solveddate; ?>
										</td>
									</tr>
									<tr>
										<td>
											<a href="#" data-toggle="tooltip" title="<?php echo $probdescription; ?>">Description</a>
										</td>
										<td>
											<a href="#" data-toggle="tooltip" title="<?php echo $description; ?>">Description</a>
										</td>
									</tr>
									<tr>
										<td align="center" colspan="2">
											<button class="btn btn-danger" style="float:center" name="reject" value="<?php echo $comid; ?>">Reject</button>
											<button class="btn btn-primary" style="float:center" name="confirm" value="<?php echo $comid; ?>">Confirm</button>
										</td>
									</tr>
								</tbody> 
							</table> 
						</div>
					</form>
				</div>
			</div>
	<?php								
		}
	?>
</body>
</html>

<?php
	if(isset($_POST['confirm']))
	{
		$ccomid=$_POST['confirm'];

		$update=mysqli_query($connection,"UPDATE complain_master SET conf_code=4 WHERE comid='$ccomid' ");
		$update2=mysqli_query($connection,"UPDATE work_cmp SET conf_code=2 WHERE comid='$ccomid' ");
		?>
			<meta http-equiv="refresh" content="0">
		<?php
	}
	elseif(isset($_POST['reject']))
	{
		$ccomid=$_POST['reject'];
		$to = $email;
		$subject = "Work Rejection";
		$user = $fname." ".$lname;
		$message = "Hello <b>".$user."</b><p><p>";
		$message .= "We Reject your<b><u>work</u></b> <p><p>";
		$message .= "Due to Some inappropriate work.<br>";
		$message .= "";
		
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <swarnaindia007@gmail.com>' . "\r\n";
		$headers .= 'Cc: myboss@example.com' . "\r\n";

		$flag=mail($to,$subject,$message,$headers);

		$update3=mysqli_query($connection,"UPDATE complain_master SET conf_code=1 WHERE comid='$ccomid' ");
		$update4=mysqli_query($connection,"DELETE FROM work_cmp WHERE comid='$ccomid' ");

		?>
			<meta http-equiv="refresh" content="0">
		<?php
	}
?>