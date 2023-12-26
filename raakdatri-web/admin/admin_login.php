<?php
include '../database/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $password = $_POST['password'];

    // Query ke database untuk memeriksa keberadaan admin
    $query = "SELECT * FROM admins WHERE nama = '$nama' AND password = '$password'";
    $result = mysqli_query($koneksi, $query);

    // Jika data admin ditemukan, alihkan ke halaman admin yang diinginkan
    if (mysqli_num_rows($result) > 0) {
        $admin_data = mysqli_fetch_assoc($result);

        session_start();
        $_SESSION['admin_id'] = $admin_data['id'];
        // Sesuaikan alihkan ke halaman yang diinginkan setelah login berhasil
        header("Location: dashboard.php");
        exit();
    } else {
        // Jika data admin tidak ditemukan, tampilkan pesan kesalahan
        $message = "Username atau password salah. Silakan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin_login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login - Raakdatri Admin</title>
</head>
<body>
    <?php
    // Tampilkan pesan
    if (isset($message)) {
        echo '
        <div class="message">
            <span>' . $message . '</span>
            <i class="bx bx-x" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
    ?>
    <!-- form login admin mulai -->
    <section class="form-container">
        <form action="" method="POST">
            <h3>Login Sebagai Admin</h3>
            <p>Silahkan login menggunakan akun admin yang telah terdaftar</p>
            <input type="text" name="nama" maxlength="50" required placeholder="masukkan username anda" class="box" oninput="this.value = this.value.replace(/\s/g,'')">
            <input type="password" name="password" maxlength="50" required placeholder="masukkan password anda" class="box" oninput="this.value = this.value.replace(/\s/g,'')">
            <p class="daftar">Belum punya akun? <a href="admin_regist.php">Daftar</a></p>
            <input type="submit" value="login" name="submit" class="btn">
        </form>
    </section>
    <!-- form login admin selesai -->
</body>

</html>