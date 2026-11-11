<?php
require_once __DIR__ . "/../../repositories/product-repositories.php";
require_once __DIR__ . "/../../repositories/helpers.php";
require_once __DIR__ . "/../../validations/product-validation.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
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
if ($errors) {
    setFlash(array_values($errors), $data);
    header("Location: ../../pages/products/create.php");
    exit();
}
try {
    $pdo->beginTransaction();
    $query = "SELECT product_id FROM products
              WHERE product_code = :product_code";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'product_code' => $data['product_code']
    ]);
    if ($stmt->fetch()) {
        $pdo->rollBack();

        setFlash(["Kode produk sudah digunakan."], $data);
        header("Location: ../../pages/products/create.php");
        exit();
    }

    $query = "INSERT INTO products
              (product_code, product_name, category, unit, price, stock, entry_date, description)
              VALUES
              (:product_code, :product_name, :category, :unit, :price, :stock, :entry_date, :description)";

    $stmt = $pdo->prepare($query);
    $stmt->execute($data);

    $pdo->commit();

    header("Location: ../../pages/products/index.php");
    exit();

} catch (PDOException $error) {
    $pdo->rollBack();
    throw $error;
}
