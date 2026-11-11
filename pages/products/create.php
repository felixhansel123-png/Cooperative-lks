<?php
require_once __DIR__ . "/../../repositories/product-repositories.php";
require_once __DIR__ . "/../../repositories/helpers.php";

$categories = getCategories();
$units = getUnits();

[$errors, $old] = getFlash();

$pageTitle = "Tambah product";
$pageSubtitle = "Lengkapi data product baru";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah product - koperasi</title>
    <link rel="stylesheet" href="../../styles/categories/create.css">
</head>

<body>
    <div class="layout">
        <?php require_once __DIR__ . "/../../components/sidebar.php" ?>

        <main class="main">
            <?php require_once __DIR__ . "/../../components/topbar.php" ?>

            <div class="content">
                <?php foreach ($errors as $error): ?>
                    <div class="alert alert-error"><?= e($error) ?></div>
                <?php endforeach; ?>
                <form method="POST" action="../../actions/products/store.php" class="card">
                    <div class="form-group">
                        <label for="product_code">product_code</label>
                        <input type="text" id="product_code" name="product_code"
                            maxlength="10" required
                            value="<?= e($old['product_code'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label for="product_name">Nama produk</label>
                        <input type="text" id="product_name" name="product_name"
                            maxlength="100" required
                            value="<?= e($old['product_name'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label for="category">category</label>
                        <select id="category" name="category" required>
                            <option value="">Pilih kategori</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= e($category) ?>"
                                    <?= ($old['category'] ?? '') === $category ? 'selected' : '' ?>>
                                    <?= e($category) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>unit</label>
                        <?php foreach ($units as $unit): ?>
                            <input type="radio" name="unit"
                                value="<?= e($unit) ?>" required
                                <?= ($old['unit'] ?? '') === $unit ? 'checked' : '' ?>>
                            <?= e($unit) ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="form-group">
                        <label for="price">price</label>
                        <input type="number" id="price" name="price"
                            min="0" step="0.01" required
                            value="<?= e($old['price'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label for="stock">stock</label>
                        <input type="number" id="stock" name="stock"
                            min="0" step="1" required
                            value="<?= e($old['stock'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label for="entry_date">entry_date</label>
                        <input type="date" id="entry_date" name="entry_date"
                            required value="<?= e($old['entry_date'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">description</label>
                        <textarea id="description" name="description"
                            rows="3"><?= e($old['description'] ?? '') ?></textarea>
                    </div>
                    <div class="form-actions">
                        <a href="index.php" class="btn btn-outline">Batal</a>
                        <button type="submit" name="store" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
