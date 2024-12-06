<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        echo "Username and password cannot be empty.";
        exit;
    }
    $data = json_decode(file_get_contents('database.sql'), true);
    if ($data === null) {
        $data = []; 
    }

    foreach ($data as $user) {
        if ($user['username'] === $username) {
            echo "Username already exists!";
            exit;
        }
    }
    $data[] = [
        'username' => $username,
        'password' => password_hash($password, PASSWORD_DEFAULT),
    ];
    file_put_contents('database.sql', json_encode($data));
    
    echo "Registration successful! You can now <a href='login.php'>login</a>.";
}
?>