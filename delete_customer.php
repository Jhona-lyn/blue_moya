<?php
session_start();
include("connect.php");

// Check if the customer ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prevent SQL Injection
    $id = $conn->real_escape_string($id);

    // Delete query
    $sql = "DELETE FROM customers WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Customer deleted successfully!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error deleting customer: " . $conn->error;
        $_SESSION['message_type'] = "danger";
    }
} else {
    $_SESSION['message'] = "Invalid request.";
    $_SESSION['message_type'] = "warning";
}

// Redirect back to customer list
header("Location: customer_list.php");
exit();
?>
