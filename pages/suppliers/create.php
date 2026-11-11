<?php
require_once __DIR__ . "/../../repositories/supplier-repositories.php";
require_once __DIR__ . "/../../middleware/auth-check.php";

if ($_SESSION['role'] !== 'Admin') {
  header("Location: ../suppliers/index.php");
  exit();
}
$productTypes = getProductTypes();
[$errors, $old] = getFlash();
$selectedTypes = $old['product_types'] ?? [];

$pageTitle = "Tambah supplier";
$pageSubtitle = "Lengkapi data supplier baru";
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah supplier - koperasi</title>
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
        <form method="POST" action="../../actions/suppliers/store.php" class="card">
          <div class="form-group">
            <label for="supplier_name">supplier_name</label>
            <input type="text" id="supplier_name" name="supplier_name" maxlength="100" required
              value="<?= e($old['supplier_name'] ?? '') ?>">
          </div>
          <div class="form-group">
            <label for="email">email</label>
            <input type="email" id="email" name="email" maxlength="100" required value="<?= e($old['email'] ?? '') ?>">
          </div>
          <div class="form-group">
            <label for="phone">phone</label>
            <input type="tel" id="phone" name="phone" maxlength="15" required value="<?= e($old['phone'] ?? '') ?>">
          </div>
          <div class="form-group">
            <label for="address">address</label>
            <textarea id="address" name="address" rows="3" required><?= e($old['address'] ?? '') ?></textarea>
          </div>
          <div class="form-group">
            <label>product_types</label>
            <?php foreach ($productTypes as $type): ?>
              <input type="checkbox" name="product_types[]" value="<?= e($type) ?>" <?= in_array($type, $selectedTypes, true) ? 'checked' : '' ?>>
              <?= e($type) ?>
            <?php endforeach; ?>
          </div>
          <div class="form-group">
            <label for="partnership_date">partnership_date</label>
            <input type="date" id="partnership_date" name="partnership_date" required
              value="<?= e($old['partnership_date'] ?? '') ?>">
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