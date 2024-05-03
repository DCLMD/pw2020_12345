<?php
require 'function.php';
$mahasiswa = query("SELECT * FROM mahasiswa");

// tampung ke variabel mahasiswa
// $mahasiswa = $rows;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Mahasiswa</title>
</head>

<body>
  <h3>Daftar Mahasiswa</h3>

  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th>#</th>
      <th>gambar</th>
      <th>nik</th>
      <th>nama</th>
      <th>alamat</th>
      <th>jurusan</th>
      <th>aksi</th>
    </tr>

    <?php $i = 1;
    foreach ($mahasiswa as $m) : ?>
      <tr>
        <td><?= $i++ ?></td>
        <td><img width="100" src="img/<?= $m['gambar']; ?>"></td>
        <td><?= $m['nik']; ?></td>
        <td><?= $m['nama']; ?></td>
        <td><?= $m['alamat']; ?></td>
        <td><?= $m['jurusan']; ?></td>
        <td>
          <a href="">ubah</a>|<a href="">hapus</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>