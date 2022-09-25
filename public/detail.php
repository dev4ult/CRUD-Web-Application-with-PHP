<?php
require 'functions.php';

$data_mhs = query_select("SELECT * FROM mahasiswa");

if (isset($_GET['data-id'])) {
    $id = $_GET['data-id'];
    if ($id >= 1 && $id <= sizeof($data_mhs)) {
        $info = $data_mhs[$_GET['data-id'] - 1];

        $mhs_id = $info['id'];
        $nama = $info['nama'];
        $email = $info['email'];
        $nim = $info['nim'];
        $jurusan = $info['jurusan'];
        $gambar = $info['gambar'];

        if (isset($_GET['delete'])) {
            query_dml("DELETE FROM mahasiswa WHERE id = " . $mhs_id);
            echo "<script>window.location.href = 'index.php';</script>";
        }
    }
}

if (isset($_POST['save-data'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $nim = htmlspecialchars($_POST['nim']);
    $jurusan = htmlspecialchars($_POST['jurusan']);
    $gambar = htmlspecialchars($_POST['gambar']);

    query_dml("UPDATE mahasiswa SET nama = '" . $nama . "', email = '" . $email . "', nim = '" . $nim . "', jurusan = '" . $jurusan . "', gambar = '" . $gambar . "' WHERE id = '" . $mhs_id . "'");
    echo "<script>window.location.href='detail.php?data-id=" . $id . "'</script>";
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
        <div class="shadow-lg w-fit p-3 flex flex-col">
            <a class="btn btn-warning w-fit mb-4" href="index.php">
                <img src="./img/logo/back-arrow.svg" alt="back button" class="w-8">
            </a>
            <?php if (isset($_GET['data-id']) && $_GET['data-id'] >= 1 && $_GET['data-id'] <= sizeof($data_mhs)): ?>
            <div class="stats stats-vertical lg:stats-horizontal shadow">

                <div class="stat">
                    <div class="stat-title">Nama / Email</div>
                    <div class="stat-value"><?=$nama?></div>
                    <div class="stat-desc text-lg"><?=$email?></div>
                </div>

                <div class="stat">
                    <div class="stat-title">NIM / Jurusan</div>
                    <div class="stat-value"><?=$nim?></div>
                    <div class="stat-desc text-lg"><?=$jurusan?></div>
                </div>

            </div>
            <div class="flex">
                <!-- update-button -->
                <label for="update-data" class="btn modal-button btn-primary text-white w-1/2">Edit</label>
                <!-- delete button -->
                <label for="delete-data"
                    class="btn modal-button btn-error text-white w-1/2 bg-red-500 hover:bg-red-700">Delete</label>
            </div>
        </div>
        <!-- update modal -->
        <input type="checkbox" id="update-data" class="modal-toggle" />
        <div class="modal modal-bottom sm:modal-middle">
            <div class="modal-box relative">
                <h3 class="font-bold text-lg mb-8">Form Ubah Data</h3>
                <form class="flex flex-col gap-2" action="" method="post">
                    <div class="form-control ">
                        <label class="input-group input-group-sm">
                            <span>Nama</span>
                            <input type="text" placeholder="Nama" class="input input-bordered input-md w-full"
                                name="nama" value="<?=$nama?>" />
                        </label>
                    </div>
                    <div class="form-control ">
                        <label class="input-group input-group-sm">
                            <span>Email</span>
                            <input type="text" placeholder="Email" class="input input-bordered input-md w-full"
                                name="email" value="<?=$email?>" />
                        </label>
                    </div>
                    <div class="form-control ">
                        <label class="input-group input-group-sm">
                            <span>NIM</span>
                            <input type="text" placeholder="NIM" class="input input-bordered input-md w-full" name="nim"
                                value="<?=$nim?>" />
                        </label>
                    </div>
                    <div class="form-control ">
                        <label class="input-group input-group-sm">
                            <span>Jurusan</span>
                            <input type="text" placeholder="Jurusan" class="input input-bordered input-md w-full"
                                name="jurusan" value="<?=$jurusan?>" />
                        </label>
                    </div>
                    <div class="form-control ">
                        <label class="input-group input-group-sm">
                            <span>Gambar</span>
                            <input type="text" placeholder="Gambar" class="input input-bordered input-md w-full"
                                name="gambar" value="<?=$gambar?>" />
                        </label>
                    </div>
                    <div class="modal-action">
                        <input type="submit" value="Save" class="btn btn-sm btn-success text-white" name="save-data">
                    </div>
                </form>
                <div class="modal-action absolute top-0 right-0 m-6">
                    <label for="update-data" class="btn p-0 btn-square btn-sm">
                        <img src="./img/logo/close.svg" alt="close button" class="w-6">
                    </label>
                </div>
            </div>
        </div>

        <!-- delete modal -->
        <input type="checkbox" id="delete-data" class="modal-toggle" />
        <div class="modal modal-bottom sm:modal-middle">
            <div class="modal-box">
                <h3 class="font-bold text-lg">Are you sure you want to delete?</h3>
                <div class="modal-action">
                    <a href="detail.php?data-id=<?=$_GET['data-id']?>&delete"
                        class="btn btn-success btn-sm w-fit text-white">Confirm</a>
                    <label for="delete-data" class="btn btn-error btn-outline btn-sm">Cancel</label>
                </div>
            </div>
        </div>
        <?php else: ?>
        <h1 class='text-3xl font-semibold bg-red-500 text-white px-3 py-1'>There is no data can be showed</h1>
        <?php endif?>




    </main>
</body>

</html>