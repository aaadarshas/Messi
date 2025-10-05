<?php
// admin_feedback.php
session_start();

// Optional: Admin login check (add your logic if needed)

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "books";
$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all feedback records
$query = "SELECT * FROM feedback ORDER BY submitted_date DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin - Feedback Dashboard</title>
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #fdf6ec;
        margin: 0;
        padding: 20px;
    }
    h2 {
        color: #8b4513;
        text-align: center;
        margin-bottom: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fffaf2;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #deb887;
    }
    th {
        background-color: #8b4513;
        color: #fff;
    }
    tr:hover {
        background-color: #f3e5d8;
    }
    img {
        max-width: 60px;
        border-radius: 5px;
    }
</style>
</head>
<body>

<h2>📋 User Feedbacks</h2>

<table>
    <tr>
        <th>ID</th>
        <th>User Name</th>
        <th>Email</th>
        <th>Book Name</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Complaint</th>
        <th>Image</th>
        <th>Submitted Date</th>
    </tr>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>" . htmlspecialchars($row['user_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['book_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['address']) . "</td>";
            echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
            echo "<td>" . htmlspecialchars($row['complaint']) . "</td>";
            echo "<td>";
            if (!empty($row['image'])) {
                echo "<img src='{$row['image']}' alt='Image'>";
            } else {
                echo "No Image";
            }
            echo "</td>";
            echo "<td>{$row['submitted_date']}</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='9' style='text-align:center;'>No feedbacks found.</td></tr>";
    }
    ?>
</table>

</body>
</html>
