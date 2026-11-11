<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../config/database.php";

function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function getEnumOptions($table, $column)
{
    global $pdo;
    $stmt = $pdo->prepare(
        "SELECT COLUMN_TYPE AS type
           FROM INFORMATION_SCHEMA.COLUMNS
          WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = :t AND COLUMN_NAME = :c"
    );
    $stmt->execute(['t' => $table, 'c' => $column]);
    $row = $stmt->fetch();
    if (!$row) {
        return [];
    }
    preg_match_all("/'([^']+)'/", $row['type'], $matches);
    return $matches[1];
}

function setFlash(array $errors, array $old = [])
{
    $_SESSION['flash_errors'] = $errors;
    $_SESSION['flash_old'] = $old;
}

function getFlash()
{
    $errors = $_SESSION['flash_errors'] ?? [];
    $old = $_SESSION['flash_old'] ?? [];
    unset($_SESSION['flash_errors'], $_SESSION['flash_old']);
    return [$errors, $old];
}

function isValidDate($date)
{
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') === $date;
}

function isDuplicateError(PDOException $error)
{
    return ($error->errorInfo[1] ?? 0) == 1062;
}
