<?php
	session_start();
  	$uid=$_SESSION['uid'];
    if($uid=="")
    {
      echo "<script>location.replace('../index.php');</script>";
    }

  	include('db.php');

	$res=mysqli_query($connection,"SELECT fname,lname,email,imgname,imgpath FROM user_master WHERE uid='$uid' ");
	$row=mysqli_fetch_assoc($res);
	$name=$row['fname']." ".$row['lname'];
	$email=$row['email'];
	$imgname=$row['imgname'];
	$imgpath=$row['imgpath'];

	if(isset($_POST['sbtn']))
	{
		$subject=$_POST['subject'];
		$msg=$_POST['message'];

		$insert=mysqli_query($connection,"INSERT INTO message (name,email,subject,msg,imgname,imgpath) VALUES ('$name','$email','$subject','$msg','$imgname','$imgpath') ");

		if($insert=="")
		{
			echo "<script>alert('ERROR.......');</script>";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Contact Us</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="../style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
		include('header.php');
	?>

	<div id="breadcrumb">
    	<div class="container">
      		<div class="breadcrumb">
        		<li><a href="home.php">Home</a>&nbsp/&nbsp</li>
        		<li>Contact Us</li>
      		</div>
    	</div>
  	</div>

  	<section id="contact-page">
    	<div class="container">
      		<div class="center">
        		<h2>Drop Your Message</h2><hr>
      		</div>
      		<div class="row contact-wrap">
        		<div class="status alert alert-success" style="display:none;"></div>
        		<div class="col-md-6 col-md-offset-3">
          			<div id="sendmessage">Your message has been sent. Thank you!</div>
          			<div id="errormessage"></div>
          			<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="transform: translate(50%);">
            			<div class="form-group">
              				<input type="text" name="name" class="form-control" id="name" name="name" value="<?php echo $name;?>" data-rule="minlen:4" data-msg="Please enter at least 4 chars" disabled />
        					<div class="validation"></div>
            			</div>
           				<div class="form-group">
              				<input type="email" class="form-control" name="email" id="email" value="<?php echo $email; ?>" data-rule="email" data-msg="Please enter a valid email" disabled />
              				<div class="validation"></div>
           		 		</div>
            			<div class="form-group">
              				<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" required />
              				<div class="validation"></div>
            			</div>
            			<div class="form-group">
              				<textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message" required /></textarea>
              				<div class="validation"></div>
            			</div>
            			<div class="text-center">
            				<input type="submit" name="sbtn" class="btn btn-primary btn-lg" value="Submit Your Message">
            			</div>
          			</form>
        		</div>
      		</div>
    	</div>
  	</section>

</body>
</html>