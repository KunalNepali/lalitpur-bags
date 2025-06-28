<?php
include 'db.php'; // Ensure this connects to your DB

// Fetch input
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

// Basic validation
if (empty($message)) {
    die("Feedback message is required.");
}

// Insert into DB
$stmt = $conn->prepare("INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $message);

if ($stmt->execute()) {
    // Send email to admin
    $to = "kunalnepali123456@gmail.com";
    $subject = "New Feedback Received";
    $emailBody = "You received feedback:\n\nName: $name\nEmail: $email\n\nMessage:\n$message";
    $headers = "From: noreply@lalitpurbags.com";

    mail($to, $subject, $emailBody, $headers);

    echo "<script>
        alert('Thank you for your feedback!');
        window.history.back();
    </script>";
} else {
    echo "Error saving feedback: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
