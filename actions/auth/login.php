<?php
session_start();

require_once __DIR__ . "/../../config/database.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../pages/auth/login.php");
    exit();
}
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch();
if (!$user || !password_verify($password, $user['password'])) {
    $_SESSION['auth_error'] = "Username atau password salah.";
    header("Location: ../../pages/auth/login.php");
    exit();
}
session_regenerate_id(true);
$_SESSION['user_id'] = $user['user_id'];
$_SESSION['name'] = $user['name'];
$_SESSION['username'] = $user['username'];
$_SESSION['role'] = $user['role'];

header("Location: ../../pages/products/index.php");
exit();
