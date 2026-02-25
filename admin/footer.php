
<footer class="footer" style="background-color:#f8f8f8; padding:20px 0; border-top:1px solid #ddd; margin-top:50px;">
    <div class="container text-center">
        <p style="margin:0; color:#555;">
            &copy; <?php echo date("Y"); ?> SIPANDAI Admin/Petugas. Semua hak dilindungi.
        </p>
        <p style="margin:5px 0 0 0;">
            <a href="halaman_utama.php" style="color:#28a745; text-decoration:none;">Dashboard</a> |
            <a href="daftar_pengaduan.php" style="color:#28a745; text-decoration:none;">Daftar Pengaduan</a>
        </p>
    </div>
</footer>


<script>
    
    console.log("Footer admin loaded");
</script>
</body>
</html>

<style>
	
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
}


.wrapper {
    min-height: 100%;          
    display: flex;
    flex-direction: column;
}


.content {
    flex: 1;                   
}


.footer {
    background-color: #f8f8f8;
    padding: 20px 0;
    border-top: 1px solid #ddd;
    color: #555;
    text-align: center;
}
.footer a {
    color: #28a745;
    text-decoration: none;
}
.footer a:hover {
    text-decoration: underline;
}

</style>