<?php
require 'functions.php';
$data_mhs = query("SELECT * FROM mahasiswa");
?>

<!DOCTYPE html>
<html lang="en" data-theme="corporate">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="./css/styles.css" />
    <title>Document</title>
</head>

<body class='font-poppins'>
    <main class="container max-w-6xl mx-auto px-3">
        <div class="overflow-x-auto">
            <div class="overflow-x-auto">
                <table class="table table-compact w-full">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>NIM</th>
                            <th>Jurusan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $id = 1;
                        foreach ($data_mhs as $mhs) : ?>
                        <tr>
                            <th><?= $id ?></th>
                            <td><?= $mhs['gambar'] ?></td>
                            <td><?= $mhs['nama'] ?></td>
                            <td><?= $mhs['email'] ?></td>
                            <td><?= $mhs['nim'] ?></td>
                            <td><?= $mhs['jurusan'] ?></td>
                            <td>
                                <a href="update.php?data-id=<?= $id ?>" class="btn btn-info btn-sm">Edit</a>
                            </td>
                        </tr>
                        <?php
                            $id++;
                        endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>NIM</th>
                            <th>Jurusan</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </main>
</body>

</html>