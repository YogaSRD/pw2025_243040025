<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../auth/login.php"); // Sesuaikan path
    exit;
}

require 'functions.php';
//$makanan = query("SELECT * FROM makanan");
$makanan = query("SELECT makanan.*, user.username 
                  FROM makanan 
                  LEFT JOIN user ON makanan.user_id = user.id");

if (isset($_POST["cari"])) {
    $makanan = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Halaman Admin</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <a href="../auth/logout.php" class="top-right">Logout</a>
    <h1>Daftar Resep Makanan</h1>


    <form action="" method="post">
        <input type="text" name="keyword" size="30" autofocus placeholder="masukkan nama resep makanan..." autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari">Telusuri</button>
    </form>

    <br>
    <div id="container">
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No.</th>
                <th>Gambar</th>
                <th>Nama Makanan</th>
                <th>Level Pedas</th>
                <th>Waktu Memasak</th>
                <th>Bahan</th>
                <th>Langkah Memasak</th>
                <th>Sumber</th>
                <th>Di tambahkan user</th>
                <th>Aksi</th>
            </tr>

            <?php $i = 1; ?>
            <?php foreach ($makanan as $row) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td>
                        <img src="../img/<?= $row["gambar"]; ?>" width="50"> <!-- path gambar -->
                    </td>
                    <td><?= $row["nama_makanan"]; ?></td>
                    <td><?= $row["level_pedas"]; ?></td>
                    <td><?= $row["waktu_memasak"]; ?></td>
                    <td><?= substr($row["bahan"], 0, 50); ?></td>
                    <td><?= substr($row["langkah_memasak"], 0, 70); ?></td>
                    <td><?= $row["sumber"]; ?></td>
                    <td><?= $row["username"]; ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row["id"]; ?>" class="table-action">Edit</a>
                        <a href="hapus.php?id=<?= $row["id"]; ?>" class="table-action" onclick="return confirm('Apakah Kamu Yakin Ingin Menghapus Resep Ini?')">Hapus</a>
                    </td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </table>
    </div>

    <a href="tambah.php" class="bottom-right">Tambah Resep Makanan</a>


    <script src="../js/script.js"></script>

</body>

</html>