<?php
    session_start();
    if (!array_key_exists("login", $_SESSION)) {
        echo "access denied";
        exit;
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Управление</title>
        <link rel="stylesheet" href="management.css">
    </head>
    <body>
        <div class="container">
            <div class="form-container">
                <h2>Создать Новый Аккаунт</h2>
                <form action="lib/register.php" method="post">
                    <input type="text" name="username" placeholder="Имя пользователя" required>
                    <input type="password" name="password" placeholder="Пароль" required>
                    <input type="submit" value="Содать Аккаунт">
                </form>
            </div>

            <div class="form-container">
                <h2>Добавить Новый Продукт</h2>
                <form action="lib/add_product.php" method="post">
                    <input type="text" name="name" placeholder="Название" required>
                    <input type="number" name="count" placeholder="Количество" required>
                    <input type="submit" value="Добавить Продукт">
                </form>
            </div>

            <div class="product-list">
                <h2>Список Продуктов</h2>
                <?php
                    require "lib/database.php";
                    $query = $pdo->prepare("SELECT * FROM products");
                    $query->execute();
                    $products = $query->fetchAll(PDO::FETCH_OBJ);
                    foreach ($products as $product) {
                        echo '
                            <div class="product-item">
                                <span>' . $product->name . '</span>
                                <span>Количество: ' . $product->count . '</span>
                                <form action="lib/delete_product.php" method="post">
                                <input type="submit" name="name" value="' . $product->name . '" />
                                <img src="trash.svg" />
                                </form>
                            </div>';
                    }
                ?>
            </div>
        </div>
    </body>
</html>
