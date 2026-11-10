<?php
require_once __DIR__ . "/../config/database.php";

function getSuppliers()
{
    global $pdo;
    $query = "select*from suppliers";
    $stmt = $pdo->prepare($query);

    $stmt->execute();
    $suppliers = $stmt->fetchAll();

    return $suppliers;
}