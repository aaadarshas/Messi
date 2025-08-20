<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $book_id = $_POST['id'];

        // First fetch image name to delete it from uploads folder
        $fetch_image = "SELECT image FROM books WHERE id = ?";
        $stmt = $conn->prepare($fetch_image);
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $book = $result->fetch_assoc();
            $image_path = "uploads/" . $book['image'];

            // Delete image from uploads folder if it exists
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }

        // Delete book from database
        $sql = "DELETE FROM books WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $book_id);

        if ($stmt->execute()) {
            echo "<script>alert('Book deleted successfully!'); window.location.href='admin_home.php';</script>";
        } else {
            echo "<script>alert('Error deleting book. Please try again!'); window.location.href='admin_home.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid book ID!'); window.location.href='admin_home.php';</script>";
    }
} else {
    header("Location: admin_home.php");
    exit();
}
?>
