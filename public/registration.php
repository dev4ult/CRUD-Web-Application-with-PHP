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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Registration Page</title>
</head>

<body class="bg-gray-100">
    <main
        class="container max-w-6xl mx-auto px-3 flex items-center justify-center h-screen font-poppins flex-col gap-2">
        <div class="shadow-lg p-8 flex flex-col gap-4 sm:flex-row sm:gap-10 sm:items-center rounded-md bg-white">
            <section>
                <img src="./img/illustration/juicy-girl-waving-from-laptop.png" alt="girl waving from laptop"
                    class="sm:hidden">
                <img src="./img/illustration/juicy-young-woman-raised-one-hand.png" alt="young woman raised one hand"
                    class="hidden sm:block w-52">
            </section>
            <form action="" method="post">
                <div class="mb-7">
                    <h1 class="text-2xl font-bold">Sign Up</h1>
                    <span href="" class="block text-sm mt-2">Already have an account? <a href="login.php"
                            class="font-bold">Login</a></span>
                </div>
                <div class="form-control">
                    <label class="input-group">
                        <input type="text" placeholder="Username"
                            class="input focus:outline-none mt-2 border-0 border-b-2 border-gray-200" name="username"
                            required />
                    </label>
                </div>
                <div class="form-control">
                    <label class="input-group">
                        <input type="email" placeholder="Email"
                            class="input focus:outline-none mt-2 border-0 border-b-2 border-gray-200" name="email"
                            required />
                    </label>
                </div>
                <div class="form-control">
                    <label class="input-group">
                        <input type="password" placeholder="Password"
                            class="input focus:outline-none mt-2 border-0 border-b-2 border-gray-200" name="password"
                            required />
                    </label>
                </div>
                <div class="form-control">
                    <label class="input-group">
                        <input type="password" placeholder="Confirm your password"
                            class="input focus:outline-none mt-2 border-0 border-b-2 border-gray-200" name="password2"
                            required />
                    </label>
                </div>
                <div class="mt-8">
                    <button type="submit"
                        class="btn-success w-full py-2 text-lg text-white font-semibold rounded-sm uppercase"
                        name="signup-btn">Create an
                        Account</button>
                </div>
            </form>
        </div>
        <div>
            Illustration by <a href="https://icons8.com/illustrations/author/zD2oqC8lLBBA" class="underline">Icons 8</a>
            from <a href="https://icons8.com/illustrations" class="underline">Ouch!</a>
        </div>
    </main>
</body>

</html>