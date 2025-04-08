<?php 
session_start();
include 'Includes_Header.php';
include 'DatabaseConf.php'; 

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Logika untuk menghapus pengguna
if (isset($_GET['delete'])) {
    $user_id = intval($_GET['delete']); // Pastikan hanya menerima angka untuk mencegah SQL Injection
    
    $stmt = $pdo->prepare("DELETE od FROM order_details od 
                           JOIN orders o ON od.order_id = o.id 
                           WHERE o.user_id = ?");
    $stmt->execute([$user_id]);
    
    $stmt = $pdo->prepare("DELETE FROM orders WHERE user_id = ?");
    $stmt->execute([$user_id]);

    $stmt = $pdo->prepare("DELETE FROM carts WHERE user_id = ?");
    $stmt->execute([$user_id]);
    // Hapus pengguna dari database
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$user_id]);

    // Redirect setelah penghapusan untuk mencegah refresh berulang yang dapat menyebabkan penghapusan ganda
    header("Location: manage_users.php");
    exit();
}

// Mengambil semua pengguna dari database
$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    
</head>
<body>
    <h2>Manage Users</h2>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['id']) ?></td>
            <td><?= htmlspecialchars($user['Name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= htmlspecialchars($user['password']) ?></td>
            <td>
                <a href="manage_users.php?delete=<?= htmlspecialchars($user['id']) ?>" onclick="return confirm('Are you sure?')">Delete</a>
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
