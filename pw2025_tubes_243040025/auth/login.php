<?php
session_start();

require '../admin/functions.php';

if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    // cek username
    if (mysqli_num_rows($result) === 1) {
        // cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            // set session
            $_SESSION["login"] = true;
            $_SESSION["user_id"] = $row["id"];
            header("Location: ../admin/index.php");
            exit;
        }
    }

    $error = true;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Halaman Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <a href="../user/index_user.php" class="top-right">Kembali ke User</a>

    <h1>Halaman Login</h1>

    <?php if (isset($error)) : ?>
        <p class="error-msg">Username / Password salah</p>
    <?php endif; ?>

    <form action="" method="post" class="form-login">
        <label for="username">Username :</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password :</label>
        <input type="password" name="password" id="password" required>

        <button type="submit" name="login">Login</button>
        <p class="register-link">Belum pernah masuk? <a href="registrasi.php">Registrasi</a></p>
    </form>

</body>

</html>