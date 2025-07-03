<?php
session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: admin-login.html'); 
    exit();


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container py-5">
    <h2 class="text-center">Welcome Admin</h2>
    <p class="text-center">You are logged in as Admin #<?php echo $_SESSION['admin_id']; ?></p>

    <div class="text-center mt-4">
      <a href="editor-panel.html" class="btn btn-success">Manage Products</a>
      <a href="logout.php" class="btn btn-danger ms-2">Logout</a>
    </div>
  </div>
</body>
</html>
