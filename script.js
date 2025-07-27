document.addEventListener('DOMContentLoaded', function () {
  const provinsiSelect = document.getElementById('provinsi');
  const kabupatenSelect = document.getElementById('kabupaten');
  const resultDiv = document.getElementById('result');

  function loadKabupaten(idProvinsi) {
    kabupatenSelect.innerHTML = '<option>Loading...</option>';
    fetch('load_kabupaten.php?id_provinsi=' + idProvinsi)
      .then(res => res.json())
      .then(data => {
        kabupatenSelect.innerHTML = '<option value="">-- Pilih Kabupaten/Kota --</option>';
        data.forEach(kab => {
          const option = document.createElement('option');
          option.value = kab.id;
          option.text = kab.nama_kabupaten;
          kabupatenSelect.appendChild(option);
        });
        kabupatenSelect.disabled = false;
        resultDiv.style.display = 'none';
      });
  }

  function loadDataKabupaten(idKabupaten) {
    resultDiv.innerHTML = 'Memuat data...';
    fetch('load_data.php?id_kabupaten=' + idKabupaten)
      .then(res => res.text())
      .then(html => {
        resultDiv.innerHTML = html;
        resultDiv.style.display = 'block';
      });
  }

  provinsiSelect.addEventListener('change', function () {
    const id = this.value;
    resultDiv.style.display = 'none';
    resultDiv.innerHTML = "";
    if (id) {
      loadKabupaten(id);
    } else {
      kabupatenSelect.innerHTML = '<option value="">-- Pilih Kabupaten/Kota --</option>';
      kabupatenSelect.disabled = true;
    }
  });

  kabupatenSelect.addEventListener('change', function () {
    const id = this.value;
    if (id) {
      loadDataKabupaten(id);
    } else {
      resultDiv.style.display = 'none';
      resultDiv.innerHTML = "";
    }
  });
});

function exportCSV() {
  const rows = [["Kecamatan", "Potensi", "Rencana SPPG", "SPPG Operasional", "% Operasional"]];
  document.querySelectorAll("#kecamatanGrid .card").forEach(card => {
    const data = Array.from(card.querySelectorAll("p")).map(p => p.textContent.split(": ")[1]);
    rows.push([card.querySelector("h3").textContent, ...data]);
  });
  let csvContent = rows.map(e => e.join(",")).join("\n");
  let blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
  let link = document.createElement("a");
  link.setAttribute("href", URL.createObjectURL(blob));
  link.setAttribute("download", "data_kecamatan.csv");
  link.click();
}
