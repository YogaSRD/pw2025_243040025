<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../auth/login.php"); // ← sesuaikan path ke login.php
    exit;
}

require 'functions.php';

// ambil data di url
$id = $_GET["id"];

// query berdasarkan id
$mhs = query("SELECT * FROM makanan WHERE id = $id")[0];

if (isset($_POST["submit"])) {
    if (edit($_POST) > 0) {
        echo "
            <script>
                alert('Resep berhasil diedit!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Resep gagal diedit!');
                document.location.href = 'index.php';
            </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Resep Makanan</title>
</head>

<body>

    <h1>Edit Resep Makanan</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">
        <ul>

            <li>
                <label for="nama_makanan">Nama Makanan:</label>
                <input type="text" name="nama_makanan" required value="<?= $mhs["nama_makanan"]; ?>">
            </li>

            <li>
                <label for="level_pedas">Level Pedas:</label>
                <input type="number" name="level_pedas" value="<?= $mhs["level_pedas"]; ?>">
            </li>

            <li>
                <label for="waktu_memasak">Waktu Memasak:</label>
                <input type="text" name="waktu_memasak" value="<?= $mhs["waktu_memasak"]; ?>">
            </li>

            <li>
                <label for="bahan">Bahan:</label><br>
                <textarea name="bahan" rows="4" cols="50" required><?= $mhs["bahan"]; ?></textarea>
            </li>

            <li>
                <label for="langkah_memasak">Langkah Memasak:</label><br>
                <textarea name="langkah_memasak" rows="4" cols="70" required><?= $mhs["langkah_memasak"]; ?></textarea>
            </li>

            <li>
                <label for="gambar">Gambar:</label><br>
                <img src="../img/<?= $mhs['gambar']; ?>" width="40"><br> <!-- ← path gambar diperbaiki -->
                <input type="file" name="gambar">
            </li>

            <li>
                <label for="sumber">Sumber:</label>
                <input type="text" name="sumber" value="<?= $mhs["sumber"]; ?>">
            </li>

            <li>
                <button type="submit" name="submit">Edit Resep</button>
            </li>

        </ul>
    </form>
</body>

</html>