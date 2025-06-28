<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $bagType = $_POST['bagType'];
    $issueType = $_POST['issueType'];
    $calendarDate = $_POST['calendarDate'];
    $location = $_POST['location'];

    $uploadDir = __DIR__ . '/../uploads/';
    $filePath = null;

    // Check if file uploaded without error
    if (isset($_FILES['bagImage']) && $_FILES['bagImage']['error'] === UPLOAD_ERR_OK) {
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $filename = basename($_FILES['bagImage']['name']);
        $filePathFull = $uploadDir . time() . "_" . preg_replace("/[^a-zA-Z0-9._-]/", "", $filename);

        if (move_uploaded_file($_FILES['bagImage']['tmp_name'], $filePathFull)) {
            // Store relative path for DB
            $filePath = 'uploads/' . basename($filePathFull);
        } else {
            echo "Failed to upload image.";
            exit;
        }
    }

    $stmt = $conn->prepare("INSERT INTO repair_requests (user_id, bag_type, issue_type, image_path, calendar_date, location) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $user_id, $bagType, $issueType, $filePath, $calendarDate, $location);

    if ($stmt->execute()) {
        // Email Notification
        $to = 'kunalnepali123456@gmail.com';
        $subject = 'New Repair Request';
        $message = "New repair request submitted.\n\nBag Type: $bagType\nIssue: $issueType\nDate: $calendarDate\nLocation: $location";
        $headers = 'From: noreply@lalitpurbags.com';

        mail($to, $subject, $message, $headers);

        echo "Request submitted successfully, we will reach out to you ASAP.";
    } else {
        echo "DB Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Please login first.";
}
?>
