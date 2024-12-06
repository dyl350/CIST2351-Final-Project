<?php
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
    <title>About</title>
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
        <h2>About my blog</h2>
        <?php if (isset($_SESSION['username'])): ?>
        <p>Logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?> | <a href="logout.php">Logout</a></p>
    <?php else: ?>
        <p>You are not logged in. <a href="login.php">Login here</a>.</p>
    <?php endif; ?>
        <p>Welcome to my camping blog! I'm Dylan, and I'm a passionate outdoor enthusiast dedicated to sharing my love for camping and nature with fellow adventurers.
             Ever since I was a child, exploring the great outdoors has been a source of joy and inspiration for me. 
             Each camping trip brings a unique sense of adventure, excitement, and tranquility, whether I'm tucked away in the woods or relaxing by a serene lake.
              Through this blog, I hope to encourage others to unplug, explore the natural world, and experience the magic of the wilderness.
            </p>
        <p>
        On my blog, you'll find a wealth of information gathered from my personal camping experiences and discoveries. 
        I aim to provide practical tips, detailed campground reviews, and gear recommendations to help you make the most of your time in nature.
         Whether you're a seasoned camper or just starting out, my goal is to create a welcoming community where we can all learn from each other and share our love for the outdoors.
        </p>
        <p>
        I believe that camping has the remarkable ability to bring people together, foster connections, and create lasting memories. 
        So, grab your camping gear, and join me on this journey as we embark on new adventures, explore stunning landscapes, and savor the little moments that make camping so special.
         I can't wait to hear about your outdoor experiences and the unique stories that make each trip unforgettable!
        </p>
        <p>
            Email: NotACampBlog@gmail.com
        </p>
    </main>
    <footer>
        <p>Site made by Dylan Clark &copy; <?= date("Y"); ?> NotACampBlog</p>
    </footer>
</body>
</html>