<?php 
session_start();
include 'Includes_Header.php'; 
include 'DatabaseConf.php'; 


if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}





// Hapus produk
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $admin = $_SESSION['admin_logged_in'];

    // Fetch product to ensure it belongs to the current user
    $stmt = $pdo->prepare("SELECT id, image FROM products WHERE id = ? AND user_id = ?");
    $stmt->execute([$product_id, $admin]);
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
            $stmt->execute([$product_id, $admin]);

            // Delete product image from server
            if (file_exists($product['image'])) {
                unlink($product['image']);
            }

            // Commit transaction
            $pdo->commit();
            
            // Redirect to profile or homepage after deletion
            header("Location: manage_products.php");
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
    echo "<p></p>";
}


// Ambil semua produk
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    
</head>
<body>
    <h2>Manage Products</h2>

    

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?= htmlspecialchars($product['id']) ?></td>
            <td><img src="<?= htmlspecialchars($product['image']) ?>" 
            style="max-width: 200px;"></td>
            <td><?= htmlspecialchars($product['name']) ?></td>
            <td><?= htmlspecialchars($product['description']) ?></td>
            <td>IDR<?= htmlspecialchars($product['price']) ?></td>
            <td><?= htmlspecialchars($product['stock']) ?></td>
            <td>
                <a href="manage_products.php?id=<?= htmlspecialchars($product['id']) ?>" onclick="return confirm('Are you sure?')">Delete</a>
                <br><br><br><br><br><br><br>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <div class="dashboard">
    <a href="admin_dashboard.php">Back to Dashboard</a>
    <br>
    <a href="logout.php" class="logout">Logout</a>
    </div><br><br>
</body>
</html>
<?php include 'Includes_Footer.php'; ?>