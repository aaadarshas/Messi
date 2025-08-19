<?php
// order.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $book_title = $_POST['book_title'];

    include 'db_connect.php';
    $sql = "INSERT INTO orders (name, email, phone, address, book_title) 
            VALUES ('$name', '$email', '$phone', '$address', '$book_title')";
    if ($conn->query($sql)) {
        echo "<script>alert('Order placed successfully!'); window.location='index.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Details - Book Order</title>
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #ffd700, #1e3c72); /* Using BookWorld colors */
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
    }
    .order-container {
      background: #fff;
      padding: 35px 30px;
      border-radius: 16px;
      width: 400px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.2);
      animation: fadeIn 1s ease;
      border: 2px solid #ffd700; /* Gold border */
    }
    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(20px);}
      to {opacity: 1; transform: translateY(0);}
    }
    h2 {
      text-align: center;
      color: #1e3c72; /* Dark blue title */
      margin-bottom: 25px;
      font-size: 22px;
    }
    label {
      font-weight: 600;
      display: block;
      margin-top: 14px;
      color: #1e3c72; /* Dark blue labels */
      font-size: 14px;
    }
    input, textarea {
      width: 100%;
      padding: 12px;
      margin-top: 6px;
      border: 1px solid #ccc;
      border-radius: 10px;
      font-size: 14px;
      transition: 0.3s;
    }
    input:focus, textarea:focus {
      border-color: #ffd700;
      outline: none;
      box-shadow: 0 0 6px rgba(255, 215, 0, 0.6);
    }
    textarea {
      resize: none;
    }
    button {
      margin-top: 22px;
      width: 100%;
      padding: 14px;
      background: linear-gradient(90deg, #1e3c72, #2a5298); /* Blue gradient */
      border: none;
      color: white;
      font-size: 16px;
      font-weight: 600;
      border-radius: 10px;
      cursor: pointer;
      transition: transform 0.2s, background 0.3s;
    }
    button:hover {
      transform: translateY(-2px);
      background: linear-gradient(90deg, #2a5298, #1e3c72);
    }
  </style>
</head>
<body>
  <div class="order-container">
    <h2>📚 Order Your Book</h2>
    <form method="POST" action="">
      <label>Full Name</label>
      <input type="text" name="name" required>

      <label>Email</label>
      <input type="email" name="email" required>

      <label>Phone</label>
      <input type="text" name="phone" required>

      <label>Address</label>
      <textarea name="address" rows="3" required></textarea>

      <label>Book Title</label>
      <input type="text" name="book_title" required>

      <button type="submit">Place Order</button>
    </form>
  </div>
</body>
</html>
