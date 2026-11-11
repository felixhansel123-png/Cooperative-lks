<?php
require_once __DIR__ . "/../../repositories/product-repositories.php";
require_once __DIR__ . "/../../validations/product-validation.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../pages/products/index.php");
    exit();
}

$id = $_POST['id'] ?? '';

if (empty($id)) {
    header("Location: ../../pages/products/index.php");
    exit();
}
$data = [
    'product_code' => trim($_POST['product_code'] ?? ''),
    'product_name' => trim($_POST['product_name'] ?? ''),
    'category' => $_POST['category'] ?? '',
    'unit' => $_POST['unit'] ?? '',
    'price' => $_POST['price'] ?? '',
    'stock' => $_POST['stock'] ?? '',
    'entry_date' => $_POST['entry_date'] ?? '',
    'description' => trim($_POST['description'] ?? '')
];
$errors = validateProduct($data);
if (!in_array($data['category'], getCategories(), true)) {
    $errors['category'] = "Kategori tidak valid.";
}
if (!in_array($data['unit'], getUnits(), true)) {
    $errors['unit'] = "Satuan tidak valid.";
}
if (strlen($data['product_code']) > 10) {
    $errors['product_code'] = "Kode produk maksimal 10 karakter.";
}
if (strlen($data['product_name']) > 100) {
    $errors['product_name'] = "Nama produk maksimal 100 karakter.";
}

if ($errors) {
    header("Location: ../../pages/products/edit.php?id=$id&error=1");
    exit();
}
try {
    $pdo->beginTransaction();
    $query = "SELECT product_id FROM products
              WHERE product_code = :product_code
              AND product_id != :id";

    $stmt = $pdo->prepare($query);

    $stmt->execute([
        'product_code' => $data['product_code'],
        'id' => $id
    ]);
    if ($stmt->fetch()) {
        $pdo->rollBack();

        header("Location: ../../pages/products/edit.php?id=$id&error=duplicate");
        exit();
    }
    $query = "UPDATE products SET
                product_code = :product_code,
                product_name = :product_name,
                category = :category,
                unit = :unit,
                price = :price,
                stock = :stock,
                entry_date = :entry_date,
                description = :description
              WHERE product_id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute($data + ['id' => $id]);
    $pdo->commit();
    header("Location: ../../pages/products/index.php");
    exit();
} catch (PDOException $error) {
    $pdo->rollBack();
    throw $error;
}
