<?php
session_start();

require_once __DIR__ . "/../../config/database.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../pages/auth/register.php");
    exit();
}
$name = trim($_POST['name'] ?? '');
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';
if ($name === '' || $username === '' || $password === '' || $confirmPassword === '') {
    $_SESSION['auth_error'] = "Semua kolom wajib diisi.";
    header("Location: ../../pages/auth/register.php");
    exit();
}
if ($password !== $confirmPassword) {
    $_SESSION['auth_error'] = "Password tidak cocok.";
    header("Location: ../../pages/auth/register.php");
    exit();
}
if (strlen($password) < 6) {
    $_SESSION['auth_error'] = "Password minimal 6 karakter.";
    header("Location: ../../pages/auth/register.php");
    exit();
}
$stmt = $pdo->prepare("SELECT user_id FROM users WHERE username = :username");
$stmt->execute(['username' => $username]);
if ($stmt->fetch()) {
    $_SESSION['auth_error'] = "Username sudah digunakan.";
    header("Location: ../../pages/auth/register.php");
    exit();
}
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$query = "INSERT INTO users (name, username, password, role)
          VALUES (:name, :username, :password, 'member')";

$stmt = $pdo->prepare($query);
$stmt->execute([
    'name' => $name,
    'username' => $username,
    'password' => $hashedPassword
]);
$_SESSION['auth_success'] = "Register berhasil. Silakan login.";

header("Location: ../../pages/auth/login.php");
exit();
