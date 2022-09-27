<?php
require 'functions.php';

if (isset($_POST['signup-btn'])) {
    if (register($_POST) > 0) {
        echo "<script>
                alert('You have submit your registration, Check for login if admin has already confirm your registration');
              </script>";
    } else {
        echo mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en" data-theme="corporate">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <main class="container max-w-6xl mx-auto px-3 flex items-center justify-center h-screen">
        <form action="" class="" method="post">
            <div class="form-control">
                <label class="input-group">
                    <span>username</span>
                    <input type="text" placeholder="johnDoe" class="input input-bordered" name="username" required />
                </label>
            </div>
            <div class="form-control">
                <label class="input-group">
                    <span>email</span>
                    <input type="email" placeholder="info@site.com" class="input input-bordered" name="email"
                        required />
                </label>
            </div>
            <div class="form-control">
                <label class="input-group">
                    <span>password</span>
                    <input type="password" placeholder="*****" class="input input-bordered" name="password" required />
                </label>
            </div>
            <div class="form-control">
                <label class="input-group">
                    <span>confirm your password</span>
                    <input type="password" placeholder="*****" class="input input-bordered" name="password2" required />
                </label>
            </div>
            <div>
                <input type="submit" value="Sign Up" class="btn" name="signup-btn">
            </div>
        </form>
    </main>
</body>

</html>