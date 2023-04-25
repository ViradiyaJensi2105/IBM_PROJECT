<?php
	include('db.php');
	if(isset($_GET['mid']))	
	{
		$mid=$_GET['mid'];						
		$result=mysqli_query($connection,"SELECT * FROM message WHERE msgid='$mid' ");
		$n=mysqli_num_rows($result);
	}
	else
	{						
		$result=mysqli_query($connection,"SELECT * FROM message");
		$n=mysqli_num_rows($result);
	}											
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<?php
		include('sidebar.php');
	?>
	<div class="outter-wp" style="margin-left: 250px;">
		<h3 class="inner-tittle two">Total <b><?php echo $n; ?></b> messages</h3>
			<div style="float:left; width: 100%;height: 500px;overflow: scroll;">
			<?php 
				while($row=mysqli_fetch_assoc($result))
				{
					$msgid=$row['msgid'];
					$name=$row['name'];
					$msg=$row['msg'];
					$email=$row['email'];
					$subject=$row['subject'];
					$imgname=$row['imgname'];
					$imgpath=$row['imgpath'];
			?>	
					<div class="graph">
						<form method="POST">			
							<div class="tables">
								<table class="table table-bordered">
									<tbody> 
										<tr>
											<?php 
												if($imgname=="" && $imgpath=="")
												{
											?>
													<td width="10%" rowspan="4">
														<div>
															<a href="message.php"><img class="img img-circle" height="100px" width="100%" src="../images/male.png" /></a>
														</div>
													</td>
											<?php 
												}
												else
												{
											?>
													<td width="10%" rowspan="4">
														<div>
															<a href="message.php"><img class="img img-circle" height="100px" width="100%" src="../<?php echo $imgpath; ?>" /></a>
														</div>
													</td>
											<?php
												}
											?>
													<td>
														<font size="3px">Name</font>
													</td>
													<td>
														<font size="3px"><?php echo $name; ?></font>
													</td>
										</tr>
										<tr>
											<td>
												<font size="3px">E-mail</font>
											</td>
											<td>
												<font size="3px"><?php echo $email; ?></font>
											</td>
										</tr>
										<tr>
											<td>
												<font size="3px">Subject</font>
											</td>
											<td>
												<font size="3px"><?php echo $subject; ?></font>
											</td>
										</tr>
										<tr>
											<td>
												<font size="3px">Message</font>
											</td>
											<td>
												<font size="3px"><?php echo $msg; ?></font>
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
</body>
</html>