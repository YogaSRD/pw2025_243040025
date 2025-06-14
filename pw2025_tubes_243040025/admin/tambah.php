<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../auth/login.php");
    exit;
}

require 'functions.php'; // Ganti jika functions ada di luar folder admin

if (isset($_POST["submit"])) {

    if (tambah($_POST) > 0) {
        echo "
            <script>
                alert('resep berhasil ditambahkan!');
                document.location.href = 'index.php' ;
            </script>
        ";
    } else {
        echo "
        <script>
                alert('resep gagal ditambahkan!');
                document.location.href = 'index.php' ;
            </script>
        ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tambah Resep Makanan</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <h1>Tambah Resep Makanan</h1>
    <a href="index.php" class="btn-kembali">Menu Utama</a>
    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nama_makanan">Nama Makanan : </label>
                <input type="text" name="nama_makanan" required>
            </li>

            <li>
                <label for="level_pedas">Level Pedas : </label>
                <input type="number" name="level_pedas">
            </li>

            <li>
                <label for="waktu_memasak">Waktu Memasak : </label>
                <input type="text" name="waktu_memasak">
            </li>

            <li>
                <label for="bahan">Bahan : </label><br>
                <textarea name="bahan" rows="4" cols="50" required></textarea>
            </li>

            <li>
                <label for="langkah_memasak">Langkah Memasak : </label><br>
                <textarea name="langkah_memasak" rows="4" cols="70" required></textarea>
            </li>

            <li>
                <label for="gambar">Gambar : </label>
                <input type="file" name="gambar">
            </li>

            <li>
                <label for="sumber">Sumber : </label>
                <input type="text" name="sumber">
            </li>

            <li>
                <button type="submit" name="submit">Tambahkan Resep</button>
            </li>
        </ul>
    </form>

</body>

</html>