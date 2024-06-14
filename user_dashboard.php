<?php
session_start();
include 'config.php'; 

if (!isset($_SESSION['usr_id'])) {
    echo "User is not logged in.";
    exit;
}

$user_id = $_SESSION['usr_id']; 
$query = "SELECT email, contact, address FROM users WHERE id = ?";
$stmt = $con->prepare($query);

if ($stmt) {
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        echo "No user found with the given ID.";
        exit;
    }

    $stmt->close();
    
} else {
    echo "Failed to prepare the SQL statement.";
    exit;
}
$user_id = $_SESSION['usr_id'];
$sql = "SELECT order_number, products, total, order_time FROM orders WHERE user_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

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
 <div class="container">
        <div class="profile">
            <div class="profile-info">
                <img src="userProfile.png" alt="Profile Picture" class="profile-pic">
                <h2><?php echo $_SESSION['usr_name']; ?></h2>
                
                
            </div>
            <div class="contact-info">
                <h3>Contact Information</h3>
                <p><strong>Name:</strong><?php echo $_SESSION['usr_name']; ?> </p>
                <p><strong>Email:</strong><?php echo $user['email']; ?> </p>
                <p><strong>Contact number:</strong><?php echo $user['contact']; ?> </p>
                <p><strong>Address:</strong> <?php echo $user['address']; ?></p>
               
            </div>
        </div>
        
		
        <div class="orders">
           <table>
    <tr>
        <th>Order Number</th>
        <th>Products</th>
        <th>Total</th>
        <th>Order Time</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['order_number'] . "</td>";
            echo "<td>" . $row['products'] . "</td>";
            echo "<td>R" . number_format($row['total'], 2) . "</td>";
            echo "<td>" . $row['order_time'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>You have no orders.</td></tr>";
    }
    $stmt->close();
    $con->close();
    ?>
</table>
            </div>
			</div>
    
	<style>
	body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
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
  top:-53px;
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
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 50px;
	
}

.profile {
    display: flex;
    flex-wrap: wrap;
 background: linear-gradient(-45deg,#fe0847,#feae3f);

    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    padding: 20px;
}

.profile-info {
    flex: 1 1 300px;
    text-align: center;
    padding: 20px;
}

.profile-info .profile-pic {
    border-radius: 50%;
    width: 150px;
    height: 150px;
    object-fit: cover;
}

.profile-info h2 {
    margin: 10px 0;
}

.profile-info p {
    margin: 5px 0;
    color: #777;
}

.profile-info .btn {
    margin: 10px 5px;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.follow {
    background-color: #007bff;
    color: #fff;
}

.message {
    background-color: #28a745;
    color: #fff;
}

.contact-info {
    flex: 2 1 500px;
    padding: 20px;
}

.contact-info h3 {
    margin-top: 0;
}

.contact-info p {
    margin: 10px 0;
}

.contact-info .btn {
    margin-top: 20px;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    background-color: #ffc107;
    color: #fff;
}
table {
            width: 60%;
		 border-radius: 0.25em;
            border-collapse: collapse;
			margin: 0 auto;
        }
        table, th, td {
            border-bottom: 1px solid #364043;
		
        }
        th, td {
            padding: 7px;
            text-align: left;
			
        }
        th {
            background-color: #34495E;
        }
		

	</style>
</body>
</html>
