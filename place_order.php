<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer_name'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $total = $_POST['total'];
    $delivery_date = $_POST['delivery_date'];

    // Tamang SQL query syntax
    $insert = $conn->prepare("INSERT INTO orders (customer_name, address, contact_number, product_id, quantity, total, delivery_date) 
                              VALUES (?, ?, ?, ?, ?, ?, ?)"); 

    $insert->bind_param("ssssiis", $customer_name, $address, $contact_number, $product_id, $quantity, $total, $delivery_date);

    if ($insert->execute()) {
        header("Location: orders.php?success=Order placed successfully");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error placing order: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h2 class="text-center mb-4">Place Order</h2>

        <!-- Order Form -->
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Customer Name:</label>
                <input type="text" name="customer_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Address:</label>
                <input type="text" name="address" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Contact:</label>
                <input type="text" name="contact_number" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Product:</label>
                <select name="product_id" class="form-control" required>
                <option value="Water Jug">Water Jug</option>
                <option value="Round Water">Round Water Dispenser</option>
           </select>
           </div>
           <div class="mb-3">
                <label class="form-label">Quantity:</label>
                <input type="number" name="quantity" class="form-control" required>
            </div>
           <div class="mb-3">
                <label class="form-label">Total:</label>
                <input type="number" name="total" id="total" class="form-control"  required>
            </div>

            <div class="mb-3">
                <label class="form-label">Delivery Date:</label>
                <input type="date" name="delivery_date" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Place Order</button>
        </form>

        <div class="text-center mt-3">
            <a href="orders.php" class="btn btn-outline-secondary">Back To Orders List</a>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
