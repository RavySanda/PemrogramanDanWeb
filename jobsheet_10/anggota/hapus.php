<?php
// 1. Guard Utama: Mengecek apakah pengguna sudah login (WAJIB PALING ATAS)
require __DIR__ . '/../includes/auth.php'; 

// 2. Pengecekan Hak Akses (Role-based Access Control)
// Jika role bukan 'admin', tolak akses dan kembalikan ke halaman list
if ($_SESSION['role'] !== 'admin') {
    $_SESSION['flash'] = [
        'type' => 'error', 
        'pesan' => 'Akses ditolak: Hanya admin yang memiliki izin untuk menghapus data anggota.'
    ];
    header('Location: list.php');
    exit;
}

// 3. Keamanan Tambahan: Pastikan file ini hanya bisa diakses lewat form (metode POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

// 4. Panggil koneksi ke database PostgreSQL
require __DIR__ . '/../includes/koneksi.php';

// 5. Tangkap ID anggota yang akan dihapus
$id = $_POST['id'] ?? null;

// 6. Proses eksekusi hapus data dari tabel anggota
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM anggota WHERE id = :id");
    $stmt->execute(['id' => $id]);
    
    // Siapkan pesan sukses
    $_SESSION['flash'] = [
        'type' => 'success', 
        'pesan' => 'Data anggota berhasil dihapus.'
    ];
}

// 7. Arahkan kembali ke halaman daftar anggota setelah proses selesai
header('Location: list.php');
exit;