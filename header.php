<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

include 'koneksi/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<title>SIPANDAI – Sistem Pengaduan dan Aspirasi Siswa</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<style>
		body {
			background-color: #e6f5e6;
			font-family: "Segoe UI", sans-serif;
			padding-top: 60px;
		
		}

		.navbar-default {
			position: fixed;
			top: 0;
			width: 100%;
			z-index: 1030;
			background-color: #28a745;
			border-color: #28a745;
			margin: 0;
		}

		
		.navbar-default .navbar-brand {
			color: #fff;
			font-weight: bold;
			font-size: 18px;
		}

		.navbar-default .navbar-brand img {
			height: 35px;
			margin-right: 10px;
			vertical-align: middle;
		}

	
		.navbar-default .navbar-nav>li>a {
			color: #fff;
			font-weight: 500;
			transition: 0.3s;
		}

		.navbar-default .navbar-nav>li>a:hover {
			color: #d4edda;
			background-color: transparent;
		}

	
		.navbar-default .navbar-nav .dropdown-menu {
			background-color: #343a40;
			border: none;
			border-radius: 5px;
		}

		.navbar-default .navbar-nav .dropdown-menu>li>a {
			color: #f1f1f1;
		}

		.navbar-default .navbar-nav .dropdown-menu>li>a:hover {
			background-color: #28a745;
			color: #fff;
		}

	
		.navbar-toggle {
			border-color: #fff;
		}

		.icon-bar {
			background-color: #fff;
		}
	</style>
</head>

<body>

	<nav class="navbar navbar-default" role="navigation">
		<div class="container">
	
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
					data-target="#navbar-collapse" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">
					SIPANDAI
				</a>
			</div>

		
			<div class="collapse navbar-collapse" id="navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="index.php">Beranda</a></li>
					<li><a href="about.php">Tentang Sekolah</a></li>
					<li><a href="manual.php">Manual Aplikasi</a></li>
					<li><a href="lapor1.php">Lapor</a></li>
					<li><a href="kontak.php">Kontak & Bantuan</a></li>

					<?php if (!isset($_SESSION['nama'])) { ?>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="glyphicon glyphicon-user"></i> Akun <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li><a href="user_login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        </ul>
    </li>
<?php } else { ?>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="glyphicon glyphicon-user"></i> 
            <?= htmlspecialchars($_SESSION['nama']); ?> 
            <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li><a href="laporan_saya.php">Feedback</a></li>
            <li><a href="logoutuser.php">Logout</a></li>
        </ul>
    </li>
<?php } ?>
				</ul>
			</div>
		</div>
	</nav>
</body>

</html>