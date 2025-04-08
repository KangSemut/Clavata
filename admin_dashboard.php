<?php
 
session_start();
include 'Includes_Header.php'; 
include 'DatabaseConf.php';
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Code for admin dashboard goes here
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="CSS.css">
</head>
<body>
    <main>
        <h2>Admin Dashboard</h2>
        <p>Welcome, Admin!</p>
        <div class="dashboard">
            <a href="manage_products.php">Manage Products</a>
            <a href="manage_orders.php">Manage Orders</a>
            <a href="manage_users.php">Manage Users</a>
            <a href="logout.php" class="logout">Logout</a>
        </div><br><br>
    </main>
</body>
</html>
<?php include 'Includes_Footer.php'; ?>