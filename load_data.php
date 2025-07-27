<?php
$conn = new mysqli("localhost", "root", "", "wilayah");
$id_kab = intval($_GET['id_kabupaten']);
$result = $conn->query("SELECT * FROM data_wilayah WHERE id_kabupaten = $id_kab");

if ($result->num_rows === 0) {
  echo "<p><em>Data tidak ditemukan.</em></p>";
} else {


  echo '<div class="grid" id="kecamatanGrid">';
  while ($row = $result->fetch_assoc()) {
    $persen = 0;
    if ($row['rencana_sppg'] > 0) {
      $persen = ($row['sppg_operasional'] / $row['rencana_sppg']) * 100;
    }
    $warna = "red";
    if ($persen >= 100) $warna = "green";
    elseif ($persen >= 50) $warna = "yellow";

    echo '<div class="card ' . $warna . '">';
    echo '<h3>' . htmlspecialchars($row['nama_kecamatan']) . '</h3>';
    echo '<p><strong>Potensi Penerima Manfaat:</strong> ' .rtrim(rtrim(number_format($row['potensi_penerima'], 2, '.', ''), '0'), '.');
    echo '<p><strong>Rencana Jumlah SPPG:</strong> ' . $row['rencana_sppg'] . '</p>';
    echo '<p><strong>Jumlah SPPG yang sudah operasional per 14 Juni 2025:</strong> ' . $row['sppg_operasional'] . '</p>';
    echo '<p><strong></strong> ' . round($persen, 2) . '%</p>';
    echo '</div>';
  }
  echo '</div>';
}
?>
