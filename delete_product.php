<?php

session_start();
include 'DatabaseConf.php';
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if product ID is provided
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Fetch product to ensure it belongs to the current user
    $stmt = $pdo->prepare("SELECT id, image FROM products WHERE id = ? AND user_id = ?");
    $stmt->execute([$product_id, $user_id]);
    $product = $stmt->fetch();

    if ($product) {
        // Start transaction
        $pdo->beginTransaction();
        
        try {
            $stmt = $pdo->prepare("DELETE FROM cart_items WHERE product_id = ?");
            $stmt->execute([$product_id]);
            // Delete related order items or other related records first
            $stmt = $pdo->prepare("DELETE FROM order_details WHERE product_id = ?");
            $stmt->execute([$product_id]);

            // Delete product from database
            $stmt = $pdo->prepare("DELETE FROM products WHERE id = ? AND user_id = ?");
            $stmt->execute([$product_id, $user_id]);

            // Delete product image from server
            if (file_exists($product['image'])) {
                unlink($product['image']);
            }

            // Commit transaction
            $pdo->commit();
            
            // Redirect to profile or homepage after deletion
            header("Location: profile.php");
            exit();
        } catch (Exception $e) {
            // Rollback transaction if something goes wrong
            $pdo->rollBack();
            echo "<p>Failed to delete product: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p>Product not found or you do not have permission to delete this product.</p>";
    }
} else {
    echo "<p>Invalid request.</p>";
}
?>