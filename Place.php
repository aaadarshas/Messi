<?php
include 'db_connect.php';

// Fetch all user orders with book details
$sql = "SELECT orders.id AS order_id, users.name AS user_name, users.email, 
               books.title AS book_title, books.author, orders.quantity, orders.order_date 
        FROM orders
        INNER JOIN users ON orders.user_id = users.id
        INNER JOIN books ON orders.book_id = books.id
        ORDER BY orders.order_date DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - User Orders</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9f9f9;
      margin: 0;
      padding: 0;
    }
    header {
      background: #2c3e50;
      color: white;
      padding: 15px;
      text-align: center;
    }
    .container {
      width: 95%;
      margin: 20px auto;
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0px 3px 8px rgba(0,0,0,0.2);
    }
    h2 {
      text-align: center;
      color: #333;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 12px;
      text-align: center;
    }
    th {
      background: #2c3e50;
      color: white;
    }
    tr:nth-child(even) {
      background: #f2f2f2;
    }
    .no-data {
      text-align: center;
      color: red;
      margin-top: 20px;
    }
  </style>
</head>
<body>

<header>
  <h1>📚 Bookstore Admin Dashboard</h1>
</header>

<div class="container">
  <h2>User Orders</h2>
  <?php if ($result->num_rows > 0) { ?>
    <table>
      <tr>
        <th>Order ID</th>
        <th>User Name</th>
        <th>Email</th>
        <th>Book Title</th>
        <th>address</th>
        <th>phone no</th>
        <th>Order Date</th>
      </tr>
      <?php while ($row = $result->fetch_assoc()) { ?>
      <tr>
        <td><?php echo $row['order_id']; ?></td>
        <td><?php echo $row['user_name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['book_title']; ?></td>
        <td><?php echo $row['address']; ?></td>
        <td><?php echo $row['phone no']; ?></td>
        <td><?php echo $row['order_date']; ?></td>
      </tr>
      <?php } ?>
    </table>
  <?php } else { ?>
    <p class="no-data">No orders found.</p>
  <?php } ?>
</div>

</body>
</html>
