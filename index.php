<?php
$conn = new mysqli("localhost", "root", "", "wilayah");
$provinsi = $conn->query("SELECT * FROM provinsi");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Kecamatan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Pilih Provinsi dan Kabupaten/Kota</h2>
<form id="wilayahForm" onsubmit="return false;">
  <select name="provinsi" id="provinsi" required>
    <option value="">-- Pilih Provinsi --</option>
    <?php while ($row = $provinsi->fetch_assoc()): ?>
      <option value="<?= $row['id'] ?>"><?= $row['nama_provinsi'] ?></option>
    <?php endwhile; ?>
  </select>
  <select name="kabupaten" id="kabupaten" required disabled>
    <option value="">-- Pilih Kabupaten/Kota --</option>
  </select>
</form>
<div id="result" class="grid" style="display:none;"></div>
<script src="script.js"></script>
</body>
</html>
