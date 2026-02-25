<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['role']!=='admin'){
    header("Location: loginadmin.php");
    exit;
}

include '../koneksi/koneksi.php';
include 'header.php';
?>

<div class="container mt-4">
    <h2 class="text-center mb-4" style="color:#28a745; font-weight:bold;">Daftar Pengaduan</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead style="background-color:#28a745; color:white;">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Pengirim</th>
                    <th>Tanggal Kejadian</th>
                    <th>Status</th>
                    <th>Lampiran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            $query = "SELECT p.*, c.username 
                      FROM pengaduan p
                      LEFT JOIN customer c ON p.id_customer=c.id_customer
                      ORDER BY p.id_pengaduan DESC";
            $result = mysqli_query($conn, $query);
            
            if($result && mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo '<tr>';
                    echo '<td>'.$no++.'</td>';
                    echo '<td>'.htmlspecialchars($row['judul']).'</td>';
                    echo '<td>'.htmlspecialchars($row['klasifikasi']).'</td>';
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
                        $badge = '<span class="badge bg-warning text-dark">Pending</span>';
                    } elseif($status == 'Proses'){
                        $badge = '<span class="badge bg-primary">Proses</span>';
                    } elseif($status == 'Selesai'){
                        $badge = '<span class="badge bg-success">Selesai</span>';
                    } elseif($status == 'Ditolak'){
                        $badge = '<span class="badge bg-danger">Ditolak</span>';
                    } else {
                        $badge = '<span class="badge bg-secondary">'.htmlspecialchars($status).'</span>';
                    }

                    echo '<td>'.$badge.'</td>';

                    
                    echo '<td>';
                    if($row['lampiran']) echo '<a href="../uploads/'.$row['lampiran'].'" target="_blank">Lihat</a>';
                    else echo '-';
                    echo '</td>';

                    
                    echo '<td>
                        <a href="detail_pengaduan.php?id='.$row['id_pengaduan'].'" class="btn btn-primary btn-sm mb-1">Detail</a>
                        <a href="proses/hapus_pengaduan.php?id='.$row['id_pengaduan'].'" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus?\')">Hapus</a>
                    </td>';

                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="8" class="text-center">Belum ada pengaduan</td></tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>