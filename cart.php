<?php
session_start();
include 'config.php';



if (!isset($_SESSION['usr_id'])) {
    header("Location: Login.php");
    exit();
}

function generateOrderNumber($con) {
    $isUnique = false;
    $orderNumber = '';
    while (!$isUnique) {
        $orderNumber = str_pad(mt_rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
        $check_sql = "SELECT order_number FROM orders WHERE order_number = '$orderNumber'";
        $result = $con->query($check_sql);
        if ($result->num_rows == 0) {
            $isUnique = true;
        }
    }
    return $orderNumber;
}
$total = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $contact = $_POST['contact'];
    $city = $_POST['city'];
    $address = $_POST['address'];
	$user_id = $_SESSION['usr_id'];
	$order_number = generateOrderNumber($con);
	 $logo = NULL;
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
        $logo = addslashes(file_get_contents($_FILES['logo']['tmp_name']));
    }
 
    $sql = "UPDATE users SET contact='$contact', city='$city', address='$address' WHERE id='$user_id'";
    
    if ($con->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $con->error;
    }
	
    $sql = "SELECT c.id, c.item_name, i.price, c.quantity 
            FROM cart c INNER JOIN items i ON c.item_name = i.name 
            WHERE c.user_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $itemTotal = $row['price'] * $row['quantity'];
        $total += $itemTotal;
    }
    $stmt->close();
	
    $order_sql = "INSERT INTO orders (user_id, address, contact_number, city, logo,order_number,total ) VALUES ('$user_id', '$address', '$contact', '$city', '$logo', '$order_number', '$total')";
    if ($con->query($order_sql) === TRUE) {
        echo "Order placed successfully";
        $order_id = $con->insert_id; 
		
    $concat_sql = "SELECT GROUP_CONCAT(item_name SEPARATOR ', ') AS products FROM cart WHERE user_id = '$user_id'";
    $result = $con->query($concat_sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $products = $row['products'];

        
        $update_sql = "UPDATE orders SET products = '$products' WHERE order_id = '$order_id'";
        if ($con->query($update_sql) === TRUE) {
            echo " Products added to order successfully";
        } else {
            echo "Error updating products: " . $con->error;
        }
    } else {
        echo "Error fetching cart items: " . $con->error;
    }
		
		
		
    } else {
        echo "Error placing order: " . $con->error;
    }
	
    $sql_update_cart = "UPDATE cart SET status='Confirmed' WHERE user_id='$user_id'";
if ($con->query($sql_update_cart) === TRUE) {
    echo "Cart items status updated successfully";
	
	
} else {
    echo "Error updating cart items status: " . $con->error;
}
    
    $con->close();
	 exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apparel Branding</title>
    
</head>
<body>

<header class="header">
    <nav class="nav">
        <a href="#" class="nav_logo">OnBrand</a>
        <ul class="nav_items">
            <li class="nav_item">
                <a href="Index.php" class="nav_link">Home</a>
                <a href="team.html" class="nav_link">Team</a>
                <div class="dropdown">
                    <a href="services.php" class="nav_link dropdown-toggle">Services &dtrif;</a>
                    <ul class="custom-dropdown">
                        <li>Branding</li>
                        <li><a href="moreServices.php">Apparel</a></li>
                        <li><a href="product-branding.php">Product Branding</a></li>
                        <li><a href="packagedesign.php">Package and Design</a></li>
                    </ul>
                </div>
                <a href="aboutUs.html" class="nav_link">About Us</a>
            </li>
        </ul>
        <?php if (isset($_SESSION['usr_id'])) { ?>
            <li><p class="navbar-text">Signed in as <?php echo $_SESSION['usr_name']; ?></p></li>
            <li><a href="logout.php">Log Out</a></li>
        <?php } else { ?>
            <li><a href="Login.php" id="form-open" class="nav_link">Login</a></li>
            <li><a href="Register.php" id="signup-link" class="nav_link">Sign Up</a></li>
        <?php } ?>
    </nav>
</header>

