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

//mengambil id dari url
$id = $_GET['id'];

if (hapus($id) > 0) {
  echo "<script>
          alert('data berhasil dihapus');
          document.location.href = 'indeks.php';
          </script>";
} else {
  echo "data gagal dihapus!";
}
