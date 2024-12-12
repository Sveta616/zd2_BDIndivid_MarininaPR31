<?php
// register.php - Форма регистрации
session_start();

// Подключение к базе данных
$conn = new mysqli('localhost', 'root', '', 'zoo');
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Проверка существующего пользователя
    $sql = "SELECT id FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<p>Username already exists. Please choose another one.</p>";
    } else {
        // Хэширование пароля
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Добавление нового пользователя
        $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $username, $hashedPassword, $role);

        if ($stmt->execute()) {
            echo "<p>Регистрация успешна!<a href='index.php'></a>.</p>";
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Регистрация</title>
</head>
<body>
    <h1>Регистрация</h1>
    <form action="" method="POST">
        <label for="username">Логин:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="role">Роль:</label>
        <select id="role" name="role">
            <option value="user">Пользователь</option>
            <option value="admin">Админ</option>
        </select><br>

        <button type="submit">Зарегестрироваться</button>
    </form>
    <a href="index.php">Вернуться обратно</a>
</body>
</html>
