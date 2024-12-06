<?php include('functions.php');
session_start();

if (isset($_COOKIE['remember_username']) && isset($_COOKIE['remember_token'])) {
    $username = $_COOKIE['remember_username'];
    $token = $_COOKIE['remember_token'];

    $data = json_decode(file_get_contents('database.sql'), true);
    if ($data !== null) {
        foreach ($data as $user) {
            if ($user['username'] === $username && $user['remember_token'] === $token) 
            {
                $_SESSION['username'] = $username;
                break;
            }
        }
    }
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Dylan Clark">
    <meta name="description" content="Camping Blog">
    <meta name="keywords" content="Camping, Blog posts">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Smores Galore</title>
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
                <li><a href="tags.php">Tags</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Smores Galore</h2>
        <p>
        I feel one of the best things to cook on a trip would be smores. Making s'mores on a camping trip is a deliciously simple treat that brings everyone together around the campfire.
         First, gather your ingredients: graham crackers, marshmallows, and chocolate bars. 
         Start by roasting a marshmallow on a skewer over the fire until it's golden brown and gooey—this is the classic method, but you can adjust to your preferred level of roasted perfection. 
         Once ready, place a piece of chocolate on a graham cracker and top it with the warm marshmallow. 
         Finish by covering it with another graham cracker and gently pressing down to create a melty masterpiece. Enjoy your s'mores!
        </p>
        
        <div id="comments">
        <?php if (isset($_SESSION['username'])): ?>
        <p>Logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?> | <a href="logout.php">Logout</a></p>
        
        <form action="comments.php" method="POST">
            <label for="comment">Leave a comment:</label><br>
            <textarea id="comment" name="comment" required></textarea><br><br>
            <input type="submit" value="Submit Comment">
        </form>
    <?php else: ?>
        <p>You must be logged in to comment. <a href="login.php">Login here</a>.</p>
    <?php endif; ?>

    <h3>Comments:</h3>
    <?php
    if (file_exists('database.sql')) {
        $comments = json_decode(file_get_contents('database.sql'), true);
        if ($comments) {
            foreach ($comments as $comment) {
                echo "<p><strong>" . htmlspecialchars($comment['username']) . ":</strong> " . htmlspecialchars($comment['comment']) . "</p>";
            }
        } else {
            echo "<p>No comments yet.</p>";
        }
    }
    ?>
    </main>
    <footer>
        <p>Site made by Dylan Clark &copy; <?= date("Y"); ?> NotACampBlog</p>
    </footer>
</body>
</html>