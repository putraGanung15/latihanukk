<?php
session_start();
include '../koneksi/koneksi.php';
include 'header.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: loginadmin.php");
    exit;
}

$total = mysqli_fetch_assoc(mysqli_query($conn, 
    "SELECT COUNT(*) as total FROM pengaduan"));

$menunggu = mysqli_fetch_assoc(mysqli_query($conn, 
    "SELECT COUNT(*) as total 
     FROM pengaduan p 
     LEFT JOIN history_aspirasi h ON p.id_pengaduan = h.id_pengaduan
     WHERE h.status IS NULL OR h.status='Pending'"));


$proses = mysqli_fetch_assoc(mysqli_query($conn, 
    "SELECT COUNT(*) as total 
     FROM history_aspirasi h 
     WHERE h.status='Proses'"));

$selesai = mysqli_fetch_assoc(mysqli_query($conn, 
    "SELECT COUNT(*) as total 
     FROM history_aspirasi h 
     WHERE h.status='Selesai'"));


$ditolak = mysqli_fetch_assoc(mysqli_query($conn, 
    "SELECT COUNT(*) as total 
     FROM history_aspirasi h 
     WHERE h.status='Ditolak'"));

$data_klasifikasi = mysqli_query($conn, 
    "SELECT klasifikasi, COUNT(*) as jumlah 
     FROM pengaduan 
     GROUP BY klasifikasi");

$labels = [];
$data = [];

while($row = mysqli_fetch_assoc($data_klasifikasi)){
    $labels[] = $row['klasifikasi'];
    $data[] = $row['jumlah'];
}
?>

<div class="container" style="margin-top:50px;">
    <h2>Statistik Data Laporan Sampah</h2>

    
    <div class="row text-center mt-4">
        <div class="col-md-2">
            <div class="card bg-success text-white p-3">
                <h4><?= $total['total']; ?></h4>
                <p>Total Laporan</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card bg-warning text-dark p-3">
                <h4><?= $menunggu['total']; ?></h4>
                <p>Menunggu</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card bg-info text-white p-3">
                <h4><?= $proses['total']; ?></h4>
                <p>Diproses</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card bg-success text-white p-3">
                <h4><?= $selesai['total']; ?></h4>
                <p>Selesai</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card bg-danger text-white p-3">
                <h4><?= $ditolak['total']; ?></h4>
                <p>Ditolak</p>
            </div>
        </div>
    </div>

    
    <div class="card mt-5 p-4">
        <h5>Grafik Berdasarkan Klasifikasi</h5>
        <canvas id="chartKlasifikasi"></canvas>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('chartKlasifikasi');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($labels); ?>,
        datasets: [{
            label: 'Jumlah Laporan',
            data: <?= json_encode($data); ?>,
            backgroundColor: [
                '#28a745', // Hijau
                '#ffc107', // Kuning
                '#007bff', // Biru
                '#dc3545', // Merah
                '#6f42c1'  // Ungu
            ]
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        }
    }
});
</script>

<?php include 'footer.php'; ?>