<?php	
	include('sidebar.php');

	include("db.php");
										
	$result=mysqli_query($connection,"SELECT * FROM complain_master WHERE conf_code=0");
	$nm=mysqli_num_rows($result);
?>

<script>
	$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
	});
</script>

<?php 
	if($nm==0)
	{
?>	
		<script type="text/javascript">
				alert("You are not having any complain...!!");
		</script>
<?php 
	}
	else
	{
?>
		<div class="outter-wp" style="margin-left:250px;">										 
			<h3 class="inner-tittle two">Complaints</h3>
			
			<?php 
				while($row=mysqli_fetch_array($result))
				{
					$uid=$row['uid'];

					$qry2="select fname,mname,lname,email from user_master where uid='$uid'";
					$result2=mysqli_query($connection,$qry2);
					$row2=mysqli_fetch_array($result2);
					$fname=$row2['fname'];
					$mname=$row2['mname'];
					$lname=$row2['lname'];
					$uemail=$row2['email'];


					$district=$row['district'];
					$city=$row['city'];

						$q1=mysqli_query($connection,"SELECT dname from district WHERE did='$district' ");
						$q2=mysqli_query($connection,"SELECT cname from city WHERE cid='$city' ");
						
							$r1=mysqli_fetch_assoc($q1);
							$district=$r1['dname'];
						
							$r2=mysqli_fetch_assoc($q2);
							$city=$r2['cname'];

					$fname1=$row['fname'];
					$prob=$row['probtype'];
					$since_date=$row['probdate'];
					$pb_detail=$row['probdescription'];
					$cid=$row['comid'];
														
					if(isset($_POST['confirm']))
					{
						$ccid=$_POST['confirm'];
						$updt_qry="update complain_master set conf_code=1 where comid='$ccid'";
						$result3=mysqli_query($connection,$updt_qry);
			?>
						<meta http-equiv="refresh" content="0">
			<?php																		
					}
					else if(isset($_POST['reject']))
					{
						$ccid=$_POST['reject'];
						$to = $uemail;
						$subject = "Complain Rejection";
						$user = $fname." ".$mname." ".$lname;
						$message = "Hello <b>".$user."</b><p><p>";
						$message = "We Reject your<b><u>Complain</u></b> <p><p>";
						$message = "Due to Some Missing Information or inappropriate information.<br>";
						$message = "";
                    
						// Always set content-type when sending HTML email
						$headers = "MIME-Version: 1.0" . "\r\n";
						$headers = "Content-type:text/html;charset=UTF-8" . "\r\n";

						// More headers
						$headers = 'From: <swarnaindia007@gmail.com>' . "\r\n";
						$headers = 'Cc: myboss@example.com' . "\r\n";

						//$flag=mail($to,$subject,$message,$headers);
																
						$del_qry = "delete from complain_master where comid='$ccid'";
						$result4 = mysqli_query($connection,$del_qry);	
							
					}	
			?>	
															
					<div class="graph">										
						<form method="POST">					
							<div class="tables">					
								<table class="table table-bordered">				 
										<tbody> 
												<tr>
													<td rowspan="3" style="width:40%;">
														<div><img width=100% src="../<?php echo $fname1; ?>" /></div>
													</td>
													<td><b>Name</b> : <?php echo $fname." ".$mname." ".$lname; ?></td>
												</tr>
																		
												<tr>						
													<td><b>E-mail </b> : <?php echo $uemail; ?></td>
												</tr>
																		
												<tr>
													<td><b>Pincode City State</b> : <?php echo $city.", ".$district; ?></td>
												</tr>
																		
												<tr>
													<td><b>Problem Statement</b>: <?php echo $prob; ?></td>
													<td><b>Problem Since From : </b><?php echo $since_date; ?></td>
												</tr>
																		
												<tr>
													<td><a href="#" data-toggle="tooltip" title="<?php echo $pb_detail;; ?>">Problem Description</a></td>
													<td align="center"><!--Approval <select class="btn" name="approval">
																							<option value="yes">Yes</option>
																							<option value="no">No</option>
																						</select>-->
														<button class="btn btn-danger" style="float:center" name="reject" value="<?php echo $ccid; ?>">Reject</button>
														<button class="btn btn-primary" style="float:center" name="confirm" value="<?php echo $cid; ?>">Confirm</button>
																					
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
<?php 
	} 
?>