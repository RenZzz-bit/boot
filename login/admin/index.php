<?php
include('db.php');

// Fetch all articles
$sql = "SELECT * FROM articles ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Articles</title>
</head>
<body>
    <h1>Latest News</h1>
    
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
            echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
            
            if ($row['image']) {
                echo "<img src='images/" . htmlspecialchars($row['image']) . "' alt='Article Image' width='300'>";
            }
            
            echo "<p><small>Published on: " . $row['created_at'] . "</small></p>";
            echo "</div><hr>";
        }
    } else {
        echo "<p>No articles published yet.</p>";
    }
    ?>
</body>
</html>
