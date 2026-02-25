<?php
session_start();
include '../koneksi/koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];
$email    = $_POST['email'];
$no_hp    = $_POST['no_hp'];

$cek = mysqli_query($conn, "SELECT * FROM customer WHERE username='$username'");

if(mysqli_num_rows($cek) > 0){
    echo "<script>
        alert('Username sudah digunakan!');
        window.location='../register.php';
    </script>";
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);

mysqli_query($conn, "INSERT INTO customer (username, password, email, no_hp)
VALUES ('$username', '$hash', '$email', '$no_hp')");

echo "<script>
    alert('Registrasi berhasil!');
    window.location='../login.php';
</script>";
?>