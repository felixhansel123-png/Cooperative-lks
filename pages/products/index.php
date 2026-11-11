<?php

require_once __DIR__ . "/../../repositories/product-repositories.php";
$products = getProducts();
$errors = [];

$pageTitle = "Manajemen product";
$pageSubtitle = "Kelola data product koperasi";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product - koperasi</title>
    <link rel="stylesheet" href="../../styles/categories/index.css">
</head>

<body>
    <div class="layout">
        <?php require_once __DIR__ . "/../../components/sidebar.php" ?>

        <main class="main">
            <?php require_once __DIR__ . "/../../components/topbar.php" ?>

            <div class="content">
                <div class="toolbar">
                    <a href="create.php" class="btn btn-primary">+ Tambah product</a>
                </div>

                <div class="card">
                    <table>
                        <thead>
                            <tr>
                                <th>product_code</th>
                                <th>product_name</th>
                                <th>category</th>
                                <th>unit</th>
                                <th>price</th>
                                <th>stock</th>
                                <th>entry_date</th>
                                <th>description</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <TBody>
                            <?php if (empty($products)): ?>
                                <tr>
                                    <td colspan="9">Koperasi belum stock barang.</td>
                                </tr>
                            <?php endif; ?>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td colspan="1"><?= $product['product_code'] ?></td>
                                    <td colspan="1"><?= $product['product_name'] ?></td>
                                    <td colspan="1"><?= $product['category'] ?></td>
                                    <td colspan="1"><?= $product['unit'] ?></td>
                                    <td colspan="1"><?= $product['price'] ?></td>
                                    <td colspan="1"><?= $product['stock'] ?></td>
                                    <td colspan="1"><?= $product['entry_date'] ?></td>
                                    <td colspan="1"><?= $product['description'] ?></td>
                                    <td colspan="1">
                                        <a href="edit.php?id=<?= $product['product_id'] ?>" class="btn">Edit</a>
                                        <form action="../../actions/products/delete.php" method="post"
                                            style="display:inline" onsubmit="return confirm('Hapus product ini?')">
                                            <input type="hidden" name="id" value="<?= $product['product_id'] ?>">
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </TBody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>

</html>