<?php
session_start();
include '../koneksi/koneksi.php';
include 'header.php';


if(!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin'){
    header("Location: loginadmin.php");
    exit;
}


$result = mysqli_query($conn, "SELECT * FROM kontak ORDER BY tanggal DESC");
?>

<div class="container" style="margin-top:50px; margin-bottom:100px;">
    <h2 class="text-center" style="color:#28a745; font-weight:bold; border-bottom:4px solid #28a745; display:inline-block; padding-bottom:8px;">
        Daftar Pesan Kontak / Bantuan
    </h2>

    <div class="table-responsive mt-4">
        <table class="table table-bordered table-hover">
            <thead class="thead-success" style="background-color:#28a745; color:white;">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Pesan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($result && mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>
                                <td>{$no}</td>
                                <td>".htmlspecialchars($row['nama'])."</td>
                                <td>".htmlspecialchars($row['email'])."</td>
                                <td>".htmlspecialchars($row['pesan'])."</td>
                                <td>{$row['tanggal']}</td>
                              </tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Belum ada pesan</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
