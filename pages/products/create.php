<?php

$errors = [];
$old = [];

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
        <form method="POST" action="../../actions/products/store.php" class="card">
          <div class="form-group">
            <label for="product_code">product_code</label>
            <input type="text" name="product_code" value="">
          </div>
          <div class="form-group">
            <label for="full_name">Nama produk</label>
            <input type="text" name="product_name" value="">
          </div>
          <div class="form-group">
            <label for="category">category</label>
            <select id="category" name="category">
              <?php foreach ($categories as $category): ?>
                <option value="<?= $category ?>"><?= $category ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="unit">unit</label>
            <?php foreach ($units as $unit): ?>
              <input type="radio" name="unit" value="<?= ($unit) ?>">
              <?= ($unit) ?>
            <?php endforeach; ?>
          </div>
          <div class="form-group">
            <label for="price">price</label>
            <input type="number" id="price" name="price" placeholder="Isi data">
          </div>

          <div class="form-group">
            <label for="stock">stock</label>
            <input type="number" id="stock" name="stock" placeholder="Isi data">
          </div>

          <div class="form-group">
            <label for="entry_date">entry_date</label>
            <input type="date" id="entry_date" name="entry_date" placeholder="Isi data">
          </div>

          <div class="form-group">
            <label for="description">description</label>
            <textarea id="description" name="description" rows="3"></textarea>
          </div>

          <div class="form-actions">
            <a href="" class="btn btn-outline">Batal</a>
            <button type="submit" name="store" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>

    </main>
  </div>
</body>

</html>