<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['productName'];
    $price = $_POST['productPrice'];
    $desc = $_POST['productDesc'];

    $uploadDir = '../uploads/';
    $imageName = basename($_FILES['productImage']['name']);
    $targetPath = $uploadDir . $imageName;

    if (move_uploaded_file($_FILES['productImage']['tmp_name'], $targetPath)) {
        $stmt = $conn->prepare("INSERT INTO products (name, price, description, image_path) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sdss", $name, $price, $desc, $imageName);

        if ($stmt->execute()) {
            echo "Product added successfully!";
        } else {
            echo "Database error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Image upload failed.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <h2 class="text-center">Add New Product</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="productName" name="productName" required>
            </div>
            <div>
                <label for="productPrice" class="form-label ">Product Price</label>
                <input type="number" class="form-control" id="productPrice" name="productPrice" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="productDesc" class="form-label">Product Description</label>
                <textarea class="form-control" id="productDesc" name="productDesc" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="productImage" class="form-label">Product Image</label>
                <input type="file" class="form-control" id="productImage" name="productImage" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Add Product</button>
        </form>
        <div class="text-center mt-4">
            <a href="admin-login.html" class="btn btn-outline-primary">Go to Admin Login</a>
            <a href="view-products.php" class="btn btn-outline-info ms-2">View Products</a>
        </div>
    </div>
    <!--Bootstrap JS  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>