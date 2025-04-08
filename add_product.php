<?php 

session_start();
include 'Includes_Header.php'; 
include 'DatabaseConf.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category_id = $_POST['category_id'];
    $user_id = $_SESSION['user_id'];

    $image = $_FILES['image'];

    // Handle image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image["name"]);
    move_uploaded_file($image["tmp_name"], $target_file);

    $stmt = $pdo->prepare("INSERT INTO products (name, description, price, stock, category_id, user_id, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $description, $price,$stock, $category_id, $user_id, $target_file]);

    echo "<p>Product added successfully.</p>";
}
?>

<main>
    <h2>Add Product</h2>
    <form action="add_product.php" method="post" enctype="multipart/form-data">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required><br>
        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" min="0" required><br>
        <label for="category_id">Category:</label>
        <select id="category_id" name="category_id" required>
            <?php
            $stmt = $pdo->query("SELECT id, name FROM categories");
            while ($category = $stmt->fetch()) {
                echo "<option value=\"" . htmlspecialchars($category['id']) . "\">" . htmlspecialchars($category['name']) . "</option>";
            }
            ?><br>
        </select><br>
        <label for="image">Image:</label>
        <input type="file" id="image" name="image" required><br>
        <button type="submit">Add Product</button>
    </form>
</main>

<?php include 'Includes_Footer.php'; ?>