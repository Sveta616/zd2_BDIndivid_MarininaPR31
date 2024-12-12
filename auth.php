<?php
// auth.php - Обработка авторизации
session_start();

// Подключение к базе данных
$conn = new mysqli('localhost', 'root', '', 'zoo');
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['user_id'] = $user['id'];

        if ($user['role'] === 'admin') {
            header('Location: admin.php');
        } elseif ($user['role'] === 'user') {
            header('Location: user.php');
        }
        exit();
    }
}

// Если авторизация не удалась
header('Location: index.php?error=invalid_credentials');
exit();
