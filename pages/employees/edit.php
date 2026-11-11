<?php
require_once __DIR__ . "/../../repositories/employee-repositories.php";

$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);
$employee = $id ? getEmployee($id) : null;
if (!$employee) {
  header("Location: index.php");
  exit();
}
$genders = getGenders();
$positions = getPositions();
$genderLabels = ['M' => 'Laki-laki', 'F' => 'Perempuan'];
[$errors, $old] = getFlash();

$form = $old ?: $employee;

$pageTitle = "Edit employee";
$pageSubtitle = "Perbarui data employee";
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit employee - koperasi</title>
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

        <form method="POST" action="../../actions/employees/update.php" class="card">
          <input type="hidden" name="id" value="<?= $employee['employee_id'] ?>">
          <div class="form-group">
            <label for="employee_number">employee_number</label>
            <input type="text" id="employee_number" name="employee_number" maxlength="10"
              value="<?= e($form['employee_number']) ?>" required>
          </div>
          <div class="form-group">
            <label for="full_name">full_name</label>
            <input type="text" id="full_name" name="full_name" maxlength="100" value="<?= e($form['full_name']) ?>"
              required>
          </div>
          <div class="form-group">
            <label>gender</label>
            <?php foreach ($genders as $gender): ?>
              <input type="radio" name="gender" value="<?= e($gender) ?>" <?= $form['gender'] === $gender ? 'checked' : '' ?>
                required>
              <?= e($genderLabels[$gender] ?? $gender) ?>
            <?php endforeach; ?>
          </div>
          <div class="form-group">
            <label for="birth_date">birth_date</label>
            <input type="date" id="birth_date" name="birth_date" max="<?= date('Y-m-d') ?>"
              value="<?= e($form['birth_date']) ?>" required>
          </div>
          <div class="form-group">
            <label for="position">position</label>
            <select id="position" name="position" required>
              <?php foreach ($positions as $position): ?>
                <option value="<?= e($position) ?>" <?= $form['position'] === $position ? 'selected' : '' ?>>
                  <?= e($position) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="salary">salary</label>
            <input type="number" id="salary" name="salary" min="0" step="0.01" value="<?= e($form['salary']) ?>"
              required>
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