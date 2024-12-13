<?php
    $name = $_POST["name"];

    include "database.php";
    $query = $pdo->prepare("DELETE FROM products WHERE name = ?");
    $query->execute([$name]);

    header("Location: /management.php");
?>
