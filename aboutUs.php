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

    <section id="home">
        <div class="home-left">
            <img src="Anglo American-540.jpg" alt="">
        </div>
        <div class="home-right">
            <h2 class="home-heading"> About us </h2>
            <p class="home-para">On Brand Marketing Communications is a
Gauteng based company whose core business
is within the brand marketing space. It is an
100% locally manufactured and sourced
company. We manufacture and install in-store
branding, exhibitions displays and kitchen units.
It was formed by Violet Moatshe, partnered with
Ndaba Ndlovu who have a combined 18 years
of experience in the exhibition industry.
The company boasts of a highly qualified
staff equipped with years of active
experience in the chosen field.
We believe in the power of creativity and
innovation. We strive to develop compelling
content and design captivating visuals that
capture attention and leave a lasting
impression, we are committed to
delivering exceptional results.</p>
           
        </div>
    </section>
    
        <h2 class="heading"> Our Mission </h2>
        <p class="para">To be among the top most preferred
service providers and partners in
Exhibition Stand Industry, Shop fitting ,
Mall Space Activations & Fitted Cabinetry <br>Our values are entrenched within the way
we treat each other, our customers and
other stakeholders including our
communities<br> Professionalism, integrity, support,
commitment, objectivity, quality of service,
positive thinking & solution driven</p>
        <div class="num-container">
            <div class="num-item"><span>27,882 <br>Customers</span></div>
            <div class="num-item"><span>90% <br>Action Plans</span></div>
            <div class="num-item"><span>70,592 <br>Downloads</span></div>
        </div>
    </section>
  
    <section id="goal">
        <div class="goal-left">
            <h2>Our Goal</h2>
            <p>We believe in data-driven decision-making. Our goal is to track and analyze key
performance indicators (KPIs) to assess the effectiveness of our marketing campaigns
By gathering insights and making data-backed optimizations, we continually strive for
improvement and better results.</p>
            <ul>
                <li> Increase brand visibility</li><br>
                <li>  Generate leads and drive sales</li><br>
                <li> Enhance customer engagement and loyalty</li>
            </ul>
          
        </div>
        <div class="goal-right">
            <img src="EI.png" alt="">
        </div>
    </section>
   
    <section id="our-Team">
        <h2>Portfolio</h2>
       
    </section>
	<style>
	* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: sans-serif;
}
.header {
  position: fixed;
  margin-top:0%;
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
#home {
    width: 100%;
    padding: 3rem;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-around;
}

.home-left {
    height: 300px;
    position: relative;
}

.home-left img {
    height: 100%;
    border-radius: 10px;
}

.home-right {
    width: 50%;
}

.home-heading {
    font-size: 2rem;
    margin-bottom: 10px;
}

.home-para {
    margin-bottom: 20px;
}

.btn {
    text-decoration: none;
    color: black;
    font-weight: bold;
    position: relative;
    width: 0;
}

.btn:hover::after {
    content: '';
    height: 4px;
    position: absolute;
    background-color: aqua;
    left: 0;
    bottom: -10px;
    animation: width;
    animation-duration: 0.5s;
    animation-fill-mode: forwards;
    border-radius: 5px;
}

@keyframes width {
    0% {
        width: 0%;
    }

    100% {
        width: 100%;
    }
}
.icon-container {
            position: relative;
            display: inline-block;
			margin-left:450px;
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
#workFlow {
    width: 100%;
    display: flex;
    justify-content: center;
    align-content: center;
    flex-direction: column;
    text-align: center;
    margin-bottom: 4rem;
}

.heading {
    margin: 1rem auto;
    text-align: center;
}

.para {
    margin: 1rem auto;
}

.num-container {
    width: 70%;
    margin: 1rem auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.num-item {
    font-size: 1.5rem;
    line-height: 1.4rem;
    color: rgb(43, 126, 199);
}


#goal {
    width: 80%;
    margin: 2rem auto;
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    align-items: center;
}

.goal-left {
    width: 60%;
    line-height: 2rem;
}

.goal-left h2 {
    font-size: 2.4rem;
}

.goal-left p {
    line-height: 1.5rem;
    margin: 1rem 0;
}

.goal-left ul {
    list-style: none;
    margin-bottom: 1rem;
}

.goal-left ul li::before {
    line-height: 1.5rem;
    content: '✓';
    color: red;
}

.goal-right {
    position: relative;
    width: 35%;
}

.goal-right img {
    width: 100%;
    cursor: pointer;
    border-radius: 10px;
    filter: drop-shadow(3px 4px 5px black);
    transition: all 0.2s linear;
}

.goal-right img:hover {
    transform: translateY(-5px);
    filter: drop-shadow(5px 6px 7px black);
}

#our-Team {
    width: 80%;
    margin: 4rem auto 1rem;
}

#our-Team h2 {
    text-align: center;
    margin: 1rem auto 4rem;
    position: relative;
}

#our-Team h2::after {
    content: '';
    height: 4px;
    margin: 0 auto;
    text-align: center;
    width: 15%;
    background-color: aqua;
    position: absolute;
    left: 50%;
    bottom: -10px;
    border-radius: 5px;
    transform: translate(-50%);
}

.teamContainer {
    width: 70%;
    margin: 0 auto;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.team-item {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin: 0.5rem;
}

.team-item h5 {
    margin-top: 1rem;
    font-size: 1.1rem;
}

.team-item span {
    margin-top: .4rem;
    font-weight: bold;
    text-transform: uppercase;
    color: rgb(7, 176, 176);
}

.team-item img {
    width: 80px;
}

footer {
    padding: 1rem 0;
    text-align: center;
}

@media screen and (max-width: 784px) {
    #list {
        display: none;
    }

    #hamBurger {
        cursor: pointer;
        display: block;
        z-index: 20;
        font-size: 2rem;
    }

    .navbar .responsive {
        display: flex;
        flex-direction: column;
        position: fixed;
        top: 0%;
        left: 100%;
        padding: 2rem 0;
        z-index: 2;
        height: 100vh;
        background-color: rgb(24, 23, 24);
        width: 100%;
        transition: all 0.5s linear;
        opacity: 0.9;
    }

    .navbar ul li {
        margin: 0.4rem 0;
    }

    .responsive.active {
        left: 0%;
    }

    .goal-right {
        width: 100%;
        margin: 0 auto 2rem;
    }

    .goal-left {
        width: 100%;
        text-align: center;
    }

    #goal {
        flex-direction: column-reverse;
    }
}

@media screen and (max-width: 633px) {
    #home {
        flex-direction: column;
    }

    .home-left {
        width: 100%;
        height: auto;
    }

    .home-left img {
        width: 100%;
    }

    .home-right {
        margin-top: 2rem;
        width: 100%;
    }

    .para {
        width: 90%;
    }

    .num-container {
        flex-direction: column;
    }

    .num-item {
        margin: 1rem;
    }

    .teamContainer {
        justify-content: center;
    }
}
  </style>  
  
</body>
</html>
