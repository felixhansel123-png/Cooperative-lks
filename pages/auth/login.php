<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    header("Location: ../products/index.php");
    exit();
}

$error = $_SESSION['auth_error'] ?? '';
$success = $_SESSION['auth_success'] ?? '';

unset($_SESSION['auth_error'], $_SESSION['auth_success']);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h2>Login Koperasi</h2>
    <?php if ($error): ?>
        <p><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <?php if ($success): ?>
        <p><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>
    <form action="../../actions/auth/login.php" method="POST">

        <div>
            <label>Username</label>
            <input type="text" name="username" required>
        </div>

        <div>
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit">Login</button>

    </form>

    <p>Belum punya akun? <a href="register.php">Register</a></p>

</body>

</html>