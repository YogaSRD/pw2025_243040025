<?php
require '../admin/functions.php';
$makanan = query("SELECT * FROM makanan");

if (isset($_POST["cari"])) {
    $makanan = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Halaman User - Resep</title>
</head>

<body>

    <h1>Daftar Resep Makanan</h1>

    <form action="" method="post">
        <input type="text" name="keyword" size="30" autofocus placeholder="Cari resep..." autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari">Telusuri</button>
    </form>

    <br>
    <a href="../auth/login.php">Masuk sebagai Admin</a>

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
            </tr>

            <?php $i = 1; ?>
            <?php foreach ($makanan as $row) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><img src="../img/<?= $row["gambar"]; ?>" width="50"></td>
                    <td><?= $row["nama_makanan"]; ?></td>
                    <td><?= $row["level_pedas"]; ?></td>
                    <td><?= $row["waktu_memasak"]; ?></td>
                    <td><?= substr($row["bahan"], 0, 50); ?></td>
                    <td><?= substr($row["langkah_memasak"], 0, 70); ?></td>
                    <td><?= $row["sumber"]; ?></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </table>
    </div>

    <script src="../js/script_user.js"></script>
</body>

</html>