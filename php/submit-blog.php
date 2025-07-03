<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $conn->real_escape_string(trim($_POST['title']));
    $content = $conn->real_escape_string(trim($_POST['content']));
    $author = $conn->real_escape_string(trim($_POST['author']));
    $imageName = '';

    // Handle image upload
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../images/";
        $imageName = basename($_FILES["image"]["name"]);
        $targetFile = $targetDir . $imageName;
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
    }

    // Insert blog into DB
    $stmt = $conn->prepare("INSERT INTO blogs (title, content, author, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $content, $author, $imageName);

    if ($stmt->execute()) {
        header("Location: ../blog.html"); // Or blog.php depending on your setup
        exit();
    } else {
        echo "Failed to publish blog.";
    }
}
?>
