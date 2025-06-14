<?php
require '../admin/functions.php';

$keyword = $_GET["keyword"];
$query = "SELECT * FROM makanan 
            WHERE 
            nama_makanan LIKE '%$keyword%' OR
            level_pedas LIKE '%$keyword%' OR
            waktu_memasak LIKE '%$keyword%' OR
            bahan LIKE '%$keyword%' OR
            sumber LIKE '%$keyword%'";

$makanan = query($query);
?>

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