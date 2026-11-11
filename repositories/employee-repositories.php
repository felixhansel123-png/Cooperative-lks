<?php
require_once __DIR__ . "/helpers.php";

function getEmployees()
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM employees");
    $stmt->execute();
    return $stmt->fetchAll();
}

function getEmployee($id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM employees WHERE employee_id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch() ?: null;
}

function getGenders()
{
    return getEnumOptions('employees', 'gender');
}

function getPositions()
{
    return getEnumOptions('employees', 'position');
}
