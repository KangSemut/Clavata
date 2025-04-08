
<?php session_start();
include 'Includes_Header.php'; 
include 'DatabaseConf.php';
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll();?>
<?php
// Query to fetch categories and their products
$categoriesStmt = $pdo->query("SELECT id, name FROM categories");
$categories = $categoriesStmt->fetchAll();
?>

<main>
    <h2>Products</h2>
    <?php foreach ($categories as $category): ?>
        <section>
            <h3><?= htmlspecialchars($category['name']) ?></h3>
    <div class="products">
    <?php
                $productsStmt = $pdo->prepare("SELECT * FROM products WHERE category_id = ?");
                $productsStmt->execute([$category['id']]);
                $products = $productsStmt->fetchAll();
                ?>
        <?php if ($products): ?>
            <?php foreach ($products as $product): ?>
                <div class="product">
                    <ul>
                    <li><img src="<?= htmlspecialchars($product['image']) ?>" 
                    alt="<?= htmlspecialchars($product['name']) ?>" 
                    style="max-width: 120px;"></li>
                    <h3><?= htmlspecialchars($product['name']) ?></h3>
                    <li><p><?= htmlspecialchars($product['description']) ?></p></li>
                    <li><p>IDR<?= htmlspecialchars($product['price']) ?></p></li>
                    <li><p>Stock:   <?= htmlspecialchars($product['stock']) ?></p></li>
                    <a href="add_to_cart.php?id=<?= htmlspecialchars($product['id']) ?>">Add to Cart</a>
                </ul>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products available in this category.</p>
        <?php endif; ?>
    </div>
    </section>
    <?php endforeach; ?>
</main>

<?php include 'Includes_Footer.php'; ?>