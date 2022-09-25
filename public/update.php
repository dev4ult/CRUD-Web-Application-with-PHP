<?php
require 'functions.php';

$data_mhs = query("SELECT * FROM mahasiswa");

if (isset($_GET['data-id'])) {
    $id = 1;
    while ($id < sizeof($data_mhs)) {
        if ($id == $_GET['data-id']) {
            $info = $data_mhs[$id];
            break;
        }
        $id++;
    }

    $nama = $info['nama'];
    $email = $info['email'];
    $nim = $info['nim'];
    $jurusan = $info['jurusan'];
    $gambar = $info['gambar'];
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="corporate">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Document</title>
</head>

<body class="font-poppins">
    <main class="container px-3 max-w-6xl mx-auto">
        <?php if (isset($_GET['data-id'])) : ?>
        <div class="stats stats-vertical lg:stats-horizontal shadow">

            <div class="stat">
                <div class="stat-title">Nama / Email</div>
                <div class="stat-value"><?= $nama ?></div>
                <div class="stat-desc text-lg"><?= $email ?></div>
            </div>

            <div class="stat">
                <div class="stat-title">NIM / Jurusan</div>
                <div class="stat-value"><?= $nim ?></div>
                <div class="stat-desc text-lg"><?= $jurusan ?></div>
            </div>

        </div>
        <?php else : ?>

        <?php endif ?>

    </main>
</body>

</html>