<?php
session_start();
include '../koneksi/koneksi.php';


if(!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin'){
    header("Location: loginadmin.php");
    exit;
}


$id_pengaduan = $_POST['id_pengaduan'] ?? 0;
$feedback     = mysqli_real_escape_string($conn, $_POST['feedback']);
$status       = mysqli_real_escape_string($conn, $_POST['status']);


if(empty($feedback) || empty($id_pengaduan)){
    echo "<script>
            alert('Data tidak lengkap!');
            window.history.back();
          </script>";
    exit;
}

mysqli_query($conn, "INSERT INTO history_aspirasi 
                     (id_pengaduan, feedback, status, created_at)
                     VALUES ('$id_pengaduan', '$feedback', '$status', NOW())");

mysqli_query($conn, "UPDATE pengaduan 
                     SET status='$status'
                     WHERE id_pengaduan='$id_pengaduan'");


echo "<script>
        alert('Feedback berhasil dikirim!');
        window.location='detail_pengaduan.php?id=$id_pengaduan';
      </script>";
exit;
?>