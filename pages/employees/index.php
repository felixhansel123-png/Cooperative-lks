<?php

require_once __DIR__ . "/../../repositories/employee-repositories.php";
$employees = getEmployees();
$isAdmin = true;
$errors = [];

$pageTitle = "Manajemen employee";
$pageSubtitle = "Kelola data employee koperasi";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>employee - koperasi</title>
    <link rel="stylesheet" href="../../styles/categories/index.css">
</head>

<body>
    <div class="layout">
        <?php require_once __DIR__ . "/../../components/sidebar.php" ?>

        <main class="main">
            <?php require_once __DIR__ . "/../../components/topbar.php" ?>

            <div class="content">

                <div class="toolbar">
                    <a href="create.php" class="btn btn-primary">+ Tambah employee</a>
                </div>
                <div class="card">
                    <table>
                        <thead>
                            <tr>
                                <th>employee_number</th>
                                <th>full_name</th>
                                <th>gender</th>
                                <th>birth_date</th>
                                <th>position</th>
                                <th>salary</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($employees)): ?>
                                <tr>
                                    <td colspan="7">Koperasi belum memiliki employee.</td>
                                </tr>
                            <?php endif; ?>
                            <?php foreach ($employees as $employee): ?>
                                <tr>
                                    <td colspan="1"><?= $employee['employee_number'] ?></td>
                                    <td colspan="1"><?= $employee['full_name'] ?></td>
                                    <td colspan="1"><?= $employee['gender'] ?></td>
                                    <td colspan="1"><?= $employee['birth_date'] ?></td>
                                    <td colspan="1"><?= $employee['position'] ?></td>
                                    <td colspan="1"><?= $employee['salary'] ?></td>
                                    <td colspan="1">
                                        <a href="edit.php?id=<?= $employee['employee_id'] ?>" class="btn">Edit</a>
                                        <form action="../../actions/employees/delete.php" method="post"
                                            style="display:inline" onsubmit="return confirm('Hapus employee ini?')">
                                            <input type="hidden" name="id" value="<?= $employee['employee_id'] ?>">
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>

</html>