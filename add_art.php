<?php
// add_art.php - Форма добавления картины
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Подключение к базе данных
    $conn = new mysqli('localhost', 'root', '', 'zoo');
    if ($conn->connect_error) {
        die('Database connection failed: ' . $conn->connect_error);
    }

    $animal = $_POST['animal'];
    $description = $_POST['description'];
    $weight = $_POST['weight'];

    $sql = "INSERT INTO allzoo(`animal`,`description`,`weight`) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param("ssi", $animal, $description, $weight);

    if ($stmt->execute()) {
        echo "<p>Животное добавлено успешно!</p>";
    } else {
        echo "<p>Ошибка добавления: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Добавить животное</title>
</head>
<body>
    <h1>Добавить новое животное</h1>
    <form action="" method="POST">
        <label for="animal">Название животного:</label>
        <input type="text" id="animal" name="animal" required><br>

        <label for="description">Описание:</label>
        <input type="text" id="description" name="description" required><br>

        <label for="weight">Вес:</label>
        <input type="number" id="weight" name="weight" required><br>

        <button type="submit">Добавить животное</button>
    </form>
    <a href="admin.php">Вернуться к панели</a>
</body>
</html>
