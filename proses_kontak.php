<?php
session_start();
include 'koneksi/koneksi.php';

$nama = mysqli_real_escape_string($conn, $_POST['nama']);
$metode = mysqli_real_escape_string($conn, $_POST['metode']);
$kontak = mysqli_real_escape_string($conn, $_POST['kontak']);
$pesan = mysqli_real_escape_string($conn, $_POST['pesan']);

if ($metode === 'email') {
    $email = $kontak;
    $no_hp = null;
} else {
    $email = null;
    $no_hp = $kontak;
}

date_default_timezone_set('Asia/Jakarta');
$tanggal = date('Y-m-d H:i:s');

if (empty($nama) || empty($kontak) || empty($pesan)) {
    echo "<script>
        alert('Semua field harus diisi!');
        window.history.back();
    </script>";
    exit;
}

$query = "INSERT INTO kontak (nama, email, no_hp, pesan, tanggal) 
          VALUES ('$nama', '$email', '$no_hp', '$pesan', '$tanggal')";

if (mysqli_query($conn, $query)) {
    echo "<script>
        alert('Pesan berhasil dikirim!');
        window.location = 'kontak.php';
    </script>";
    exit;
} else {
    echo "<script>
        alert('Terjadi kesalahan: " . mysqli_error($conn) . "');
        window.history.back();
    </script>";
    exit;
}
?>