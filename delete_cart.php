<?php 

session_start();
include 'Includes_Header.php'; 
include 'DatabaseConf.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $cart_item_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Fetch cart item to ensure it belongs to the current user
    $stmt = $pdo->prepare("SELECT ci.id FROM cart_items ci 
                           JOIN carts c ON ci.cart_id = c.id 
                           WHERE ci.id = ? AND c.user_id = ?");
    $stmt->execute([$cart_item_id, $user_id]);
    $item = $stmt->fetch();

    if ($item) {
        try {
            // Start transaction
            $pdo->beginTransaction();
            
            // Delete cart item from database
            $stmt = $pdo->prepare("DELETE FROM cart_items WHERE id = ?");
            $stmt->execute([$cart_item_id]);

            // Commit transaction
            $pdo->commit();

            header("Location: cart.php");
            exit();
        } catch (Exception $e) {
            // Rollback transaction if something goes wrong
            $pdo->rollBack();
            echo "<p>Failed to delete cart item: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p>Item not found or you do not have permission to delete this item.</p>";
    }
} else {
    echo "<p>Invalid request.</p>";
}

include 'Includes_Footer.php'; 
?>