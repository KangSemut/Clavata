<?php 
session_start();
include 'Includes_Header.php'; 
include 'Databaseconf.php'; 
?>

<main>
    <?php
    $id = $_GET['id'];
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$id]);
    $product = $stmt->fetch();

    if ($product) {
        echo '<h2>' . htmlspecialchars($product['name']) . '</h2>';
        echo '<p>' . htmlspecialchars($product['description']) . '</p>';
        echo '<p>$' . htmlspecialchars($product['price']) . '</p>';
        echo '<button>Add to Cart</button>';
    } else {
        echo '<p>Product not found.</p>';
    }
    ?>
</main>

<?php include 'Includes_Footer.php'; ?>