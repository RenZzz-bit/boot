<?php
// Assuming you're using MySQLi to connect to your database
include('db.php'); // Include your DB connection file

// Get the article ID from the URL
if (isset($_GET['id'])) {
    $articleId = $_GET['id'];

    // Fetch the article data from the database
    $query = "SELECT * FROM news WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $articleId); // "i" for integer type
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $article = $result->fetch_assoc();
        $title = htmlspecialchars($article['title']);
        $content = nl2br(htmlspecialchars($article['content']));
        $image = $article['image'] ? 'login/admin/assets/' . htmlspecialchars($article['image']) : 'assets/default.jpg'; // Fallback image
        $createdAt = date('F j, Y', strtotime($article['created_at']));
    } else {
        echo "<h3>Article not found</h3>";
    }
} else {
    echo "<h3>Invalid article ID</h3>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <!-- Add your CSS link here -->
    <link rel="stylesheet" href="css/stylearticle.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Article Detail</h1>
        </header>

        <article class="article-detail">
            <!-- Article Title -->
            <h2 class="article-title"><?php echo $title; ?></h2>

            <!-- Article Image -->
            <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" class="article-image">

            <!-- Article Creation Date -->
            <small class="article-date"><?php echo $createdAt; ?></small>

            <!-- Article Content -->
            <div class="article-content">
                <?php echo $content; ?>
            </div>
        </article>

        <div class="back-button">
            <a href=".../index.php" class="btn btn-primary">Back to Articles</a>
        </div>
    </div>

    <!-- Add any necessary JavaScript files here -->
</body>
</html>

