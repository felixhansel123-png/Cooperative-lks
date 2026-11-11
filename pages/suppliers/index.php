<?php

require_once __DIR__ . "/../../repositories/supplier-repositories.php";
$suppliers = getSuppliers();
$categories = [];
$isAdmin = true;
$errors = [];

$pageTitle = "Manajemen supplier";
$pageSubtitle = "Kelola data supplier koperasi";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>supplier - koperasi</title>
    <link rel="stylesheet" href="../../styles/categories/index.css">
</head>

<body>
    <div class="layout">
        <?php require_once __DIR__ . "/../../components/sidebar.php" ?>

        <main class="main">
            <?php require_once __DIR__ . "/../../components/topbar.php" ?>

            <div class="content">

                <div class="toolbar">
                    <a href="create.php" class="btn btn-primary">+ Tambah supplier</a>
                </div>

                <div class="card">
                    <table>
                        <thead>
                            <tr>
                                <th>supplier_name</th>
                                <th>email</th>
                                <th>phone</th>
                                <th>address</th>
                                <th>product_types</th>
                                <th>partnership_date</th>
                                <th>Aksi</th>
                            </tr>
                            <?php if (empty($suppliers)): ?>
                                <tr>
                                    <td colspan="7"> Koperasi blm ada supplier</td>
                                </tr>
                            <?php endif; ?>
                            <?php foreach ($suppliers as $supplier): ?>
                                <tr>
                                    <td colspan="1"><?= $supplier['supplier_name'] ?></td>
                                    <td colspan="1"><?= $supplier['email'] ?></td>
                                    <td colspan="1"><?= $supplier['phone'] ?></td>
                                    <td colspan="1"><?= $supplier['address'] ?></td>
                                    <td colspan="1">
                                        <?= implode(', ', json_decode($supplier['product_types'], true) ?? []) ?>
                                    </td>
                                    <td colspan="1"><?= $supplier['partnership_date'] ?></td>
                                    <td colspan="1">
                                        <a href="edit.php?id=<?= $supplier['supplier_id'] ?>" class="btn">Edit</a>
                                        <form action="../../actions/suppliers/delete.php" method="post"
                                            style="display:inline" onsubmit="return confirm('Hapus supplier ini?')">
                                            <input type="hidden" name="id" value="<?= $supplier['supplier_id'] ?>">
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </thead>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>

</html>