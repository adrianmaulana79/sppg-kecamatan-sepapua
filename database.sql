CREATE DATABASE IF NOT EXISTS wilayah;
USE wilayah;

CREATE TABLE provinsi (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama_provinsi VARCHAR(100) NOT NULL
);

CREATE TABLE kabupaten (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_provinsi INT NOT NULL,
  nama_kabupaten VARCHAR(100) NOT NULL,
  FOREIGN KEY (id_provinsi) REFERENCES provinsi(id)
);

CREATE TABLE data_wilayah (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_kabupaten INT NOT NULL,
  nama_kecamatan VARCHAR(100),
  potensi_penerima INT,
  rencana_sppg INT,
  sppg_operasional INT,
  FOREIGN KEY (id_kabupaten) REFERENCES kabupaten(id)
);

INSERT INTO provinsi (id, nama_provinsi) VALUES (1, 'Papua');
