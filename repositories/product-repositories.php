<?php
session_start();

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
function getProduct($id)
{
    global $pdo;
    $query = "select * from products where product_id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);

    return $stmt->fetch() ?: null;
}
function getEnumValues($table, $column)
{
    global $pdo;
    $query = "SHOW COLUMNS FROM `$table` LIKE '$column'";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch();

    preg_match_all("/'([^']+)'/", $row['Type'], $matches);

    return $matches[1];
}

function getUnits()
{
    return getEnumValues('products', 'unit');
}

function getCategories()
{
    return getEnumValues('products', 'category');
}