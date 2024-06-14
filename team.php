<?php
session_start();
include 'config.php'; 

if (!isset($_SESSION['usr_id'])) {
   
}
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OnBrand</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
 <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
 <header class="header">
    <nav class="nav">
        <a href="#" class="nav_logo">OnBrand</a>
        <ul class="nav_items">
            <li class="nav_item"><a href="Index.php" class="nav_link">Home</a></li>
            <li class="nav_item"><a href="team.php" class="nav_link">Team</a></li>
            <li class="nav_item dropdown">
                <a class="nav_link dropdown-toggle">Services &dtrif;</a>
                <ul class="custom-dropdown">
                    <li><a href="#">Branding</a></li>
                    <li><a href="moreServices.php">Apparel</a></li>
                    <li><a href="product-branding.html">Product Branding</a></li>
                    <li><a href="packagedesign.php">Package and Design</a></li>
                </ul>
            </li>
            <li class="nav_item"><a href="aboutUs.php" class="nav_link">About Us</a></li>
            <?php if (isset($_SESSION['usr_id'])) { ?>
                <li class="nav_item">
                    <div class="icon-container">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <div class="buttons">
                            <button onclick="location.href='dashboard.html'">Dashboard</button>
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
<body>
  
 
    <div class="container">
    <h1 id="page-title">Our Team</h1>
    <hr id="title_hr">
    <div id="wrapper">
      
        <div class="card-profile-item">
        <div class="card-profile">
            <div class="card-profile-header">
            </div>
            <div class="card-profile-subheader">
            <div class="card-profile-details">
                <div class="profile-img">
                <img src="crop logo (1).png" alt="Image by wayhomestudio on Freepik">
                </div>
                <div class="profile-name">Vela Mzimela</div>
                <div class="profile-sub">Creative Director</div>
            </div>
            </div>
            <div class="card-profile-body">
            <div class="profile-description"></div>
            <div class="profile-social-links">
                <a href="" class="profile-social-link"><i class="fab fa-facebook-f"></i></a>
                <a href="" class="profile-social-link"><i class="fab fa-twitter"></i></a>
                <a href="" class="profile-social-link"><i class="fab fa-pinterest"></i></a>
                <a href="" class="profile-social-link"><i class="fab fa-linkedin"></i></a>
            </div>
            </div>
        </div>
        </div>
      
        <div class="card-profile-item">
        <div class="card-profile">
            <div class="card-profile-header">
            </div>
            <div class="card-profile-subheader">
            <div class="card-profile-details">
                <div class="profile-img">
                <img src="./image-2.jpg" alt="Image by wayhomestudio on Freepik">
                </div>
                <div class="profile-name">Shonisani Makhari</div>
                <div class="profile-sub">Head of Communications & Media Relations</div>
            </div>
            </div>
            <div class="card-profile-body">
            <div class="profile-description"></div>
            <div class="profile-social-links">
                <a href="" class="profile-social-link"><i class="fab fa-facebook-f"></i></a>
                <a href="" class="profile-social-link"><i class="fab fa-twitter"></i></a>
                <a href="" class="profile-social-link"><i class="fab fa-pinterest"></i></a>
                <a href="" class="profile-social-link"><i class="fab fa-linkedin"></i></a>
            </div>
            </div>
        </div>
        </div>
        
        <div class="card-profile-item">
        <div class="card-profile">
            <div class="card-profile-header">
            </div>
            <div class="card-profile-subheader">
            <div class="card-profile-details">
                <div class="profile-img">
                <img src="./image-3.jpg" alt="Image by wayhomestudio on Freepik">
                </div>
                <div class="profile-name">Violet Moatshe</div>
                <div class="profile-sub">CEO</div>
            </div>
            </div>
            <div class="card-profile-body">
            <div class="profile-description"></div>
            <div class="profile-social-links">
                <a href="" class="profile-social-link"><i class="fab fa-facebook-f"></i></a>
                <a href="" class="profile-social-link"><i class="fab fa-twitter"></i></a>
                <a href="" class="profile-social-link"><i class="fab fa-pinterest"></i></a>
                <a href="" class="profile-social-link"><i class="fab fa-linkedin"></i></a>
            </div>
            </div>
        </div>
        </div>
        
        <div class="card-profile-item">
        <div class="card-profile">
            <div class="card-profile-header">
            </div>
            <div class="card-profile-subheader">
            <div class="card-profile-details">
                <div class="profile-img">
                <img src="./image-4.jpg" alt="Image by wayhomestudio on Freepik">
                </div>
                <div class="profile-name">Bonolo Mushanganyisi</div>
                <div class="profile-sub">Brand Marketing & Communications Specialist</div>
            </div>
            </div>
            <div class="card-profile-body">
            <div class="profile-description"></div>
            <div class="profile-social-links">
                <a href="" class="profile-social-link"><i class="fab fa-facebook-f"></i></a>
                <a href="" class="profile-social-link"><i class="fab fa-twitter"></i></a>
                <a href="" class="profile-social-link"><i class="fab fa-pinterest"></i></a>
                <a href="" class="profile-social-link"><i class="fab fa-linkedin"></i></a>
            </div>
            </div>
        </div>
        </div>
   
    </div>
	<style>
	
@import url('https://fonts.googleapis.com/css2?family=Dongle:wght@300;400;700&family=Roboto+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet');
*{
    margin: 0;
    padding: 0;
    
    font-family: 'Dongle', sans-serif;
    font-family: 'Roboto Mono', monospace;
}
::selection{
    color: #fff;
    background: #4db2ec;
	box-sizing: border-box;
}
.header {
  position: fixed;
  margin-top:-47%;
  height: 80px;
  width: 100%;
  z-index: 100;
  padding: 0 20px;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
   backdrop-filter: blur(10px); /* Apply blur effect */
    background: rgba(255, 255, 255, 0.1); /* Semi-transparent background */
	color:black;
}
.nav {

  max-width: 1100px;
  width: 100%;
  margin: 0 auto;
}
.nav,
.nav_item {
  display: inline-block;
  left:400px;
  height: 100%;
  align-items: center;
  justify-content: space-between;
  color:black;
}
.nav_logo,
.nav_link,
.button {
  color: black;
}
.nav_logo {
  font-size: 25px;
}
.nav_item {
  column-gap: 25px;
  color:white;
}
.nav_link:hover {
  color: #d9d9d9;
}
.button {
  padding: 6px 24px;
  border: 2px solid #fff;
  background: transparent;
  border-radius: 6px;
  cursor: pointer;
}
.button:active {
  transform: scale(0.98);
}
ul li {
  list-style: none;
  margin: 0 auto;
  display: inline-block;
  padding: 0 30px;
  position: relative;
  text-decoration: none;
  text-align: center;
  font-family: arvo;
}

li a {
  color: black;
}

li a:hover {
  color: #3ca0e7;
}

li:hover {
  cursor: pointer;
}

.custom-dropdown {
  visibility: hidden;
  opacity: 0;
  position: absolute;
  left: 0;
  display: none;
  background: black;
}

.dropdown:hover > .custom-dropdown {
  visibility: visible;
  opacity: 1;
  display: block;
  min-width: 250px;
  text-align: left;
  padding-top: 20px;
  box-shadow: 0px 3px 5px -1px #ccc;
}

.custom-dropdown li {
  clear: both;
  width: 100%;
  text-align: left;
  margin-bottom: 20px;
  border-style: none;
}

.custom-dropdown li a:hover {
  padding-left: 10px;
  border-left: 2px solid #3ca0e7;
  transition: all 0.3s ease;
}

a {
  text-decoration: none;
}

a:hover {
  color: #3CA0E7;
}

.custom-dropdown li a {
  transition: all 0.5s ease;
}
@media (max-width: 768px) {
  .nav {
    flex-direction: column; /* Stack items vertically on small screens */
  }
  
  .nav_items {
	  
    margin-top: 10px; /* Add space between logo and items */
  }

  .nav_item {
    margin: 0 0 10px 0; /* Adjust margins for stacked items */
  }

  .custom-dropdown {
    position: static; /* Override absolute positioning on small screens */
    display: none; /* Ensure dropdowns are hidden initially */
  }

  .dropdown:hover .custom-dropdown {
    display: none; /* Keep dropdowns hidden until clicked/touched */
  }
}
body{
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    background: #0B2447;
    background-image: linear-gradient(to right, #2E4F4F 0%, #0B2447 100%);
    padding: 2em 0;
}
#page-title{
    color: #fff;
    text-align: center;
    font-weight: 500;
}
#title_hr{
    width:60px;
    border: 2px solid #ffffff;
    margin: .35em auto;
}


