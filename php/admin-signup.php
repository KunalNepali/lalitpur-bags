<?php
session_start();
include 'db.php'; // Your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string(trim($_POST['name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $password = $_POST['password'];

    // Basic validation
    if (empty($name) || empty($email) || empty($password)) {
        die("All fields are required.");
    }

    // Check if email already exists
    $result = $conn->query("SELECT id FROM users WHERE email='$email' AND role='admin'");
    if ($result->num_rows > 0) {
        die("Admin with this email already exists.");
    }

    // Hash password securely
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insert new admin user
    $insert = $conn->query("INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password_hash', 'admin')");

    if ($insert) {
        // Get new user id
        $admin_id = $conn->insert_id;

        // Set session variables for logged-in admin
        $_SESSION['user_id'] = $admin_id;
        $_SESSION['user_name'] = $name;
        $_SESSION['user_role'] = 'admin';

        // Redirect to dashboard.html
        header('Location: ../dashboard.html');
        exit();
    } else {
        echo "Signup failed. Please try again.";
    }
} else {
    echo "Invalid request method.";
}
?>
