<?php
$page_title = "Daftar Anggota";

include __DIR__ . '/../includes/header.php';

$daftarAnggota = $_SESSION['anggota'] ?? [];

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>

<section>

    <h2>Daftar Anggota</h2>

    <?php if ($flash): ?>
        <p class="flash flash-<?php echo $flash['type']; ?>">
            <?php echo $flash['pesan']; ?>
        </p>
    <?php endif; ?>

    <p>
        <a href="tambah.php">+ Tambah Anggota</a>
    </p>

    <table>
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
                            <?php echo htmlspecialchars($anggota['no_anggota']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($anggota['nama']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($anggota['alamat']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($anggota['no_hp']); ?>
                        </td>
                    </tr>

                <?php endforeach; ?>

            <?php endif; ?>

        </tbody>
    </table>

</section>

<?php
include __DIR__ . '/../includes/footer.php';
?>