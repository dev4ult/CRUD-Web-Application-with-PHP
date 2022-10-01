<?php
session_start();

if (!isset($_SESSION['login'])) {
    echo "<script>alert('You are not login yet')</script>";
    header("Location: login.php");
    exit;
}

require 'functions.php';

$data_per_page = 5;
$total_page = ceil(count(query_select("SELECT * FROM mahasiswa")) / $data_per_page);
$page_number = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;

if ($page_number < 1) {
    header("Location: index.php");
    exit;
}

$first_data = ($page_number - 1) * $data_per_page;

$data_mhs = query_select("SELECT * FROM mahasiswa LIMIT $first_data, $data_per_page");

if (isset($_POST['tambah-data'])) {
    if (catch_post_and($_POST, "INSERT", 0) > 0) {
        echo "<script>window.location.href='index.php'</script>";

    } else {
        echo "<script>alert('Error Occured When trying to insert a new row of data')</script>";
    }
}

if (isset($_GET['search'])) {
    $key = $_GET['search'];
    $search_query = "SELECT * FROM mahasiswa WHERE
        nama LIKE '%$key%' OR
        nim LIKE '%$key%' OR
        email LIKE '%$key%' OR
        jurusan LIKE '%$key%'";
    $data_mhs = query_select($search_query);
    $total_page = ceil(count($data_mhs) / $data_per_page);
    $data_mhs = query_select($search_query . " LIMIT $first_data, $data_per_page");
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

<body class='font-poppins bg-gray-100 h-screen py-10'>
    <main class="container max-w-6xl mx-auto px-3">
        <div class="flex gap-4">
            <a href="index.php" class="bg-black rounded-sm btn-sm flex items-center justify-center">
                <img class="w-5" src="./img/logo/home.svg" alt="home logo">
            </a>
            <!-- add data button -->
            <label for="add-button" class="btn modal-button btn-success btn-sm text-white">Tambah
                Mahasiswa</label>

            <div class="form-control">
                <div class="input-group">
                    <input type="text" id="search-keyword" placeholder="Search…"
                        class="input input-sm input-bordered bg-gray-100" />
                    <button id="search-btn" class="btn btn-sm btn-square text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </div>

            <a href="logout.php" class="btn btn-sm ml-auto ">Log out</a>
        </div>
        <div class="overflow-x-auto w-full shadow-md  my-5">
            <table class="table w-full">
                <!-- head -->
                <thead>
                    <tr>
                        <th class="rounded-none bg-black text-white">Nama / Email</th>
                        <th class="bg-black text-white">Jurusan / NIM</th>
                        <th class="rounded-none bg-black"></th>
                    </tr>
                </thead>
                <tbody id="data-container">
                    <?php $list_num = 1;foreach ($data_mhs as $mhs): ?>
                    <tr>
                        <td class="rounded-none">
                            <div class="flex items-center space-x-3">
                                <div class="avatar">
                                    <div class="mask mask-squircle w-12 h-12">
                                        <img src="./img/pfp/<?=$mhs['gambar']?>" alt="<?=$mhs['nama']?> profile pic">
                                    </div>
                                </div>
                                <div>
                                    <div class="font-bold"><?=$mhs['nama']?></div>
                                    <div class="text-sm opacity-50"><?=$mhs['email']?></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <?=$mhs['jurusan']?>
                            <br />
                            <span class="badge badge-ghost badge-sm"><?=$mhs['nim']?></span>
                        </td>
                        <th class="rounded-none">
                            <a href="detail.php?data-id=<?=$mhs['id']?>" class="btn btn-ghost btn-xs">details</a>
                        </th>
                    </tr>
                    <?php $list_num++;endforeach?>
                </tbody>
            </table>
        </div>
        <div>
            <?php if ($total_page > 1): ?>
            <div class="btn-group btn-pagination">
                <?php for ($i = 1; $i <= $total_page; $i++): ?>
                <?php if ((!isset($_GET['page']) || $_GET['page'] == 1) && $i == 1): ?>
                <a href="index.php?<?=(isset($_GET['search'])) ? "search=" . $_GET['search'] . "&" : ""?>page=<?=$i?>"
                    class="btn btn-sm btn-success text-white"><?=$i?></a>
                <?php elseif (isset($_GET['page']) && $_GET['page'] == $i): ?>
                <a href="index.php?<?=(isset($_GET['search'])) ? "search=" . $_GET['search'] . "&" : ""?>page=<?=$i?>"
                    class="btn btn-sm btn-success text-white"><?=$i?></a>
                <?php else: ?>
                <a href="index.php?<?=(isset($_GET['search'])) ? "search=" . $_GET['search'] . "&" : ""?>page=<?=$i?>"
                    class="btn btn-sm"><?=$i?></a>
                <?php endif?>
                <?php endfor;?>
            </div>
            <?php endif;?>
        </div>
    </main>

    <!-- add data modal -->
    <input type="checkbox" id="add-button" class="modal-toggle" />
    <div class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="font-bold text-lg mb-4">Form Tambah Mahasiswa</h3>
            <form class="flex flex-col gap-4" action="" method="post" enctype="multipart/form-data">
                <div class="form-control grid grid-cols-2 w-full gap-4">
                    <label class="input-group input-group-sm">
                        <input type="text" placeholder="Nama" class="input input-bordered input-md w-full"
                            name="nama" />
                    </label>
                    <label class="input-group input-group-sm">
                        <input type="email" placeholder="Email" class="input input-bordered input-md w-full"
                            name="email" />
                    </label>
                </div>
                <div class="form-control">
                    <select class="select focus:outline-none w-full pl-4 border-2 border-gray-200 font-normal"
                        name="jurusan">
                        <option disabled selected>Pilih Jurusan</option>
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
                        <input type="number" placeholder="NIM" class="input input-bordered input-md w-full"
                            name="nim" />
                    </label>
                    <label class="input-group input-group-sm">
                        <span class="w-full btn bg-black" id="file-name">Pilih Gambar</span>
                        <input type="file" id="file-img" class="w-full hidden" name="gambar" />
                    </label>
                </div>
                <div class="modal-action mt-4">
                    <input type="submit" value="Submit" class="btn btn-sm btn-success text-white" name="tambah-data">
                </div>
            </form>
            <div class="modal-action absolute top-0 right-0 m-6">
                <label for="add-button" class="btn btn-square btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </label>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
</body>

</html>