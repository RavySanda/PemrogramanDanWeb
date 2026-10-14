<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
session_destroy();

// Hapus cookie dengan mengatur masa berlakunya ke 1 jam yang lalu
if (isset($_COOKIE['ingat_saya_id'])) {
    setcookie('ingat_saya_id', '', time() - 3600, '/');
}

header('Location: login.php');
exit;