<?php
	include('db.php');

	$q1=mysqli_query($connection,"SELECT * FROM complain_master WHERE conf_code=0");
	$no1=mysqli_num_rows($q1);

	$q2=mysqli_query($connection,"SELECT * FROM message");
	$no2=mysqli_num_rows($q2);

	$q3=mysqli_query($connection,"SELECT * FROM message ORDER BY msgid DESC");
	$no3=mysqli_num_rows($q3);
?>
<!DOCTYPE html>
<html>
<head>
			<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container-fluid">
	<div class="row">
	<div class="page-container">
		<div class="left-content">
			<div class="inner-content">
				<div class="header-section">
						<div style="float:right;margin-right:3%">
							<ul class="nofitications-dropdown">
								<li class="dropdown note">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i> <span class="badge"><?php echo $no2; ?></span></a>
									<ul class="dropdown-menu two first">

										<?php
											while($row3=mysqli_fetch_array($q3))
											{
										?>
												<li class="dropdown-item">
													<a href="message.php?mid=<?php echo $row3['msgid']?>">
														<div class="user_img"><img src="images/img_avatar.png" alt=""></div>
														<div class="notification_desc">
															<p><b><?php echo $row3['name']?></b></p>
															<p><?php echo $row3['subject']?></p>
														</div>
														<div class="clearfix"></div>
													</a>
												</li>
										<?php
											}
										?>
										<li>
											<div class="notification_bottom">
												<a href="message.php">See all messages</a>
											</div> 
										</li>
									</ul>
								</li>
										
								<li class="dropdown note">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i> <span class="badge"><?php echo $no1; ?></span></a>

									<ul class="dropdown-menu two">
										<li>
											<div class="notification_header">
												<h3>You have <?php echo $no1?> new notification</h3>
											</div>
										</li>
										<?php 
											while($row1=mysqli_fetch_array($q1))
											{
												$uid=$row1['uid'];
												$q4=mysqli_query($connection,"SELECT * FROM user_master WHERE uid='$uid' ");
												$row4=mysqli_fetch_assoc($q4);
												$name=$row4['fname']." ".$row4['lname'];
												$imgpath=$row4['imgpath'];
												if($imgpath=="")
												{
													$imgpath="images/male.png";
												}
										?>

										<li>
											<a href="vcmp.php">
												<div class="user_img"><img src="../<?php echo $imgpath?>" alt=""></div>
										   		<div class="notification_desc">
													<p><b><?php echo $name?></p>
													<p></b>has request to clean the area.</p>
													<p><span>Date : <?php echo $row1['registerdate']?></span></p>
												</div>
										  		<div class="clearfix"></div>	
										 	</a>
										</li>
										<?php
											}	 
										?>
										<li>
											<div class="notification_bottom">
												<a href="vcmp.php">See all notification</a>
											</div> 
										</li>
									</ul>
								</li>			   		
								<div class="clearfix"></div>	
							</ul>
						</div>
						<div class="clearfix"></div>	
					<div class="clearfix"></div>
				</div>


				<div class="sidebar-menu">
					<header class="logo">
						<a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="dashboard.php"> <span id="logo"> <h3>SWACHHTA ABHIYAN</h3></span>
					  	</a> 
					</header>
					<div style="border-top:1px solid rgba(65, 94, 60, 0.7)"></div>
					<!--/down-->
					<div class="down">	
						<a href="#"><img src="images/img_avatar.png" height="5%" width="25%"></a>
						<a href="#"><span class="name-caret">Admin</span></a>
						<p>System Administrator in Company</p>
						<ul>	
							<li><a class="tooltips" href="../signout.php"><span>Log out</span><i class="fa fa-power-off"></i></a></li>
						</ul>	
					</div>
					<!--//down-->
	                <div class="menu">
						<ul id="menu" >
								<li><a href="dashboard.php"><i class="fa fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
								<li id="menu-academico" ><a href="#"><i class="fa fa-table"></i> <span> Complaints</span> <span class="fa fa-angle-right" style="float: right"></span></a>
									<ul id="menu-academico-sub" >
										<li id="menu-academico-avaliacoes" ><a href="vcmp.php"> Verify Complaints</a></li>
										<li id="menu-academico-boletim" ><a href="vwork.php">Verify Work</a></li>		
									</ul>
								</li>
								<li id="menu-academico" ><a href="#"><i class="fa fa-file-alt"></i> <span>Worker</span> <span class="fa fa-angle-right" style="float: right"></span></a>
									<ul id="menu-academico-sub" >
										<li id="menu-academico-avaliacoes" ><a href="disp_worker.php">Display Worker</a></li>
										<li id="menu-academico-boletim" ><a href="reqworker.php">Worker Request</a></li>
									</ul>
								</li>
								<li><a href="report.php"><i class="fa fa-book"></i> <span>Report</span></a></li>
								<li><a href="disp_users.php"><i class="fa fa-users"></i> <span>Users</span></a></li>	
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>
</div>
			<div class="clearfix"></div>

			<script>
				var toggle = true;
										
				$(".sidebar-icon").click(function() 
				{                
					if (toggle)
					{
						$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
						$("#menu span").css({"position":"absolute"});
					}
					else
					{
						$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
						setTimeout(function() {
						$("#menu span").css({"position":"relative"});
					}, 400);
				}
				toggle = !toggle;
				});
			</script>
</body>
</html>