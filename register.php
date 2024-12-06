<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Dylan Clark">
    <meta name="description" content="Camping Blog">
    <meta name="keywords" content="Camping, Blog posts">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registration</title>
</head>
<body>
<header>
        <h1>NotACampBlog
        </h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="registration/index.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>
    <h2>Register</h2>
    <form action="registration.php" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" value="Register">
    </form>
    <p>Already have an account? <a href="login.php">Login here</a>.</p>
    <footer>
        <p>Site made by Dylan Clark &copy; <?= date("Y"); ?> NotACampBlog</p>
    </footer>
</body>
</html>