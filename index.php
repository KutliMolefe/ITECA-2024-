<?php
session_start();
include_once 'config.php';
if (isset($_SESSION['usr_id'])) {
 
  $_SESSION['cart'] = []; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OnBrand</title>
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="new 1.css">
    
</head>
<body>
   <header class="header">
    <nav class="nav">
        <a href="#" class="nav_logo">OnBrand</a>
        <ul class="nav_items">
            <li class="nav_item"><a href="Index.php" class="nav_link">Home</a></li>
            <li class="nav_item"><a href="team.html" class="nav_link">Team</a></li>
            <li class="nav_item dropdown">
                <a class="nav_link dropdown-toggle">Services &dtrif;</a>
                <ul class="custom-dropdown">
                    <li><a href="#">Branding</a></li>
                    <li><a href="moreServices.php">Apparel</a></li>
                    
                    <li><a href="packagedesign.php">Package and Design</a></li>
                </ul>
            </li>
            <li class="nav_item"><a href="aboutUs.php" class="nav_link">About Us</a></li>
            <?php if (isset($_SESSION['usr_id'])) { ?>
                <li class="nav_item">
                    <div class="icon-container">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <div class="buttons">
                            <button onclick="location.href='user_dashboard.php'">Dashboard</button>
                            <button><p class="navbar-text">Signed in as <?php echo $_SESSION['usr_name']; ?></p></button>
                            <button><a href="logout.php">Log Out</a></button>
                        </div>
                    </div>
                </li>
            <?php } else { ?>
                <li class="nav_item"><a href="Login.php" id="form-open" class="nav_link">Login</a></li>
            <?php } ?>
        </ul>
    </nav>
</header>

    <div id="page1of1">
        <img src="background1.jpg" alt="Background Image" style="filter: brightness(50%);">
        <img src="logo.png" alt="Logo" id="logo">
        <h1>The Power of creativity and innovation</h1>
        <h2>We are a design agency based in South Africa. With a strong belief<br>
            in strategically founded and highly crafted digital experiences,<br>
            we strive to create remarkable solutions that captivate our clients and their audiences.</h2>
    </div>

    <div id="video-content"></div>

    <div id="video-background2">
        <video autoplay muted loop id="myVideo2">
            <source src="background2.mp4" type="video/mp4">
            Your browser does not support HTML5 video.
        </video>
        <div class="overlay">
            <h3>Who we are</h3>
            <p>A platform-first social creative agency.</p>
            <p> </p>Welcome to On Brand Marketing Communications! We specialize in creating effective and engaging communication strategies to help business connect with their target audiences.</p>
            <p>Our team of skilled proffesionals is dedicated to delivering high-quality marketing solution tailored to meet our clients unque needs.</p>
            <a href="#" class="btn">Learn More</a>
        </div>
    </div>

    <div id="page1of3">
        <h4>OUR SERVICES</h4>
        <div class="square-block">
            <div class="inner-square">
                <img src="branding.jpg" alt="Picture 1" style="height: 247px;" class="zoom">
                <p>Branding</p>
                <p>Branding is one of the most crucial aspects of any business, large or small. An effective brand can give you a significant edge in today’s highly competitive market.</p>
                <a href="#" class="learn-more-btn">Learn More</a>
            </div>
        </div>
        <div class="square-block">
            <div class="inner-square">
                <img src="Brand_Marketing_Management.png" alt="Picture 2" style="height: 247px;" class="zoom">
                <p>Brand Marketing Management</p>
                <p>We take pride in delivering and servicing fully-integrated, proven digital marketing solutions. As your partner digital agency in New York, we are here to help support all your brands' digital needs.</p>
                <a href="#" class="learn-more-btn">Learn More</a>
            </div>
        </div>
        <div class="square-block">
            <div class="inner-square">
                <img src="EventActivation.jpg" alt="Picture 3" style="height: 247px;" class="zoom">
                <p>Event activation</p>
                <p>Event activations are unique experiences that allow brands to engage face-to-face with a target audience in ways that other marketing channels simply can’t compete with</p>
                <a href="#" class="learn-more-btn">Learn More</a>
            </div>
        </div>
        <div class="square-block">
            <div class="inner-square">
                <img src="development.png" alt="Picture 1" style="height: 247px;" class="zoom">
                <p>Brand Development</p>
                <p>Branding is one of the most crucial aspects of any business, large or small. An effective brand can give you a significant edge in today’s highly competitive market.</p>
                <a href="#" class="learn-more-btn">Learn More</a>
            </div>
        </div>
        <div class="square-block">
            <div class="inner-square">
                <img src="creative.png" alt="Picture 1"  style="max-width: 100%; height: 235px;" class="zoom">
                <p>Creative design and innovation</p>
                <p>Branding is one of the most crucial aspects of any business, large or small. An effective brand can give you a significant edge in today’s highly competitive market.</p>
                <a href="#" class="learn-more-btn">Learn More</a>
            </div>
        </div>
        <div class="square-block">
            <div class="inner-square">
                <img src="branding.jpg" alt="Picture 1" style="height: 247px;" class="zoom">
                <p>Management and implementation</p>
                <p>Branding is one of the most crucial aspects of any business, large or small. An effective brand can give you a significant edge in today’s highly competitive market.</p>
                <a href="#" class="learn-more-btn">Learn More</a>
            </div>
        </div>
    </div>
	<div id="page1of4">
<div class="circle top-left"></div>
<div class="circle top-left2"></div>
    <div class="circle top-right"></div>
	<div class="circle top-right2"></div>
    <div class="circle bottom-left"></div>
	<div class="circle bottom-left2"></div>
    <div class="circle bottom-right"></div>
	<div class="circle bottom-right2"></div>
<h5>OUR FEATURED CLIENTS</h5>
   <div class="container">
        <div class="ball" id="ball1"></div>
        <div class="ball" id="ball2"></div>
        <div class="ball" id="ball3"></div>
        <div class="ball" id="ball4"></div>
        <div class="ball" id="ball5"></div>
        <div class="ball" id="ball6"></div>
        <div class="ball" id="ball7"></div>
        <div class="ball" id="ball8"></div>
        <div class="ball" id="ball9"></div>
    </div>
		<div class="info">
		<p>Our Work</p>
    </div>
	<div class="info2">
		<p>we specialize in creating effective and engaging communications
        <br>strategies to help businesses connect with ther target audiences.
		<br>Our team of skilled professionalsis dedicated to delivering high 
		<br>quality marketing solutions tailored to meet our clients needs.
		<br>We believe in the power of creativity and innovation.</p>
    </div>
	
</div>


<div id="page1of5">

  <div class="containers">
    <div class="contents">
      <div class="left-side">
        <div class="address details">
          <i class="fas fa-map-marker-alt"></i>
          <div class="topic">Address</div>
          <div class="text-one">1 Mushroom Road</div>
          <div class="text-two">Midrand, 1685</div>
        </div>
        <div class="phone details">
          <i class="fas fa-phone-alt"></i>
          <div class="topic">Phone</div>
          <div class="text-one">011 943 1522</div>
          <div class="text-two">083 429 7361</div>
        </div>
        <div class="email details">
          <i class="fas fa-envelope"></i>
          <div class="topic">Email</div>
          <div class="text-one">info@onbrandmarketing.co.za</div>
          
        </div>
      </div>
      <div class="right-side">
        <div class="topic-text">Send us a message</div>
        <p>Ready to up-level your marketing strategy?We help established brands grow by writing a new content marketing playbook that’s designed to work in any financial environment and amid industry changes.</p>
      <form action="#">
        <div class="input-box">
          <input type="text" placeholder="Enter your name">
        </div>
        <div class="input-box">
          <input type="text" placeholder="Enter your email">
        </div>
        <div class="input-box message-box">
          
        </div>
        <div class="button">
          <input type="button" value="Send Now" >
        </div>
      </form>
    </div>
    </div>
	 </div>

</div>
<style>
 .icon-container {
            position: relative;
            display: inline-block;
			
        }

        .icon-container .fa-user {
            font-size: 25px;
			
        }

        .icon-container .buttons {
            display: none;
            position: absolute;
            top: 20px; /* Adjust as needed */
            left: -18px;
            z-index: 1;
            background-color: white;
            border: 1px solid #ccc;
            padding: 40px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
				
        }

        .icon-container:hover .buttons {
            display: block;
		
        }

        .buttons button, .buttons li a, .buttons li p {
            display: block;
            margin-bottom: 5px;
        }

        .buttons button:last-child, .buttons li a:last-child, .buttons li p:last-child {
            margin-bottom: 0;
        }

        .buttons li {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .buttons li a {
            text-decoration: none;
            color: black;
            padding:10px;
            border-radius: 3px;
            background-color: #f1f1f1;
            display: block;
        }

        .buttons li a:hover {
            background-color: #ddd;
        }
</style>
<script>


</script>
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="index.js"></script>
</body>
</html>
