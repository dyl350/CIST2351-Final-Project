<?php
session_start();
session_destroy();
setcookie('remember_username', '', time() - 3600, "/");
setcookie('remember_token', '', time() - 3600, "/");
header("Location: index.php");
exit();
?>