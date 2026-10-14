<?php
$page_title = "Edit Buku";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$id = $_GET['id'] ?? null;
?>

<?php
if (!$id) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM buku WHERE id = :id");
$stmt->execute(['id' => $id]);
$buku = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$buku) {
    header('Location: list.php');
    exit;
}
?>

<section>
    <h2>Edit Buku</h2>
   <form id="form-edit" class="form-edit" method="post" action="proses_edit.php">
    <input type="hidden" name="id" value="<?php echo $buku['id']; ?>">
    <p>
        <label for="judul">Judul</label><br>
        <input type="text" id="judul" name="judul" value="<?php echo $buku['judul']; ?>">
    </p>
    <p>
        <label for="pengarang">Pengarang</label><br>
        <input type="text" id="pengarang" name="pengarang" value="<?php echo $buku['pengarang']; ?>">
    </p>
    <p>
        <label for="tahun">Tahun</label><br>
        <input type="number" id="tahun" name="tahun" value="<?php echo $buku['tahun']; ?>">
    </p>
    <p>
        <label for="isbn">ISBN</label><br>
        <input type="text" id="isbn" name="isbn" value="<?php echo $buku['isbn']; ?>">
    </p>
    <p>
        <label for="stok">Stok</label><br>
        <input type="number" id="stok" name="stok" value="<?php echo $buku['stok']; ?>">
    </p>
    <p>
        <label for="kategori">Kategori</label><br>
        <input type="text" id="kategori" name="kategori" value="<?php echo $buku['kategori']; ?>">
    </p>
    <button type="submit">Simpan Perubahan</button>
</form>

</section>

<script>
document.addEventListener("submit", function(e) {
    const form = e.target;
    if (form.classList.contains("form-edit")) {
        const yakin = confirm("Yakin ingin mengubah data ini?");
        if (!yakin) e.preventDefault();
    }
});
</script>

