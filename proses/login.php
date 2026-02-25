<?php
session_start();
include '../koneksi/koneksi.php';

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = $_POST['pass'];

$cek = mysqli_query($conn, "SELECT * FROM customer WHERE username='$username'");
$jml = mysqli_num_rows($cek);
$row = mysqli_fetch_assoc($cek);

if ($jml == 1) {

    if (password_verify($password, $row['password'])) {


        $_SESSION['login'] = true;
        $_SESSION['role'] = 'user';
        $_SESSION['id_customer'] = $row['id_customer'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['kd_cs'] = $row['kode_customer'];

        echo "
        <script>
            alert('Login berhasil! Selamat datang ".$row['nama']."');
            window.location = '../index.php';
        </script>
        ";

    } else {
        echo "
        <script>
            alert('Password salah!');
            window.location = '../user_login.php';
        </script>
        ";
    }

} else {

    echo "
    <script>
        alert('Username tidak ditemukan!');
        window.location = '../user_login.php';
    </script>
    ";

}
?>