<?php
$conn = mysqli_connect("localhost", "root", "", "rmp");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// tambah
function tambah($data)
{
    global $conn;
    $nama_makanan = htmlspecialchars($data["nama_makanan"]);
    $level_pedas = htmlspecialchars($data["level_pedas"]);
    $waktu_memasak = htmlspecialchars($data["waktu_memasak"]);
    $bahan = htmlspecialchars($data["bahan"]);
    $langkah_memasak = htmlspecialchars($data["langkah_memasak"]);
    $sumber = htmlspecialchars($data["sumber"]);

    // upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO makanan 
        (nama_makanan, level_pedas, waktu_memasak, bahan, langkah_memasak, gambar, sumber)
        VALUES 
        ('$nama_makanan', '$level_pedas', '$waktu_memasak', '$bahan', '$langkah_memasak', '$gambar', '$sumber')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
                alert('Masukkan gambar makanan dahulu!');
            </script>";
        return false;
    }

    // cek ekstensi
    $ekstensiValid = ['jpg', 'jpeg', 'png'];
    $ekstensi = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
    if (!in_array($ekstensi, $ekstensiValid)) {
        echo "<script>
                alert('File bukan gambar!');
            </script>";
        return false;
    }

    // cek ukuran
    if ($ukuranFile > 2000000) {
        echo "<script>
                alert('Ukuran gambar terlalu besar!');
            </script>";
        return false;
    }

    // nama baru
    $namaBaru = uniqid() . '.' . $ekstensi;
    move_uploaded_file($tmpName, '../img/' . $namaBaru);

    return $namaBaru;
}

function hapus($id)
{
    global $conn;

    // hapus gambar juga
    $gambar = query("SELECT gambar FROM makanan WHERE id = $id")[0]['gambar'];
    if (file_exists("../img/" . $gambar)) {
        unlink("../img/" . $gambar);
    }

    mysqli_query($conn, "DELETE FROM makanan WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function edit($data)
{
    global $conn;
    $id = $data["id"];
    $nama_makanan = htmlspecialchars($data["nama_makanan"]);
    $level_pedas = htmlspecialchars($data["level_pedas"]);
    $waktu_memasak = htmlspecialchars($data["waktu_memasak"]);
    $bahan = htmlspecialchars($data["bahan"]);
    $langkah_memasak = htmlspecialchars($data["langkah_memasak"]);
    $sumber = htmlspecialchars($data["sumber"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        // hapus gambar lama
        if (file_exists("../img/" . $gambarLama)) {
            unlink("../img/" . $gambarLama);
        }
        $gambar = upload();
    }

    $query = "UPDATE makanan SET
        nama_makanan = '$nama_makanan',
        level_pedas = '$level_pedas',
        waktu_memasak = '$waktu_memasak',
        bahan = '$bahan',
        langkah_memasak = '$langkah_memasak',
        gambar = '$gambar',
        sumber = '$sumber'
        WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $query = "SELECT * FROM makanan
        WHERE
        nama_makanan LIKE '%$keyword%' OR
        level_pedas LIKE '%$keyword%' OR
        level_pedas = '$keyword' OR
        bahan LIKE '%$keyword%' OR
        sumber LIKE '%$keyword%'";
    return query($query);
}

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('Username sudah terdaftar!');
            </script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
                alert('Konfirmasi password tidak sesuai!');
            </script>";
        return false;
    }

    // enkripsi
    $password = password_hash($password, PASSWORD_DEFAULT);

    // insert user
    mysqli_query($conn, "INSERT INTO user (username, password) VALUES('$username', '$password')");

    return mysqli_affected_rows($conn);
}
