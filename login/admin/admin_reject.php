<?php
include 'db.php';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Update the status of the user to rejected (or whatever status makes sense)
    $query = "UPDATE users SET verified = -1 WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $userId);
    if ($stmt->execute()) {
        // Redirect to the admin page after success
        header("Location: accounts.php?status=rejected"); // Replace admin_page.php with your actual admin page filename
        exit; // Make sure to call exit after the header to stop further execution
    } else {
        echo "Error rejecting user.";
    }
}
?>

