<?php
include 'db.php'; // Connect to your database

// Fetch all blogs
$result = $conn->query("SELECT * FROM blogs ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Blog - Lalitpur Bags</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container py-5">
    <h2 class="text-center mb-4">📰 Our Blog</h2>

    <div class="row">
      <?php while($row = $result->fetch_assoc()): ?>
        <div class="col-md-6 mb-4">
          <div class="card h-100">
            <?php if (!empty($row['image'])): ?>
              <img src="../images/<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top" alt="Blog Image">
            <?php endif; ?>
            <div class="card-body">
              <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
              <p class="card-text">
                <?php echo nl2br(substr(htmlspecialchars($row['content']), 0, 150)); ?>...
              </p>
              <<?php
include 'db.php'; // Connect to your database

// Fetch all blogs
$result = $conn->query("SELECT * FROM blogs ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Blog - Lalitpur Bags</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container py-5">
    <h2 class="text-center mb-4">📰 Our Blog</h2>

    <div class="row">
      <?php while($row = $result->fetch_assoc()): ?>
        <div class="col-md-6 mb-4">
          <div class="card h-100">
            <?php if (!empty($row['image'])): ?>
              <img src="../images/<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top" alt="Blog Image">
            <?php endif; ?>
            <div class="card-body">
              <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
              <p class="card-text">
                <?php echo nl2br(substr(htmlspecialchars($row['content']), 0, 150)); ?>...
              </p>
              <small class="text-muted">
                Posted by <?php echo htmlspecialchars($row['author']); ?> on <?php echo date('F j, Y', strtotime($row['created_at'])); ?>
              </small>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</body>
</html>
small class="text-muted">
                Posted by <?php echo htmlspecialchars($row['author']); ?> on <?php echo date('F j, Y', strtotime($row['created_at'])); ?>
              </small>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</body>
</html>
