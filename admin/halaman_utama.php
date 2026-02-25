<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: loginadmin.php");
    exit;
}

include '../koneksi/koneksi.php';
include 'header.php';

$total_menunggu = mysqli_fetch_assoc(mysqli_query($conn, 
"SELECT COUNT(*) AS total FROM pengaduan p 
 LEFT JOIN history_aspirasi h ON p.id_pengaduan = h.id_pengaduan
 WHERE (h.status IS NULL OR h.status='Pending')"))['total'];

$total_proses   = mysqli_fetch_assoc(mysqli_query($conn, 
"SELECT COUNT(*) AS total FROM history_aspirasi h 
 LEFT JOIN pengaduan p ON p.id_pengaduan = h.id_pengaduan
 WHERE h.status='Proses'"))['total'];

$total_selesai  = mysqli_fetch_assoc(mysqli_query($conn, 
"SELECT COUNT(*) AS total FROM history_aspirasi h 
 LEFT JOIN pengaduan p ON p.id_pengaduan = h.id_pengaduan
 WHERE h.status='Selesai'"))['total'];

$total_ditolak  = mysqli_fetch_assoc(mysqli_query($conn, 
"SELECT COUNT(*) AS total FROM history_aspirasi h 
 LEFT JOIN pengaduan p ON p.id_pengaduan = h.id_pengaduan
 WHERE h.status='Ditolak'"))['total'];

$pengaduan = mysqli_query($conn, "SELECT p.*, c.username 
                                  FROM pengaduan p 
                                  LEFT JOIN customer c ON p.id_customer=c.id_customer 
                                  ORDER BY p.id_pengaduan DESC 
                                  LIMIT 5");
?>

<div class="container mt-4">
    <h2 class="text-center mb-4" style="color:#28a745; font-weight:bold;">SIPANDAI – Dashboard Admin</h2>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-warning shadow-sm">
                <div class="card-body text-center">
                    <h5>Menunggu</h5>
                    <h2><?= $total_menunggu ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info shadow-sm">
                <div class="card-body text-center">
                    <h5>Proses</h5>
                    <h2><?= $total_proses ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body text-center">
                    <h5>Selesai</h5>
                    <h2><?= $total_selesai ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger shadow-sm">
                <div class="card-body text-center">
                    <h5>Ditolak</h5>
                    <h2><?= $total_ditolak ?></h2>
                </div>
            </div>
        </div>
    </div>


    <div class="card shadow-sm mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Pengaduan Terbaru</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead style="background-color:#28a745; color:white;">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Pengirim</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
<?php
$no = 1;
if($pengaduan && mysqli_num_rows($pengaduan) > 0){
    while($row = mysqli_fetch_assoc($pengaduan)){
        echo '<tr>';
        echo '<td>'.$no++.'</td>';
        echo '<td>'.htmlspecialchars($row['judul']).'</td>';
        echo '<td>'.($row['anonim'] ? 'Anonim' : htmlspecialchars($row['username'])).'</td>';
        echo '<td>'.htmlspecialchars($row['tanggal_kejadian']).'</td>';

        
        $id_pengaduan = $row['id_pengaduan'];
        $history = mysqli_query($conn, "SELECT status FROM history_aspirasi 
                                        WHERE id_pengaduan='$id_pengaduan' 
                                        ORDER BY created_at DESC LIMIT 1");
        if(mysqli_num_rows($history) > 0){
            $h = mysqli_fetch_assoc($history);
            $status = $h['status'];
        } else {
            $status = $row['status'];
        }

        
        if($status == 'Pending'){
            $badge = "<span class='badge bg-warning text-dark'>Menunggu</span>";
        } elseif($status == 'Proses'){
            $badge = "<span class='badge bg-info'>Proses</span>";
        } elseif($status == 'Selesai'){
            $badge = "<span class='badge bg-success'>Selesai</span>";
        } elseif($status == 'Ditolak'){
            $badge = "<span class='badge bg-danger'>Ditolak</span>";
        } else {
            $badge = "<span class='badge bg-secondary'>".htmlspecialchars($status)."</span>";
        }

        echo '<td>'.$badge.'</td>';

        echo '<td>
                <a href="detail_pengaduan.php?id='.$row['id_pengaduan'].'" class="btn btn-primary btn-sm">Detail</a>
                <a href="proses/hapus_pengaduan.php?id='.$row['id_pengaduan'].'" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus?\')">Hapus</a>
              </td>';

        echo '</tr>';
    }
}else{
    echo '<tr><td colspan="6" class="text-center">Belum ada pengaduan</td></tr>';
}
?>
                </tbody>
            </table>
        </div>
        <div class="card-footer text-end">
            <a href="daftar_pengaduan.php" class="btn btn-success btn-sm">Lihat Semua Pengaduan</a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>