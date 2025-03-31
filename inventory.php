<?php 
include("connect.php");

// Add new product
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    $product_name = htmlspecialchars(trim($_POST['product_name']));
    $stock = filter_var($_POST['stock'], FILTER_VALIDATE_INT);
    $unit_price = filter_var($_POST['unit_price'], FILTER_VALIDATE_FLOAT);

    if ($product_name && $stock !== false && $unit_price !== false) {
        $stmt = $conn->prepare("INSERT INTO inventory (product_name, stock, unit_price) VALUES (?, ?, ?)");
        $stmt->bind_param("sid", $product_name, $stock, $unit_price);  // Correct parameter types
        $stmt->execute();
        $stmt->close();

        header("Location: inventory.php?success=Product added");
        exit();
    } else {
        echo "Invalid input values.";
    }
}

// Fetch inventory
$inventory = $conn->query("SELECT * FROM inventory");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        
        body {
            background:url('images/jjj.jpg.jpg')  center fixed;
            line-height: 1.6;
            padding: 20px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            background:url('images/kkk.jpg.jpg')  center fixed;
            padding: 20px;
            box-shadow: 0 0 10px #ccc;
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color:rgb(0, 0, 0);
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background:rgb(5, 130, 233);
            color: white;
        }

        tr:nth-child(even) {
            background:rgb(5, 179, 233);
        }

        tr:hover {
            background:rgb(5, 179, 233);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        input, button {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background:rgb(5, 130, 233);
            color: white;
            cursor: pointer;
        }

        button:hover {
            background:rgb(5, 130, 233);
        }

        .success {
            color: green;
            text-align: center;
            margin-bottom: 15px;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }

        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            color:rgb(24, 27, 201);
            text-decoration: none;
            padding: 8px 12px;
            margin: 0 4px;
            border: 1px solid rgb(24, 27, 201);
            border-radius: 4px;
        }

        .pagination a:hover {
            background:rgb(24, 27, 201);
            color: white;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Inventory Management</h2>

    <!-- Success or error message -->
    <?php if (isset($_GET['success'])): ?>
        <div class="success"><?= htmlspecialchars($_GET['success']); ?></div>
    <?php endif; ?>

    <!-- Inventory Table -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Stock</th>
                <th>Unit Price</th>
                <th>Last Updated</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $inventory->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= htmlspecialchars($row['product_name']); ?></td>
                <td><?= $row['stock']; ?></td>
                <td>₱<?= number_format($row['unit_price'], 2); ?></td>
                <td><?= date("Y-m-d H:i:s", strtotime($row['last_updated'])); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Add New Product Form -->
    <h2>Add New Product</h2>
    <form method="post">
        <input type="text" name="product_name" placeholder="Product Name" required>
        <input type="number" name="stock" placeholder="Stock" required>
        <input type="text" name="unit_price" placeholder="Unit Price" required>
        <button type="submit" name="add_product">Add Product</button>
    </form>

</div>
<div class="text-center mt-3">
            <a href="Admin_Dashboard.php" class="btn btn-outline-secondary">Back To Dashboard</a>
        </div>
</body>
</html>
