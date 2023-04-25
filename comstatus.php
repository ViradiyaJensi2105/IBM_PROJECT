<?php
	include('db.php');

	if(isset($_REQUEST['done']))
	{
		$comid=$_REQUEST['done'];

		$q2=mysqli_query($connection,"SELECT * FROM work_cmp WHERE comid='$comid' ");
		$row2=mysqli_fetch_assoc($q2);

			$beforepic=$row2['beforepic'];
			$afterpic=$row2['afterpic'];

		$q4=mysqli_query($connection,"SELECT * FROM complain_master WHERE comid='$comid' ");
		$row4=mysqli_fetch_assoc($q4);

			$date=$row4['registerdate'];
			$uid=$row4['uid'];

		$q3=mysqli_query($connection,"SELECT * FROM user_master WHERE uid='$uid' ");
		$row3=mysqli_fetch_assoc($q3);

			$name=$row3['fname']." ".$row3['mname']." ".$row3['lname'];
			$email=$row3['email'];		
?>
		<div style="height:300px;margin-top:5px;width:100%;" id="data">
			<table class="table table-bordered" rowspan="6">
				<tbody> 
					<tr style="background-color:#CAF5CF">
						<td colspan="6" align="center">Before</td>
						<td align="center">After</td>
					</tr>
					<tr>			
						<th colspan="6">
							<?php 
								if($beforepic!="")
								{
							?>
									<img height="200px" width="250px" src="../<?php echo $beforepic; ?>" />
							<?php 
								} 
							?>
						</th>
						<th colspan="6">
							<?php 
								if($afterpic!="")
								{
							?>
									<img height="200px" width="250px" src="../<?php echo $afterpic; ?>" />
							<?php 
								} 
							?>
						</th>
					</tr>
					<tr>
						<td colspan="6">
							<b>Complainer Name : </b>
						</td>
						<td>
							<?php echo $name; ?>
						</td>
					</tr>
					<tr>
						<td colspan="6">
							<b>Complainer E-mail : </b>
						</td>
						<td>
							<?php echo $email; ?>
						</td>
					</tr>
					<tr>
						<td colspan="6">
							<b>Registered Date : </b>
						</td>
						<td>
							<?php echo $date; ?>
						</td>
					</tr>
				</tbody> 
			</table> 
		</div>
		
<?php
	}
?>