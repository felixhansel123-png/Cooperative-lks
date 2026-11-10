<?php


$errors = [];
$old = [];

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
        <form method="POST" action="../../actions/employees/store.php" class="card">
          <div class="form-group">
            <label for="employee_number">employee_number</label>
            <input type="text" id="employee_number" name="employee_number">
          </div>
          <div class="form-group">
            <label for="full_name">full_name</label>
            <input type="text" id="full_name" name="full_name" maxlength="100">
          </div>
          <div class="form-group">
            <label>gender</label>
            <?php foreach ($genders as $gender): ?>
              <input type="radio" name="gender" value="<?= $gender ?>"> <?= $gender ?>
            <?php endforeach; ?>
          </div>
          <div class="form-group">
            <label for="birth_date">birth_date</label>
            <input type="date" id="birth_date" name="birth_date">
          </div>
          <div class="form-group">
            <label for="position">position</label>
            <select id="position" name="position">
              <?php foreach ($positions as $position): ?>
                <option value="<?= $position ?>"><?= $position ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="salary">salary</label>
            <input type="number" id="salary" name="salary">
          </div>
          <div class="form-actions">
            <a href="index.php" class="btn btn-outline">Batal</a>
            <button type="submit" name="store" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </main>
  </div>
</body>

</html>