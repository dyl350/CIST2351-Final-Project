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
    <title>Something New</title>
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
        <h2>Something New</h2>
        <p>This weekend, after a grueling work week, I decided to go on a camping trip. I was growing tired of the usual places I'd thoroughly explored up to this point.
             So I decided to set out an find something new. A change in location can completely revolutionize the camping experience. If you feel the novelty wearing off, I highly suggest venturing out somewhere new. 
        </p>
        <p>Upon arriving, I was immediately taken aback by my surroundings. The campsite was nestled beside a glistening lake, surrounded by tall trees with vibrant green leaves swaying in the gentle breeze.
             The air was fresher than I had ever experienced, and the sound of chirping birds created a soothing soundtrack to my adventure.
              I found a perfect spot to pitch my tent, an area where the grass was soft and welcoming. 
              As the sun began to set, the lake shimmered with golden reflections, and I felt a wave of excitement and relief wash over me.
        </p>
        <p>
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