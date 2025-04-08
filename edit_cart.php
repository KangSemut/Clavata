<?php

session_start();
include 'Includes_Header.php';
include 'DatabaseConf.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $cart_item_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Fetch cart item details
    $stmt = $pdo->prepare("SELECT p.name, p.price, ci.quantity
                           FROM cart_items ci 
                           JOIN products p ON ci.product_id = p.id 
                           JOIN carts c ON ci.cart_id = c.id 
                           WHERE ci.id = ? AND c.user_id = ?");
    $stmt->execute([$cart_item_id, $user_id]);
    $item = $stmt->fetch();

    if ($item) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $new_quantity = $_POST['quantity'];

            // Update cart item quantity
            $stmt = $pdo->prepare("UPDATE cart_items SET quantity = ? WHERE id = ?");
            $stmt->execute([$new_quantity, $cart_item_id]);

            header("Location: cart.php");
            exit();
        }
    } else {
        echo "<p>Item not found or you do not have permission to edit this item.</p>";
        exit();
    }
} else {
    echo "<p>Invalid request.</p>";
    exit();
}
?>

<main>
    <h2>Edit Cart Item</h2>
    <form action="edit_cart.php?id=<?= htmlspecialchars($cart_item_id) ?>" method="post">
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="<?= htmlspecialchars($item['quantity']) ?>" required>
        <button type="submit">Update</button>
    </form>
</main>

<?php include 'Includes_Footer.php'; ?>
