<?php
session_start();
include 'config.php';


if (!isset($_SESSION['usr_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

if (isset($_POST['item_id']) && isset($_POST['quantity'])) { 
    $user_id = $_SESSION['usr_id'];
    $user_name = $_SESSION['usr_name'];
    $item_id = $_POST['item_id'];
    $status = 'Added to cart';
    $quantity = $_POST['quantity']; 

   
    $stmt = $con->prepare("SELECT name FROM items WHERE id = ?");
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $item_name = $row['name'];

   
    $stmt_check = $con->prepare("SELECT * FROM cart WHERE user_id = ? AND item_id = ?");
    $stmt_check->bind_param("ii", $user_id, $item_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        
        $stmt_update = $con->prepare("UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND item_id = ?");
        $stmt_update->bind_param("iii", $quantity, $user_id, $item_id);
        $stmt_update->execute();
        $stmt_update->close();
    } else {
        
        $stmt_insert = $con->prepare("INSERT INTO cart (user_id, user_name, item_id, item_name, status, quantity) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt_insert->bind_param("issssi", $user_id, $user_name, $item_id, $item_name, $status, $quantity);
        $stmt_insert->execute();
        $stmt_insert->close();
    }

    $stmt->close();

   
    $stmt_count = $con->prepare("SELECT SUM(quantity) as count FROM cart WHERE user_id = ?");
    $stmt_count->bind_param("i", $user_id);
    $stmt_count->execute();
    $result_count = $stmt_count->get_result();
    $row_count = $result_count->fetch_assoc();
    $cart_count = $row_count['count'];

    $stmt_count->close();
    $con->close();

    
    echo json_encode(['success' => true, 'cartCount' => $cart_count]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>

