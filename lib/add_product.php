<?php
    $name = $_POST["name"];
    //$address = $_POST["address"];
    $count = $_POST["count"];
    //$expiration_date = $_POST["expiration_date"];
    //$size = $_POST["size"];

    require "database.php";
    $query = $pdo->prepare("SELECT count FROM products WHERE name = ?");
    $query->execute([$name]);
    $old_count = $query->fetch()["count"];

    if ($query->rowCount() != 0) {
        $query = $pdo->prepare("UPDATE products SET count = ? WHERE name = ?");
        $query->execute([$old_count + $count, $name]);
    }
    else {
        //$query = $pdo->prepare("INSERT INTO products(name, address, count, expiration_date, size) VALUES(?, ?, ?, ?, ?)");
        $query = $pdo->prepare("INSERT INTO products(name, count) VALUES(?, ?)");
        //$query->execute([$name, $address, $count, $expiration_date, $size]);
        $query->execute([$name, $count]);
    }

    header("Location: /management.php");
?>
