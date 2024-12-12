<?php
// index.php - Стартовая страница для авторизации
session_start();

if (isset($_SESSION['user_role'])) {
    if ($_SESSION['user_role'] === 'admin') {
        header('Location: admin.php');
        exit();
    } elseif ($_SESSION['user_role'] === 'user') {
        header('Location: user.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Авторизация</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        h1, a {
            margin: 10px 0; /* Уменьшено расстояние между заголовками и полями ввода */
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center; /* Центрирование полей ввода */
        }
        input {
            margin: 5px 0; /* Уменьшено расстояние между полями ввода */
            text-align: center; /* Центрирование текста в полях ввода */
        }
    </style>
</head>
<body>
    <h1>Авторизация</h1>
    <?php if (isset($_GET['error'])): ?>
        <p style="color: red;">Неверно введены данные, попробуйте снова</p>
    <?php endif; ?>
    <form action="auth.php" method="POST">
        <label for="username">Логин:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Войти</button>
    </form>
    <a href="register.php">Регистрация</a>
</body>
</html>
