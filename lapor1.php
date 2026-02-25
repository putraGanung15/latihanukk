<?php
include 'header.php';

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['kd_cs'])){
    header("Location: user_login.php");
    exit;
}

if(!isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['token'];
?>

<div class="container" style="margin-top:60px; margin-bottom:100px;">
  <h2 class="text-center"
      style="font-weight:bold; color:#28a745; border-bottom:4px solid #28a745; display:inline-block; padding-bottom:8px;">
      Sampaikan Laporan Siswa
  </h2>

  <div class="row justify-content-center mt-4">
    <div class="col-md-8">
      <div class="card shadow-sm" style="border-radius:15px; border:none;">
        <div class="card-body">
          <form id="formLapor" method="post" action="proses_lapor.php" enctype="multipart/form-data" onsubmit="disableSubmit()">

            <input type="hidden" name="token" value="<?= $token ?>">

            <div class="form-group mb-3">
              <label><strong>Pilih Klasifikasi Laporan:</strong></label>
              <select name="klasifikasi" class="form-control" required>
                <option value="">-- Pilih Klasifikasi --</option>
                <option value="Masalah Fasilitas">Masalah Fasilitas</option>
                <option value="Perilaku Siswa / Guru">Perilaku Siswa / Guru</option>
                <option value="Kebersihan Sekolah">Kebersihan Sekolah</option>
                <option value="Lainnya">Lainnya</option>
              </select>
            </div>

            <div class="form-group mb-3">
              <label><strong>Judul Laporan Anda *</strong></label>
              <input type="text" name="judul" class="form-control" placeholder="Ketik judul laporan" required>
            </div>

            <div class="form-group mb-3">
              <label><strong>Isi Laporan Anda *</strong></label>
              <textarea name="isi" class="form-control" rows="5" placeholder="Ketik isi laporan" required></textarea>
            </div>

            <div class="form-group mb-3">
              <label><strong>Tanggal Kejadian *</strong></label>
              <input type="date" name="tanggal_kejadian" class="form-control" placeholder="dd/mm/yyyy" required>
            </div>

            <div class="form-group mb-3">
              <label><strong>Lokasi / Ruang Kelas *</strong></label>
              <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Ruang Lab RPL" required>
            </div>

            <div class="form-group mb-3">
              <label><strong>Pihak Terkait</strong></label>
              <input type="text" name="instansi" class="form-control" placeholder="Contoh: Guru BK / Wali Kelas">
            </div>

            <div class="form-group mb-3">
              <label><strong>Upload Lampiran</strong></label>
              <input type="file" name="lampiran" class="form-control">
            </div>

            <div class="form-check mb-3">
              <input type="checkbox" name="anonim" value="1" class="form-check-input" id="anonimCheck">
              <label class="form-check-label" for="anonimCheck">Kirim sebagai Anonim / Rahasia</label>
            </div>

            <button type="submit" id="submitBtn" class="btn btn-success btn-block"
              style="border-radius:25px; padding:12px; font-weight:600;">
              Kirim Laporan
            </button>
          </form>
        </div>
      </div>

      <div class="alert alert-info mt-4" style="border-left:5px solid #28a745;">
        <strong>Info:</strong> Laporan Anda akan diperiksa oleh pihak sekolah sesuai urutan masuk.
        Pastikan informasi yang Anda berikan lengkap dan jelas untuk penanganan yang lebih cepat.
        Kami akan memberikan update terkait status laporan Anda melalui kontak yang Anda berikan (jika tidak anonim).
      </div>
    </div>
  </div>
</div>

<script>
function disableSubmit() {
    document.getElementById('submitBtn').disabled = true;
    return true;
}
</script>

<style>
.form-control {
  border-radius: 12px;
  border: 1px solid #28a745;
}

.form-control:focus {
  border-color: #28a745;
  box-shadow: 0 0 5px rgba(40, 167, 69, 0.4);
}

.btn-success {
  background-color: #28a745;
  border: none;
}

.btn-success:hover {
  background-color: #19692c;
}

.alert-info {
  background-color: #d4edda;
  color: #155724;
}
</style>

<?php include 'footer.php'; ?>
