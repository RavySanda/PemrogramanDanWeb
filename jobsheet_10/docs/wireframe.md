+-------------------------------------------------------+
| SIMPUS-Mini                                           |
|-------------------------------------------------------|
| Beranda | Daftar Buku | Registrasi                    |
|-------------------------------------------------------|
|                                                       |
|   [ Registrasi Anggota Baru ]                         |
|                                                       |
|   Nama Lengkap  : [_________________________]         |
|   Email / No. HP: [_________________________]         |
|   Alamat        : [_________________________]         |
|                                                       |
|   [ Daftar Menjadi Anggota ]                          |
|                                                       |
|   Pastikan data diri yang diisi sudah benar.          |
|                                                       |
+-------------------------------------------------------+




### User Flow: Penolakan Peminjaman (Anggota Menunggak)

[Petugas Login] -> [Dashboard] -> [Pilih menu "Peminjaman Baru"] 
-> [Petugas memilih nama Anggota di form] -> [Sistem mengecek riwayat denda anggota] 
-> [Muncul Peringatan UI: "Akses Ditolak! Anggota masih memiliki tunggakan"] 
-> [Sistem menonaktifkan (disable) pilihan Buku dan tombol Simpan] 
-> [Petugas membatalkan form dan meminta anggota melunasi denda]

**Penjelasan Singkat:**
Alur ini menerapkan aturan bisnis di mana sistem secara otomatis memvalidasi status anggota dan mencegah (*disable*) transaksi baru jika ada denda yang belum dilunasi.
