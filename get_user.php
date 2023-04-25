<?php
	include('db.php');

	if(isset($_REQUEST['uid']))
	{
		$id=$_REQUEST['uid'];

		$sql=mysqli_query($connection,"select * from user_master where uid='$id'");
		$num=mysqli_num_rows($sql);	
		$row=mysqli_fetch_array($sql);

		$name=$row['fname']." ".$row['mname']." ".$row['lname'];
		$gender=$row['gender'];
		$email=$row['email'];
		$dob=$row['bdate'];
		$address=$row['address'];

		$district=$row['district'];
		$city=$row['city'];

			$q1=mysqli_query($connection,"SELECT dname from district WHERE did='$district' ");
			$q2=mysqli_query($connection,"SELECT cname from city WHERE cid='$city' ");

			$r1=mysqli_fetch_assoc($q1);
			$district=$r1['dname'];
						
			$r2=mysqli_fetch_assoc($q2);
			$city=$r2['cname'];

		$mob=$row['mobileno'];
		$img=$row['imgname'];
?>
		<div style="height:300px;margin-top:5px" id="data">
			<table class="table table-bordered" rowspan="5">			 
				<tbody> 
					<tr>												
						<th rowspan="6">
							<?php 
								if($img!="")
								{
							?>
									<img height="200px" width="180px" src="../profileupload/<?php echo $img; ?>" />
							<?php 
								}
								else
								{ 
							?>
									<img height="200px" width="180px" src="../images/male.png" />
							<?php 
								} 
							?>
						</th>
						<td><b>Name : </b><?php echo $name; ?></td>
					</tr>
					<tr>
						<td><b>E-mail : </b><?php echo $email; ?></td>
					</tr>
					<tr>
						<td><b>Gender : </b><?php echo $gender; ?></td>
					</tr>
					<tr>
						<td><b>Date Of Birth : </b><?php echo $dob; ?></td>
					</tr>
					<tr>
						<td><b>Address : </b><?php echo $address.", ".$city.", ".$district; ?></td>
					</tr>
					<tr>
						<td><b>Contact : </b><?php echo $mob; ?></td>
					</tr>
				</tbody> 
			</table> 
		</div>
		
<?php
	}
?>