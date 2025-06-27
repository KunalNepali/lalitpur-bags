<?php
// db.php (for reuse)
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'lalitpur_bags';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
