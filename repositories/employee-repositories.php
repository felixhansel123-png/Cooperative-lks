<?php
require_once __DIR__ . "/../config/database.php";
function getEmployees()
{
    global $pdo;
    $query = "select * from employees";
    $stmt = $pdo->prepare($query);

    $stmt->execute();

    $employees = $stmt->fetchAll();

    return $employees;
}