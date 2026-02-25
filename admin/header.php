<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../koneksi/koneksi.php';
?>


<!DOCTYPE html>
<html>
<head>
	<title>Admin Pelayanan Pengaduan Siswa</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<script src="../js/jquery.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-default" style="padding: 5px;">
	<div class="container">

		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
			        data-target="#navbar-content" aria-expanded="false" aria-controls="navbar-content">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="halaman_utama.php"><strong>SIPANDAI Admin/Petugas</strong></a>
		</div>

		<div class="collapse navbar-collapse" id="navbar-content">
			<ul class="nav navbar-nav">

				<li><a href="halaman_utama.php"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</a></li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<i class="glyphicon glyphicon-list-alt"></i> Kelola Data <span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="daftar_pengaduan.php"><i class="glyphicon glyphicon-user"></i> Data Laporan</a></li>
						<li><a href="data_petugas.php"><i class="glyphicon glyphicon-user"></i> Data Petugas</a></li>
						<li><a href="data_user.php"><i class="glyphicon glyphicon-user"></i> Data User</a></li>

					</ul>
				</li>

				<li><a href="statistik.php"><i class="glyphicon glyphicon-stats"></i> Statistik</a></li>

				<li><a href="kontak_bantuan.php"><i class="glyphicon glyphicon-comment"></i> Kontak & Bantuan</a></li>

			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<i class="glyphicon glyphicon-cog"></i> Pengaturan <span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="proses/logout.php">Logout</a></li>
						<li><a href="profil_admin.php">Profil</a></li>
					</ul>
				</li>
			</ul>
		</div>

	</div>
</nav>
