<?php include('functions.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Dylan Clark">
    <meta name="description" content="Camping Blog">
    <meta name="keywords" content="Camping, Blog posts">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Posts by Tags</title>
</head>
<body>
    <header>
        <h1>NotACampBlog</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Tags</h2>
        <ul>
            <li><a href="post.php?tag=essentials">Essentials</a></li>
            <li><a href="post2.php?tag=campsites">Campsites</a></li>
            <li><a href="post3.php?tag=cooking">Cooking</a></li>
        </ul>
    </main>
    <footer>
        <p>Site made by Dylan Clark &copy; <?= date("Y"); ?> NotACampBlog</p>
    </footer>
</body>
</html>