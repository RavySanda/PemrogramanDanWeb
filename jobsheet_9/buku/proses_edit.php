<?php
require_once __DIR__ . '/../includes/koneksi.php';

$id = $_POST['id'] ?? null;
// ... (lanjut kode yang kamu kirim tadi)
// Tangkap semua data dari form (tambahkan kode ini)
$judul = $_POST['judul'] ?? '';
$pengarang = $_POST['pengarang'] ?? '';
$tahun = $_POST['tahun'] ?? '';
$isbn = $_POST['isbn'] ?? '';
$stok = $_POST['stok'] ?? 0;
$kategori = $_POST['kategori'] ?? '';

if (!$id) {
    header('Location: list.php');
    exit;
}

// Proses update ke database
$stmt = $pdo->prepare(
    "UPDATE buku SET judul = :judul, pengarang = :pengarang, tahun = :tahun,
        isbn = :isbn, stok = :stok, kategori = :kategori WHERE id = :id"
);
$stmt->execute([
    'judul' => $judul,
    'pengarang' => $pengarang,
    'tahun' => (int) $tahun,
    'isbn' => $isbn,
    'stok' => (int) $stok,
    'kategori' => $kategori,
    'id' => $id,
]);

// Setelah berhasil update, kembalikan ke halaman daftar buku
header('Location: list.php');
exit;