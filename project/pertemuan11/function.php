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
