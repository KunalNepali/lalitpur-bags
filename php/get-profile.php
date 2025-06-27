<?php
// File: lalitpur-bags/php/get-profile.php

session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
  echo json_encode(['error' => 'Unauthorized']);
  exit();
}

include 'db.php';
$user_id = $_SESSION['user_id'];

// Fetch Repair History
$repairs = [];
$repairQuery = $conn->prepare("SELECT bag_type, issue_type, calendar_date, location FROM repair_requests WHERE user_id = ? ORDER BY created_at DESC");
$repairQuery->bind_param("i", $user_id);
$repairQuery->execute();
$repairResult = $repairQuery->get_result();
while ($row = $repairResult->fetch_assoc()) {
  $repairs[] = $row;
}
$repairQuery->close();

// Fetch Order History
$orders = [];
$orderQuery = $conn->prepare("SELECT item, quantity, total_price FROM orders WHERE user_id = ? ORDER BY created_at DESC");
$orderQuery->bind_param("i", $user_id);
$orderQuery->execute();
$orderResult = $orderQuery->get_result();
while ($row = $orderResult->fetch_assoc()) {
  $orders[] = $row;
}
$orderQuery->close();

// Return as JSON
echo json_encode([
  'repairs' => $repairs,
  'orders' => $orders
]);

