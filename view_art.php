<?php
// view_art.php - Просмотр картин
session_start();

if (!isset($_SESSION['user_role'])) {
    header('Location: index.php');
    exit();
}

// Подключение к базе данных
$conn = new mysqli('localhost', 'root', '', 'zoo');
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$sql = "SELECT * FROM allzoo";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Животные</title>
</head>
<body>
    <h1>Список</h1>
    <table>
        <thead>
            <tr>
                <th>Животные</th>
                <th>Описание</th>
                <th>Вес</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['animal']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td><?php echo htmlspecialchars($row['weight']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="<?php echo $_SESSION['user_role'] === 'admin' ? 'admin.php' : 'user.php'; ?>">Вернуться к панели</a>
</body>
</html>
