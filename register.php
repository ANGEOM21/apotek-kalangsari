<?php
session_start();
require 'functions/config.php';

if (isset($_POST['register'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $re_pass = $_POST['repassword'];
    $nama = $_POST['nama_lengkap'];
    $level = "user";
    // Melakukan hash password sebelum menyimpan ke database
    if ($pass !== $re_pass) {
        $error = true;
        $message = "Password tidak cocok!";
    }
    $password = password_hash($pass, PASSWORD_DEFAULT);

    // Periksa apakah username sudah ada dalam database
    $check_user = mysqli_query($conn, "SELECT * FROM users WHERE username = '$user'");
    if (mysqli_num_rows($check_user) > 0) {
        $error = true;
        $message = "Username sudah digunakan!";
    } else {
        // Jika username belum ada, lakukan proses registrasi
        $query = mysqli_query($conn, "INSERT INTO users (username, nama_lengkap, password, level) VALUES ('$user', '$nama', '$password', '$level')");
        if ($query) {
            $_SESSION['level'] = $level; // Set level sesuai dengan yang diinputkan
            header("Location: login.php"); // Setelah registrasi berhasil, arahkan ke halaman login
            exit;
        } else {
            $error = true;
            $message = "Registrasi gagal. Silakan coba lagi.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registrasi</title>
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <style type="text/css">
        .kotak {
            margin-top: 150px;
            background-color: pink;
            /*#AAE25E*/
            color: #fff;
        }

        .kotak .input-group {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <form action="" method="post">
        <div class="col-md-3 col-md-offset-4 kotak">
            <h3 class="text-center">Registrasi</h3>
            <?php if (isset($error)): ?>
                <p style="color: red;font-style: italic;">
                    <?php echo $message; ?>
                </p>
            <?php endif; ?>
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="off"
                    autofocus required />
            </div>
            <div class="form-group">
                <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap"
                    autocomplete="off" required />
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password" autocomplete="off"
                    required />
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder=" Konfirmasi Password" name="repassword" autocomplete="off"
                    required />
            </div>
            <div class="form-group">
                <input type="submit" name="register" class="btn btn-primary form-control" value="Register">
            </div>
            <br>
            <center>
                <p>Repost by <a href="https://stokcoding.com/" title="StokCoding.com" target="_blank">kelompok apotek</a>
                </p>
            </center>
        </div>
    </form>
</body>

</html>