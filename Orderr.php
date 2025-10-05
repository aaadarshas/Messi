<!DOCTYPE html>    
<html lang="en">    
<head>    
    <meta charset="UTF-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>Order Book</title>    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">    
    <style>    
        :root {    
            --primary: #2e7d32;    
            --primary-light: #4caf50;    
            --primary-dark: #1b5e20;    
            --accent: #ff5722;    
            --text-dark: #263238;    
            --text-light: #78909c;    
            --background: #f1f8e9;    
            --card-bg: #ffffff;    
        }    
            
        * {    
            margin: 0;    
            padding: 0;    
            box-sizing: border-box;    
        }    
            
        body {    
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;    
            background: var(--background);    
            color: var(--text-dark);    
            line-height: 1.6;    
            padding: 20px;    
        }    
            
        .container {    
            max-width: 800px;    
            margin: 0 auto;    
            background: var(--card-bg);    
            border-radius: 12px;    
            overflow: hidden;    
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);    
        }    
            
        header {    
            text-align: center;    
            padding: 25px;    
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);    
            color: white;    
        }    
            
        header h1 {    
            font-size: 2rem;    
            margin-bottom: 10px;    
        }    
            
        .book-info {    
            display: flex;    
            padding: 20px;    
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);    
            background: #f9f9f9;    
        }    
            
        .book-info img {    
            width: 120px;    
            height: 160px;    
            object-fit: cover;    
            border-radius: 8px;    
            margin-right: 20px;    
        }    
            
        .book-details h3 {    
            color: var(--primary-dark);    
            margin-bottom: 10px;    
        }    
            
        .book-details p {    
            margin-bottom: 5px;    
            color: var(--text-light);    
        }    
            
        .book-price {    
            font-size: 1.5rem;    
            font-weight: bold;    
            color: var(--primary);    
            margin-top: 10px;    
        }    
            
        .order-form {    
            padding: 25px;    
        }    
            
        .form-title {    
            font-size: 1.5rem;    
            color: var(--primary-dark);    
            margin-bottom: 20px;    
            padding-bottom: 10px;    
            border-bottom: 2px solid var(--primary-light);    
        }    
            
        .form-group {    
            margin-bottom: 20px;    
        }    
            
        .form-group label {    
            display: block;    
            margin-bottom: 8px;    
            font-weight: 600;    
            color: var(--text-dark);    
        }    
            
        .form-group input, .form-group textarea {    
            width: 100%;    
            padding: 14px;    
            border: 1px solid #ddd;    
            border-radius: 8px;    
            font-size: 16px;    
            transition: all 0.3s;    
        }    
            
        .form-group input:focus, .form-group textarea:focus {    
            outline: none;    
            border-color: var(--primary);    
            box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.2);    
        }    
            
        .form-group textarea {    
            min-height: 100px;    
            resize: vertical;    
        }    
            
        .submit-btn {    
            display: block;    
            width: 100%;    
            padding: 16px;    
            background: var(--primary);    
            color: white;    
            border: none;    
            border-radius: 8px;    
            font-size: 1.1rem;    
            font-weight: 600;    
            cursor: pointer;    
            transition: background 0.3s ease;    
        }    
            
        .submit-btn:hover {    
            background: var(--primary-dark);    
        }    
            
        .alert {    
            padding: 15px;    
            border-radius: 8px;    
            margin-bottom: 20px;    
            font-weight: 500;    
            display: flex;    
            align-items: center;    
            gap: 10px;    
        }    
            
        .alert-success {    
            background-color: #d1fae5;    
            color: #065f46;    
            border-left: 4px solid #10b981;    
        }    
            
        .alert-danger {    
            background-color: #fee2e2;    
            color: #b91c1c;    
            border-left: 4px solid #ef4444;    
        }    
            
        footer {    
            text-align: center;    
            padding: 20px;    
            color: var(--text-light);    
            font-size: 0.9rem;    
            border-top: 1px solid rgba(0, 0, 0, 0.1);    
        }    

        /* ========== NEW PAYMENT SECTION STYLE ========== */
        .form-group.payment-method {
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            border: 2px dashed var(--primary-light);
            border-radius: 10px;
            padding: 20px;
            margin-top: 25px;
            transition: all 0.3s ease;
        }

        .form-group.payment-method:hover {
            background: #e0f2f1;
            box-shadow: 0 4px 10px rgba(46, 125, 50, 0.2);
        }

        .form-group.payment-method label {
            color: var(--primary-dark);
            font-size: 1rem;
        }

        .form-group.payment-method input[type="radio"] {
            margin-right: 8px;
            accent-color: var(--primary);
            transform: scale(1.1);
        }

        #card-details {
            background: #f9fbe7;
            border-radius: 10px;
            padding: 15px 20px;
            border: 1px solid #c5e1a5;
            animation: fadeIn 0.4s ease;
        }

        #card-details .form-group label {
            color: var(--text-dark);
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(-10px);}
            to {opacity: 1; transform: translateY(0);}
        }
            
        @media (max-width: 600px) {    
            .book-info {    
                flex-direction: column;    
                align-items: center;    
                text-align: center;    
            }    
                
            .book-info img {    
                margin-right: 0;    
                margin-bottom: 15px;    
            }    
        }    
    </style>    
</head>    
<body>    
    <div class="container">    
        <header>    
            <h1><i class="fas fa-shopping-cart"></i> Place Your Order</h1>    
            <p>Complete the form below to order your book</p>    
        </header>    
            
        <?php    
	session_start();    
        $host = "localhost";    
        $user = "root";    
        $password = "";    
        $dbname = "books";    
    
        $conn = mysqli_connect($host, $user, $password, $dbname);    
    
        if (!$conn) {    
            die("Connection failed: " . mysqli_connect_error());    
        }    
    
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;    
    
        $query = "SELECT * FROM book WHERE id = $id";    
        $result = mysqli_query($conn, $query);    
    
        if ($result && mysqli_num_rows($result) > 0) {    
            $book = mysqli_fetch_assoc($result);    
        } else {    
            die("Book not found!");    
        }    
            
