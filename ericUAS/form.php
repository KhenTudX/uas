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
$tahun_kelahiran   = "";
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
    $tahun_kelahiran   = $r1['tahun_kelahiran'];

    if ($nim == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $nim        = $_POST['nim'];
    $nama       = $_POST['nama'];
    $region     = $_POST['region'];
    $tahun_kelahiran   = $_POST['tahun_kelahiran'];

    if ($nim && $nama && $region && $tahun_kelahiran) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update mahasiswa set nim = '$nim',nama='$nama',region = '$region',tahun_kelahiran='$tahun_kelahiran' where id = '$id'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into mahasiswa(nim,nama,region,tahun_kelahiran) values ('$nim','$nama','$region','$tahun_kelahiran')";
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
  <a  href="home.php">Home</a>
  <hr class="solid">
  <a  href="index.php">Table</a>
  <hr class="solid">
  <a  class="active" href="form.php">Form</a>
  <hr class="solid">
  
</div>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">Id</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $nim ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="region" class="col-sm-2 col-form-label">Region</label>

                        <div class="col-sm-10">
                            <select class="form-control" name="region" id="region">
                                <option value="">- Pilih Region -</option>
                                <option value="Asia" <?php if ($region == "Asia") echo "selected" ?>>Asia</option>
                                <option value="Europe" <?php if ($region == "Europe") echo "selected" ?>>Europe</option>
                                <option value="America" <?php if ($region == "America") echo "selected" ?>>America</option>
                                
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Tahun Kelahiran</label>
                        <div class="col-sm-10">
                            <input type="year" min="1900" max="2023" step="1" value="2000" class="form-control" id="tahun_kelahiran" name="tahun_kelahiran" value="<?php echo $tahun_kelahiran ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div class="footer">
        <p>Copyright &copy; Erich's Projects 2023 </p>
    </div>
</body>

</html>
