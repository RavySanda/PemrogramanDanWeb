// ===== Fungsi Pembantu: Update Counter Tabel (Soal 4) =====
function updateCounter(table) {
    const counter = document.getElementById("table-counter");
    if (!counter) return;
    
    const total = table.querySelectorAll("tbody tr").length;
    const visible = Array.from(table.querySelectorAll("tbody tr")).filter(row => row.style.display !== "none").length;
    
    // PERBAIKAN: Gunakan backtick (di sebelah kiri tombol angka 1), bukan petik biasa
   counter.textContent = "Menampilkan " + visible + " dari " + total + " data";
}

// ===== Hamburger menu (JS-driven, menggantikan checkbox hack) =====
function initNavToggle() {
    const toggleBtn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector("header nav");
    
    if (!toggleBtn || !nav) return;
    
    toggleBtn.addEventListener("click", function () {
        nav.classList.toggle("nav-open");
    });
}

// ===== Konfirmasi hapus (front-end only, belum ke server) =====
// ===== Konfirmasi hapus =====
function initHapusConfirm() {
  document.addEventListener("click", function (e) {

    // SOAL 4: melihat elemen yang diklik
    console.log(e.target);

    const btn = e.target.closest(".btn-hapus");
    if (!btn) return;

    const row = btn.closest("tr");
    const nama = row
      ? row.querySelector("td")?.textContent
      : "data ini";

    const yakin = confirm(
      "Yakin ingin menghapus \"" + nama + "\"?"
    );

    if (yakin && row) {
      row.remove();
    }
  });
}

// ===== Filter/pencarian tabel real-time =====
function initTableFilter() {
    const input = document.getElementById("search-input");
    const table = document.querySelector(".table-responsive table");
    
    if (!input || !table) return;
    
    updateCounter(table); // SOAL 4: Inisialisasi counter saat pertama kali dimuat
    
    input.addEventListener("keyup", function () {
        const keyword = input.value.toLowerCase();
        const rows = table.querySelectorAll("tbody tr");
        
        rows.forEach(function (row) {
            const selPertama = row.querySelector("td");
            const teks = selPertama ? selPertama.textContent.toLowerCase() : "";
            
            row.style.display = teks.includes(keyword) ? "" : "none";
        });
        
        updateCounter(table); // SOAL 4: Update counter setelah tabel difilter
    });
}

// ===== Validasi form (client-side) =====
function tampilkanError(input, pesan) {
    hapusError(input);
    const span = document.createElement("span");
    span.className = "error";
    span.textContent = pesan;
    input.insertAdjacentElement("afterend", span);
}

function hapusError(input) {
    const next = input.nextElementSibling;
    if (next && next.classList.contains("error")) {
        next.remove();
    }
}

function initValidasiForm() {
    const form = document.getElementById("form-tambah");
    if (!form) return;
    
    form.addEventListener("submit", function (e) {
        let valid = true;
        
        // SOAL 5: Refactor validasi menggunakan array & perulangan forEach
        const requiredFields = ['judul', 'nama', 'pengarang', 'no_anggota'];
        requiredFields.forEach(fieldName => {
            const field = form.querySelector(`[name='${fieldName}']`);
            if (field) {
                if (field.value.trim() === "") {
                    tampilkanError(field, "Field ini wajib diisi.");
                    valid = false;
                } else {
                    hapusError(field);
                }
            }
        });

        // Pengecekan ISBN 
        const isbn = form.querySelector("[name='isbn']");
        if (isbn && isbn.value.trim() !== "") {
            const regexISBN = /^[0-9-]+$/; 
            if (!regexISBN.test(isbn.value)) {
                tampilkanError(isbn, "ISBN hanya boleh berisi angka dan tanda hubung (-).");
                valid = false;
            } else {
                hapusError(isbn);
            }
        }

        // Pengecekan Tahun
        const tahun = form.querySelector("[name='tahun']");
        if (tahun) {
            const nilai = parseInt(tahun.value, 10);
            if (isNaN(nilai) || nilai < 1900 || nilai > 2026) {
                tampilkanError(tahun, "Tahun harus di antara 1900-2026.");
                valid = false;
            } else {
                hapusError(tahun);
            }
        }

        // Pengecekan Stok
        const stok = form.querySelector("[name='stok']");
        if (stok) {
            const nilaiStok = parseInt(stok.value, 10);
            if (isNaN(nilaiStok) || nilaiStok < 0) {
                tampilkanError(stok, "Stok tidak boleh bernilai negatif.");
                valid = false;
            } else {
                hapusError(stok);
            }
        }

        if (!valid) {
            e.preventDefault();
        }
    });
}

// ===== Menjalankan semua fungsi saat halaman selesai dimuat =====
document.addEventListener("DOMContentLoaded", function () {
    initNavToggle();
    initHapusConfirm();
    initTableFilter();
    initValidasiForm();
});