<?php
require_once __DIR__ . "/../../repositories/supplier-repositories.php";

$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);
$supplier = $id ? getSupplier($id) : null;
if (!$supplier) {
  header("Location: index.php");
  exit();
}

$productTypes = getProductTypes();
[$errors, $old] = getFlash();

if ($old) {
  $form = $old;
  $selectedTypes = $old['product_types'];
} else {
  $form = $supplier;
  $selectedTypes = json_decode($supplier['product_types'], true) ?? [];

}

$pageTitle = "Edit supplier";
$pageSubtitle = "Perbarui data supplier";
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit supplier - koperasi</title>
  <link rel="stylesheet" href="../../styles/categories/edit.css">
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

        <form method="POST" action="../../actions/suppliers/update.php" class="card">
          <input type="hidden" name="id" value="<?= $supplier['supplier_id'] ?>">
          <div class="form-group">
            <label for="supplier_name">supplier_name</label>
            <input type="text" id="supplier_name" name="supplier_name" maxlength="100"
              value="<?= e($form['supplier_name']) ?>" required>
          </div>
          <div class="form-group">
            <label for="email">email</label>
            <input type="email" id="email" name="email" maxlength="100" value="<?= e($form['email']) ?>" required>
          </div>
          <div class="form-group">
            <label for="phone">phone</label>
            <input type="tel" id="phone" name="phone" maxlength="15" value="<?= e($form['phone']) ?>" required>
          </div>
          <div class="form-group">
            <label for="address">address</label>
            <textarea id="address" name="address" rows="3" required><?= e($form['address']) ?></textarea>
          </div>
          <div class="form-group">
            <label>product_types</label>
            <?php foreach ($productTypes as $type): ?>
              <input type="checkbox" name="product_types[]" value="<?= e($type) ?>" <?= in_array($type, $selectedTypes, true) ? 'checked' : '' ?>> <?= e($type) ?>
            <?php endforeach; ?>
          </div>
          <div class="form-group">
            <label for="partnership_date">partnership_date</label>
            <input type="date" id="partnership_date" name="partnership_date" max="<?= date('Y-m-d') ?>"
              value="<?= e($form['partnership_date']) ?>" required>
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