<?php
$conn = new mysqli("localhost", "root", "", "wilayah");
$id_prov = intval($_GET['id_provinsi']);
$result = $conn->query("SELECT id, nama_kabupaten FROM kabupaten WHERE id_provinsi = $id_prov");
$data = [];
while ($row = $result->fetch_assoc()) {
  $data[] = $row;
}
echo json_encode($data);
?>
