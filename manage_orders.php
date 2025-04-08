<?php  
session_start();
include 'Includes_Header.php';
include 'DatabaseConf.php';


if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Mengambil semua pesanan dari database
$stmt = $pdo->query("SELECT * FROM orders");
$orders = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    
</head>
<body>
    <h2>Manage Orders</h2>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Total</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($orders as $order): ?>
        <tr>
            <td><?= htmlspecialchars($order['id']) ?></td>
            <td><?= htmlspecialchars($order['user_id']) ?></td>
            <td>IDR<?= htmlspecialchars($order['total']) ?></td>
            <td><?= htmlspecialchars($order['status']) ?></td>
            <td>
                <a href="view_order.php?order_id=<?= htmlspecialchars($order['id']) ?>&user_id=<?= htmlspecialchars($order['user_id']) ?>">View</a>
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
