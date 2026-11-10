<?php
$title = "Beranda - koperasi";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $title ?>
    </title>
    <link rel="stylesheet" href="styles/index.css">
</head>

<body>
    <?php require_once __DIR__ . "/components/landing/navbar.php" ?>

    <section class="hero">
        <h1>Kelola koperasi dengan rajin</h1>
        <p>Koperasi merah putih 2.0 siap membantu</p>
        <div class="hero-cta">
            <a href="pages/employees/index.php" class="btn btn-outline">Lihat koperasi</a>
        </div>
    </section>

    <section class="features">
        <div class="feature-card">
            <h3>Manajemen Koperasi</h3>
            <p>Admin dapat menambah, mengubah, dan menghapus koperasi.</p>
        </div>
        <div class="feature-card">
            <h3>Manajemen koperasi</h3>
            <p>Setiap koperasi dikelompokkan ke dalam satu koperasi.</p>
        </div>
        <div class="feature-card">
            <h3>Hak Akses</h3>
            <p>Admin mengelola data, member hanya dapat melihat.</p>
        </div>
    </section>

    <?php require_once __DIR__ . "/components/landing/footer.php" ?>
</body>

</html>