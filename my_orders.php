<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "books";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$user_id = $_SESSION['user_id'];

// Fetch orders for this user
$query = "SELECT * FROM orders WHERE user_id = $user_id ORDER BY order_date DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>My Orders</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #fffaf2; /* light cream-white */
      color: #4b2e05; /* dark brown text */
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 1000px;
      margin: 50px auto;
      background: #ffffff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 5px 15px rgba(139, 69, 19, 0.15);
    }

    h1 {
      text-align: center;
      color: #8b4513; /* medium brown */
      margin-bottom: 20px;
      font-size: 2.2rem;
    }

    p {
      text-align: center;
      font-size: 1.1rem;
      margin-bottom: 30px;
      color: #5c3d1a;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: #fffdf8;
      border-radius: 10px;
      overflow: hidden;
    }

    th, td {
      padding: 15px;
      text-align: left;
      border-bottom: 1px solid #e6d2b5;
    }

    th {
      background-color: #8b4513;
      color: white;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }

    tr:hover {
      background-color: #f3e5d8;
      transition: 0.3s ease;
    }

    td {
      color: #3d2b1f;
      font-size: 1rem;
    }

    .no-orders {
      text-align: center;
      color: #8b4513;
      font-size: 1.2rem;
      font-weight: 500;
      padding: 20px;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .container {
        padding: 20px;
      }

      table, th, td {
        font-size: 0.9rem;
      }

      h1 {
        font-size: 1.8rem;
      }
    }

    @media (max-width: 480px) {
      th, td {
        padding: 10px;
      }

      table {
        font-size: 0.85rem;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>📦 My Orders</h1>
    <p>Welcome, <?php echo $_SESSION['username']; ?>! Here's a list of your recent orders:</p>

    <?php if (mysqli_num_rows($result) > 0): ?>
      <table border="0">
        <tr>
          <th>Order ID</th>
          <th>Book Name</th>
          <th>Price</th>
          <th>Address</th>
          <th>Phone</th>
          <th>Pincode</th>
          <th>Order Date</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td>₹<?php echo number_format($row['price'], 2); ?></td>
            <td><?php echo htmlspecialchars($row['address']); ?></td>
            <td><?php echo htmlspecialchars($row['phone']); ?></td>
            <td><?php echo htmlspecialchars($row['pincode']); ?></td>
            <td><?php echo date("d M Y, h:i A", strtotime($row['order_date'])); ?></td>
          </tr>
        <?php endwhile; ?>
      </table>
    <?php else: ?>
      <p class="no-orders">No orders found. Go grab a book!</p>
    <?php endif; ?>
  </div>
</body>
</html>
