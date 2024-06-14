<?php
session_start();

if(isset($_SESSION['usr_id'])!="") {
    header("Location: Index.php");
}

include_once 'config.php';


if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $result = mysqli_query($con, "SELECT * FROM users WHERE email = '" . $email. "' and password = '" . md5($password) . "'");

   if ($row = mysqli_fetch_array($result)) {
        $_SESSION['usr_id'] = $row['id'];
        $_SESSION['usr_name'] = $row['name'];

        
        $domain = substr(strrchr($email, "@"), 1);
        if ($domain === 'onBrand.com') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: Index.php");
        }
    } else {
        $errormsg = "Incorrect Email or Password!!!";
    } 
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP Login Script</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
</head>

<header class="header">
      <nav class="nav">
        <a href="Index.php" class="nav_logo">OnBrand</a>
        
      </nav>
    </header>

<body>
<video autoplay muted loop class="video-bg">
        <source src="blob.mp4" type="video/mp4">
        Your browser does not support HTML5 video.
    </video> 
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 well">
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
                <fieldset>
                    <legend>Login</legend>
                    
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="text" name="email" placeholder="Your Email" required class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="password" name="password" placeholder="Your Password" required class="form-control" />
                    </div>

                    <div class="form-group">
                        <input type="submit" name="login" value="Login" class="btn btn-primary" />
                    </div>
                </fieldset>
            </form>
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">    
        New User? <a href="register.php">Sign Up Here</a>
        </div>
    </div>
</div>

<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
<style>
body {
  margin: 0;
  padding: 0;
  background-color:black;
}
.video-bg {
          
			width: 40%;
  height: auto;
  transform: translate(50%, 7%);
    z-index: -1;       
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
	color:white;
}
.nav {

  max-width: 1100px;
  width: 100%;
  margin: 0 auto;
}

.nav_logo,
.nav_link,
.button {
  color: white;
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


li a {
  color: white;
}

li a:hover {
  color: #3ca0e7;
}

li:hover {
  cursor: pointer;
}



a {
  text-decoration: none;
}

a:hover {
  color: #3CA0E7;
}


.container{
	margin-top:-270px;
	right:-40%;
	width:25%;
	height:60%;
	position:relative;
	z-index:1;
           
			border-radius: 20px; /* Adjust the radius as needed */
            backdrop-filter: blur(10px); /* Adjust the blur intensity as needed */
            background-color: rgba(255, 255, 255, 0.5); /* Adjust the background color and opacity as needed */
            padding: 20px; /* Adjust padding as needed */
}
  @media (max-width: 768px) {
            .header {
                padding: 10px;
            }

            .container {
                margin-top: 30%;
            }
        }
</style>
</body>
</html>
