<?php
session_start();
include 'koneksi/koneksi.php';
date_default_timezone_set('Asia/Jakarta');

if(!isset($_SESSION['id_customer'])){
    echo "<script>alert('Error: Anda harus login terlebih dahulu'); window.location='user_login.php';</script>";
    exit;
}


$id_customer      = $_SESSION['id_customer'];
$klasifikasi      = mysqli_real_escape_string($conn, $_POST['klasifikasi']);
$judul            = mysqli_real_escape_string($conn, $_POST['judul']);
$isi_laporan      = mysqli_real_escape_string($conn, $_POST['isi']);
$tanggal_kejadian = mysqli_real_escape_string($conn, $_POST['tanggal_kejadian']);
$lokasi           = mysqli_real_escape_string($conn, $_POST['lokasi']);
$instansi         = mysqli_real_escape_string($conn, $_POST['instansi']);
$anonim           = isset($_POST['anonim']) ? 1 : 0;
$tgl_pengaduan    = date('Y-m-d H:i:s');
$status           = 'Menunggu';

$lampiran = null;
$upload_dir = 'uploads/';
if(!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

if(isset($_FILES['lampiran']) && $_FILES['lampiran']['error']==0){
    $nama_file = time().'_'.basename($_FILES['lampiran']['name']);
    move_uploaded_file($_FILES['lampiran']['tmp_name'], $upload_dir.$nama_file);
    $lampiran = $nama_file;
}

$sql = "INSERT INTO pengaduan
(id_customer, klasifikasi, judul, isi_laporan, tanggal_kejadian, lokasi, instansi, anonim, lampiran, tgl_pengaduan, status)
VALUES
('$id_customer', '$klasifikasi', '$judul', '$isi_laporan', '$tanggal_kejadian', '$lokasi', '$instansi', '$anonim', '$lampiran', '$tgl_pengaduan', '$status')";

if(mysqli_query($conn, $sql)){
    echo "<script>alert('Pengaduan berhasil dikirim!'); window.location='index.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
