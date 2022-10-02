<?php
require 'functions.php';

if (isset($_GET['data-id'])) {
    $id = $_GET['data-id'];
    try {
        $selected_mhs = query_select("SELECT * FROM mahasiswa WHERE id = $id")[0];
    } catch (Exception $e) {
        $id = (int) $id;
        header("Location: detail.php?data-id=$id");
        exit;
    }

    if ($selected_mhs) {
        $mhs_id = $selected_mhs['id'];
        $nama = $selected_mhs['nama'];
        $email = $selected_mhs['email'];
        $nim = $selected_mhs['nim'];
        $jurusan = $selected_mhs['jurusan'];
        $gambar = $selected_mhs['gambar'];

        if (isset($_GET['delete'])) {
            unlink('./img/pfp/' . $gambar);

            delete_data($mhs_id);
            echo "<script>window.location.href = 'index.php'</script>";
        }
    } else {
        header("Location: index.php");
        exit;
    }
}

if (isset($_POST['save-data'])) {
    if (catch_post_and($_POST, "UPDATE", $mhs_id) > 0) {
        unlink('./img/pfp/' . $gambar);
        echo "<script>alert('This Data has been changed')</script>";
    } else {
        echo "<script>alert('Error Occured When trying to update a row of data')</script>";
    }
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

<body class="font-poppins bg-gray-100">
    <main class="container px-3 max-w-6xl mx-auto h-screen flex justify-center py-10">
        <div class="w-fit p-3 flex flex-col gap-2">
            <a class="btn w-fit btn-sm" href="index.php">
                <img src="./img/logo/back-arrow.svg" alt="back button" class="w-5">
            </a>
            <?php if (isset($_GET['data-id'])): ?>
            <div class="stats stats-vertical lg:stats-horizontal shadow">
                <div class="stat">
                    <div class="stat-title">Nama / Email</div>
                    <div class="stat-value whitespace-normal max-w-sm">
                        <p class="break-words"><?=$nama?></p>
                    </div>
                    <div class="stat-desc text-lg"><?=$email?></div>
                </div>
                <div class="stat flex items-center justify-center">
                    <div>
                        <img src="./img/pfp/<?=$gambar?>" alt="Profile Picture" class="w-32">
                    </div>
                </div>
            </div>
            <div class="stats stats-vertical lg:stats-horizontal shadow">
                <div class="stat">
                    <div class="stat-title">NIM / Jurusan</div>
                    <div class="stat-value"><?=$nim?></div>
                    <div class="stat-desc text-lg"><?=$jurusan?></div>
                </div>
            </div>
            <div class="flex gap-2">
                <!-- update-button -->
                <label for="update-data" class="btn btn-sm modal-button btn-success text-white">Edit</label>
                <!-- delete button -->
                <label for="delete-data" class="btn btn-sm modal-button text-white">Delete</label>
            </div>
            <?php else: ?>
            <h1 class='text-3xl font-semibold bg-red-500 text-white px-3 py-1'>There is no data can be showed</h1>
            <?php endif?>
        </div>
    </main>
    <!-- update modal -->
    <input type="checkbox" id="update-data" class="modal-toggle" />
    <div class="modal modal-bottom sm:modal-middle">
        <div class="modal-box relative">
            <h3 class="font-bold text-lg mb-8">Form Ubah Data</h3>
            <form class="flex flex-col gap-2" action="" method="post" enctype="multipart/form-data">
                <div class="form-control grid grid-cols-2 w-full gap-4">
                    <label class="input-group input-group-sm">
                        <input type="text" placeholder="Nama" class="input input-bordered input-md w-full" name="nama"
                            value="<?=$nama?>" />
                    </label>
                    <label class="input-group input-group-sm">
                        <input type="email" placeholder="Email" class="input input-bordered input-md w-full"
                            name="email" value="<?=$email?>" />
                    </label>
                </div>
                <div class="form-control">
                    <select class="select focus:outline-none w-full pl-4 border-2 border-gray-200 font-normal"
                        name="jurusan">
                        <option selected><?=$jurusan?></option>
                        <option value="Teknik Informatika dan Komputer">Teknik Informatika dan Komputer</option>
                        <option value="Teknik Elektro">Teknik Elektro</option>
                        <option value="Administrasi Niaga">Administrasi Niaga</option>
                        <option value="Teknik Sipil">Teknik Sipil</option>
                        <option value="Teknik Mesin">Teknik Mesin</option>
                        <option value="Akuntansi">Akuntansi</option>
                        <option value="Teknik Grafika dan Penerbitan">Teknik Grafika dan Penerbitan</option>
                    </select>
                </div>
                <div class="form-control grid grid-cols-2 w-full gap-4">
                    <label class="input-group input-group-sm">
                        <input type="number" placeholder="NIM" class="input input-bordered input-md w-full" name="nim"
                            value="<?=$nim?>" />
                    </label>
                    <label class="input-group input-group-sm">
                        <span class="w-full btn bg-black" id="file-name"><?=$gambar?></span>
                        <input type="file" id="file-img" class="w-full hidden" name="gambar" />
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
        <div class="modal-box sm:max-w-[21.8rem]">
            <h3 class="font-bold text-lg">Are you sure you want to delete?</h3>
            <div class="modal-action">
                <a href="detail.php?data-id=<?=$_GET['data-id']?>&delete"
                    class="btn btn-success btn-sm w-fit text-white">Confirm</a>
                <label for="delete-data" class="btn btn-sm">Cancel</label>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
</body>

</html>