<?php
require_once __DIR__ . "/../../config/database.php";

if (isset($_POST['id']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    try {
        $pdo->beginTransaction();
        $query = "DELETE FROM suppliers WHERE supplier_id = :id";// ambil idnya 
        $stmt = $pdo->prepare($query);

        $stmt->execute([
            'id' => $id//delete idnya supplier
        ]);
        $pdo->commit();
        header("Location: ../../pages/employees/index.php");
        exit;
    } catch (PDOException $error) {
        $pdo->rollBack();
        die("Gagal hapus data: " . $error->getMessage());
    }
}
