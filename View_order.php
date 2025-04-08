<?php
session_start();
include 'Includes_Header.php';
include 'DatabaseConf.php';


if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['order_id']) || !is_numeric($_GET['order_id'])) {
    echo "<p>Invalid order ID.</p>";
    exit();
}

if (!isset($_GET['user_id']) || !is_numeric($_GET['user_id'])) {
    echo "<p>Invalid user ID.</p>";
    exit();
}

$order_id = $_GET['order_id'];
$user_id = $_GET['user_id'];

$stmt = $pdo->prepare("SELECT o.id, o.total, o.created_at, o.status, u.shipping_address 
                       FROM orders o 
                       JOIN users u ON o.user_id = u.id 
                       WHERE o.id = ? AND o.user_id = ?");
$stmt->execute([$order_id, $user_id]);
$order = $stmt->fetch();

if ($order) {
    $stmt = $pdo->prepare("SELECT oi.product_id, p.name, oi.quantity, oi.price 
                           FROM order_details oi 
                           JOIN products p ON oi.product_id = p.id 
                           WHERE oi.order_id = ?");
    $stmt->execute([$order_id]);
    $order_items = $stmt->fetchAll();
} else {
    echo "<p>Order not found or you do not have permission to view this order.</p>";
    exit();
}
?>

<main>
    <h2>Invoice</h2>
    <p>Order ID: <?= htmlspecialchars($order['id']) ?></p>
    <p>Order Date: <?= htmlspecialchars($order['created_at']) ?></p>
    <p>Order Status: <?= htmlspecialchars($order['status']) ?></p>
    <p>Shipping Address: <?= htmlspecialchars($order['shipping_address']) ?></p>
    <table>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
        <?php foreach ($order_items as $item): ?>
        <tr>
            <td><?= htmlspecialchars($item['name']) ?></td>
            <td><?= htmlspecialchars($item['quantity']) ?></td>
            <td>IDR<?= htmlspecialchars($item['price']) ?></td>
            <td>IDR<?= htmlspecialchars($item['price'] * $item['quantity']) ?></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3">Total</td>
            <td>IDR<?= htmlspecialchars($order['total']) ?></td>
        </tr>
    </table>
    <div class="dashboard">
    <a href="admin_dashboard.php">Back to Dashboard</a>
    <br>
    <a href="manage_orders.php">Back to Manage Orders</a>
    <br>
    <a href="logout.php" class="logout">Logout</a>
    </div><br><br>
</main>

<?php include 'Includes_Footer.php'; ?>
