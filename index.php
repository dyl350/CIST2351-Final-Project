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
    <title>NotACampBlog</title>
</head>
<body>
    <header>
        <h1>NotACampBlog
        </h1>
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
        <h2>Welcome!</h2> 
        
        <?php if (isset($_SESSION['username'])): ?>
        <p>Logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?> | <a href="logout.php">Logout</a></p>
    <?php else: ?>
        <p>You are not logged in. <a href="login.php">Login here</a>.</p>
    <?php endif; ?>

        <p>Hi, welcome to my camping blog! If you like exploration and adventure, then this is the place for you. Don't worry if you're not a seasoned camper. 
            This is a place where I beleive novices, and even those with experience can appreciate and learn something.  I find camping to be a wonderful experience, a chance to reconnect with nature and discover something new.
            This blog is my way of documenting those experiences, this way I won't forget them. I also delight in the idea of getting to share my stories with fellow campers. I hope I can inspire others to get out there and enjoy the beauty of nature as I do. 
        </p>
        <p>
            I'd really like to build a community through this blog. Once you make an account, you'll be able to comment under any of my blog posts.
            This way you'll be able to interact with me and other campers. If you had any questions about equipment or how to prepare a meal, I'd be happy to help. Or you could provide insights and tips of your own, any contribution would be appreciated.
        </p>
        <p>
            Below are my "recent posts" this way you can stay up to date on all of my adventures.Each post is dated and tagged. The tags will tell you what kind of post it is.
            Whether it be cooking, new discoveries, or equipment, each post will have a tag that fits into one of these categories. Above you can login and view the about page to learn more about this site.
            I'll try to post somewhat regularly, it all depends on how eventful the day's been.
        </p>
        <h2>Recent Posts</h2>
        <ul>
        <?php
            $posts = [
                ['title' => 'Camping Essentials', 'date' => '2024-10-01', 'tag' => 'equipment', 'file' => 'post.php'],
                ['title' => 'Something New', 'date' => '2024-10-02', 'tag' => 'discoveries', 'file' => 'post2.php'],
                ['title' => 'Smores Galore', 'date' => '2024-10-03', 'tag' => 'cooking', 'file' => 'post3.php']
            ];

            foreach ($posts as $post) {
                echo "<li><a href='{$post['file']}?title={$post['title']}'>{$post['title']}</a> - {$post['date']} (Tag: {$post['tag']})</li>";
            }
            ?>
        </ul>
    </main>
    <footer>
        <p>Site made by Dylan Clark &copy; <?= date("Y"); ?> NotACampBlog</p>
    </footer>
</body>
</html>