<div class="wrap cf">
    <h1 class="projTitle">Shopping Cart</h1>
    <div class="heading cf">
        <h1>My Cart</h1>
        <a href="moreServices.php" class="continue">Continue Shopping</a>
    </div>
    <div class="cart">
	<?php
 
        $user_id = $_SESSION['usr_id'];
        $sql = "SELECT c.id, c.item_name, i.price, i.image, c.quantity FROM cart c INNER JOIN items i ON c.item_name = i.name WHERE c.user_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
		
                $itemTotal = $row['price'] * $row['quantity'];
                $total += $itemTotal;
				
        echo '<li class="cartItem">';
        echo '<div class="cartContent">';
       
        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="' . $row['item_name'] . '" class="itemImage">'; // Display image
        echo '<h3>' . $row['item_name'] . '</h3>';
        echo '<p><class="quantity" value=" ' . $row['quantity'] . '" /> x R' . number_format($row['price']) . '</p>';
		 
        echo '</div>';
        echo '<div class="prodTotal cartSection">';
        echo '<p>R' . number_format($row['price']*$row['quantity'] ) . '</p>'; // Assuming quantity is 3, you can replace it with the actual quantity
        echo '</div>';
		


        echo'<form class="form-box" method="POST" enctype="multipart/form-data">';
		echo '<input type="file" name="logo' . $row['id'] . '" accept="image/*">' ;
		
		echo '</form>';
        echo '<div class="cartSection removeWrap">';
        echo '<form action="removeFromCart.php" method="post">';
        echo '<input type="hidden" name="item_id" value="' . $row['id'] . '">';
                echo '<button type="submit" class="remove">x</button>';
                echo '</form>';
                echo '</div>';
                echo '</li>';
    }
} else {
    echo '<p>Your cart is empty</p>';
}

$stmt->close();
$con->close();
?>

 
    <div class="totalRow">
        <span class="label">Total Cost: </span>
        <span class="value">R<?php echo number_format($total); ?></span>
		
    </div>
	
    <div class="totalRow">
        <button id="checkoutButton">Checkout</button>
    <div id="checkoutPage" class="hidden">
      
		<div class="receipt">
          <h2 class="receipt-heading">Receipt Summary</h2>
          <div>
            <table class="table"> 
              <tr class="total">
                <td>Total</td>
                <td class="price">R<?php echo number_format($total); ?> </td>
				
              </tr>
            </table>
          </div>
        </div>

        <div class="payment-info">
          <h3 class="payment-heading">Payment Information</h3>
          <form
            class="form-box"
            enctype="text/plain"
            method="get"
            target="_blank"
          >
            <div>
              <label for="full-name">Full Name</label>
              
                
               <?php echo $_SESSION['usr_name']; ?>
                
              
            </div>
			<div>
              <label for="contact">Contact</label>
              <input
                id="contact"
                name="contact"
                placeholder="012 345 6789"
                required
                type="Number"
              />
            </div>
			<div>
              <label for="city">City</label>
              <input
                id="city"
                name="city"
                placeholder="Johannesburg"
                required
                type="text"
              />
            </div>
<div>
              <label for="address">Address</label>
              <input
                id="address"
                name="address"
                placeholder="2 Nara Smith Streen Lucky Park"
                required
                type="text"
              />
            </div>
			
            <div>
              <label for="credit-card-num"
                >Card Number
                <span class="card-logos">
                  <i class="card-logo fa-brands fa-cc-visa"></i>
                  <i class="card-logo fa-brands fa-cc-amex"></i>
                  <i class="card-logo fa-brands fa-cc-mastercard"></i>
                  <i class="card-logo fa-brands fa-cc-discover"></i> </span
              ></label>
              <input
                id="credit-card-num"
                name="credit-card-num"
                placeholder="1111-2222-3333-4444"
                required
                type="text"
              />
            </div>

            <div>
              <p class="expires">Expires on:</p>
              <div class="card-experation">
                <label for="expiration-month">Month</label>
                <select id="expiration-month" name="expiration-month" required>
                  <option value="">Month:</option>
                  <option value="">January</option>
                  <option value="">February</option>
                  <option value="">March</option>
                  <option value="">April</option>
                  <option value="">May</option>
                  <option value="">June</option>
                  <option value="">July</option>
                  <option value="">August</option>
                  <option value="">September</option>
                  <option value="">October</option>
                  <option value="">November</option>
                  <option value="">Decemeber</option>
                </select>

                <label class="expiration-year">Year</label>
                <select id="experation-year" name="experation-year" required>
                  <option value="">Year</option>
                  <option value="">2023</option>
                  <option value="">2024</option>
                  <option value="">2025</option>
                  <option value="">2026</option>
                </select>
              </div>
            </div>

            <div>
              <label for="cvv">CVV</label>
              <input
                id="cvv"
                name="cvv"
                placeholder="415"
                type="text"
                required
              />
              <a class="cvv-info" href="#">What is CVV?</a>
            </div>

            <button class="btn" onclick="submitForm()">
    <i class="fa-solid fa-lock"></i> Confirm
