<?php
session_start();
include 'config.php';



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link rel="stylesheet" href="moreServices.css">
    <title>Apparel Branding</title>
    
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
			<div class="cart-container" >
        <a href="cart.php"  id="toggle-cart">
            <img src="shopping-cart.png"  alt="Cart" class="cart-icon">
            <span class="badge" id="cart-count">0</span>
        </a>
      
		 </div>
    </nav>
</header>


      

<div class="heading">
    <h1>Branded Apparel</h1>
</div>

<div class="filter">
    <nav class="filter-nav">
        <button class="filter-btn active" data-filter="all">All</button>
        <button class="filter-btn" data-filter="best-sellers">Best Sellers</button>
        <button class="filter-btn" data-filter="T-Shirts">Shirts</button>
        <button class="filter-btn" data-filter="pants">Pants</button>
        <button class="filter-btn" data-filter="caps/Hats">Caps/Hats</button>
        <button class="filter-btn" data-filter="Accessories">Accessories</button>
    </nav>
</div>

<section class="products">
    <h2>Best Sellers</h2>
    <div class="product-list">
        <?php
        $sql = "SELECT id, name, price, size, image FROM items WHERE branding_type= 'Apparel'";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $imageBase64 = base64_encode($row["image"]);
                echo '<div class="product" data-category="all">';
                echo '<img src="data:image/jpeg;base64,' . $imageBase64 . '" alt="' . $row["name"] . '">';
                echo '<h3>' . $row["name"] . '</h3>';
                echo '<p>R' . $row["price"] . '</p>';
                echo '<div class="product-options">';
                echo '<label for="size">Size:</label>';
                echo '<select name="size" class="size">';
                echo '<option value="small">Small</option>';
                echo '<option value="medium">Medium</option>';
                echo '<option value="large">Large</option>';
                echo '</select>';
                echo '<br>';
                echo '<label for="quantity">Quantity:</label>';
                
                echo '</div>';
               echo '<form id="add-to-cart-form-' . $row["id"] . '" class="add-to-cart-form" method="post" action="addToCart.php">';
			echo '<input type="number" name="quantity" class="quantity" value="1" min="1">';
                echo '<input type="hidden" name="item_id" value="' . $row["id"] . '">';
                echo '<button type="submit" name="add_to_cart"  class="add-to-bag">Add to Bag</button>';
                echo '</form>';
                echo '</div>';
            }
        } else {
            echo "0 results";
        }

        $con->close();
        ?>
    </div>
</section>

<script src="index.js"></script>
<script src="new 1.js"></script>
<script>

document.getElementById('toggle-cart').addEventListener('click', function(event) {
    event.preventDefault();
    var cartContent = document.getElementById('cart-content');
    if (cartContent.classList.contains('hidden')) {
        cartContent.classList.remove('hidden');
        cartContent.classList.add('visible');
    } else {
        cartContent.classList.remove('visible');
        cartContent.classList.add('hidden');
    }
});


function submitForm(event) {
    event.preventDefault();
    var form = event.target;
    var formData = new FormData(form);

    fetch(form.action, {
        method: form.method,
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
          
            var cartCount = document.getElementById('cart-count');
            cartCount.textContent = data.cartCount;
        } else {
            alert('Failed to add to cart');
        }
    })
    .catch(error => console.error('Error:', error));
}


document.querySelectorAll('.add-to-cart-form').forEach(form => {
    form.addEventListener('submit', submitForm);
});
</script>

</body>
</html>
