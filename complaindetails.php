<?php
	session_start();
	  	$uid=$_SESSION['uid'];
	  if($uid=="")
	  {
	  	echo "<script>location.replace('../index.php');</script>";
	  }
?>
<!DOCTYPE html>
<html>
<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	  <link rel="stylesheet" href="../style.css">
	  <link rel="stylesheet" href="../table.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <style type="text/css">
    	tr,td,th
    	{
    		font-family:Century Gothic !important;
    		text-align: center;
    	}
	</style>
</head>
<body>
	<?php
		include('header.php');
	?>
		<div class="limiter" style="margin-top:-150px;">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100 ver5 m-b-110">
					<div class="table100-head">
						<table>
							<thead>
								<tr class="row100 head">
									<th class="column1">Sr.No</th>
									<th class="column2">Problem Title</th>
									<th class="column3">Problem Date</th>
									<th class="column4">Status</th>
								</tr>
							</thead>
						</table>
					</div>

					<div class="table100-body">
						<table>
							<tbody>
							<?php
							$query=mysqli_query($connection,"SELECT * FROM work_cmp WHERE uid='$uid' ");
							$no=mysqli_num_rows($query);

							if($no>0)
							{
								while($row=mysqli_fetch_assoc($query))
								{
									$comid=$row['comid'];
									$q1=mysqli_query($connection,"SELECT * FROM complain_master WHERE comid='$comid' ");

									$sr=0;
									while($row1=mysqli_fetch_assoc($q1)) 
									{
										$sr++;
										$comid=$row1['comid'];
										$probtype=$row1['probtype'];
										$probdescription=$row1['probdescription'];
										$registerdate=$row1['registerdate'];
										$fname=$row1['fname'];
										$conf_code=$row1['conf_code'];

										if($conf_code==0)
										{
											$status="Pending Approval";
										}
										elseif($conf_code==1)
										{
											$status="No One Select";
										}
										elseif($conf_code==2)
										{
											$status="Rejected";
										}
										elseif($conf_code==3)
										{
											$status="Work in Progress";
										}
										elseif($conf_code==4)
										{
											$status="Solved";
										}
						?>			
						<tr class="row100 body">
							<td class="column1"><?php echo $sr;?></td>
							<td class="column2"><?php echo $probtype;?></td>
							<td class="column3"><?php echo $registerdate;?></td>
							
							<?php 
								if($conf_code==4)
								{
							?>
								<td align="center" class="column4">
									<button type="button" style="margin-bottom:10px" class="btn btn-primary" data-toggle="modal" data-target="#myModal" data-value="<?php echo $comid; ?>" onclick="datamodel('<?php echo $comid?>')"><?php echo $status; ?></button>
								</td>
							<?php 
								} 
								else
								{
							?>
								<td align="center" class="column4">
									<button class="btn btn-primary" disabled><?php echo $status?></button>
								</td>
							<?php 
								}
							?>
						</tr>
						<?php
							}
						}
						}
						?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document" style="margin-top:7%;margin-right:40%;">
			<div class="modal-content" style="width:600px;height: 600px;">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel"></h4>
				</div>
				<div class="modal-body"  style="height:400px;color:black" id="modeldata"></div>
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
			
			abc.open("POST","comstatus.php?done="+str,true);
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