</button>
          </form>

          <p class="footer-text">
            <i class="fa-solid fa-lock"></i>
            Your credit card infomration is encrypted
          </p>
        </div>
      </div>
    
 
  
    
</div>
<style>
@import "compass/css3";

@import url(https://fonts.googleapis.com/css?family=Droid+Serif:400,400italic|Montserrat:400,700);
@import "compass/reset";
$fontSans : 'Montserrat', sans-serif;
$fontSerif : 'Droid Serif', serif;


@mixin transition($transition-property, $transition-time, $method) {
    -webkit-transition: $transition-property $transition-time $method;
    -moz-transition: $transition-property $transition-time $method;
    -ms-transition: $transition-property $transition-time $method;
    -o-transition: $transition-property $transition-time $method;
    transition: $transition-property $transition-time $method;
}
*{ box-sizing:border-box;}



body {
  color: #333;
  -webkit-font-smoothing: antialiased;
  font-family: $fontSerif;
 
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
	color:black;
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
  color:black;
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
  background: white;
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

.home {
  position: relative;
  height: 100vh;
  width: 100%;
 
  background-size: cover;
  background-position: center;
}
.home::before {
  content: "";
  position: absolute;
  height: 100%;
  width: 100%;
  background-color: rgba(0, 0, 0, 0.6);
  z-index: 100;
  opacity: 0;
  pointer-events: none;
  transition: all 0.5s ease-out;
}
.home.show::before {
  opacity: 1;
  pointer-events: auto;
}

.form_container {
  position: fixed;
  max-width: 320px;
  width: 100%;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%) scale(1.2);
  z-index: 101;
  background: #fff;
  padding: 25px;
  border-radius: 12px;
  box-shadow: rgba(0, 0, 0, 0.1);
  opacity: 0;
  pointer-events: none;
  transition: all 0.4s ease-out;
}
.home.show .form_container {
  opacity: 1;
  pointer-events: auto;
  transform: translate(-50%, -50%) scale(1);
}
.signup_form {
  display: none;
}
.form_container.active .signup_form {
  display: block;
}
.form_container.active .login_form {
  display: none;
}
.form_close {
  position: absolute;
  top: 10px;
  right: 20px;
  color: #0b0217;
  font-size: 22px;
  opacity: 0.7;
  cursor: pointer;
}
.form_container h6 {
  font-size: 22px;
  color: #0b0217;
  text-align: center;
}
.input_box {
  position: relative;
  margin-top: 30px;
  width: 80%;
  height: 40px;
}
.input_box input {
  height: 100%;
  width: 100%;
  border: none;
  outline: none;
  padding: 0 30px;
  color: #333;
  transition: all 0.2s ease;
  border-bottom: 1.5px solid #aaaaaa;
}
.input_box input:focus {
  border-color: #7d2ae8;
}
.input_box i {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  font-size: 20px;
  color: #707070;
}
.input_box i.email,
.input_box i.password {
  left: 0;
}
.input_box input:focus ~ i.email,
.input_box input:focus ~ i.password {
  color: #7d2ae8;
}
.input_box i.pw_hide {
  right: 0;
  font-size: 18px;
  cursor: pointer;
}
.option_field {
  margin-top: 14px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.form_container a {
  color: #7d2ae8;
  font-size: 12px;
}
.form_container a:hover {
  text-decoration: underline;
}
.checkbox {
  display: flex;
  column-gap: 8px;
  white-space: nowrap;
}
.checkbox input {
  accent-color: #7d2ae8;
}
.checkbox label {
  font-size: 12px;
  cursor: pointer;
  user-select: none;
  color: #0b0217;
}
.form_container .button {
  background: #7d2ae8;
  margin-top: 30px;
  width: 100%;
  padding: 10px 0;
  border-radius: 10px;
}
.login_signup {
  font-size: 12px;
  text-align: center;
  margin-top: 15px;
}


.wrap {
    max-width: 1200px;
    margin: 2em auto;
    padding: 2em;
    background: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

.projTitle {
    font-size: 2em;
    margin-bottom: 1em;
    text-align: center;
}

.heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1em;
}

.heading h1 {
    font-size: 1.5em;
}

.continue {
    text-decoration: none;
    color: #ff6f61;
    padding: 0.5em 1em;
    border: 1px solid #ff6f61;
    border-radius: 4px;
}

.continue:hover {
    background: #ff6f61;
    color: #fff;
}

.cart {
    list-style: none;
}

.cartItem {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1em 0;
    border-bottom: 1px solid #ddd;
}

.cartContent {
    display: flex;
    align-items: center;
}

.itemImage {
    width: 60px;
    height: 60px;
    object-fit: cover;
    margin-right: 1em;
}

.prodTotal {
    text-align: right;
}

.form-box input[type="file"] {
    display: block;
    margin-top: 0.5em;
}

.removeWrap {
    text-align: right;
}

.remove {
    background: none;
    border: none;
    color: #ff6f61;
    cursor: pointer;
    font-size: 1.2em;
}

.remove:hover {
    color: #e63946;
}

/* Summary */
.summary {
    text-align: right;
    margin-top: 2em;
}

.totalRow {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.5em;
    font-size: 1.2em;

}

.label {
    font-weight: bold;
}

.value {
    font-size: 1.5em;
    font-weight: bold;
}

#checkoutButton {
	float: right;
    background: #ff6f61;
    color: #fff;
    padding: 0.5em 1em;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1.2em;

}

#checkoutButton:hover {
    background: #e63946;
}


