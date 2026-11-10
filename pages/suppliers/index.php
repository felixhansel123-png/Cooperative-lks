<?php
// === TAHAP 1 - CRUD ===
// TODO 1 : session_start();   (TAHAP 3: ganti dengan require middleware + requireAuth())
// TODO 2 : require_once repositories/category-repository.php
// TODO 3 : $categories = getCategories();
// TODO 4 : ambil $_SESSION['errors'] lalu unset()  (untuk pesan gagal hapus)
// === TAHAP 3 - OTORISASI (terakhir) ===
// TODO 5 : $isAdmin = hasRole(['admin']);

$categories = [];
$isAdmin = true;
$errors = [];

$pageTitle = "Manajemen supplier";
$pageSubtitle = "Kelola data supplier koperasi";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>supplier - koperasi</title>
    <link rel="stylesheet" href="../../styles/categories/index.css">
</head>

<body>
    <div class="layout">
        <?php require_once __DIR__ . "/../../components/sidebar.php" ?>

        <main class="main">
            <?php require_once __DIR__ . "/../../components/topbar.php" ?>

            <div class="content">

                <div class="toolbar">
                    <a href="create.php" class="btn btn-primary">+ Tambah supplier</a>
                </div>

                <div class="card">
                    <table>
                        <thead>
                            <tr>
                                <th>supplier_name</th>
                                <th>email</th>
                                <th>phone</th>
                                <th>address</th>
                                <th>product_types</th>
                                <th>partnership_date</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>

</html>