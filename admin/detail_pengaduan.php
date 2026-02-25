<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['role']!=='admin'){
    header("Location: loginadmin.php");
    exit;
}

include '../koneksi/koneksi.php';
include 'header.php';

$id_pengaduan = $_GET['id'] ?? 0;

$query = mysqli_query($conn, "
    SELECT p.*, c.nama 
    FROM pengaduan p
    JOIN customer c ON p.id_customer = c.id_customer
    WHERE p.id_pengaduan='$id_pengaduan'
");

$data = mysqli_fetch_assoc($query);

if(!$data){
    echo "<script>alert('Data tidak ditemukan'); window.location='dashboard.php';</script>";
    exit;
}
?>

<div class="container mt-4">
    <h2 class="text-center mb-4 text-success">Detail Pengaduan</h2>

    <table class="table table-bordered">
        <tr><th>Nama Pelapor</th><td><?= htmlspecialchars($data['nama']); ?></td></tr>
        <tr><th>Judul</th><td><?= $data['judul']; ?></td></tr>
        <tr><th>Kategori</th><td><?= $data['klasifikasi']; ?></td></tr>
        <tr><th>Tanggal Kejadian</th><td><?= $data['tanggal_kejadian']; ?></td></tr>
        <tr><th>Status</th><td><?= $data['status']; ?></td></tr>
    </table>

    <h4 class="mt-4">Berikan Feedback</h4>
    <form method="POST" action="proses_feedback.php">
        <input type="hidden" name="id_pengaduan" value="<?= $id_pengaduan; ?>">

        <div class="mb-3">
            <textarea name="feedback" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <select name="status" class="form-control">
                <option value="diproses">Diproses</option>
                <option value="selesai">Selesai</option>
                <option value="ditolak">Ditolak</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Kirim Feedback</button>
    </form>
</div>

<?php include 'footer.php'; ?>