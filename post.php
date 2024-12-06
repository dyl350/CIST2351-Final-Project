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
    <title>Camping Essentials</title>
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
        <h2>Camping Essentials</h2>
        <p>When preparing for a camping trip, having the right equipment can make all the difference in ensuring a fun and comfortable experience.
             Start with a durable tent that suits your group size and provides adequate weather protection; this will serve as your home base.
              Essential sleeping gear, including a quality sleeping bag and sleeping pad, is crucial for a good nights rest. 
              For cooking, a portable stove, cookware, and a reliable cooler for food storage will let you prepare warm meals and keep food fresh.
               Don't forget to pack a first-aid kit for safety, a reliable navigation tool, and a flashlight or headlamp to light your way after dark.
                With this essential camping gear, you can immerse yourself in nature with confidence and peace of mind!
        </p>
        That evening, I roasted marshmallows over a crackling fire, while chatting with other campers who were just as friendly as I had hoped. 
        Together, we shared tips, recommended trails, and exchanged warm smiles that made me feel part of something bigger—a community that loves the great outdoors. 
        As I lay in my tent that night, gazing up at the countless stars twinkling overhead, I realized that I had discovered more than just a campsite; I had found a place where I could unwind and connect with nature on my own terms.
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