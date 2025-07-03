<?php
include 'php/db.php';
$blogs = $conn->query("SELECT * FROM blogs ORDER BY created_at DESC LIMIT 3");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lalitpur Bags</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="images/LALITPUR-BAGS.png" alt="Lalitpur Bags" width="50"> Lalitpur Bags
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="login.html">Login</a></li>
        <li class="nav-item"><a class="nav-link" href="signup.html">Signup</a></li>
        <li class="nav-item"><a class="nav-link" href="profile.html">Profile</a></li>
        <li class="nav-item"><a class="nav-link" href="repair.html">Repair</a></li>
        <li class="nav-item"><a class="nav-link" href="arrivals.html">New Arrivals</a></li>
        <li class="nav-item"><a class="nav-link" href="order.html">Order</a></li>
        <li class="nav-item"><a class="nav-link" href="php/blog.php">Blogs</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="moreMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            ☰
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreMenu">
            <li><a class="dropdown-item" href="index.php">Home</a></li>
            <li><a class="dropdown-item" href="about_us.html">About Us</a></li>
            <li><a class="dropdown-item" href="contact.html">Contact</a></li>
            <li><a class="dropdown-item" href="cart.html">Cart</a></li>
            <li><a class="dropdown-item" href="cost.html">Cost</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Image Carousel -->
<div class="container mt-4">
  <div id="storeCarousel" class="carousel slide mx-auto" data-bs-ride="carousel" style="max-width: 100vw; max-height: 500px;">
    <div class="carousel-inner">
      <div class="carousel-item active"><img src="images/store1.jpg" class="d-block w-100" alt="Store 1"></div>
      <div class="carousel-item"><img src="images/store2.jpg" class="d-block w-100" alt="Store 2"></div>
      <div class="carousel-item"><img src="images/store3.jpg" class="d-block w-100" alt="Store 3"></div>
      <div class="carousel-item"><img src="images/store4.jpg" class="d-block w-100" alt="Store 4"></div>
      <div class="carousel-item"><img src="images/store5.jpg" class="d-block w-100" alt="Store 5"></div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#storeCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#storeCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>

<style>
  #storeCarousel { max-width: 100vw; max-height: 500px; }
  #storeCarousel .carousel-inner img { width: 100%; height: 500px; object-fit: cover; }
  @media (max-width: 768px) {
    #storeCarousel .carousel-inner img { height: 300px; }
  }
</style>

<!-- Blog Section -->
<section class="container py-5">
  <h2 class="text-center mb-4">📰 Latest Blog Posts</h2>
  <div class="row">
    <?php if ($blogs && $blogs->num_rows > 0): ?>
      <?php while($row = $blogs->fetch_assoc()): ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <?php if (!empty($row['image'])): ?>
              <img src="images/<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top" alt="Blog Image">
            <?php endif; ?>
            <div class="card-body">
              <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
              <p class="card-text">
                <?php echo substr(strip_tags($row['content']), 0, 100); ?>...
              </p>
              <a href="php/blog.php" class="btn btn-outline-primary btn-sm">Read More</a>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="text-center">No blog posts found.</p>
    <?php endif; ?>
  </div>
  <div class="text-center mt-3">
    <a href="php/blog.php" class="btn btn-primary">View All Blogs</a>
  </div>
</section>

<!-- Services -->
<div class="container text-center mt-4">
  <div class="row">
    <div class="col"><a href="repair.html" class="btn btn-outline-primary">Repair</a></div>
    <div class="col"><a href="order.html" class="btn btn-outline-success">Order</a></div>
    <div class="col"><a href="arrivals.html" class="btn btn-outline-info">New Arrivals</a></div>
  </div>
</div>

<!-- Cost Section -->
<div class="container mt-5" id="cost">
  <h3>Cost</h3>
  <div class="row">
    <div class="col-md-3"><h5>School Bag</h5><ul><li>Chain</li><li>Zip</li><li>Sewing</li></ul></div>
    <div class="col-md-3"><h5>Laptop Bag</h5><ul><li>Chain</li><li>Zip</li><li>Sewing</li></ul></div>
    <div class="col-md-3"><h5>Hand Bag</h5><ul><li>Chain</li><li>Zip</li><li>Sewing</li></ul></div>
    <div class="col-md-3"><h5>Luggage</h5><ul><li>Chain</li><li>Zip</li><li>Sewing</li></ul></div>
  </div>
</div>
<div class="text-center mt-2">
  <p>Note: We repair all types of issues. So, if your bag has problems other than this, feel free to contact us.</p>
</div>

<!-- Footer -->
<footer class="bg-dark text-light mt-5 p-4">
  <div class="container">
    <p>📞 +977 9860357158 | +977 9841821074</p>
    <p>📧 Email: kunalnepali123456@gmail.com</p>
    <p>🔐 
      <a href="#" class="text-light" data-bs-toggle="modal" data-bs-target="#privacyModal">Privacy Policy</a> |
      <a href="#" class="text-light" data-bs-toggle="modal" data-bs-target="#termsModal">Terms</a> |
      <a href="#" class="text-light" data-bs-toggle="modal" data-bs-target="#feedbackModal">Feedback</a>
    </p>
    <p>💳 Payment Partners: eSewa, Khalti</p>
    <p>📱 Follow us: <a href="#" class="text-light">Facebook</a> | <a href="#" class="text-light">Instagram</a></p>
  </div>
</footer>

<!-- Modals -->
<?php include 'php/modals.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
