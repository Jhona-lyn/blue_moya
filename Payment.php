<?php
session_start();
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer = $_SESSION["customer"];
    $amount = $_POST["amount"];
    $quantity = $_POST["quantity"];
    $payment_method = "GCash"; 
    $payment_date = date("Y-m-d H:i:s"); 

    // Insert into payments table
    $stmt = $conn->prepare("INSERT INTO payments (customer, amount, quantity, payment_method, payment_date) 
                            VALUES (?, ?, ?, ?, ?, ?')");
    $stmt->bind_param("iddsss", $customer, $amount, $quantity, $payment_method, $payment_date);

    if ($stmt->execute()) {
        header("Location: payment_history.php");
        exit();
    } else {
        $error = "Error processing payment.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCash Payment - Blue Moya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3 class="text-center">Pay via GCash</h3>
        <div class="text-center">
            <img src='images/my_gcash.jpg' alt="GCash QR Code" width="250">
            <p>Scan the QR code using your GCash app.</p>
        </div>
</body>
</html>
