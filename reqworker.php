<?php
	include('sidebar.php');
	include('db.php');

	$res=mysqli_query($connection,"SELECT * FROM user_master WHERE conf_code=1 AND utype='worker' ");
	$no=mysqli_num_rows($res);
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<div class="outter-wp" style="margin-left: 250px;">
		<h3 class="inner-tittle two">Total <b><?php echo $no; ?></b> Worker Request</h3>
		
		<div>
		
		<?php 
			while($row=mysqli_fetch_array($res))
			{
				$uid=$row['uid'];
				$fname=$row['fname'];
				$mname=$row['mname'];
				$lname=$row['lname'];
				$gender=$row['gender'];
				$email=$row['email'];
			?>
				<div class="graph" style="width:600px;">
					<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">			
						<div class="tables">
							<table class="table table-bordered">
								<tbody> 
									<tr>
										<?php 
											if($gender=="male")
											{
										?>
												<td width="10%">
													<div>
														<a href="#"><img height="100px" src="../images/male.png" /></a>
													</div>
												</td>
										<?php 
											}
											else
											{ 
										?>
												<td width="10%">
													<div>
														<a href="#"><img  height="100px" src="../images/female.png" /></a>
													</div>
												</td>
										<?php 
											} 
										?>
												<td>
													<button type="button" style="margin-bottom:10px" class="btn btn-primary" data-toggle="modal" data-target="#myModal" data-value="<?php echo $uid?>" onclick="datamodel('<?php echo $uid; ?>')"><?php echo $fname." ".$mname." ".$lname; ?></button><br><br>
													
													<button class="btn btn-danger" style="float:center" name="reject" value="<?php echo $uid; ?>">Reject</button>
													<button class="btn btn-primary" style="float:center" name="confirm" value="<?php echo $uid; ?>">Confirm</button>
												</td>
									</tr>
								</tbody> 
							</table> 
						</div>
					</form>
				</div>
				
		<?php 
			} 
		?>
		</div>
	</div>

		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document" style="margin-top:5%;margin-right:30%">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">Worker Profile</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					</div>
					<div class="modal-body"  style="height:370px" id="modeldata"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
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
		
		abc.open("POST","get_user.php?uid="+str,true);
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

<?php
	if(isset($_POST['confirm']))
	{
		$wuid=$_POST['confirm'];
		$update=mysqli_query($connection,"UPDATE user_master SET conf_code=2 WHERE uid='$wuid' ");

		?>
			<meta http-equiv="refresh" content="0">
		<?php					
	}
	else if(isset($_POST['reject']))
	{
		$wuid=$_POST['reject'];
		$to = $email;
		$subject = "Complain Rejection";
		$user = $fname." ".$lname;
		$message = "Hello <b>".$user."</b><p><p>";
		$message .= "We Reject your<b><u>Complain</u></b> </p></p>";
		$message .= "Due to Some Missing Information or inappropriate information.<br>";
		$message .= "";

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <swarnaindia007@gmail.com>' . "\r\n";
		$headers .= 'Cc: myboss@example.com' . "\r\n";
		
		$flag=mail($to,$subject,$message,$headers);

		$delete=mysqli_query($connection,"DELETE FROM user_master WHERE uid='$wuid' ");

		?>
			<meta http-equiv="refresh" content="0">
		<?php
	}
?>