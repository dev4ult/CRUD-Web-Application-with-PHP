<?php
require 'functions.php';
$data_mhs = query_select("SELECT * FROM mahasiswa");

if (isset($_POST['tambah-data'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $nim = htmlspecialchars($_POST['nim']);
    $jurusan = htmlspecialchars($_POST['jurusan']);
    $gambar = htmlspecialchars($_POST['gambar']);

    query_dml("INSERT INTO mahasiswa VALUES('', '" . $nama . "', '" . $nim . "', '" . $email . "', '" . $jurusan . "', '" . $gambar . "')");
    echo "<script>window.location.href='index.php'</script>";
}
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
    <title>Tabel Mahasiswa</title>
</head>

<body class='font-poppins'>
    <main class="container max-w-6xl mx-auto px-3">
        <!-- The button to open modal -->
        <label for="add-button" class="btn modal-button btn-sm btn-success hover:bg-green-500 text-white my-5">Tambah
            Mahasiswa</label>

        <!-- Put this part before </body> tag -->
        <input type="checkbox" id="add-button" class="modal-toggle" />
        <div class="modal modal-bottom sm:modal-middle">
            <div class="modal-box">
                <h3 class="font-bold text-lg mb-4">Form Tambah Mahasiswa</h3>
                <form class="flex flex-col gap-2 " action="" method="post">
                    <div class="form-control ">
                        <label class="input-group input-group-sm">
                            <span>Nama</span>
                            <input type="text" placeholder="Nama" class="input input-bordered input-md w-full"
                                name="nama" />
                        </label>
                    </div>
                    <div class="form-control ">
                        <label class="input-group input-group-sm">
                            <span>Email</span>
                            <input type="text" placeholder="Email" class="input input-bordered input-md w-full"
                                name="email" />
                        </label>
                    </div>
                    <div class="form-control ">
                        <label class="input-group input-group-sm">
                            <span>NIM</span>
                            <input type="text" placeholder="NIM" class="input input-bordered input-md w-full"
                                name="nim" />
                        </label>
                    </div>
                    <div class="form-control ">
                        <label class="input-group input-group-sm">
                            <span>Jurusan</span>
                            <input type="text" placeholder="Jurusan" class="input input-bordered input-md w-full"
                                name="jurusan" />
                        </label>
                    </div>
                    <div class="form-control ">
                        <label class="input-group input-group-sm">
                            <span>Gambar</span>
                            <input type="text" placeholder="Gambar" class="input input-bordered input-md w-full"
                                name="gambar" />
                        </label>
                    </div>
                    <div class="modal-action">
                        <input type="submit" value="Tambah" class="btn btn-sm btn-success text-white"
                            name="tambah-data">
                    </div>
                </form>
            </div>
        </div>
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
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $id = 1;
foreach ($data_mhs as $mhs): ?>
                    <tr>
                        <th><?=$id?></th>
                        <td><?=$mhs['gambar']?></td>
                        <td><?=$mhs['nama']?></td>
                        <td><?=$mhs['email']?></td>
                        <td><?=$mhs['nim']?></td>
                        <td><?=$mhs['jurusan']?></td>
                        <td>
                            <a href="detail.php?data-id=<?=$id?>" class="btn btn-info btn-sm text-white">Edit</a>
                        </td>
                    </tr>
                    <?php
$id++;
endforeach?>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>NIM</th>
                        <th>Jurusan</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </main>
</body>

</html>