<?php
require_once __DIR__ . "/helpers.php";

function getSuppliers()
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM suppliers");
    $stmt->execute();
    return $stmt->fetchAll();
}
function getSupplier($id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM suppliers WHERE supplier_id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch() ?: null;
}
function getProductTypes()
{
    return getEnumOptions('products', 'category');
}
