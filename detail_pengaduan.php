<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['role'] !== 'user'){
    header("Location: login.php");
    exit;
}

include 'koneksi/koneksi.php';
include 'header.php';

$id_pengaduan = $_GET['id'] ?? 0;
$id_customer  = $_SESSION['id_customer'];

$query = mysqli_query($conn, "
    SELECT * FROM pengaduan 
    WHERE id_pengaduan='$id_pengaduan'
    AND id_customer='$id_customer'
");

$data = mysqli_fetch_assoc($query);

if(!$data){
    echo "<script>alert('Data tidak ditemukan'); window.location='dashboard.php';</script>";
    exit;
}
?>

<div class="container mt-4">
    <h4 class="text-center mb-4 text-primary">Detail Pengaduan Saya</h4>

    <table class="table table-bordered">
        <tr>
            <th>Judul</th>
            <td><?= htmlspecialchars($data['judul']); ?></td>
        </tr>
        <tr>
            <th>Kategori</th>
            <td><?= htmlspecialchars($data['klasifikasi']); ?></td>
        </tr>
        <tr>
            <th>Tanggal Kejadian</th>
            <td><?= htmlspecialchars($data['tanggal_kejadian']); ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                <span class="badge bg-success">
                    <?= htmlspecialchars($data['status']); ?>
                </span>
            </td>
        </tr>
    </table>

    <h4 class="mt-4">Feedback dari Admin</h4>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Feedback</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $history = mysqli_query($conn, "
            SELECT * FROM history_aspirasi
            WHERE id_pengaduan='$id_pengaduan'
            ORDER BY created_at DESC
        ");

        if(mysqli_num_rows($history) > 0){
            while($h = mysqli_fetch_assoc($history)){
                echo "<tr>";
                echo "<td>".$no++."</td>";
                echo "<td>".htmlspecialchars($h['feedback'])."</td>";
                echo "<td>".htmlspecialchars($h['status'])."</td>";
                echo "<td>".$h['created_at']."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr>
                    <td colspan='4' class='text-center text-muted'>
                        Belum ada feedback dari admin
                    </td>
                  </tr>";
        }
        ?>
        </tbody>
    </table>

    <div class="box-kecil">
    <a href="index.php" class="btn btn-secondary btn-sm">Kembali</a>
    <style>
.box-kecil{
    display:inline-block;
    padding:10px;
    border:1px solid #00b737;
    border-radius:8px;
    background:#f8f9fa;
}
</style>
</div>
</div>

<?php include 'footer.php'; ?>