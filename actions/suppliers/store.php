<?php
require_once __DIR__ . "/../../repositories/supplier-repositories.php";
require_once __DIR__ . "/../../validations/supplier-validation.php";
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../pages/suppliers/index.php");
    exit();
}

$productTypes = $_POST['product_types'] ?? [];
$data = [
    'supplier_name' => trim($_POST['supplier_name'] ?? ''),
    'email' => trim($_POST['email'] ?? ''),
    'phone' => trim($_POST['phone'] ?? ''),
    'address' => trim($_POST['address'] ?? ''),
    'product_types' => is_array($productTypes) ? $productTypes : [],
    'partnership_date' => $_POST['partnership_date'] ?? ''
];

$errors = validateSupplier($data, getProductTypes());

if ($errors) {
    setFlash($errors, $data);
    header("Location: ../../pages/suppliers/create.php");
    exit();
}
try {
    $pdo->beginTransaction();
    $query = "INSERT INTO suppliers
              (supplier_name, email, phone, address, product_types, partnership_date)
              VALUES
              (:supplier_name, :email, :phone, :address, :product_types, :partnership_date)";

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'supplier_name' => $data['supplier_name'],
        'email' => $data['email'],
        'phone' => $data['phone'],
        'address' => $data['address'],
        'product_types' => json_encode($data['product_types']),
        'partnership_date' => $data['partnership_date']
    ]);
    $pdo->commit();
    header("Location: ../../pages/suppliers/index.php");
    exit();

} catch (PDOException $error) {
    $pdo->rollBack();
    throw $error;
}
