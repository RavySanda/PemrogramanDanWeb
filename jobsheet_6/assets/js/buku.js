document.addEventListener("DOMContentLoaded", function () {

  muatDataJSON("buku.json", [
    "judul",
    "pengarang",
    "tahun",
    "stok",
    "kategori"
  ]);

  const btnMuatUlang = document.getElementById("btn-muat-ulang");

  if (btnMuatUlang) {
    btnMuatUlang.addEventListener("click", function () {
      muatDataJSON("buku.json", [
        "judul",
        "pengarang",
        "tahun",
        "stok",
        "kategori"
      ]);
    });
  }

});