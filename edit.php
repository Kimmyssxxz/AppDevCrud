<?php
require 'config.php';

// pag-UPDATE
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $sql = "UPDATE tbl_products SET name = ?, description = ?, price = ?, quantity = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $description, $price, $quantity, $id]);

    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM tbl_products WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>
    <form action="edit.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
        <input type="text" name="name" value="<?php echo $product['name']; ?>" required>
        <input type="text" name="description" value="<?php echo $product['description']; ?>" required>
        <input type="number" name="price" value="<?php echo $product['price']; ?>" required>
        <input type="number" name="quantity" value="<?php echo $product['quantity']; ?>" required>
        <button type="submit" name="update">Update Product</button>
    </form>
</body>
</html>
