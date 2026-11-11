<?php
require_once __DIR__ . "/../../repositories/employee-repositories.php";

$genders = getGenders();
$positions = getPositions();

$genderLabels = [
  'M' => 'Laki-laki',
  'F' => 'Perempuan'
];

[$errors, $old] = getFlash();

$pageTitle = "Tambah employee";
$pageSubtitle = "Lengkapi data employee baru";
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah employee - koperasi</title>
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
        <form method="POST" action="../../actions/employees/store.php" class="card">
          <div class="form-group">
            <label for="employee_number">employee_number</label>
            <input type="text" id="employee_number" name="employee_number" maxlength="10" required
              value="<?= e($old['employee_number'] ?? '') ?>">
          </div>
          <div class="form-group">
            <label for="full_name">full_name</label>
            <input type="text" id="full_name" name="full_name" maxlength="100" required
              value="<?= e($old['full_name'] ?? '') ?>">
          </div>
          <div class="form-group">
            <label>gender</label>
            <?php foreach ($genders as $gender): ?>
              <input type="radio" name="gender" value="<?= e($gender) ?>" required <?= ($old['gender'] ?? '') === $gender ? 'checked' : '' ?>>
              <?= e($genderLabels[$gender] ?? $gender) ?>
            <?php endforeach; ?>
          </div>
          <div class="form-group">
            <label for="birth_date">birth_date</label>
            <input type="date" id="birth_date" name="birth_date" required value="<?= e($old['birth_date'] ?? '') ?>">
          </div>
          <div class="form-group">
            <label for="position">position</label>
            <select id="position" name="position" required>
              <option value="">Pilih posisi</option>
              <?php foreach ($positions as $position): ?>
                <option value="<?= e($position) ?>" <?= ($old['position'] ?? '') === $position ? 'selected' : '' ?>>
                  <?= e($position) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="salary">salary</label>
            <input type="number" id="salary" name="salary" min="0" step="0.01" required
              value="<?= e($old['salary'] ?? '') ?>">
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