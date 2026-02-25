<?php
session_start();
include '../koneksi/koneksi.php';
include 'header.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: loginadmin.php");
    exit;
}

$query = "SELECT kode_customer, nama, email, username, telp FROM customer ORDER BY kode_customer ASC";
$result = mysqli_query($conn, $query);
?>

<div class="container" style="margin-top: 50px;">
    <h2>Data User</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-success" style="background-color:#28a745; color:white;">
                <tr>
                    <th>No</th>
                    <th>Kode Customer</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>No. HP</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . htmlspecialchars($row['kode_customer']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['telp']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Belum ada data user</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
