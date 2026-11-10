<?php


$categories = [];
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
                                <th>full_name</th>
                                <th>employee_number</th>
                                <th>gender</th>
                                <th>birth_date</th>
                                <th>position</th>
                                <th>salary</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>

</html>