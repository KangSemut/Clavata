<?php 
session_start();
include 'Includes_Header.php';
include 'DatabaseConf.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


$product_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ? AND user_id = ?");
$stmt->execute([$product_id, $user_id]);
$product = $stmt->fetch();

if (!$product) {
    echo "<p>Product not found or you do not have permission to edit this product.</p>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $stock = $_POST['stock'];

    $stmt = $pdo->prepare("UPDATE products SET name = ?, description = ?, price = ?, stock = ?, category_id = ? WHERE id = ?");
    $stmt->execute([$name, $description, $price, $stock, $category_id, $product_id]);

    echo "<p>Product updated successfully.</p>";
}
?>

<main>
    <h2>Edit Product</h2>
    <form action="edit_product.php?id=<?= htmlspecialchars($product_id) ?>" method="post">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?= htmlspecialchars($product['description']) ?></textarea><br>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" value="<?= htmlspecialchars($product['price']) ?>" required><br>
        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" min="0" value="<?= htmlspecialchars($product['stock']) ?>" required><br>
        <label for="category_id">Category:</label>
        <select id="category_id" name="category_id" required>
            <?php
            $stmt = $pdo->query("SELECT id, name FROM categories");
            while ($category = $stmt->fetch()) {
                $selected = $category['id'] == $product['category_id'] ? 'selected' : '';
                echo "<option value=\"" . htmlspecialchars($category['id']) . "\" $selected>" . htmlspecialchars($category['name']) . "</option>";
            }
            ?>
        </select><br>
        <label for="image">Image:</label>
        <input type="file" id="image" name="image" required><br>
        <button type="submit">Update Product</button>
    </form>
</main>

<?php include 'Includes_Footer.php'; ?>