if ($_SERVER['REQUEST_METHOD'] === 'POST') {    
    $user_id = $_SESSION['user_id'];    
    $book_id = $id;    
    $name = $book['name'];    
    $price = $book['price'];    
    $address = mysqli_real_escape_string($conn, $_POST['address']);    
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);    
    $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);    
    $order_date = date('Y-m-d H:i:s');    
    
    $insert_query = "INSERT INTO orders (book_id, user_id, name, price, address, phone, pincode, order_date)    
                     VALUES ('$book_id', '$user_id', '$name', '$price', '$address', '$phone', '$pincode', '$order_date')";    
    
    if (mysqli_query($conn, $insert_query)) {    
        echo '<div class="alert alert-success">    
                <i class="fas fa-check-circle"></i> Your order has been placed successfully!    
              </div>';    
    } else {    
        echo '<div class="alert alert-danger">    
                <i class="fas fa-exclamation-circle"></i> Error: ' . mysqli_error($conn) . '    
              </div>';    
    }    
}    
      ?>    
            
        <div class="book-info">    
            <img src="<?php echo $book['image']; ?>" alt="<?php echo $book['name']; ?>">    
            <div class="book-details">    
                <h3><?php echo $book['name']; ?></h3>    
                <p><strong>Author:</strong> <?php echo $book['author']; ?></p>    
                <p><strong>Publisher:</strong> <?php echo $book['publisher']; ?></p>    
                <p><strong>Year:</strong> <?php echo $book['year_of_publish']; ?></p>    
                <div class="book-price">Price: ₹<?php echo $book['price']; ?></div>    
            </div>    
        </div>    
            
        <div class="order-form">    
            <h2 class="form-title">Shipping Information</h2>    
                
            <form method="POST" action="">    
                <div class="form-group">    
                    <label for="customer_name"><i class="fas fa-user"></i> Full Name</label>    
                    <input type="text" id="customer_name" name="customer_name" required placeholder="Enter your full name">    
                </div>    
                    
                <div class="form-group">    
                    <label for="address"><i class="fas fa-map-marker-alt"></i> Delivery Address</label>    
                    <textarea id="address" name="address" required placeholder="Enter your complete delivery address"></textarea>    
                </div>    
                    
                <div class="form-group">    
                    <label for="phone"><i class="fas fa-phone"></i> Phone Number</label>    
                    <input type="tel" id="phone" name="phone" required placeholder="Enter your 10-digit phone number">    
                </div>    
                    
                <div class="form-group">    
                    <label for="pincode"><i class="fas fa-map-pin"></i> Pincode</label>    
                    <input type="text" id="pincode" name="pincode" required placeholder="Enter your area pincode">    
                </div>    
                
                <!-- Enhanced Payment Method Section -->
                <div class="form-group payment-method">    
                    <label><i class="fas fa-money-bill-wave"></i> Payment Method</label>    
                    <div>    
                        <label><input type="radio" name="payment_method" value="cod" required> Cash on Delivery</label><br>    
                        <label><input type="radio" name="payment_method" value="card"> Card Payment</label>    
                    </div>    
                </div>    
    
                <div id="card-details" style="display:none; margin-top:15px;">    
                    <div class="form-group">    
                        <label for="card_number"><i class="fas fa-credit-card"></i> Card Number</label>    
                        <input type="text" id="card_number" name="card_number" placeholder="Enter 16-digit card number">    
                    </div>    
    
                    <div class="form-group">    
                        <label for="expiry_date"><i class="fas fa-calendar-alt"></i> Expiry Date</label>    
                        <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY">    
                    </div>    
    
                    <div class="form-group">    
                        <label for="cvv"><i class="fas fa-lock"></i> CVV</label>    
                        <input type="password" id="cvv" name="cvv" placeholder="123">    
                    </div>    
                </div>    
    
                <button type="submit" class="submit-btn">    
                    <i class="fas fa-check"></i> Confirm Order    
                </button>    
            </form>    
        </div>    
            
        <footer>    
            <p>© 2023 BookStore. Your order will be delivered within 5-7 business days.</p>    
        </footer>    
    </div>    
    
    <script>    
document.addEventListener('DOMContentLoaded', function() {    
    const codOption = document.querySelector('input[value="cod"]');    
    const cardOption = document.querySelector('input[value="card"]');    
    const cardDetails = document.getElementById('card-details');    
    
    document.querySelectorAll('input[name="payment_method"]').forEach(option => {    
        option.addEventListener('change', function() {    
            if (cardOption.checked) {    
                cardDetails.style.display = 'block';    
            } else {    
                cardDetails.style.display = 'none';    
            }    
        });    
    });    
});    
    
document.addEventListener('DOMContentLoaded', function() {    
    const form = document.querySelector('form');    
    form.addEventListener('submit', function(e) {    
        let isValid = true;    
        const phone = document.getElementById('phone');    
        const phonePattern = /^[0-9]{10}$/;    
        if (!phonePattern.test(phone.value)) {    
            alert('Please enter a valid 10-digit phone number');    
            isValid = false;    
        }    
        const pincode = document.getElementById('pincode');    
        const pincodePattern = /^[0-9]{6}$/;    
        if (!pincodePattern.test(pincode.value)) {    
            alert('Please enter a valid 6-digit pincode');    
            isValid = false;    
        }    
        if (!isValid) {    
            e.preventDefault();    
        }    
    });    
});    
    </script>    
</body>    
</html>