/* Card Wrapper */
#wrapper{
    width: 1300px;
    margin: 1em auto;
    padding: 1em 2em;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-gap: 1em;
    margin: 0.35em auto;
}
@media (max-width:1350px){
    #wrapper{
    width: 100%;
    grid-template-columns: repeat(3, 1fr);
    }
}
@media (max-width:950px){
    #wrapper{
    width: 100%;
    grid-template-columns: repeat(2, 1fr);
    }
}
@media (max-width:750px){
    #wrapper{
    width: 100%;
    grid-template-columns: repeat(1, 1fr);
    }
}
/* Card Profile Item */
.card-profile-item {
    margin: auto;
}
/* Card Profile */
.card-profile {
    position: relative;
    width: 300px;
    background: #fff;
    border: 1px solid #c1c1c1;
    border-radius: 2px;
    box-shadow: 0px 0px 5px #0c0c0cab;
}
 
.card-profile:before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
    width: 100%;
    height: 30vh;
    background: #dfdddd38;
    clip-path: polygon(0% 0%, 1% 0%, 100% 44%, 100% 0%);
}
.card-profile:after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    z-index: 3;
    width: 100%;
    height: 30vh;
    background: #4c3d3d38;
    clip-path: polygon(66% 0%, 36% 68%, 191% 90%, -22% 100%);
}
/* Card header */
.card-profile-header {
    position: relative;
    width: 100%;
    height: 30vh;
    margin-bottom: 60px;
    background-image: url('crop logo (1).png');
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center center;
    overflow-x: hidden;
}
 
