<?php
    session_start();
    
    $username = $_POST["username"];
    $password = $_POST["password"];

    require "database.php";
    $query = $pdo->prepare("SELECT password_hash FROM users WHERE username = ?");
    $query->execute([$username]);

    if (password_verify($password, $query->fetch()["password_hash"])) {
        $_SESSION["login"]["username"] = $username;
        header("Location: /management.php");
        exit;
    }

    echo "user does NOT exist"
?>
