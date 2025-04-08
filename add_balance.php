<?php
session_start();
include 'Includes_Header.php';
include 'DatabaseConf.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['amount'])) {
    $user_id = $_SESSION['user_id'];
    $amount = $_POST['amount'];

    if ($amount > 0) {
        $stmt = $pdo->prepare("UPDATE users SET balance = balance + ? WHERE id = ?");
        $stmt->execute([$amount, $user_id]);

        echo "<p>Balance updated successfully.</p>";
    } else {
        echo "<p>Invalid amount.</p>";
    }
} else {
    echo "<p>Invalid request.</p>";
}

header("Location: profile.php");
exit();
?>
