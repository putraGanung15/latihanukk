<?php
session_start();
include '../koneksi/koneksi.php';
include 'header.php';

if(!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin'){
    header("Location: loginadmin.php");
    exit;
}

$id_admin = $_SESSION['id_admin'];
$folder = __DIR__ . "/../uploads/admin/";
if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
}

$stmt = $conn->prepare("SELECT username, password, foto FROM admin WHERE id_admin=?");
$stmt->bind_param("i", $id_admin);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

$foto = $data['foto'] ?? 'default.png';

if(isset($_POST['upload_foto'])){

    $file = $_FILES['foto'];

    if($file['error'] === 0){

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png'];

        if(!in_array($ext, $allowed)){
            echo "<script>alert('Hanya file JPG/JPEG/PNG yang diperbolehkan!');</script>";
        } else {

            $namaBaru = time().'_'.$file['name'];

            if(move_uploaded_file($file['tmp_name'], $folder.$namaBaru)){

                // hapus foto lama
                if($foto && $foto != 'default.png' && file_exists($folder.$foto)){
                    unlink($folder.$foto);
                }

                $update = $conn->prepare("UPDATE admin SET foto=? WHERE id_admin=?");
                $update->bind_param("si", $namaBaru, $id_admin);
                $update->execute();

                echo "<script>alert('Foto berhasil diupdate'); window.location='profil_admin.php';</script>";
                exit;
            } else {
                echo "<script>alert('Upload gagal!');</script>";
            }
        }

    } else {
        echo "<script>alert('Terjadi kesalahan saat upload!');</script>";
    }
}

if(isset($_POST['edit_username'])){

    $usernameBaru = trim($_POST['username']);

    if(!empty($usernameBaru)){
        $update = $conn->prepare("UPDATE admin SET username=? WHERE id_admin=?");
        $update->bind_param("si", $usernameBaru, $id_admin);
        $update->execute();

        $_SESSION['username'] = $usernameBaru;

        echo "<script>alert('Username berhasil diubah'); window.location='profil_admin.php';</script>";
        exit;
    }
}

if(isset($_POST['ganti_password'])){

    $passLama = $_POST['pass_lama'];
    $passBaru = $_POST['pass_baru'];

    if(password_verify($passLama, $data['password'])){

        $hashBaru = password_hash($passBaru, PASSWORD_DEFAULT);

        $update = $conn->prepare("UPDATE admin SET password=? WHERE id_admin=?");
        $update->bind_param("si", $hashBaru, $id_admin);
        $update->execute();

        echo "<script>alert('Password berhasil diganti'); window.location='profil_admin.php';</script>";
        exit;

    } else {
        echo "<script>alert('Password lama salah!');</script>";
    }
}
?>

<style>
.profile-card{
    width:450px;
    margin:auto;
    padding:25px;
    border-radius:15px;
    background:#fff;
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
}
.profile-img{
    width:120px;
    height:120px;
    border-radius:50%;
    object-fit:cover;
    border:4px solid #28a745;
}
.btn-custom{
    background:#28a745;
    color:#fff;
    border:none;
    padding:7px 15px;
    border-radius:8px;
}
.btn-custom:hover{
    background:#218838;
}
</style>

<div class="container" style="margin-top:50px;">
<h2 class="text-center mb-4">Profil Admin</h2>

<div class="profile-card text-center">

<img src="../uploads/admin/<?= $foto ?>" class="profile-img mb-3">

<!-- Upload Foto -->
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="foto" required>
    <br><br>
    <button type="submit" name="upload_foto" class="btn-custom">Ganti Foto</button>
</form>

<hr>

<p><strong>ID:</strong> <?= $_SESSION['id_admin'] ?></p>
<p><strong>Username:</strong> <?= $_SESSION['username'] ?></p>
<p><strong>Role:</strong> <?= $_SESSION['role'] ?></p>

<hr>

<!-- Edit Username -->
<form method="POST">
    <input type="text" name="username" class="form-control mb-2" placeholder="Username Baru" required>
    <button type="submit" name="edit_username" class="btn-custom">Edit Username</button>
</form>

<hr>

<!-- Ganti Password -->
<form method="POST">
    <input type="password" name="pass_lama" class="form-control mb-2" placeholder="Password Lama" required>
    <input type="password" name="pass_baru" class="form-control mb-2" placeholder="Password Baru" required>
    <button type="submit" name="ganti_password" class="btn-custom">Ganti Password</button>
</form>

</div>
</div>

<?php include 'footer.php'; ?>