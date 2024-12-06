<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    $data = json_decode(file_get_contents('database.sql'), true);
    $authenticated = false;

    if ($data !== null) {
        foreach ($data as &$user) {
            if ($user['username'] === $username && password_verify($password, $user['password'])) {
                $authenticated = true;
                $_SESSION['username'] = $username; 

                if ($remember) {
                    $token = bin2hex(random_bytes(16)); 
                    $user['remember_token'] = $token; 
                    setcookie('remember_username', $username, time() + (86400 * 1), "/"); 
                    setcookie('remember_token', $token, time() + (86400 * 1), "/"); 
                }
                break;
            }
        }

        file_put_contents('database.sql', json_encode($data));
    }

    if ($authenticated) {
        header("Location: index.php"); 
        exit();
    } else {
        echo "Invalid username or password. Please try again.";
        echo "<p><a href='login.php'>Back to login</a></p>";
    }
}
?>