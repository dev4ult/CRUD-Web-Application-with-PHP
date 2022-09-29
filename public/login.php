<?php

session_start();
require 'functions.php';

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION['login'])) {
    echo "<script>alert('You are already login')</script>";
    header("Location: index.php");
    exit;
}

if (isset($_POST['login'])) {
    $umail = $_POST['umail'];
    $password = $_POST['password'];

    $username_check = mysqli_query($conn, "SELECT * FROM user WHERE username = '$umail'");
    $email_check = mysqli_query($conn, "SELECT * FROM user WHERE email = '$umail'");

    if (mysqli_num_rows($username_check) || mysqli_num_rows($email_check)) {
        $row = mysqli_fetch_assoc($username_check);
        if (!$row) {
            $row = mysqli_fetch_assoc($email_check);
        }

        if (password_verify($password, $row['password'])) {
            echo "<script>alert('Login Berhasil')</script>";
            $_SESSION['login'] = true;

            if (isset($_POST['remember-me'])) {

                setcookie('id', $row['id'], time() + 60);
                setcookie('id', hash('sha256', $row['username']), time() + 60);
            }

            header("Location: index.php");
            exit;
        } else {
            echo "<h2 class='text-red-500 italic'>username atau password salah</h2>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en" data-theme="corporate">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <main class="container max-w-6xl mx-auto px-3 h-screen flex items-center justify-center">
        <form action="" method="post">
            <div class="form-control">
                <label class="input-group input-group-md">
                    <span>username / email</span>
                    <input type="text" placeholder="Type here" class="input input-bordered input-md" name="umail" />
                </label>
            </div>
            <div class="form-control">
                <label class="input-group input-group-md">
                    <span>password</span>
                    <input type="password" placeholder="Type here" class="input input-bordered input-md"
                        name="password" />
                </label>
            </div>
            <div class="form-control">
                <label class="label cursor-pointer">
                    <span class="label-text">Remember me</span>
                    <input type="checkbox" class="checkbox checkbox-primary" name="remember-me" />
                </label>
            </div>
            <div>
                <input type="submit" value="Login" class="btn btn-success btn-sm" name="login">
            </div>
        </form>
    </main>
</body>

</html>