<?php
require_once __DIR__ . '/../../koneksi/koneksi.php';


if (!isset($_GET['id'])) {
    die("<script>alert('ID pengaduan tidak ditemukan'); window.history.back();</script>");
}

$id = (int) $_GET['id'];

$stmt = mysqli_prepare($conn, "DELETE FROM pengaduan WHERE id_pengaduan = ?");
if (!$stmt) {
    die("<script>alert('Gagal menyiapkan query'); window.history.back();</script>");
}

mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    
    echo "<script>
        alert('Data berhasil dihapus!');
        window.history.back(); // kembali ke halaman sebelumnya
    </script>";
} else {
    echo "<script>
        alert('Gagal menghapus data: ".mysqli_error($conn)."');
        window.history.back();
    </script>";
}
