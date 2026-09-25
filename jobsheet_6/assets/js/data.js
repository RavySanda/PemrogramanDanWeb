async function muatDataJSON(fileJSON, daftarKunci) {
  const tbody = document.querySelector(".table-responsive table tbody");
  const loading = document.getElementById("loading-indicator");

  if (!tbody) return;

  loading.style.display = "block";
  tbody.innerHTML = "";

  try {
    await new Promise((resolve) => setTimeout(resolve, 3000));

    const res = await fetch("../data/" + fileJSON);

    if (!res.ok) {
      throw new Error(
        "Gagal mengambil data (status " + res.status + ")"
      );
    }

    const data = await res.json();

    data.forEach(function (item) {
      const tr = document.createElement("tr");

      let isiKolom = "";

      daftarKunci.forEach(function (kunci) {
        isiKolom += "<td>" + item[kunci] + "</td>";
      });

      isiKolom +=
        "<td>" +
        "<button type=\"button\">Edit</button> " +
        "<button type=\"button\" class=\"btn-hapus\">Hapus</button>" +
        "</td>";

      tr.innerHTML = isiKolom;

      tbody.appendChild(tr);
    });

  } catch (err) {
    tbody.innerHTML =
      "<tr><td colspan=\"" +
      (daftarKunci.length + 1) +
      "\">Gagal memuat data: " +
      err.message +
      "</td></tr>";

  } finally {
    loading.style.display = "none";
  }
}