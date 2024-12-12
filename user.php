<?php
// user.php - Главная страница для пользователя
session_start();

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'user') {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель пользователя</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4; /* Светлый фон для контраста */
        }
        h1 {
            margin-bottom: 20px; /* Увеличено расстояние снизу */
            color: #333; /* Темный цвет текста */
        }
        nav {
            margin-bottom: 20px; /* Отступ снизу для навигации */
        }
        ul {
            list-style-type: none; /* Убираем маркеры списка */
            padding: 0; /* Убираем отступы */
        }
        li {
            margin: 10px 0; /* Отступы между элементами списка */
        }
        a {
            text-decoration: none; /* Убираем подчеркивание */
            color: #2E8B57; /* Цвет ссылки */
            font-weight: bold; /* Жирный шрифт для ссылок */
        }
        a:hover {
            text-decoration: underline; /* Подчеркивание при наведении */
        }
    </style>
</head>
<body>
    <h1>Добро пожаловать, Пользователь</h1>
    <nav>
        <ul>
            <li><a href="view_art.php">Посмотреть животных</a></li>
        </ul>
    </nav>
    <a href="logout.php">Выйти</a>
</body>
</html>
