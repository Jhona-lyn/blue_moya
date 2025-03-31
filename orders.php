<?php 
include("connect.php");

$orders = $conn->query("SELECT id, customer_name, address, contact_number, product_id, quantity, total, delivery_date, actions FROM orders");
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'deliver') {
    $order_id = $_GET['id'];
    $update_query = "UPDATE orders SET actions = 'Delivered' WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    header("Location: orders.php"); // Reload page
    exit;
}

// Kunin ang lahat ng orders
$query = "SELECT * FROM orders";
$result = $conn->query($query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">Order List</h2>

    <!-- Success Message -->
    <?php if (isset($_GET['success'])) { ?>
        <div class="alert alert-success"><?php echo $_GET['success']; ?></div>
    <?php } ?>

    <a href="place_order.php" class="btn btn-primary mb-3">+ Place New Order</a>
    <div class="table-responsive">
        <table class="table table-bordered table-hover bg-white">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Address</th>
                    <th>Contact</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Delivery Date</th>
                    <th>Actions</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $orders->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['customer_name']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['contact_number']; ?></td>
                    <td><?php echo $row['product_id']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['total']; ?></td>
                    <td><?php echo $row['delivery_date']; ?></td>

                <?php if ($row['actions'] == 'Delivered') { ?>
                <?php } ?>
            </td>
            <td>
                <?php if ($row['actions'] != 'Delivered') { ?>
                    <a href="orders.php?id=<?php echo $row['id']; ?>&action=deliver" class="btn-deliver">Mark as Delivered</a>
                <?php } else { ?>
                    <span class="text-success">✓ Delivered</span>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
    </div>
</div>

<div class="text-center mt-3">
    <a href="Admin_Dashboard.php" class="btn btn-outline-secondary">Back To Dashboard</a>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
                <style>
        body {
            background: url('images/jjj.jpg.jpg') center fixed;b
            min-height: 100vh;
            font-family: Arial, sans-serif;
            padding: 50px;           
    }