.hidden {
    display: none;
}

#checkoutPage {
	overflow-y: scroll;
    position: fixed;
    top: 55%;
    left: 85%;
    transform: translate(-50%, -50%);
    width: 10cm;
    height: 16cm;
    background-color: #fff;
    border: 1px solid #eee;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
   
}
.receipt {
  display: flex;
  flex-direction: column;
  gap: 1rem;
  border-bottom: solid 1px;
  margin-bottom: 1rem;
}

.receipt-heading {
  font-size: 1.6rem;
  text-align: left;
}

.table {
  border-collapse: separate;
  border-spacing: 0 1.5rem;
  color: #64645f;
  font-size: 1.2rem;
  margin-bottom: 0.5rem;
  width: 100%;
}

.total td {
  font-size: 1.4rem;
  font-weight: 700;
}

.price {
  text-align: end;
}



.payment-heading {
  font-size: 1.4rem;
  margin-bottom: 1rem;
}

.form-box {
  display: grid;
  grid-template-rows: 1fr;
  gap: 1.5rem;
}

.card-logo {
  font-size: 2rem;
}

.expires,
.form-box label {
  font-size: 1.2rem;
  font-weight: 700;
}

.form-box input {
  font-family: inherit;
  font-size: 1.2rem;
  padding: 0.5rem;
  width: 100%;
}

.form-box select {
  padding: 0.5rem;
}

.form-box #cvv {
  width: 25%;
}

.cvv-info:link,
.cvv-info:visited {
  color: inherit;
  text-decoration: underline;
}

.cvv-info:hover,
.cvv-info:active {
  color: #5f7986;
  text-decoration: none;
}

.btn {
  background-color: #4c616b;
  border: none;
  border-radius: 8px;
  color: #eff2f3;
  font-size: 1.6rem;
  font-weight: 700;
  letter-spacing: 0.5px;
  margin-bottom: 1rem;
  padding: 1.5rem;
  cursor: pointer;
}

.btn:hover {
  background-color: #5f7986;
  transition: ease-out 0.1s;
}

.footer-text {
  font-size: 1rem;
  text-align: center;
}

.form-box *:focus {
  outline: none;
  box-shadow: 0 0 0 0.8rem rgba(139, 139, 107, 0.5);
  border-radius: 8px;
}

</style>
<script>
document.getElementById('checkoutButton').addEventListener('click', function() {
    document.getElementById('checkoutPage').classList.remove('hidden');
});


$('a.remove').click(function(){
  event.preventDefault();
  $( this ).parent().parent().parent().hide( 400 );
 
})


  $('a.btn.continue').click(function(){
    $('li.items').show(400);
  })
function submitForm() {
   
    var contact = document.getElementById("contact").value;
    var city = document.getElementById("city").value;
    var address = document.getElementById("address").value;

   
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "cart.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

   
    xhr.onload = function() {
        if (xhr.status == 200) {
            alert("User information updated successfully");
        } else {
            alert("Error updating user information");
        }
    };

    
    xhr.onerror = function() {
        alert("Error updating user information");
    };

    
    xhr.send("contact=" + encodeURIComponent(contact) + "&city=" + encodeURIComponent(city) + "&address=" + encodeURIComponent(address)+ "&update_cart=true");
}
</script>
</body>
</html>
