<?php
session_start();
session_unset();
session_destroy();

echo "<script>
    alert('Berhasil logout');
    window.location = 'user_login.php';
</script>";
exit;
?>
