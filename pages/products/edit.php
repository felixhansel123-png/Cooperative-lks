<?php

require_once __DIR__ . "/../../repositories/product-repositories.php";
require_once __DIR__ . "/../../middleware/auth-check.php";

if ($_SESSION['role'] !== 'Admin') {
  header("Location: ../products/index.php");
  exit();
}
$id = $_GET['id'] ?? null;
$product = getProduct($id);

if (!$product) {
  header("Location: index.php");
  exit();
}

$categories = getCategories();
$units = getUnits();
$errors = [];

if (isset($_GET['error'])) {
  $errors[] = "Semua kolom wajib diisi, kecuali deskripsi.";
}

$pageTitle = "Edit product";
$pageSubtitle = "Perbarui data product";
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit product - koperasi</title>
  <link rel="stylesheet" href="../../styles/categories/edit.css">
</head>

<body>
  <div class="layout">
    <?php require_once __DIR__ . "/../../components/sidebar.php" ?>

    <main class="main">
      <?php require_once __DIR__ . "/../../components/topbar.php" ?>

      <div class="content">
        <?php foreach ($errors as $error): ?>
          <div class="alert alert-error"><?= $error ?></div>
        <?php endforeach; ?>
        <form method="POST" action="../../actions/products/update.php" class="card">
          <input type="hidden" name="id" value="<?= $product['product_id'] ?>">
          <div class="form-group">
            <label for="product_code">product_code</label>
            <input type="text" id="product_code" name="product_code"
              value="<?= htmlspecialchars($product['product_code']) ?>">
          </div>

          <div class="form-group">
            <label for="product_name">Nama produk</label>
            <input type="text" id="product_name" name="product_name"
              value="<?= htmlspecialchars($product['product_name']) ?>">
          </div>

          <div class="form-group">
            <label for="category">category</label>
            <select id="category" name="category">
              <?php foreach ($categories as $category): ?>
                <option value="<?= htmlspecialchars($category) ?>" <?= $category == $product['category'] ? 'selected' : '' ?>>
                  <?= htmlspecialchars($category) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label>unit</label>
            <?php foreach ($units as $unit): ?>
              <input type="radio" name="unit" value="<?= htmlspecialchars($unit) ?>" <?= $unit == $product['unit'] ? 'checked' : '' ?>>
              <?= htmlspecialchars($unit) ?>
            <?php endforeach; ?>
          </div>

          <div class="form-group">
            <label for="price">price</label>
            <input type="number" id="price" name="price" min="0" value="<?= $product['price'] ?>">
          </div>

          <div class="form-group">
            <label for="stock">stock</label>
            <input type="number" id="stock" name="stock" min="0" value="<?= $product['stock'] ?>">
          </div>

          <div class="form-group">
            <label for="entry_date">entry_date</label>
            <input type="date" id="entry_date" name="entry_date" value="<?= $product['entry_date'] ?>">
          </div>

          <div class="form-group">
            <label for="description">description</label>
            <textarea id="description" name="description"
              rows="3"><?= htmlspecialchars($product['description']) ?></textarea>
          </div>

          <div class="form-actions">
            <a href="index.php" class="btn btn-outline">Batal</a>
            <button type="submit" name="update" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>

    </main>
  </div>
</body>

</html>