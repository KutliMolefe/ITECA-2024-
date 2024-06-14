<?php
session_start();

if(isset($_SESSION['usr_id'])) {
    header("Location: Index.php");
}

include_once 'config.php';


$error = false;


if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    
  
    if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
        $error = true;
        $name_error = "Name must contain only alphabets and space";
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $email_error = "Please Enter Valid Email ID";
    }
    if(strlen($password) < 6) {
        $error = true;
        $password_error = "Password must be minimum of 6 characters";
    }
	if(!preg_match('/[0-9]/', $password)) {
    $error = true;
    $password_error = "Password must contain at least one number";
}
if(!preg_match('/[A-Za-z]/', $password)) {
    $error = true;
    $password_error = "Password must contain at least one letter";
}
if(!preg_match('/[^A-Za-z0-9]/', $password)) {
    $error = true;
    $password_error = "Password must contain at least one special character(e.g., !, @, #, $)";
}
    if($password != $cpassword) {
        $error = true;
        $cpassword_error = "Password and Confirm Password doesn't match";
    }
	if (!$error) {
        
        $domain = substr(strrchr($email, "@"), 1);
        $role = ($domain === 'onBrand.com') ? 'admin' : 'user';

        if(mysqli_query($con, "INSERT INTO users(name,email,password,role) VALUES('" . $name . "', '" . $email . "', '" . md5($password) . "', '" . $role . "')")) {
            $successmsg = "Successfully Registered! <a href='Login.php'>Click here to Login</a>";
        } else {
            $errormsg = "Error in registering...Please try again later!";
        }
    }
    
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration Script</title>
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
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
                <fieldset>
                    <legend>Sign Up</legend>

                    <div class="form-group">
                        <label for="name">Name</label><br>
                        <input type="text" name="name" placeholder="Enter Full Name" required value="<?php if($error) echo $name; ?>" class="form-control" />
                        <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="name">Email</label><br>
                        <input type="text" name="email" placeholder="Email" required value="<?php if($error) echo $email; ?>" class="form-control" />
                        <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="name">Password</label><br>
                        <input type="psw" name="password" placeholder="Password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" id="password"  title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required class="form-control" />
                        <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
						
                    </div>

                    <div class="form-group">
                        <label for="name">Confirm Password</label><br>
                        <input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
                        <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="signup" value="Sign Up" class="btn btn-primary" />
                    </div>
                </fieldset>
            </form>
            <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">    
        Already Registered? <a href="login.php">Login Here</a>
        </div>
    </div>

		</div>
		<div id="message">

  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  <p id="capital" class="invalid">A <b>capital</b> letter</p>
  <p id="number" class="invalid">A <b>number</b></p>
  <p id="length" class="invalid">Minimum <b>6 characters</b></p>
</div>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");


myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}


myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}


myInput.onkeyup = function() {
 
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
 
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

 
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  
  if(myInput.value.length >= 6) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>


<style>
@import url("https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900");
@import url('https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,700|Nova+Mono&display=swap');
@import url('https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,700&display=swap');

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
  
}
 body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
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
.nav,
.nav_item {
  display: flex;
  height: 100%;
  align-items: center;
  justify-content: space-between;
  color:white;
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

.custom-dropdown li a {
  transition: all 0.5s ease;
}
.container {
	right:-40%;
	width:25%;
	height:60%;
	position:relative;
	z-index:1;
            margin-top: -390px; /* Adjust the value as needed */
			border-radius: 20px; /* Adjust the radius as needed */
            backdrop-filter: blur(10px); /* Adjust the blur intensity as needed */
            background-color: rgba(255, 255, 255, 0.5); /* Adjust the background color and opacity as needed */
            padding: 20px; /* Adjust padding as needed */
}
.container label {
            color: white; /* Change this to your desired color */
            font-weight: bold; /* Optional: make the text bold */
			font-size:15px;
        }
.col-md-4 col-md-offset-4 text-center{
			color:white;
}
.form-group{
	color:white;
}





#message {
  display:none;
 font-size:12px;
  color: #000;
  position: relative;
padding-left:760px;
  margin-top: -210px;
  right:50%
  width:50px;
  height:50px;
  z-index:1;
}



/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -15px;
  content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -15px;
  content: "✖";
}
 @media (max-width: 768px) {
            .header {
                padding: 10px;
            }

            .container {
                margin-top: 10px;
            }

            #message {
                font-size: 10px;
                padding-left: 20px;
            }
        }
</style>
</body>
</html>
