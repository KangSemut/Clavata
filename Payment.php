<?php 
session_start();
include 'Includes_Header.php'; 
include 'DatabaseConf.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$order_id = $_GET['order_id'];

$stmt = $pdo->prepare("UPDATE orders SET status = 'Paid' WHERE id = ?");
$stmt->execute([$order_id]);

echo "<main><h2>Payment Successful</h2><p>Your order has been placed successfully. Order ID: " . htmlspecialchars($order_id) . "</p></main>";
?>

<?php include 'Includes_Footer.php'; ?>