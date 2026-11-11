<?php
require_once __DIR__ . "/../../repositories/supplier-repositories.php";
require_once __DIR__ . "/../../validations/supplier-validation.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../pages/suppliers/index.php");
}

$id = $_POST['id'] ?? '';

if (empty($id)) {
    header("Location: ../../pages/suppliers/index.php");
}

$data = [
    'supplier_name' => trim($_POST['supplier_name'] ?? ''),
    'email' => trim($_POST['email'] ?? ''),
    'phone' => trim($_POST['phone'] ?? ''),
    'address' => trim($_POST['address'] ?? ''),
    'product_types' => $_POST['product_types'] ?? [],
    'partnership_date' => $_POST['partnership_date'] ?? ''
];

$errors = validateSupplier($data, getProductTypes());

if ($errors) {
    setFlash($errors, $data);
    header("Location: ../../pages/suppliers/edit.php?id=$id");
}
try {
    $pdo->beginTransaction();

    $query = "UPDATE suppliers SET
                supplier_name = :supplier_name,
                email = :email,
                phone = :phone,
                address = :address,
                product_types = :product_types,
                partnership_date = :partnership_date
              WHERE supplier_id = :id";

    $stmt = $pdo->prepare($query);

    $stmt->execute([
        'supplier_name' => $data['supplier_name'],
        'email' => $data['email'],
        'phone' => $data['phone'],
        'address' => $data['address'],
        'product_types' => json_encode($data['product_types']),
        'partnership_date' => $data['partnership_date'],
        'id' => $id
    ]);
    $pdo->commit();
    header("Location: ../../pages/suppliers/index.php");
    exit();

} catch (PDOException $error) {
    $pdo->rollBack();
    throw $error;
}
