<?php
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    require "database.php";
    $query = $pdo->prepare("INSERT INTO users(username, password_hash) VALUES(?, ?)");
    $query->execute([$username, password_hash($password, PASSWORD_DEFAULT)]);

    header("Location: /management.php");
?>
