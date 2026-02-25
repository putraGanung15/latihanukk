<?php
session_start();
include '../../koneksi/koneksi.php';

if(!isset($_SESSION['login'])) {
    header("Location: ../loginadmin.php");
    exit;
}

$id_pengaduan = $_POST['id_pengaduan'];
$isi_tanggapan = $_POST['isi_tanggapan'];
$id_petugas = $_SESSION['id_petugas']; // pastikan ini ada saat login

mysqli_query($conn, "INSERT INTO tanggapan 
(id_pengaduan, id_petugas, isi_tanggapan) 
VALUES ('$id_pengaduan','$id_petugas','$isi_tanggapan')");

mysqli_query($conn, "UPDATE pengaduan 
SET status='proses' 
WHERE id_pengaduan='$id_pengaduan'");

header("Location: ../detail_pengaduan.php?id=".$id_pengaduan);