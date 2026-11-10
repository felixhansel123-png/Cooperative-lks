<?php
require_once __DIR__ . "/../../config/database.php";

if (isset($_POST['id']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    try {
        $pdo->beginTransaction();
        $query = "DELETE FROM products WHERE product_id = :id";// ambil idnya 
        $stmt = $pdo->prepare($query);

        $stmt->execute([
            'id' => $id//delete idnya produk
        ]);
        $pdo->commit();
        header("Location: ../../pages/products/index.php");
        exit;
    } catch (PDOException $error) {
        $pdo->rollBack();
        die("Gagal hapus data: " . $error->getMessage());
    }
}
