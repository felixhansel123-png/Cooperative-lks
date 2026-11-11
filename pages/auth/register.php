<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    header("Location: ../products/index.php");
    exit();
}

$error = $_SESSION['auth_error'] ?? '';

unset($_SESSION['auth_error']);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <h2>Register Member</h2>
    <?php if ($error): ?>
        <p><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form action="../../actions/auth/register.php" method="POST">
        <div>
            <label>Nama</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label>Username</label>
            <input type="text" name="username" required>
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <label>Konfirmasi Password</label>
            <input type="password" name="confirm_password" required>
        </div>
        <button type="submit">Register</button>
    </form>
    <p>Sudah punya akun? <a href="login.php">Login</a></p>
</body>

</html>