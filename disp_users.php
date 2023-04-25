<?php
	include("db.php");
	$qry="SELECT * FROM user_master WHERE utype='user' ";												
	$result=mysqli_query($connection,$qry);

?>

<?php
	include('sidebar.php');
?>

		<div class="outter-wp" style="margin-left: 250px;">								
			<h3 class="inner-tittle two">Users</h3><hr>
			<?php 
				while($row=mysqli_fetch_array($result))
				{ 
					$uid=$row['uid'];
					$fname=$row['fname'];
					$mname=$row['mname'];
					$lname=$row['lname'];
					$uemail=$row['email'];
					$gender=$row['gender'];
					$district=$row['district'];
					$city=$row['city'];
					$img=$row['imgname'];
			?>	
			
					<form method="POST">
						<div style="float:left;margin-left:2%;border:1px solid;height:380px">

						<?php 
							if($img!="")
							{
						?>
								<img height="310px" width="300px" src="../profileupload/<?php echo $img; ?>" alt="">
						<?php 
							}
							else if($gender=="male" && $img=="")
							{ 
						?>
								<img height="310px" width="300px" src="../images/male.png" alt="">
						<?php 
							}
							else 
							{ 
						?>
								<img height="310px" width="300px" src="../images/female.png" alt="">
						<?php 
							} 
						?>

						<center>
							<button type="button" style="margin-top: 10px;" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal" data-value="<?php echo $uid?>" onclick="datamodel('<?php echo $uid; ?>')">
								<?php echo $fname." ".$mname." ".$lname; ?>
							</button>
						</center>
						</div>
					</form>
			<?php 
				} 
			?>			
		</div>
										
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document" style="margin-top:5%;margin-right:30%">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">User Profile</h4>
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