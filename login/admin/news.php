<?php
// Example news article data (you could pull this data from a database or external source)
$news_title = "Breaking News: PHP Simplifies Web Development!";
$news_content = "PHP has become one of the most widely-used languages for server-side scripting. It simplifies web development by integrating seamlessly with HTML, databases, and various frameworks.";
$image_url = "https://via.placeholder.com/600x300";  // Placeholder image URL
$image_alt = "PHP Development Image";  // Alt text for the image
$date_published = "December 13, 2024";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Article</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .news-container {
            width: 80%;
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .news-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .news-header h1 {
            font-size: 2em;
            color: #333;
        }
        .news-header p {
            font-size: 0.9em;
            color: #777;
        }
        .news-image {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .news-content {
            font-size: 1.1em;
            line-height: 1.6;
            color: #555;
        }
        .news-content p {
            margin: 15px 0;
        }
    </style>
</head>
<body>

<div class="news-container">
    <div class="news-header">
        <h1><?php echo $news_title; ?></h1>
        <p><strong>Published on: <?php echo $date_published; ?></strong></p>
    </div>
    
    <!-- Image of the news article -->
    <img src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>" class="news-image">
    
    <!-- Content of the news article -->
    <div class="news-content">
        <p><?php echo $news_content; ?></p>
    </div>
</div>

</body>
</html>
