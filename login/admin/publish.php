<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Handle image upload
    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "assets/";
        $image_name = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;
        
        // Check if image file is a valid image
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image = $image_name;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Insert article into the database
    $stmt = $conn->prepare("INSERT INTO news (title, content, image) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $content, $image);
    
    if ($stmt->execute()) {
        echo "Article published successfully!";
        header("Location: admin_dashboard.php"); // Redirect to admin page after successful submission
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
