<?php
session_start();
include 'header.php';
include 'koneksi/koneksi.php'; 

$totalPengaduan = mysqli_fetch_assoc(mysqli_query($conn, 
    "SELECT COUNT(*) as total FROM pengaduan"
))['total'];

$pengaduanSelesai = mysqli_fetch_assoc(mysqli_query($conn, 
    "SELECT COUNT(*) as total FROM pengaduan WHERE status='Selesai'"
))['total'];

$pengaduanDiproses = mysqli_fetch_assoc(mysqli_query($conn, 
    "SELECT COUNT(*) as total FROM pengaduan WHERE status='Proses'"
))['total'];

$jumlahPengguna = mysqli_fetch_assoc(mysqli_query($conn, 
    "SELECT COUNT(*) as total FROM customer"
))['total'];


$laporan = mysqli_query($conn, 
    "SELECT p.id_pengaduan, c.nama, p.judul, p.klasifikasi, p.status, p.tanggal_kejadian 
     FROM pengaduan p 
     LEFT JOIN customer c ON p.id_customer = c.id_customer 
     ORDER BY p.tanggal_kejadian DESC 
     LIMIT 4"
);

?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIPANDAI – Sistem Pengaduan dan Aspirasi Siswa</title>
  <link rel="icon" type="image/png" href="image/footer/sipandai.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <style>
body {
    font-family: "Segoe UI", sans-serif;
    margin:0;
    padding-top:60px;
    background-color:#e6f5e6;
}

.navbar-default {
    position:fixed;
    top:0;
    width:100%;
    z-index:1030;
    background-color:#28a745;
    border-color:#28a745;
    padding:10px 0;
}
.navbar-default .navbar-brand {
    font-weight:bold;
    color:#fff;
    font-size:20px;
    display:flex;
    align-items:center;
    gap:10px;
}
.navbar-default .navbar-brand img {
    height:35px;
}
.navbar-default .navbar-nav>li>a {
    color:#fff;
    font-weight:500;
}
.navbar-default .navbar-nav>li>a:hover {
    color:#d4edda;
}
.navbar-default .navbar-nav .dropdown-menu {
    background:#343a40;
    border-radius:5px;
}
.navbar-default .navbar-nav .dropdown-menu>li>a {
    color:#f1f1f1;
}
.navbar-default .navbar-nav .dropdown-menu>li>a:hover {
    background-color:#28a745;
    color:#fff;
}

.jumbotron {
    height:450px;
    display:flex;
    justify-content:center;
    align-items:center;
    text-align:center;
    color:white;
    background: url('image/footer/smk4.jpg') no-repeat center center;
    background-size:cover;
    animation: jumbotronZoom 1.5s ease forwards;
}
.jumbotron > div {
    opacity: 0;
    transform: translateY(40px);
    animation: jumbotronText 1.2s ease forwards;
    animation-delay: 0.5s;
}
.jumbotron h1 { font-size:50px; font-weight:800; }
.jumbotron p { font-size:20px; }

@keyframes jumbotronZoom {
    from { background-size: 120%; }
    to { background-size: cover; }
}
@keyframes jumbotronText {
    to { opacity:1; transform: translateY(0); }
}

.section-wrapper {
    max-width:1200px;
    margin:auto;
    padding:60px 20px;
    opacity:0;
    transform: translateY(40px);
    animation: sectionFade 1.2s ease forwards;
}
.section-wrapper#tentang { animation-delay:0.3s; }
.section-wrapper:nth-of-type(2) { animation-delay:0.6s; }

.section-title { 
    text-align:center; 
    font-weight:700; 
    color:#28a745;
    margin-bottom:40px;
}

@keyframes sectionFade {
    to { opacity:1; transform: translateY(0); }
}


#tentang p, #tentang ul { font-size:16px; line-height:1.6; }
#tentang ul li { margin-bottom:8px; }


