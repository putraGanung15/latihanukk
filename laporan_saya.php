<?php
session_start();
include 'koneksi/koneksi.php';
include 'header.php';

if(!isset($_SESSION['id_customer']) || $_SESSION['role'] !== 'user'){
    header("Location: user_login.php");
    exit;
}

$id_customer = $_SESSION['id_customer'];

$query = mysqli_query($conn, "SELECT * FROM pengaduan 
                              WHERE id_customer='$id_customer' 
                              ORDER BY id_pengaduan DESC");
?>

<div class="container mt-5">
    <h2 class="text-center mb-4" style="color:#28a745; font-weight:bold;">
        Laporan Saya
    </h2>

    <table class="table table-bordered table-hover">
        <thead class="table-success">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Feedback Admin</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['judul']); ?></td>
                <td><?= htmlspecialchars($row['tanggal_kejadian']); ?></td>
                <td>
                    <?php
                    if($row['status'] == 'Pending'){
                        echo '<span class="badge bg-warning text-dark">Pending</span>';
                    } elseif($row['status'] == 'Proses'){
                        echo '<span class="badge bg-primary">Proses</span>';
                    } elseif($row['status'] == 'Selesai'){
                        echo '<span class="badge bg-success">Selesai</span>';
                    } else {
                        echo '<span class="badge bg-secondary">'.$row['status'].'</span>';
                    }
                    ?>
                </td>
                <td>
                    <a class="btn btn-info btn-sm mb-2"
                       href="detail_pengaduan.php?id=<?= $row['id_pengaduan']; ?>">
                       Lihat Detail
                    </a>
                    <br>

                    <?php
                
                    $id_pengaduan = $row['id_pengaduan'];
                    $history = mysqli_query($conn, "SELECT * FROM history_aspirasi 
                                                    WHERE id_pengaduan='$id_pengaduan' 
                                                    ORDER BY created_at DESC 
                                                    LIMIT 1");
                    
                    if(mysqli_num_rows($history) > 0){
                        $h = mysqli_fetch_assoc($history);
                        echo "<small><strong>Feedback Terbaru:</strong><br>";
                        echo htmlspecialchars($h['feedback']);
                        echo "<br><span class='text-muted'>(".$h['created_at'].")</span></small>";
                    } else {
                        echo "<span class='text-muted'>Belum ada feedback</span>";
                    }
                    ?>
                </td>
            </tr>
        <?php 
            }
        } else {
            echo "<tr><td colspan='5' class='text-center'>Belum ada laporan</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>


<style>

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}


.container {
    flex: 1; 
}

h2.text-center {
    font-size: 2rem;
}


.table {
    background-color: #fff;
    border-radius: 8px;
    overflow: hidden;
}

.table th, .table td {
    vertical-align: middle !important;
    text-align: center;
}

.badge {
    font-size: 0.9rem;
    padding: 0.4em 0.7em;
    border-radius: 12px;
}


.btn-info {
    background-color: #17a2b8;
    border: none;
}

.btn-info:hover {
    background-color: #138496;
    color: #fff;
}


footer {
    background-color: #28a745;
    color: #fff;
    text-align: center;
    padding: 15px 0;
    flex-shrink: 0; 
    margin-top: auto;
}
</style>