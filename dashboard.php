<?php
session_start();

// Redirect to login if user not logged in
if (!isset($_SESSION['user_role']) || !isset($_SESSION['user_name'])) {
    header('Location: login.html');
    exit;
}

// Sanitize session variables for output
$userRole = htmlspecialchars($_SESSION['user_role']);
$userName = htmlspecialchars($_SESSION['user_name']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard - Lalitpur Bags</title>
  <meta name="description" content="Admin and user dashboard of Lalitpur Bags e-commerce store. Manage products, blogs, orders, and feedback based on your role." />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/dashboard.css" />
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top mb-4">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <img src="images/LALITPUR-BAGS.png" alt="Lalitpur Bags" width="40" class="d-inline-block align-text-top" />
        Lalitpur Bags
      </a>
      <div class="d-flex align-items-center">
        <span class="me-3">Welcome, <strong><?php echo $userName; ?></strong></span>
        <a href="php/logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
      </div>
    </div>
  </nav>

  <main class="container">
    <h1 class="mb-4">📊 Dashboard</h1>

    <?php if ($userRole === 'editor'): ?>
      <section aria-labelledby="editor-panel">
        <h2 id="editor-panel">Editor Panel</h2>
        <p>Manage products, blogs, and site content here.</p>
        <ul class="list-group mb-4">
          <li class="list-group-item"><a href="editor-panel.html">Manage Products</a></li>
          <li class="list-group-item"><a href="blog.html">Manage Blogs</a></li>
          <li class="list-group-item"><a href="order.html">View Orders</a></li>
          <li class="list-group-item"><a href="feedback.html">View Feedback</a></li>
        </ul>
      </section>
    <?php else: ?>
      <section aria-labelledby="user-panel">
        <h2 id="user-panel">User Panel</h2>
        <p>View your orders and submit feedback.</p>
        <ul class="list-group mb-4">
          <li class="list-group-item"><a href="profile.html">View Orders</a></li>
          <li class="list-group-item"><a href="feedback.html">Submit Feedback</a></li>
        </ul>
      </section>
    <?php endif; ?>

  </main>

  <footer class="bg-light text-center py-3 mt-5">
    <small>&copy; <?php echo date("Y"); ?> Lalitpur Bags. All rights reserved.</small>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
