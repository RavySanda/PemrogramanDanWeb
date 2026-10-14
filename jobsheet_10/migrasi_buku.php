<?php

require __DIR__ . '/includes/koneksi.php';

$file = __DIR__ . '/../jobsheet_6/data/buku.json';

// Cek apakah file JSON ditemukan
if (!file_exists($file)) {
    die("File buku.json tidak ditemukan.");
}

// Membaca isi file JSON
$json = file_get_contents($file);

// Mengubah JSON menjadi array PHP
$data = json_decode($json, true);

// Cek apakah JSON valid
if (!is_array($data)) {
    die("Data JSON tidak valid.");
}

// Menyiapkan query INSERT
$stmt = $pdo->prepare(
    "INSERT INTO buku
    (judul, pengarang, tahun, stok, kategori)
    VALUES
    (:judul, :pengarang, :tahun, :stok, :kategori)"
);

// Menghitung jumlah data yang berhasil dimasukkan
$jumlah = 0;

// Memasukkan setiap data buku ke database
foreach ($data as $buku) {

    $stmt->execute([
        'judul' => $buku['judul'],
        'pengarang' => $buku['pengarang'],
        'tahun' => (int) $buku['tahun'],
        'stok' => (int) $buku['stok'],
        'kategori' => $buku['kategori']
    ]);

    $jumlah++;
}

// Menampilkan hasil migrasi
echo "Migrasi berhasil.<br>";
echo "$jumlah data buku berhasil dimasukkan.";