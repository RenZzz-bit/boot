<?php
include 'db.php';

if(isset($_GET['id'])){
    $user_id = $_GET['id'];
    
    // Update the user's verification status to 1 (verified)
    $query = "UPDATE users SET verified = 1 WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    
    echo "User Verified!";
}
?>
