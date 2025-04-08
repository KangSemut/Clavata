<?php  
session_start();
include 'Includes_Header.php'; 
include 'DatabaseConf.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $shipping_address = $_POST['shipping_address'];

    $stmt = $pdo->prepare("UPDATE users SET shipping_address = ? WHERE id = ?");
    $stmt->execute([$shipping_address, $user_id]);
}

$stmt = $pdo->prepare("SELECT Name, balance, shipping_address FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

$stmt = $pdo->prepare("SELECT * FROM products WHERE user_id = ?");
$stmt->execute([$user_id]);
$products = $stmt->fetchAll();
?>

<main>
    <h2>Your Profile</h2>
    <p><?= htmlspecialchars($user['Name']) ?></p>
    <p>Balance: IDR<?= htmlspecialchars($user['balance']) ?></p>
    <form action="profile.php" method="post">
        <label for="shipping_address">Shipping Address:</label>
        <textarea id="shipping_address" name="shipping_address" required><?= htmlspecialchars($user['shipping_address']) ?></textarea>
        <button type="submit">Update Address</button>
    </form>
    
    <form action="add_balance.php" method="post">
        <label for="amount">Add Balance:</label>
        <input type="number" id="amount" name="amount" step="0.01" required>
        <button type="submit">Add Balance</button>
    </form>
    <h2>Your Products</h2>
    
    <table border="1">
        
        <a href="add_product.php">Add New Product</a>
        
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
        <?php if ($products): ?>
            <tr>
                <?php foreach ($products as $product): ?>
                    
                    <td><img src="<?= htmlspecialchars($product['image']) ?>" 
                    alt="<?= htmlspecialchars($product['name']) ?>" 
                    style="max-width: 150px;"></td>
                        <td><h3><?= htmlspecialchars($product['name']) ?></h3></td>
                        <td><?= htmlspecialchars($product['description']) ?></td>
                        <td>IDR<?= htmlspecialchars($product['price']) ?></td>
                        <td>Stock:   <?= htmlspecialchars($product['stock']) ?></td>
                        <td><a href="edit_product.php?id=<?= htmlspecialchars($product['id']) ?>">Edit</a>
                        <a href="delete_product.php?id=<?= htmlspecialchars($product['id']) ?>">Delete</a></td>
            </tr>        
                <?php endforeach; ?>
            
        </table>
        <?php else: ?>
            <p>You have not added any products yet.</p>
        <?php endif; ?>
    
</main>

<?php include 'Includes_Footer.php'; ?>