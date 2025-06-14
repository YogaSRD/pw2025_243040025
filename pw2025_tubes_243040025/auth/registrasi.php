<?php
require '../admin/functions.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
            alert('user baru berhasil ditambahkan!');
        </script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Halaman Register</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <h1>Halaman Registrasi</h1>

    <form action="" method="post" class="form-login">
        <label for="username">Username :</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password :</label>
        <input type="password" name="password" id="password" required>

        <label for="password2">Konfirmasi Password :</label>
        <input type="password" name="password2" id="password2" required>

        <button type="submit" name="register">Daftar</button>

        <div class="register-link">
            <a href="login.php">Kembali ke Login</a>
        </div>
    </form>

</body>

</html>