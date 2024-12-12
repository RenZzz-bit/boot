<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "news_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get title and content
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);

    // Handle image upload
    $uploadedImage = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploads_dir = 'uploads';
        $tmp_name = $_FILES['image']['tmp_name'];
        $uploadedImage = basename($_FILES['image']['name']);
        
        // Attempt to move the uploaded file
        if (!move_uploaded_file($tmp_name, "$uploads_dir/$uploadedImage")) {
            echo "Error uploading image.";
            $uploadedImage = null;
        }
    }

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO articles (title, content, image_path) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $content, $uploadedImage);
    
    if ($stmt->execute()) {
        // Start outputting HTML
        echo "<!DOCTYPE html>";
        echo "<html lang='en'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>Submit</title>"; // Set the title here
        echo "</head>";
        echo "<body>";
        
        echo "<h1>Your News has been Published!</h1>";
        echo "<h2>Title: $title</h2>";
        echo "<div>Content: $content</div>";
        
        // Display uploaded image if it exists
        if ($uploadedImage) {
            echo "<h3>Uploaded Image:</h3>";
            echo "<img src='$uploads_dir/$uploadedImage' alt='Uploaded Image' style='max-width: 500px;'>";
        }

        // Back to index button
        echo '<button onclick="window.location.href=\'index.html\'" style="margin-top: 20px;">Return</button>';
        
        echo "</body>";
        echo "</html>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<h1>Invalid Request</h1>";
}
?>
