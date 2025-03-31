<?php
include 'db.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer_name'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];  // Get price
    $delivery_date = $_POST['delivery_date'];
    $status = $_POST['status'];  // Get the selected status
    $created_at = date("Y-m-d H:i:s");  // Auto-generate created_at timestamp

    // Make sure the status is one of the predefined options
    $valid_statuses = ["Pending", "Out for Delivery", "Delivered", "Canceled"];
    if (!in_array($status, $valid_statuses)) {
        $status = "Pending";  // Default to Pending if the status is invalid
    }

    // Ipasok ang order sa database
    $insert = $conn->prepare("INSERT INTO orders (customer_name, address, contact_number, product_id, quantity, price, status, delivery_date, created_at) 
                              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $insert->bind_param("ssssissss", $customer_name, $address, $contact_number, $product_id, $quantity, $price, $status, $delivery_date, $created_at);

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
                <label class="form-label">Product ID:</label>
                <input type="number" name="product_id" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Quantity:</label>
                <input type="number" name="quantity" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Price (₱):</label>
                <input type="number" step="0.01" name="price" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Delivery Date:</label>
                <input type="date" name="delivery_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Order Status:</label>
                <div class="btn-group w-100">
                    <button type="button" class="btn btn-warning w-50" onclick="setStatus('Pending')">Pending</button>
                    <button type="button" class="btn btn-info w-50" onclick="setStatus('Out for Delivery')">Out for Delivery</button>
                    <button type="button" class="btn btn-success w-50" onclick="setStatus('Delivered')">Delivered</button>
                    <button type="button" class="btn btn-danger w-50" onclick="setStatus('Canceled')">Canceled</button>
                </div>
                <input type="hidden" name="status" id="status" value="Pending">
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3">Place Order</button>
        </form>

        <div class="text-center mt-3">
            <a href="orders.php" class="btn btn-outline-secondary">View Orders</a>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Set selected status on form submission
    function setStatus(status) {
        document.getElementById('status').value = status;
    }
</script>

</body>
</html>