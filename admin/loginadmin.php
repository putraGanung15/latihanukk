<?php
session_start();
include '../koneksi/koneksi.php'; 

if (isset($_SESSION['login']) && $_SESSION['role'] === 'admin') {
    header("Location: halaman_utama.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Admin/Petugas - SIPANDAI</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <style>
    
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #a8d5ba, #cfe8d5);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        
        .login-container {
            width: 100%;
            max-width: 400px;
            background-color: #fff;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            text-align: center;
            animation: fadeIn 0.8s ease-in-out;
        }

        
        .login-container h3 {
            margin-bottom: 30px;
            color: #3a8b5f; 
            font-weight: bold;
        }

        
        .login-container .form-control {
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
            transition: 0.3s;
        }

        .login-container .form-control:focus {
            border-color: #3a8b5f;
            box-shadow: 0 0 5px rgba(58,139,95,0.5);
        }

        
        .login-container .btn-success {
            background-color: #3a8b5f;
            border: none;
            font-weight: bold;
            padding: 10px;
            border-radius: 5px;
            transition: 0.3s;
        }

        .login-container .btn-success:hover {
            background-color: #2e6f4a;
        }

       
        @keyframes fadeIn {
            0% {opacity: 0; transform: translateY(-20px);}
            100% {opacity: 1; transform: translateY(0);}
        }

        
        @media (max-width: 500px) {
            .login-container {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    <h3 class="text-center">Admin/Petugas</h3>
    <h3 class="text-center">SIPANDAI</h3>
    <form action="proses/login.php" method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="pass" class="form-control" placeholder="Password" required>
        </div>

        <button type="submit" class="btn btn-success btn-block">Login</button>
    </form>
</div>

</body>
</html>
