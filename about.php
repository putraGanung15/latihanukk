<?php
include 'header.php';
?>

<div style="
  position: relative;
  background-image: url('image/footer/smk3.jpg'); 
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
  padding: 120px 0;
  color: #fff;
">

  <div class="container text-center" style="position: relative; z-index: 1;">
    <h1 style="font-weight: bold; font-size: 48px;">
      Profil SMK Muhammadiyah 4 Yogyakarta
    </h1>
    <p style="font-size: 18px; max-width: 750px; margin: 20px auto; line-height: 1.8;">
      SMK Muhammadiyah 4 Yogyakarta adalah sekolah kejuruan yang berkomitmen
      mencetak generasi unggul, berakhlak mulia, dan siap bersaing di dunia kerja
      maupun dunia usaha dengan berlandaskan nilai-nilai Islam.
    </p>
  </div>
</div>

<div class="container" style="padding: 80px 0;">
  <div class="row align-items-center">

    <div class="col-md-6" data-aos="fade-right">
      <img src="image/footer/smk.png" alt="SMK Muhammadiyah 4 Yogyakarta"
        style="width:80%; max-width:300px; height:auto; border-radius:15px; box-shadow:0 8px 20px rgba(0,0,0,0.1);">
    </div>

    <div class="col-md-6" data-aos="fade-left">
      <h2 style="color:#28a745; font-weight:bold; margin-bottom:20px;">
        Tentang Kami
      </h2>

      <p style="font-size:16px; line-height:1.8; text-align:justify;">
        SMK Muhammadiyah 4 Yogyakarta merupakan sekolah menengah kejuruan
        yang berada di bawah naungan Persyarikatan Muhammadiyah.
        Sekolah ini memiliki komitmen untuk memberikan pendidikan yang
        berkualitas dengan mengintegrasikan ilmu pengetahuan,
        keterampilan, dan nilai-nilai keislaman.
        <br><br>
        Dengan tenaga pendidik profesional dan fasilitas yang memadai,
        sekolah berupaya menciptakan lulusan yang kompeten,
        berkarakter, serta mampu bersaing di era global.
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
        ">
          VISI
        </h2>

        <p style="font-size:16px; line-height:1.8; text-align:justify;">
          Terwujudnya lulusan yang beriman dan bertakwa kepada Allah SWT,
          berakhlak mulia, kompeten di bidang keahlian, serta siap
          menghadapi tantangan dunia kerja dan dunia usaha secara profesional.
        </p>
      </div>

      
      <div class="col-md-6" data-aos="fade-up" data-aos-delay="150">
        <h2 style="
          border-left:6px solid #28a745;
          padding-left:15px;
          font-weight:bold;
          margin-bottom:15px;
        ">
          MISI
        </h2>

        <ul style="margin-left:15px; font-size:16px; line-height:1.8; text-align:justify;">
          <li>Menyelenggarakan pendidikan berbasis kompetensi dan karakter Islami.</li>
          <li>Meningkatkan kualitas pembelajaran sesuai kebutuhan dunia industri.</li>
          <li>Mengembangkan potensi peserta didik melalui kegiatan akademik dan non-akademik.</li>
          <li>Membentuk lulusan yang mandiri, kreatif, dan inovatif.</li>
          <li>Meningkatkan kerja sama dengan dunia usaha dan dunia industri.</li>
        </ul>
      </div>

    </div>

  </div>
</div>



<<style>
.jurusan-card {
  position: relative;
  overflow: hidden;
  border-radius: 20px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.1);
  transition: 0.4s ease;
  cursor: pointer;
}

.jurusan-card img {
  width: 100%;
  height: 250px;
  object-fit: cover;
  transition: 0.4s ease;
}

.jurusan-card .overlay {
  position: absolute;
  bottom: 0;
  width: 100%;
  padding: 20px;
  background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
  color: #fff;
  text-align: center;
}

.jurusan-card h5 {
  margin: 0;
  font-weight: bold;
}

.jurusan-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 0 30px rgba(40,167,69,0.6);
}

.jurusan-card:hover img {
  transform: scale(1.1);
}
</style>


<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({
  duration:1000,
  once:true
});
</script>

<section style="padding:80px 0; background:#ffffff;">
  <div class="container text-center">

    <h2 data-aos="fade-up"
        style="color:#28a745; font-weight:bold; margin-bottom:40px;">
        Lokasi Sekolah
    </h2>

    <div data-aos="fade-up" data-aos-delay="150"
         style="border-radius:20px; overflow:hidden;
         box-shadow:0 15px 40px rgba(0,0,0,0.15);">

      <iframe 
        src="https://www.google.com/maps?q=SMK+Muhammadiyah+4+Yogyakarta&output=embed"
        width="100%" 
        height="450" 
        style="border:0;"
        allowfullscreen=""
        loading="lazy">
      </iframe>

    </div>
  </div>
</section>


<style>
.social-card {
  background:#ffffff;
  padding:30px;
  border-radius:25px;
  box-shadow:0 10px 25px rgba(0,0,0,0.08);
  transition:0.4s;
}

.social-card:hover {
  transform: translateY(-10px);
  box-shadow:0 0 25px rgba(40,167,69,0.6),
             0 0 60px rgba(40,167,69,0.3);
}

.social-card h4 {
  margin-bottom:20px;
  color:#28a745;
  font-weight:bold;
}

.social-card i {
  margin-right:8px;
}

.btn-success {
  border-radius:25px;
  padding:8px 25px;
}
</style>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({
  duration:1000,
  once:true
});
</script>

<?php
include 'footer.php';
?>