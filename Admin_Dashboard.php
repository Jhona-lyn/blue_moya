<?php 
session_start();
include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Bleu Moya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('images/Rii.jpg.jpg')  center fixed;
            background-size: cover;         
        }

        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            height: 100vh;
            background:url('images/jo.jpg.jpg')  center fixed;
            background-size: cover;         
            color: ;
            padding: 20px;
            position: fixed;
        }

        .sidebar h4 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 10px 0;
        }

        .sidebar ul li a {
            color: black;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: 0.3s;
        }

        .sidebar ul li a:hover {
            background:rgb(30, 112, 195);
        }

        .sidebar ul li i {
            margin-right: 10px;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            padding: 40px;
        }

        .main-content h2 {
            font-size: 36px;
            font-weight: bold;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
        }

        .card {
            border: none;
            box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-title {
            font-size: 22px;
            font-weight: bold;
        }

        /* Responsive Layout */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }
            
            .main-content {
                margin-left: 210px;
            }
        }

        @media (max-width: 576px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4>Blue Moya</h4>
    <hr>

    <ul>
        <li><a href="Admin_Dashboard.php"><i class="fas fa-home"></i> Admin Dashboard</a></li>
        <li><a href="inventory.php"><i class="fas fa-box"></i> Inventory</a></li>
        <li><a href="customers.php"><i class="fas fa-users"></i> Customers</a></li>
        <li><a href="customer_list.php"><i class="fas fa-users"></i> Customer_List</a></li>
        <li><a href="orders.php"><i class="fas fa-shopping-cart"></i> Orders</a></li>
        <li><a href="payment.php"><i class="fas fa-credit-card"></i> Payment</a></li>
        <li><a href="payment_history.php"><i class="fas fa-tachometer-alt"></i> Payment History</a></li>
        <li><a href="proof_of_delivery.php"><i class="fas fa-file-signature"></i> Proof Of Delivery</a></li>
        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
</div>

<!-- Main Content -->
<div class="main-content">
<h2 style="color:rgb(0, 145, 255);">Welcome to Bleu Moya Water Refilling Station</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-primary text-white mb-4">
            <div class="content">
</div>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
