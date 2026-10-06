<?php
$_SESSION = []; // kosongkan semua session

$response = [
    'status' => 'success',
    'pesan'  => 'Semua data session berhasil dikosongkan!'
];

// Kembalikan pengguna ke halaman utama
header('Location: index.php');
exit;