.card-profile-header:before {
    content: "";
    position: absolute;
    width: 100%;
    height: 40%;
    bottom: 0;
    border-bottom: 58px solid #c9bebe94;
    border-right: 330px solid transparent;
    left: -330px;
}
.card-profile-header:after {
    content: "";
    position: absolute;
    z-index:1 ;
    width: 100%;
    height: 40%;
    bottom: 0;
    border-bottom: 58px solid #bfbfbf8a;
    border-left: 330px solid transparent;
    right: -330px;
}
/* Position Subheader */
.card-profile-subheader {
    position: relative;
    z-index: 2;
    width: 100%;
    top: -147px;
    left: 0;
    padding-bottom: 1em;
}
/* Position Details */
.card-profile-details {
    position: absolute;
    width: 100%;
    left: 0;
}
 
/* profile image */
.profile-img {
    width: 100px;
    height: 100px;
    margin: 0.35em auto;
    border: 4px solid #fff;
    box-shadow: 3px 3px 10px #00000042;
    border-radius: 50% 50%;
    overflow: hidden;
}
.profile-img > img{
    height: 100%;
    width: 100%;
    object-fit: cover;
    object-position: top center;
}
 
/* Profile Name */
.profile-name {
    padding: 0.05em 2.5em;
    text-align: center;
    font-size: 1.1rem;
    color: #323232;
}
.profile-sub {
    padding: 0 3em;
    text-align: center;
    font-size: .8rem;
    color: #5c5c5c;
}
/* Card Body */
.card-profile-body {
    position: relative;
    padding: 0.5em 1em;
}
 
/* Card Description */
.profile-description {
    color: #020202;
    line-height: 1.2em;
    font-size: .8rem;
    font-weight: 300;
    text-align: unset;
    word-break: break-all;
    padding-bottom: 1em;
}
 
/* Social Links */
.profile-social-links {
    position: relative;
    z-index: 4;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-evenly;
}
 
a.profile-social-link {
    display: flex;
    width: 1.8rem;
    height: 1.8rem;
    background: #fff;
    text-decoration: none;
    border-radius: 50% 50%;
    color: #0e0e0e;
    font-size: 0.8rem;
    align-items: center;
    justify-content: center;
    border: 1px solid #e5e5e5;
    box-shadow: 0px 0px 13px #00000029;
    transition: all .2s ease;
}
a.profile-social-link:hover {
    transform: scale(1.04) translateY(-1px);
}
</style>
</body>
</html>
