<?php
	//session_start();
	$uid=$_SESSION['uid'];
	include('db.php');
	$row=mysqli_fetch_assoc(mysqli_query($connection,"SELECT fname,lname FROM user_master WHERE uid='$uid'"));
	$fname=$row['fname'];
	$lname=$row['lname'];
?>
<!DOCTYPE html>
<html>
<head>
<style>
	.nav-tabs > li > a
	{
		padding:10px;
	}
</style>
</head>
<body>
	<header>
    <nav class="navbar fixed-top" role="navigation">
      <div class="navigation">
        <div class="container-fluid">
          <div class="row">
            <div class="col" style="padding: 0;margin: 0;">
              <div class="navbar-brand">
                <a href="home.php"><h1><span>Swachhta</span>Abhiyan</h1></a>
              </div>
            </div>

            <div class="col" style="padding: 0;margin: 0;">
              <div class="menu" style="width:550px;">
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation"><a href="home.php">Home</a></li>
                  <li role="presentation"><a href="about.php">About Us</a></li>
                  <li role="presentation"><a href="selectcomplain.php">Select Complain</a></li>
                  <li role="presentation"><a href="completecomplain.php">Complete Complain</a></li>
                  <li role="presentation"><a href="contact.php">Contact Us</a></li>
                </ul>
            </div>
          </div>

          <div class="col" style="padding: 0;margin: 0;">
            <div class="dropdown">
              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><?php echo $fname." ".$lname; ?></button>
              <div class="dropdown-menu">
                <h5 class="dropdown-header">ABOUT YOU</h5>
                <a class="dropdown-item" href="profile.php">MY PROFILE</a>
                <a class="dropdown-item" href="complaindetails.php">COMPLAIN DETAILS</a>
                <a class="dropdown-item" href="changepassword.php">CHANGE PASSWORD</a>
                <div class="dropdown-divider"></div>
                <h5 class="dropdown-header">OTHER</h5>
                <a class="dropdown-item" href="signout.php">SIGN OUT</a>
              </div>
            </div>
          </div>
         </div>
        </div>
      </div>
    </nav>
  </header>
</body>
</html>