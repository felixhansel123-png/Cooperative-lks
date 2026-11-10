<?php
require_once __DIR__ . "/../config/database.php";
function getProducts()
{
    global $pdo;
    $query = "select * from products";
    $stmt = $pdo->prepare($query);

    $stmt->execute();

    $products = $stmt->fetchAll();

    return $products;
}