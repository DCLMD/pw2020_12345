<?php
SESSION_START();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

require 'function.php';

//jika tidak ada id di url
if (!isset($_GET['id'])) {
  header("location: index.php");
  exit;
}

//ambil id dari url
$id = $_GET['id'];

//query mahasiswa berdasarkan id
$m = query("SELECT * FROM mahasiswa WHERE id = $id");

// cek apakah tombol ubah sudah di tekan
if (isset($_POST['ubah'])) {
  if (ubah($_POST) > 0) {
    echo "<script>
            alert('data berhasil diubah');
            document.location.href = 'indeks.php';
            </script>";
  } else {
    echo "data gagal diubah!";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ubah Data Mahasiswa</title>
</head>

<body>
  <h3>Form Ubah Data Mahasiswa</h3>
  <form action="" method="POST">
    <input type="hidden" name="id" value="<?= $m['id']; ?>">
    <ul>

      <li>
        <label>
          NIK
          <input type="text" name="nik" autofocus required value="<?= $m['nik']; ?>">
        </label>
      </li>
      <li>
        <label>
          nama
          <input type="text" name="nama" required value="<?= $m['nama']; ?>">
        </label>
      </li>
      <li>
        <label>
          jurusan
          <input type="text" name="jurusan" required value="<?= $m['jurusan']; ?>">
        </label>
      </li>
      <li>
        <label>
          alamat
          <input type="text" name="alamat" required value="<?= $m['alamat']; ?>">
        </label>
      </li>
      <li>
        <label>
          gambar
          <input type="text" name="gambar" required value="<?= $m['gambar']; ?>">
        </label>
      </li>
      <li>
        <button type="submit" name="ubah">Ubah Data !</button>
      </li>
    </ul>



  </form>

</body>

</html>