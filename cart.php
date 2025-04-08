<?php 

session_start();
include 'Includes_Header.php'; 
include 'DatabaseConf.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT ci.id, p.name, p.price, ci.quantity FROM cart_items ci 
                       JOIN products p ON ci.product_id = p.id 
                       JOIN carts c ON ci.cart_id = c.id 
                       WHERE c.user_id = ?");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll();
?>

<main>
    <h2>Your Cart</h2>
    <div class="cart">
        <?php if ($cart_items): ?>
            <table>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
                <?php 
                $total = 0;
                foreach ($cart_items as $item): 
                    $item_total = $item['price'] * $item['quantity'];
                    $total += $item_total;
                ?>
                <tr>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td>IDR<?= htmlspecialchars($item['price']) ?></td>
                    <td><?= htmlspecialchars($item['quantity']) ?></td>
                    <td>IDR<?= htmlspecialchars($item_total) ?></td>
                    <td>
                        <a href="edit_cart.php?id=<?= htmlspecialchars($item['id']) ?>">Edit</a>
                        <a href="delete_cart.php?id=<?= htmlspecialchars($item['id']) ?>" onclick="return confirm('Are you sure you want to delete this item from your cart?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4">Total</td>
                    <td>IDR<?= htmlspecialchars($total) ?></td>
                </tr>
            </table>
            <a href="checkout.php">Checkout</a>
            <a href="index.php">Back to Home</a>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>
</main>

<?php include 'Includes_Footer.php'; ?>