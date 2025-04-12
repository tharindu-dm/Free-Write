<?php
// Include necessary files  
require_once '../app/includes/autoload.php';

session_start();

// Set the content type to JSON
header('Content-Type: application/json');

// Check if session and function are working
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['unread_count' => 0, 'error' => 'No user session']);
} elseif (!function_exists('getUnreadNotifications')) {
    echo json_encode(['unread_count' => 0, 'error' => 'Function getUnreadNotifications not found']);
} else {
    $unread_records = getUnreadNotifications($_SESSION['user_id']);
    $unreadCount = sizeof($unread_records);
    echo json_encode([
        'unread_count' => $unreadCount,
        'records' => $unread_records
    ]);
}
?>