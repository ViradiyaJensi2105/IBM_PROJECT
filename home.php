<?php
  session_start();
  $uid=$_SESSION['uid'];
    if($uid=="")
    {
      echo "<script>location.replace('../index.php');</script>";
    }

  include_once('../vtime.php');
  include('db.php');
  
  $q1=mysqli_query($connection,"SELECT * FROM user_master WHERE utype='worker' ");
  $nworker=mysqli_num_rows($q1);

  $q2=mysqli_query($connection,"SELECT * FROM complain_master");
  $ncomplain=mysqli_num_rows($q2);

  $q3=mysqli_query($connection,"SELECT * FROM complain_master WHERE conf_code=4");
  $nscomplain=mysqli_num_rows($q3);

  $q4=mysqli_query($connection,"SELECT * FROM city");
  $ncity=mysqli_num_rows($q4);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
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

<section id="main-slider" class="no-margin">
    <div class="carousel slide">
      <div class="carousel-inner">
        <div class="item active" style="background-image: url(../images/slider1.jpg)">
          <div class="container">
            <div class="row slide-margin">
              <div class="col-sm-6">
                <div class="carousel-content" style="margin-top:300px;">
                  <h2 class="animation animated-item-1">Welcome To<span> <br>Swachhta Abhiyan</span></h2>
                  <p class="animation animated-item-2">Gandhiji Ka Sapna,Swachh Bharat Ho Apna</p>
                </div>
              </div>

              <div class="col-sm-6 hidden-xs animation animated-item-4">
                <div class="slider-img" style="float:right;top:30%;">
                  <img src="../images/Gandhi.png" class="img-responsive">
                </div>
              </div>

            </div>
          </div>
        </div>
        <!--/.item-->
      </div>
      <!--/.carousel-inner-->
    </div>
    <!--/.carousel-->
  </section>
  <!--/#main-slider-->

    <div class="feature">
    <div class="container">
      <div class="text-center">
        <div class="col-md-3" style="float: left;">
          <div class="hi-icon-wrap hi-icon-effect wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
            <i class="fa fa-user-friends"></i>
            <h2><?php echo $nworker; ?> Workers</h2>
            <p></p>
          </div>
        </div>
        <div class="col-md-3" style="float: left;">
          <div class="hi-icon-wrap hi-icon-effect wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
            <i class="fa fa-laptop"></i>
            <h2><?php echo $ncomplain; ?> Complains</h2>
            <p></p>
          </div>
        </div>
        <div class="col-md-3" style="float: left;">
          <div class="hi-icon-wrap hi-icon-effect wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="900ms">
            <i class="fa fa-heart"></i>
            <h2><?php echo $nscomplain; ?> Solved</h2>
            <p></p>
          </div>
        </div>
        <div class="col-md-3" style="float: left;">
          <div class="hi-icon-wrap hi-icon-effect wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1200ms">
            <i class="fa fa-city"></i>
            <h2><?php echo $ncity; ?> Cities</h2>
            <p></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="about" style="margin-top:250px;">
    <div class="container">
      <div class="col-md-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
        <h2>About us</h2>
        <img src="../images/swachh-bharat.jpg" class="img-responsive" style="width:550px;float: left;" />
        <p>Swachh Bharat Abhiyan (SBA) is a campaign in India that aims to clean up the streets, roads and infrastructure of India's cities, smaller towns, and rural areas. The objectives of Swachh Bharat include eliminating open defecation through the construction of household-owned and community-owned toilets and establishing an accountable mechanism of monitoring toilet use. Run by the Government of India, the mission aims to achieve an Open-Defecation Free (ODF) India by 2 October 2019, the 150th anniversary of the birth of Mahatma Gandhi, by constructing 12 million toilets in rural India at a projected cost of ₹1.96 lakh crore.
        </p>
      </div>

      <div class="col-md-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" style="float: right;margin-top:-550px;padding: 50px">
        <h2>Cleanliness everywhere shows our godliness.</h2>
        <p style="text-align:justify">To accelerate the efforts to achieve universal sanitation coverage and to put focus on sanitation, the Prime Minister of India launched the Swachh Bharat Mission on 2nd October, 2014. The Mission Coordinator for SBM is Secretary.</p>
          <p style="text-align:justify">Ministry of Drinking Water and Sanitation (MDWS) with two Sub-Missions, the Swachh Bharat Mission (Gramin) and the Swachh Bharat Mission (Urban). Together, they aim to achieve Swachh Bharat by 2019,
          </p>
          <p style="text-align:justify">as a fitting tribute to Mahatma Gandhi on his 150th Birth Anniversary.In Rural India, this would mean improving the levels of cleanliness through Solid and Liquid Waste Management activities and making villages Open Defecation Free (ODF), clean and sanitised.</p>
      </div>
    </div>
  </div>
</body>
</html>