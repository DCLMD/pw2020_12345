<?php
require 'function.php';

//ambil id dari URL
$id = $_GET['id'];

//query mahasiswa berdasarkan id
$m = query("SELECT * FROM mahasiswa WHERE id = $id");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Mahasiswa</title>
</head>

<body>
  <h3>Detail Mahasiswa</h3>
  <ul>
    <li><img src="img/<?= $m['gambar']; ?>"></li>
    <li>nik: <?= $m['nik']; ?></li>
    <li>nama: <?= $m['nama']; ?></li>
    <li>alamat: <?= $m['alamat']; ?></li>
    <li>Jurusan: <?= $m['jurusan']; ?></li>
    <li><a href="" ubah>ubah</a>|<a href="" hapus>hapus</a> </li>
    <li><a href="latihan3.php" Kembali ke daftar mahasiswa>Kembali</a></li>
  </ul>
</body>

</html>