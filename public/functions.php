<?php
$username = "root";
$serverhost = "localhost";
$database = "phpdasar";

$conn = mysqli_connect($serverhost, $username, '', $database);

function query_select($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        array_push($rows, $row);
    }

    return $rows;
}

function delete_data($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = " . $id);
}

function catch_post_and($data, $query_command, $id)
{
    global $conn;

    $nama = htmlspecialchars($data['nama']);
    $email = htmlspecialchars($data['email']);
    $nim = htmlspecialchars($data['nim']);
    $jurusan = htmlspecialchars($data['jurusan']);
    $gambar = upload_img($nama, $nim);

    if (!$gambar) {
        return false;
    }

    if ($query_command == 'UPDATE') {
        $query = "UPDATE mahasiswa SET nama = '" . $nama . "', email = '" . $email . "', nim = '" . $nim . "', jurusan = '" . $jurusan . "', gambar = '" . $gambar . "' WHERE id = '" . $id . "'";
    } else {
        $query = "INSERT INTO mahasiswa VALUES('', '" . $nama . "', '" . $nim . "', '" . $email . "', '" . $jurusan . "', '" . $gambar . "')";
    }

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload_img($nama_mhs, $nim_mhs)
{

    $nama_file = $_FILES['gambar']['name'];
    $ukuran_file = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $nama_tmp = $_FILES['gambar']['tmp_name'];

    if ($error === 4) {
        echo "<script>alert('Image is required')</script>";
        return false;
    }

    $valid_extension = ['jpg', 'jpeg', 'png'];

    $ekstensi_file = explode('.', $nama_file);
    $ekstensi_file = strtolower(end($ekstensi_file));

    if (!in_array($ekstensi_file, $valid_extension)) {
        echo "<script>alert('The Image File extension is only allowed for jpg, jpeg and png')</script>";
        return false;
    }

    if ($ukuran_file > 1000000) {
        echo "<script>alert('The Size of File is too Big')</script>";
        return false;
    }

    move_uploaded_file($nama_tmp, './img/pfp/' . $nama_file . $nama_mhs . $nim_mhs);

    $full_file_name = $nama_file . $nama_mhs . $nim_mhs;

    return $full_file_name;

}