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
	<title>About Us</title>
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
        <li>About Us</li>
      </div>
    </div>
  </div>

<center>
  <div class="aboutus">
    <div class="container">
      <h3>Our company information</h3>
      <hr>
      <div class="col-md-9 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
        <img src="../images/Slogans.jpg" class="img-responsive">
        <h4>We work on cleaning through our website.</h4>
        <p>Our mission is to provide well clean city or area and most important factor is citizen's satisfactory.</p>
        <p></p>
      </div>
      <div class="col-md-5 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
        
      </div>
    </div>
  </div>
  </center>

  <div class="our-team">
    <div class="container">
      <div class="text-center">
        <div class="wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
          
          <h4> JENSI VIRADIYA</h4>
        </div>
        
      </div>
    </div>
  </div>	
</body>
</html>