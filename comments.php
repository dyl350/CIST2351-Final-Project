<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comment = $_POST['comment'];
    $username = $_SESSION['username'];

    $comments = [];
    if (file_exists('database.sql')) {
        $comments = json_decode(file_get_contents('database.sql'), true);
    }

    $comments[] = ['username' => $username, 'comment' => $comment];

    file_put_contents('database.sql', json_encode($comments));

    header("Location: index.php");
    exit();
}
?>