<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Debug Session</title>
</head>
<body>
    <h2>Mengintip Isi $_SESSION</h2>
    <hr>
    <!-- Tag pre digunakan agar struktur array PHP ditampilkan rapi dan mudah dibaca -->
    <pre><?php print_r($_SESSION); ?></pre>
    <hr>
    <a href="index.php">Kembali ke Beranda</a>
</body>
</html>
