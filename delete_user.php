<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "portfolio_db");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Delete the user from the database
    $sql = "DELETE FROM user_info WHERE id='$id'";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php");  // Redirect to admin page after successful delete
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
