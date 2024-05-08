<?php

function koneksi()
{
  return mysqli_connect('localhost', 'root', '', 'pw_043040023');
}

function query($query)
{
  $conn = koneksi();
  $result = mysqli_query($conn, $query);

  //jika hasil hanya 1 data
  if (mysqli_num_rows($result) == 1) {
    return mysqli_fetch_assoc($result);
  }

  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

function tambah($data)
{
  $conn = koneksi();

  $nik = htmlspecialchars($data['nik']);
  $nama = htmlspecialchars($data['nama']);
  $jurusan = htmlspecialchars($data['jurusan']);
  $alamat = htmlspecialchars($data['alamat']);
  $gambar = htmlspecialchars($data['gambar']);

  $query = "INSERT INTO
              mahasiswa
            VALUES
            (null, '$nik', '$nama', '$jurusan', '$alamat', '$gambar');
            ";
  mysqli_query($conn, $query);
  echo mysqli_error($conn);
  return mysqli_affected_rows($conn);
}


function hapus($id)
{
  $conn = koneksi();
  mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id") or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

function ubah($data)
{
  $conn = koneksi();

  $id = htmlspecialchars($data['id']);
  $nik = htmlspecialchars($data['nik']);
  $nama = htmlspecialchars($data['nama']);
  $jurusan = htmlspecialchars($data['jurusan']);
  $alamat = htmlspecialchars($data['alamat']);
  $gambar = htmlspecialchars($data['gambar']);

  $query = "UPDATE mahasiswa SET
            nik = '$nik',
            nama = '$nama',
            jurusan = '$jurusan',
            alamat = '$alamat',
            gambar = '$gambar'
          WHERE id = $id";
  mysqli_query($conn, $query);
  echo mysqli_error($conn);
  return mysqli_affected_rows($conn);
}


function cari($keyword)
{
  $conn = koneksi();

  $query = "SELECT * FROM mahasiswa
              WHERE nama LIKE'%$keyword%' OR 
              nik LIKE'%$keyword%' OR
              jurusan LIKE'%$keyword%' OR
              alamat LIKE'%$keyword%' OR
              gambar";

  $result = mysqli_query($conn, $query);

  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

function login($data)
{
  $conn = koneksi();

  $username = htmlspecialchars($data['username']);
  $password = htmlspecialchars($data['password']);


  //cek dulu username
  if ($user = query("SELECT * FROM user WHERE username = '$username'")) {
    //cek password
    if (password_verify($password, $user['password'])) {
      $_SESSION['login'] = true;

      header("Location: indeks.php");
      exit;
    }
  }

  //set session
  else {
    return [
      'error' => true,
      'pesan' => 'Username/Password Salah!'
    ];
  }
}


function registrasi($data)
{
  $conn = koneksi();

  $username = htmlspecialchars(strtolower($data['username']));
  $password1 = mysqli_real_escape_string($conn, $data['password1']);
  $password2 = mysqli_real_escape_string($conn, $data['password2']);

  //jika username/password kosong
  if (empty($username) || empty($password1) || empty($password2)) {
    echo "<script>
         alert('username/password tidak boleh kosong!');
         document.location.href = 'registrasi.php';
          </script>";
    return false;
  }

  //jika username udah ada
  if (query("SELECT * FROM user WHERE username = '$username'")) {
    echo "<script>
       alert('username sudah ada!');
        document.location.href = 'registrasi.php';
        </script>";
    return false;
  }

  //jika konfirmasi password tidak sesuai

  if ($password1 !== $password2) {
    echo "<script>
       alert('konfirmasi password tidak sesuai!');
        document.location.href = 'registrasi.php';
        </script>";
    return false;
  }

  //jika password < 5 digit
  if (strlen($password1) < 5) {
    echo "<script>
        alert('password terlalu pendek!');
        document.location.href = 'registrasi.php';
        </script>";
    return false;
  }

  // jika username & password sudah sesuai
  // enkripsi password
  $password_baru = password_hash($password1, PASSWORD_DEFAULT);
  // insert ke tabel user
  $query = "INSERT INTO user
            VALUES
            (null, '$username', '$password_baru')
  ";
  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}
