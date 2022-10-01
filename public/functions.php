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

    if ($query_command == "UPDATE") {
        $query = "UPDATE mahasiswa SET nama = '" . $nama . "', email = '" . $email . "', nim = '" . $nim . "', jurusan = '" . $jurusan . "', gambar = '" . $gambar . "' WHERE id = '" . $id . "'";
    } else {
        $query = "INSERT INTO mahasiswa VALUES('', '" . $nama . "', '" . $nim . "', '" . $email . "', '" . $jurusan . "', '" . $gambar . "')";
    }

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload_img($nama_mhs, $nim_mhs)
{
    var_dump($_FILES);

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

    $full_file_name = str_replace(' ', '', $nama_mhs . '-' . $nim_mhs . '-' . time());

    move_uploaded_file($nama_tmp, './img/pfp/' . $full_file_name);

    return $full_file_name;

}

function register($data)
{
    global $conn;

    $username = strtolower(stripslashes($data['username']));
    $email = $data['email'];
    $password = mysqli_real_escape_string($conn, $data['password']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);

    if ($password !== $password2) {
        echo "<script>
                alert('Password Confirmation does not match with your Password');
              </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $find_username = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($find_username)) {
        echo "<script>alert('This username has been registered')</script>";
        return false;
    }

    $find_email = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");

    if (mysqli_fetch_assoc($find_email)) {
        echo "<script>alert('This email has been registered')</script>";
        return false;
    }

    $check_total = mysqli_query($conn, "SELECT username FROM user");
    if (mysqli_num_rows($check_total) > 10) {
        echo "<script>alert('The registration form submit has reach its limit, We are sorry that we can not accept more registration than this')</script>";
        return false;
    }

    mysqli_query($conn, "INSERT INTO user VALUES ('', '$username', '$email', '$password', 'NOT VERIVIED')");
    return mysqli_affected_rows($conn);
}