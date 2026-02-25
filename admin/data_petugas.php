<?php
session_start();
include '../koneksi/koneksi.php';
include 'header.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: loginadmin.php");
    exit;
}

if(isset($_POST['tambah_petugas'])){

    $username = mysqli_real_escape_string($conn, $_POST['username'] ?? '');
    $password = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);
    $nama = mysqli_real_escape_string($conn, $_POST['nama_petugas'] ?? '');
    $no_hp = mysqli_real_escape_string($conn, $_POST['no_hp'] ?? '');
    $wilayah = mysqli_real_escape_string($conn, $_POST['wilayah'] ?? '');
    $status = mysqli_real_escape_string($conn, $_POST['status'] ?? '');

    if(empty($username) || empty($_POST['password'])){
        echo "<script>alert('Data belum lengkap!');</script>";
    } else {

        $cek = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username'");
        
        if(mysqli_num_rows($cek) > 0){
            echo "<script>alert('Username sudah digunakan!');</script>";
        } else {
            mysqli_query($conn, "INSERT INTO admin 
                (username, password, role)
                VALUES 
                ('$username','$password','petugas')");

            echo "<script>
                alert('Petugas berhasil ditambahkan');
                window.location='data_petugas.php';
            </script>";
        }
    }
}

$query = "SELECT id_admin, username, role 
          FROM admin 
          ORDER BY id_admin ASC";

$result = mysqli_query($conn, $query);
?>

<div class="container" style="margin-top: 50px;">
    <h2>Data Petugas</h2>

    
    <button class="btn btn-success mb-3" data-toggle="collapse" data-target="#formTambah">
        + Tambah Petugas
    </button>

    
    <div id="formTambah" class="collapse mb-4">
        <div class="card card-body">
            <form method="POST">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="nama_petugas" class="form-control mb-2" placeholder="Nama Petugas" required>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>
                    </div>
                    <div class="col-md-4">
                        <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="no_hp" class="form-control mb-2" placeholder="No HP">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="wilayah" class="form-control mb-2" placeholder="Wilayah">
                    </div>
                    <div class="col-md-4">
                        <select name="status" class="form-control mb-2" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>

                <button type="submit" name="tambah_petugas" class="btn btn-primary">
                    Simpan Petugas
                </button>
            </form>
        </div>
    </div>


    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead style="background-color:#28a745; color:white;">
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Nama Petugas</th>
                    <th>Username</th>
                    <th>No HP</th>
                    <th>Wilayah</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . htmlspecialchars($row['id_admin']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                    echo "</tr>";
}
                    }
     else {
                    echo "<tr><td colspan='7' class='text-center'>Belum ada data petugas</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
