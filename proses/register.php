<?php
include '../koneksi/koneksi.php';

$kode = mysqli_query($conn, "SELECT kode_customer FROM customer ORDER BY kode_customer DESC LIMIT 1");
$data = mysqli_fetch_assoc($kode);
$num = isset($data['kode_customer']) ? substr($data['kode_customer'], 1, 4) : 0;
$add = (int) $num + 1;
$format = "C" . str_pad($add, 4, "0", STR_PAD_LEFT);

$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$tlp = $_POST['telp'];
$konfirmasi = $_POST['konfirmasi'];

$hash = password_hash($password, PASSWORD_DEFAULT);


if ($password !== $konfirmasi) {
	echo "<script>alert('KONFIRMASI PASSWORD TIDAK SAMA'); window.location = '../register.php';</script>";
	exit;
}

$cek = mysqli_query($conn, "SELECT username FROM customer WHERE username='$username' OR email='$email'");
if (mysqli_num_rows($cek) > 0) {
	echo "<script>alert('USERNAME atau EMAIL SUDAH DIGUNAKAN'); window.location = '../register.php';</script>";
	exit;
}

$result = mysqli_query($conn, "INSERT INTO customer (kode_customer, nama, email, username, password, telp) 
                               VALUES ('$format','$nama','$email','$username','$hash','$tlp')");

if ($result) {
	echo "<script>alert('REGISTER BERHASIL'); window.location = '../user_login.php';</script>";
} else {
	echo "Error: " . mysqli_error($conn);
}
?>