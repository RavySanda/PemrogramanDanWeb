<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Inisialisasi penghitung gagal login jika belum ada
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

// 2. Blokir akses jika sudah gagal 3 kali berturut-turut
if ($_SESSION['login_attempts'] >= 3) {
    $_SESSION['flash'] = [
        'type' => 'error', 
        'pesan' => 'Terlalu banyak percobaan. Akun diblokir sementara. Silakan tutup browser dan coba lagi.'
    ];
    header('Location: login.php');
    exit;
}

// Panggil koneksi database
require __DIR__ . '/../includes/koneksi.php';

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// 3. Verifikasi kredensial
if ($user && password_verify($password, $user['password'])) {
    
    // Jika login berhasil, reset angka percobaan gagal kembali ke 0
    $_SESSION['login_attempts'] = 0;
    
    // Simpan identitas ke session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['role'] = $user['role'];
    
    // Fitur "Ingat Saya" (dari latihan nomor 2)
    if (isset($_POST['remember']) && $_POST['remember'] === '1') {
        setcookie('ingat_saya_id', $user['id'], time() + (7 * 24 * 60 * 60), '/');
    }

    header('Location: ../index.php');
    exit;

} else {
    // 4. Jika login gagal, tambahkan angka percobaan +1
    $_SESSION['login_attempts']++;
    
    $sisa = 3 - $_SESSION['login_attempts'];
    
    // Berikan pesan error sesuai sisa percobaan
    if ($sisa > 0) {
        $_SESSION['flash'] = [
            'type' => 'error', 
            'pesan' => "Username atau password salah. (Sisa percobaan: $sisa)"
        ];
    } else {
        $_SESSION['flash'] = [
            'type' => 'error', 
            'pesan' => 'Terlalu banyak percobaan. Akun diblokir sementara.'
        ];
    }
    
    header('Location: login.php');
    exit;
}