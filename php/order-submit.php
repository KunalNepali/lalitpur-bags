<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item = $_POST['item'];
    $quantity = (int)$_POST['quantity'];
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $otherDetails = isset($_POST['otherDetails']) ? trim($_POST['otherDetails']) : null;

    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    // Handle image upload if product is Others and image is uploaded
    $imagePath = null;
    if ($item === 'Others' && isset($_FILES['productImage']) && $_FILES['productImage']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $filename = basename($_FILES['productImage']['name']);
        $targetFile = $uploadDir . time() . "_" . preg_replace("/[^a-zA-Z0-9._-]/", "", $filename);

        if (move_uploaded_file($_FILES['productImage']['tmp_name'], $targetFile)) {
            // Save relative path for DB
            $imagePath = 'uploads/' . basename($targetFile);
        } else {
            echo "Failed to upload image.";
            exit;
        }
    }

    // Calculate dummy price (Rs. 500 per item)
    $unit_price = 500;
    $total_price = $quantity * $unit_price;

    // Insert order with optional otherDetails and imagePath
    $stmt = $conn->prepare("INSERT INTO orders (user_id, item, quantity, name, contact, address, total_price, other_details, image_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isisssiss", $user_id, $item, $quantity, $name, $contact, $address, $total_price, $otherDetails, $imagePath);

    if ($stmt->execute()) {
        // Send email notification
        $to = 'kunalnepali123456@gmail.com';
        $subject = 'New Order Received';
        $message = "New order placed:\n\n".
                   "Name: $name\n".
                   "Item: $item\n".
                   ($item === 'Others' ? "Other Details: $otherDetails\n" : "").
                   "Quantity: $quantity\n".
                   "Contact: $contact\n".
                   "Address: $address\n".
                   "Total: Rs. $total_price\n".
                   ($imagePath ? "Image: " . "http://yourdomain.com/" . $imagePath . "\n" : "");
        $headers = 'From: noreply@lalitpurbags.com';

        mail($to, $subject, $message, $headers);

        echo "Order confirmed. Thank you for your purchase!";
    } else {
        echo "Order failed: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}
?>
