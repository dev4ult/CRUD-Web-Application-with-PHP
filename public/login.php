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

                setcookie('id', $row['id'], time() + 3600);
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <main class="container max-w-6xl mx-auto px-3 h-screen flex items-center justify-center font-poppins">
        <form action="" method="post" class="p-8 rounded-lg shadow-lg border-2 border-gray-100 max-w-[22rem]">
            <div class="text-center mb-7">
                <h1 class="text-2xl font-bold mb-2">Login as admin</h1>
                <p class="text-sm">Enter your details to get sign in to your account</p>
            </div>
            <div class="form-control">
                <label class="input-group input-group-sm">
                    <span class="btn-success"><img src="./img/logo/user.svg" alt="user logo" class="w-8"></span>
                    <input type="text" placeholder="Username / Email" class="input input-bordered input-md w-full"
                        name="umail" />
                </label>
            </div>
            <div class="form-control my-3">
                <label class="input-group input-group-md">
                    <span class="btn-success"><img src="./img/logo/password.svg" alt="asterisk logo" class="w-8"></span>
                    <input type="password" placeholder="Password" class="input input-bordered input-md w-full"
                        name="password" />
                </label>
            </div>
            <div class="form-control">
                <label class="label cursor-pointer w-fit">
                    <span class="label-text mr-1.5 font-bold">Remember me</span>
                    <input type="checkbox" class="checkbox checkbox-accent h-4 w-4" name="remember-me" />
                </label>
            </div>
            <div class="mb-4 mt-6">
                <button type="submit" class="btn-success rounded-sm w-full text-white text-lg py-2 font-semibold"
                    name="login">Login</button>
            </div>
            <div>
                <span href="" class="block text-sm text-center">Don't have an account? <a href="registration.php"
                        class="font-bold">Sign
                        up</a></span>
            </div>
        </form>
    </main>
</body>

</html>