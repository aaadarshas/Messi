<?php
// feedback.php
session_start();

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "books";
$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $book_name = mysqli_real_escape_string($conn, $_POST['book_name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $complaint = mysqli_real_escape_string($conn, $_POST['complaint']);
    $image_path = "";

    // Handle image upload
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $image_path = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $image_path);
    }

    // Insert into database
    $query = "INSERT INTO feedback (user_name, email, book_name, address, phone, complaint, image)
              VALUES ('$user_name', '$email', '$book_name', '$address', '$phone', '$complaint', '$image_path')";
    if (mysqli_query($conn, $query)) {
        $success = "✅ Thank you! Your feedback has been submitted successfully.";
    } else {
        $error = "❌ Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>BookNest - Feedback</title>
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #fdf6ec;
        margin: 0;
        padding: 0;
    }
    .feedback-container {
        max-width: 700px;
        margin: 60px auto;
        background-color: #fff;
        padding: 35px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    h2 {
        color: #8b4513;
        text-align: center;
        margin-bottom: 25px;
    }
    label {
        display: block;
        font-weight: bold;
        color: #5a2e0c;
        margin-top: 15px;
    }
    input[type="text"], input[type="email"], input[type="tel"], textarea {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #d2b48c;
        border-radius: 6px;
        background-color: #fffaf2;
        font-size: 1rem;
    }
    textarea {
        resize: none;
        height: 100px;
    }
    input[type="file"] {
        margin-top: 10px;
        color: #5a2e0c;
    }
    button {
        display: block;
        width: 100%;
        margin-top: 25px;
        padding: 12px;
        background-color: #8b4513;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        cursor: pointer;
        transition: 0.3s;
    }
    button:hover {
        background-color: #a0522d;
        transform: scale(1.03);
    }
    .message {
        text-align: center;
        margin-top: 15px;
        font-weight: 600;
    }
    .success { color: green; }
    .error { color: red; }
</style>
</head>
<body>

<div class="feedback-container">
    <h2>📢 BookNest - Feedback Form</h2>

    <?php if (!empty($success)) echo "<p class='message success'>$success</p>"; ?>
    <?php if (!empty($error)) echo "<p class='message error'>$error</p>"; ?>

    <form method="POST" enctype="multipart/form-data">
        <label>User Name:</label>
        <input type="text" name="user_name" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Book Name:</label>
        <input type="text" name="book_name" required>

        <label>Address:</label>
        <textarea name="address" required></textarea>

        <label>Phone Number:</label>
        <input type="tel" name="phone" required pattern="[0-9]{10}" placeholder="Enter 10-digit number">

        <label>Your Feedback / Complaint:</label>
        <textarea name="complaint" required></textarea>

        <label>Upload Image (Optional):</label>
        <input type="file" name="image" accept="image/*">

        <button type="submit">Submit Feedback</button>
    </form>
</div>

</body>
</html>
