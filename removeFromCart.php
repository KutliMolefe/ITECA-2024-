<?php
session_start();
include 'config.php';


if (!isset($_SESSION['usr_id'])) {
    header("Location: Login.php");
    exit();
}

if (isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];
    $user_id = $_SESSION['usr_id'];

   
    $sql = "DELETE FROM cart WHERE id = ? AND user_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ii", $item_id, $user_id);

    if ($stmt->execute()) {
        header("Location: cart.php?message=Item removed from cart");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
} else {
    header("Location: cart.php");
}
?>
