<?php
session_start();

// Database connection (consider using MySQLi or PDO instead of deprecated mysql_*)
$conn = mysql_connect("localhost", "root", "");
if (!$conn) {
    die("Connection failed: " . mysql_error());
}
mysql_select_db("medicine_store", $conn);

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['form_type'])) {
        if ($_POST['form_type'] == 'register') {
            // Registration logic
            $username = mysql_real_escape_string($_POST['username']);
            $password = md5($_POST['password']); // Note: MD5 is insecure for real-world apps

            $check = mysql_query("SELECT * FROM users WHERE username='$username'");
            if (mysql_num_rows($check) > 0) {
                $register_error = "Username already exists.";
            } else {
                $insert = mysql_query("INSERT INTO users (username, password) VALUES ('$username', '$password')");
                if ($insert) {
                    $register_success = "Registration successful. Please login.";
                } else {
                    $register_error = "Error during registration.";
                }
            }
        } elseif ($_POST['form_type'] == 'login') {
            // Login logic
            $username = mysql_real_escape_string($_POST['username']);
            $password = md5($_POST['password']);

            $result = mysql_query("SELECT * FROM users WHERE username='$username' AND password='$password'");
            if (mysql_num_rows($result) == 1) {
                $_SESSION['username'] = $username;
                header("Location: index.php");
                exit();
            } else {
                $login_error = "Invalid username or password.";
            }
        }
    }
}
mysql_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Store - Login & Register</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #00bfa5 0%, #00796b 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        
        .container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            width: 400px;
            max-width: 90%;
            padding: 30px;
            position: relative;
            overflow: hidden;
        }
        
        .container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                45deg,
                transparent, 
                rgba(255, 255, 255, 0.1), 
                rgba(255, 255, 255, 0.2)
            );
            transform: rotate(45deg);
            animation: shine 6s infinite;
            z-index: 0;
        }
        
        @keyframes shine {
            0% {
                transform: rotate(45deg) translateX(-100%);
            }
            100% {
                transform: rotate(45deg) translateX(100%);
            }
        }
        
        .form-container {
            position: relative;
            z-index: 1;
        }
        
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-size: 28px;
            position: relative;
        }
        
        h2::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: linear-gradient(to right, #00bfa5, #00796b);
            margin: 8px auto;
            border-radius: 2px;
        }
        
        .tabs {
            display: flex;
            margin-bottom: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        
        .tab {
            flex: 1;
            padding: 12px;
            text-align: center;
            background-color: #f1f1f1;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
        }
        
        .tab.active {
            background-color: #00796b;
            color: white;
        }
        
        .form {
            display: none;
            animation: fadeIn 0.5s ease forwards;
        }
        
        .form.active {
            display: block;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .input-group {
            margin-bottom: 20px;
            position: relative;
        }
        
        .input-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .input-group input:focus {
            border-color: #00796b;
            box-shadow: 0 0 8px rgba(0, 121, 107, 0.3);
            outline: none;
        }
        
        .input-group label {
            position: absolute;
            top: 12px;
            left: 15px;
            color: #999;
            pointer-events: none;
            transition: all 0.3s ease;
        }
        
        .input-group input:focus + label,
        .input-group input:not(:placeholder-shown) + label {
            top: -10px;
            left: 10px;
            font-size: 12px;
            background-color: white;
            padding: 0 5px;
            color: #00796b;
        }
        
        .btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(to right, #00bfa5, #00796b);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 121, 107, 0.3);
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 121, 107, 0.5);
        }
        
        .btn:active {
            transform: translateY(0);
        }
        
        .message {
            margin-top: 20px;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
            font-weight: 500;
            animation: popIn 0.5s ease forwards;
        }
        
        @keyframes popIn {
            0% {
                transform: scale(0.8);
                opacity: 0;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .medicine-icon {
            text-align: center;
            margin-bottom: 20px;
            color: #00796b;
            font-size: 36px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="medicine-icon">
                <i class="fas fa-pills">💊</i>
            </div>
            <h2>Medicine Store</h2>
            
            <div class="tabs">
                <div class="tab active" onclick="showForm('login')">Login</div>
                <div class="tab" onclick="showForm('register')">Register</div>
            </div>
            
            <div id="message">
                <?php
                if (isset($register_error)) {
                    echo "<div class='message error'>$register_error</div>";
                } elseif (isset($register_success)) {
                    echo "<div class='message success'>$register_success</div>";
                } elseif (isset($login_error)) {
                    echo "<div class='message error'>$login_error</div>";
                }
                ?>
            </div>
            
            <form id="loginForm" class="form active" method="post">
                <input type="hidden" name="form_type" value="login">
                <div class="input-group">
                    <input type="text" name="username" placeholder=" " required>
                    <label>Username</label>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder=" " required>
                    <label>Password</label>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
            
            <form id="registerForm" class="form" method="post">
                <input type="hidden" name="form_type" value="register">
                <div class="input-group">
                    <input type="text" name="username" placeholder=" " required>
                    <label>Username</label>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder=" " required>
                    <label>Password</label>
                </div>
                <button type="submit" class="btn">Register</button>
            </form>
        </div>
    </div>

    <script>
        function showForm(formType) {
            // Update tabs
            document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.form').forEach(form => form.classList.remove('active'));
            
            if (formType === 'login') {
                document.querySelector('.tab:first-child').classList.add('active');
                document.getElementById('loginForm').classList.add('active');
            } else {
                document.querySelector('.tab:last-child').classList.add('active');
                document.getElementById('registerForm').classList.add('active');
            }
            
            // Clear message
            document.getElementById('message').innerHTML = '';
            document.getElementById('message').className = '';
        }
    </script>
</body>
</html>
