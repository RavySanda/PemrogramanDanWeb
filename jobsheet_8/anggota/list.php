<?php
require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$daftarAnggota = $pdo->query(
    "SELECT * FROM anggota ORDER BY id DESC"
)->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="container">

    <div class="page-header">
        <h1>Daftar Anggota</h1>

        <a href="tambah.php" class="btn btn-primary">
            + Tambah Anggota
        </a>
    </div>

    <div class="table-responsive">

        <table class="table">

            <thead>
                <tr>
                    <th>No. Anggota</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No. HP</th>
                </tr>
            </thead>

            <tbody>

                <?php if (empty($daftarAnggota)): ?>

                    <tr>
                        <td colspan="4">
                            Belum ada data anggota.
                        </td>
                    </tr>

                <?php else: ?>

                    <?php foreach ($daftarAnggota as $anggota): ?>

                        <tr>
                            <td>
                                <?= htmlspecialchars($anggota['no_anggota']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($anggota['nama']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($anggota['alamat']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($anggota['no_hp']) ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</main>

<?php
require __DIR__ . '/../includes/footer.php';
?>