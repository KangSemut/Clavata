<?php

session_start();
include 'Includes_Header.php';
include 'DatabaseConf.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT balance, shipping_address FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user['shipping_address']) {
    echo "<p>Please update your shipping address in your profile before checking out.</p>";
    exit();
}

// Check stock for each product in the cart
$stmt = $pdo->prepare("SELECT ci.product_id, p.stock, p.price, ci.quantity 
                       FROM cart_items ci 
                       JOIN products p ON ci.product_id = p.id 
                       JOIN carts c ON ci.cart_id = c.id 
                       WHERE c.user_id = ?");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll();

$total_price = 0;
foreach ($cart_items as $item) {
    $total_price += $item['price'] * $item['quantity'];
    if ($item['quantity'] > $item['stock']) {
        echo "<p>Sorry, the product {$item['product_id']} is out of stock.</p>";
        exit();
    }
}

if ($user['balance'] < $total_price) {
    echo "<p>Insufficient balance. Please add more funds to your account.</p>";
    exit();
}

// Start transaction
$pdo->beginTransaction();
try {
    // Insert order
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, total, status) VALUES (?, ?, 'Paid')");
    $stmt->execute([$user_id, $total_price]);
    $order_id = $pdo->lastInsertId();

    // Insert order items
    foreach ($cart_items as $item) {
        $stmt = $pdo->prepare("INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$order_id, $item['product_id'], $item['quantity'], $item['price']]);
    }

    // Deduct balance
    $stmt = $pdo->prepare("UPDATE users SET balance = balance - ? WHERE id = ?");
    $stmt->execute([$total_price, $user_id]);

    // Clear cart
    $stmt = $pdo->prepare("DELETE ci FROM cart_items ci JOIN carts c ON ci.cart_id = c.id WHERE c.user_id = ?");
    $stmt->execute([$user_id]);

    // Commit transaction
    $pdo->commit();

    header("Location: invoice.php?order_id=$order_id");
    exit();
} catch (Exception $e) {
    $pdo->rollBack();
    echo "<p>Failed to complete order: " . $e->getMessage() . "</p>";
}
?>

<main>
    <h2>Checkout</h2>
    <p>Total Price: IDR<?= htmlspecialchars($total_price) ?></p>
    <p>Shipping Address: <?= htmlspecialchars($user['shipping_address']) ?></p>
    <form action="checkout.php" method="post">
        <button type="submit">Confirm Purchase</button>
    </form>
</main>

<?php include 'Includes_Footer.php'; ?>