.alur-container {
    display:flex;
    overflow-x:auto;
    gap:20px;
    padding:0 10px;
}
.alur-step {
    flex:0 0 220px;
    background:#f0fff0;
    border-radius:15px;
    padding:20px;
    text-align:center;
    box-shadow:0 4px 10px rgba(0,0,0,0.05);
    opacity:0;
    transform: translateY(30px);
    animation: cardFade 0.8s ease forwards;
    transition: transform 0.3s;
}
.alur-step:nth-child(1) { animation-delay:0.3s; }
.alur-step:nth-child(2) { animation-delay:0.5s; }
.alur-step:nth-child(3) { animation-delay:0.7s; }
.alur-step:nth-child(4) { animation-delay:0.9s; }
.alur-step:nth-child(5) { animation-delay:1.1s; }
.alur-step:nth-child(6) { animation-delay:1.3s; }
.alur-step:hover { transform: translateY(-8px) scale(1.03); }

@keyframes cardFade {
    to { opacity:1; transform: translateY(0); }
}

.card { border-radius:15px; margin-bottom:20px; }
.card img { border-radius:15px 15px 0 0; }

.footer-modern {
    border-top:4px solid #28a745;
    background:#f9fff9;
    font-family:"Poppins", sans-serif;
    color:#333;
}
.footer-title { color:#28a745; font-weight:700; margin-bottom:0; }
.footer-subtitle { color:#28a745; font-weight:600; margin-bottom:10px; }
.footer-links { list-style:none; padding:0; }
.footer-links li { margin-bottom:6px; }
.footer-links a { text-decoration:none; color:#000; transition:color 0.3s; }
.footer-links a:hover { color:#28a745; }
.social-icons a { color:#28a745; margin-right:10px; font-size:22px; transition:0.3s; }
.social-icons a:hover { transform:scale(1.2); color:#19692c; }
.copy { background:#28a745; color:#fff; text-align:center; font-size:14px; padding:10px 0; margin-top:20px; }

@media (max-width:768px){
    .alur-step { flex:0 0 180px; }
    
}

.lapor-section {
    padding: 40px 0;
}

.lapor-box {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 25px;
    background-color: #28a745;
    color: #fff;
    border-radius: 30px;
    font-weight: 500;
    text-decoration: none



</style>
</head>
<body>
  <div class="jumbotron">
    <div>
      <h1>Selamat Datang di SIPANDAI – Sistem Pengaduan dan Aspirasi Siswa</h1>
      <p>Layanan pengaduan masalah sekolah dengan cepat dan mudah</p>
    </div>
  </div>

  <section id="tentang" class="section-wrapper" style="background-color:#e6f0ff;">
    <h2 class="section-title">Apa itu Layanan SIPANDAI – Sistem Pengaduan dan Aspirasi Siswa</h2>
    <div style="display:flex; flex-wrap:wrap; gap:30px; align-items:center;">
      <div style="flex:1; min-width:300px;">
        <p>Layanan ini memungkinkan siswa untuk melaporkan masalah atau keluhan di sekolah secara online. Semua laporan
          akan ditindaklanjuti oleh pihak sekolah.</p>
        <ul>
          <li>Membuat laporan masalah kelas, fasilitas, atau guru.</li>
          <li>Memantau status laporan secara real-time.</li>
          <li>Mendapatkan tanggapan dari guru atau staf sekolah.</li>
          <li>Melihat arsip laporan dan pengumuman penting.</li>
        </ul>
      </div>
      <div style="flex:1; min-width:300px; text-align:center;">
        <i class="bi bi-mortarboard-fill" style="font-size:100px; color:#00ff40;"></i>
      </div>
    </div>
  </section>


  <section class="section-wrapper" style="background-color:#ffffff;">
    <h2 class="section-title">Alur Pengaduan Siswa</h2>
    <div class="alur-container">
      <?php
      $alur = [
        ['icon' => 'bi-person-fill', 'title' => 'Daftar/Masuk', 'desc' => 'Siswa membuat akun atau masuk.'],
        ['icon' => 'bi-pencil-square', 'title' => 'Tulis Laporan', 'desc' => 'Laporkan masalah di sekolah.'],
        ['icon' => 'bi-clock-fill', 'title' => 'Proses', 'desc' => 'Laporan diverifikasi oleh staf sekolah.'],
        ['icon' => 'bi-chat-dots-fill', 'title' => 'Tanggapan', 'desc' => 'Dapatkan jawaban atau solusi dari sekolah.'],
        ['icon' => 'bi-check-circle-fill', 'title' => 'Selesai', 'desc' => 'Masalah terselesaikan dan ditutup.']
      ];
      foreach ($alur as $step) { ?>
        <div class="alur-step">
          <i class="bi <?= $step['icon']; ?>"></i>
          <h5 class="fw-bold pt-2"><?= $step['title']; ?></h5>
          <p style="font-size:14px;"><?= $step['desc']; ?></p>
        </div>
      <?php } ?>
    </div>
  </section>

<div class="container" style="padding: 80px 0;">
  <div class="row align-items-center">
    <div class="col-md-6" data-aos="fade-right">
      <img src="image/footer/sipandai.png" alt="Pengaduan Siswa"
        style="width:80%; max-width:300px; height:auto; background:transparent; border-radius:15px; box-shadow:0 8px 20px rgba(0,0,0,0.1);">

    </div>
    <div class="col-md-6" data-aos="fade-left">
      <h2 style="color:#28a745; font-weight:bold; margin-bottom:20px;">Cerita Kami</h2>
      <p style="font-size:16px; line-height:1.8; text-align:justify;">
        Layanan Pengaduan Siswa dibuat untuk mempermudah komunikasi antara siswa dan pihak sekolah.
        Kami ingin setiap keluhan, baik terkait fasilitas, guru, maupun kegiatan belajar, dapat tersampaikan dengan
        jelas.
        <br><br>
        Tim kami memastikan setiap laporan ditindaklanjuti dengan cepat, transparan, dan profesional.
        Dengan layanan ini, siswa dapat berperan aktif dalam menciptakan lingkungan sekolah yang nyaman dan kondusif.
      </p>
    </div>
  </div>
</div>


<div style="background-color:#f0f9f0; padding:80px 0;">
  <div class="container">

    <div class="row" style="margin-bottom:60px;">
      <div class="col-md-6" data-aos="fade-up">
        <h2 style="
          border-left:6px solid #28a745;
          padding-left:15px;
          font-weight:bold;
          margin-bottom:15px;
        ">VISI</h2>
        <p style="font-size:16px; line-height:1.8; text-align:justify;">
          Menjadi layanan pengaduan siswa yang cepat, terpercaya, dan responsif untuk menciptakan lingkungan sekolah
          yang nyaman, aman, dan kondusif bagi semua siswa.
        </p>
      </div>

      <div class="col-md-6" data-aos="fade-up" data-aos-delay="150">
        <h2 style="
          border-left:6px solid #28a745;
          padding-left:15px;
          font-weight:bold;
          margin-bottom:15px;
        ">MISI</h2>
        <ul style="margin-left:15px; font-size:16px; line-height:1.8; text-align:justify;">
          <li>Menerima aduan siswa terkait fasilitas, guru, atau kegiatan belajar secara cepat.</li>
          <li>Menindaklanjuti setiap laporan dengan profesional dan transparan.</li>
          <li>Mengedukasi siswa tentang peran aktif dalam menjaga lingkungan sekolah.</li>
          <li>Bekerja sama dengan pihak sekolah untuk solusi yang efektif.</li>
          <li>Memberikan status pengaduan yang bisa dipantau siswa secara real-time.</li>
        </ul>
      </div>
    </div>

  </div>
</div>


<section class="why-choose-us">
  <div class="container text-center">
    <h5 class="subtitle">Mengapa Menggunakan Layanan Kami</h5>
    <h2 class="title">Sekolah Nyaman, Siswa Terlindungi</h2>

    <div class="row justify-content-center mt-5">

      <div class="col-md-4 mb-4">
        <div class="feature-card">
          <i class="bi bi-clipboard-check feature-icon"></i>
          <h4>Proses Cepat</h4>
          <p>Laporan siswa segera ditindaklanjuti pihak sekolah.</p>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="feature-card">
          <i class="bi bi-people feature-icon"></i>
          <h4>Partisipasi Siswa</h4>
          <p>Siswa dapat berperan aktif dalam menciptakan lingkungan belajar nyaman.</p>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="feature-card">
          <i class="bi bi-shield-check feature-icon"></i>
          <h4>Transparan & Terpercaya</h4>
          <p>Status pengaduan dapat dipantau secara jelas oleh siswa.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="container text-center" style="padding:80px 0;">
  <h3 style="font-size:24px; color:#444; font-style:italic;">
    “Sekolah nyaman dimulai dari kepedulian setiap siswa,
    dan laporan Anda adalah langkah nyata untuk perbaikan lingkungan sekolah.”
  </h3>
  <p style="margin-top:20px; color:#28a745; font-weight:bold;">– Tim SIPANDAI – Sistem Pengaduan dan Aspirasi Siswa</p>
</div>


<section class="lapor-section">
  <div class="container text-center">
    
    <a href="lapor1.php" class="lapor-box">
      <div class="lapor-content">
        <i class="bi bi-megaphone-fill"></i>
        <h3>Buat Laporan Sekarang</h3>
        <p>Klik di sini untuk menyampaikan pengaduan atau aspirasi Anda.</p>
      </div>
    </a>

  </div>
</section>


  <footer class="footer-modern">
    <div class="container py-4">
      <div class="row align-items-center">
        <div class="col-md-4 mb-3 d-flex align-items-center">
          <img src="image/footer/smk.png" style="width:50px;height:50px;margin-right:10px;">
          <h4 class="footer-title ms-3 mb-0">Pengaduan Siswa</h4>
          <br>
          <p class="footer-desc mt-3">
          Layanan resmi pengaduan siswa untuk menciptakan lingkungan sekolah yang aman,
          nyaman, dan transparan.
        </p>
        </div>


        <div class="col-md-4 mb-3">
          <h5 class="footer-subtitle">Menu</h5>
          <ul class="footer-links">
            <li><a href="index.php">Beranda</a></li>
            <li><a href="about.php">Tentang Sekolah</a></li>
            <li><a href="manual.php">Manual Aplikasi</a></li>
            <li><a href="lapor1.php">Lapor</a></li>
          </ul>
        </div>
        <div class="col-md-4 mb-3">
  <h5 class="footer-subtitle">Ikuti Kami</h5>
  <div class="social-icons">

  
    <a href="https://www.facebook.com/smkmuh4yk" 
       target="_blank" 
       rel="noopener noreferrer">
      <i class="bi bi-facebook"></i>
    </a>

  
    <a href="https://www.instagram.com/smkmuh4yk" 
       target="_blank" 
       rel="noopener noreferrer">
      <i class="bi bi-instagram"></i>
    </a>

    
    <a href="https://www.youtube.com/@smkmuh4yk" 
       target="_blank" 
       rel="noopener noreferrer">
      <i class="bi bi-youtube"></i>
    </a>

  
    <a href="https://www.tiktok.com/@smkmuh4yk" 
       target="_blank" 
       rel="noopener noreferrer">
      <i class="bi bi-tiktok"></i>
    </a>

  </div>
</div>

        </div>
      </div>
    </div>
    <div class="copy">&copy; <?= date('Y'); ?> SIPANDAI – Sistem Pengaduan dan Aspirasi Siswa — All Rights Reserved.</div>
  </footer>

</body>

</html>