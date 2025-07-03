<?php
include 'php/db.php';
$result = $conn->query("SELECT * FROM products ORDER BY created_at DESC");

if (!$result) {
    die("Database query failed: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>View Products</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container py-5">
    <h2 class="text-center mb-4">Product List</h2>
    <div class="row">
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <img src="uploads/<?= htmlspecialchars($row['image_path']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['name']) ?>">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
              <p class="card-text"><?= htmlspecialchars($row['description']) ?></p>
              <p class="fw-bold">Rs. <?= number_format($row['price'], 2) ?></p>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php $conn->close(); ?>
