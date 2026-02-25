<footer class="footer-modern">
  <div class="container py-5">
    <div class="row align-items-start">


      <div class="col-md-4 mb-4 footer-left">
        <div class="d-flex align-items-center">
          <img src="image/footer/smk.png" alt="Logo Sekolah" class="footer-logo">
          <h4 class="footer-title ms-3 mb-0">Pengaduan Siswa</h4>
        </div>
        <p class="footer-desc mt-3">
          Layanan resmi pengaduan siswa untuk menciptakan lingkungan sekolah yang aman,
          nyaman, dan transparan.
        </p>
      </div>


      <div class="col-md-4 mb-4 footer-center">
        <h5 class="footer-subtitle">Menu</h5>
        <ul class="footer-links">
          <li><a href="index.php">Beranda</a></li>
          <li><a href="about.php">Tentang Sekolah</a></li>
          <li><a href="manual.php">Manual Aplikasi</a></li>
          <li><a href="lapor1.php">Lapor</a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="copy">
    &copy; <?= date('Y'); ?> SIPANDAI – Sistem Pengaduan dan Aspirasi Siswa — All Rights Reserved.
  </div>
</footer>

<style>
  .footer-modern {
    border-top: 4px solid #28a745;
    background-color: #f9fff9;
    font-family: "Poppins", sans-serif;
  }

  .footer-logo {
    width: 55px;
    height: 55px;
    object-fit: contain;
  }

  .footer-title {
    color: #28a745;
    font-weight: 700;
  }

  .footer-desc {
    font-size: 14px;
    color: #555;
    line-height: 1.6;
  }

  .footer-subtitle {
    color: #28a745;
    font-weight: 600;
    margin-bottom: 12px;
  }

  .footer-links {
    list-style: none;
    padding: 0;
  }

  .footer-links li {
    margin-bottom: 6px;
  }

  .footer-links a {
    color: #000;
    text-decoration: none;
    transition: color 0.3s;
  }

  .footer-links a:hover {
    color: #28a745;
  }

  .social-icons a {
    font-size: 22px;
    color: #28a745;
    margin-right: 12px;
    transition: 0.3s;
  }

  .social-icons a:hover {
    color: #19692c;
    transform: scale(1.2);
  }

  .copy {
    background-color: #28a745;
    color: #fff;
    text-align: center;
    font-size: 14px;
    padding: 12px 0;
  }

  @media (max-width: 768px) {

    .footer-left,
    .footer-center,
    .footer-right {
      text-align: center;
    }

    .footer-left .d-flex {
      justify-content: center;
    }

    .social-icons {
      justify-content: center;
    }
  }
</style>