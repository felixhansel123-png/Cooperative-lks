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

$pageTitle = "Manajemen product";
$pageSubtitle = "Kelola data product koperasi";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product - koperasi</title>
    <link rel="stylesheet" href="../../styles/categories/index.css">
</head>

<body>
    <div class="layout">
        <?php require_once __DIR__ . "/../../components/sidebar.php" ?>

        <main class="main">
            <?php require_once __DIR__ . "/../../components/topbar.php" ?>

            <div class="content">
                <div class="toolbar">
                    <a href="create.php" class="btn btn-primary">+ Tambah product</a>
                </div>

                <div class="card">
                    <table>
                        <thead>
                            <tr>
                                <th>Deskripsi</th>
                                <th>product_name</th>
                                <th>category</th>
                                <th>unit</th>
                                <th>price</th>
                                <th>stock</th>
                                <th>entry_date</th>
                                <th>description</th>
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