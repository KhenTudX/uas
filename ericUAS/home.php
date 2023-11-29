<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "akademik";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$nim        = "";
$nama       = "";
$region     = "";
$tier   = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $id         = $_GET['id'];
    $sql1       = "delete from mahasiswa where id = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "select * from mahasiswa where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $nim        = $r1['nim'];
    $nama       = $r1['nama'];
    $region     = $r1['region'];
    $tier   = $r1['tier'];

    if ($nim == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $nim        = $_POST['nim'];
    $nama       = $_POST['nama'];
    $region     = $_POST['region'];
    $tier   = $_POST['tier'];

    if ($nim && $nama && $region && $tier) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update mahasiswa set nim = '$nim',nama='$nama',region = '$region',tier='$tier' where id = '$id'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into mahasiswa(nim,nama,region,tier) values ('$nim','$nama','$region','$tier')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="style.css" rel="stylesheet">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    
<div class="header">
 <a href="#" class="logo">AccountDataStorage</a>
  <div class="header-right">
  <img src="drag.png" style="height:50px;" class="logo"><span>POWERED BY PHPMYADMIN</span>
    <!--img-->
  </div>
</div>
<div class="sidebar">
<hr class="solid">
  <a  class="active" href="home.php">Home</a>
  <hr class="solid">
  <a  href="index.php">Table</a>
  <hr class="solid">
  <a   href="form.php">Form</a>
  <hr class="solid">
    </div>
    <div class="mx-auto">
       <!--konten-->
       <br>
       <img src="silver.jpg" style="height:40px;padding-left:13rem;" >&nbsp; <span>DESIGNED AND CREATED BY ERICH</span>
       <h1>About this</h1>
       AccountDataStorage(ADS),Website yang berbasis PHP yang dirancang dengan 'localhost' dan di tenagai oleh phpMyAdmin,dengan begitu penyimpanan yang digunakan adalah penyimpanan lokal.Website ini dirancang dengan tujuan untuk menyimpan account Anda yang banyak tanpa perlu mengingat-ingat lagi id mana yang Anda ingin pakai sesuai dengan progress Anda sebelumnya
    <br><br><br><br><h1 style="padding-left:13rem;">#ADSNoNeedMoreNotes</h1>
    </div>
    <div class="footer">
        <p>Copyright &copy; Erich's Projects 2023 </p>
    </div>
</body>

</html>
