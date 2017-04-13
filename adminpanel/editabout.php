<?php
session_start();
include "../config.php";
include "cek.php";
?>
<?php
$query = "SELECT*from visimisi";
$hasil = mysqli_query($conn, $query);
$data = mysqli_fetch_array($hasil);
$about = $data['about'];
$nama = $data['nama'];
$alamat = $data['alamat'];
$kepala = $data['kepala'];
$nip = $data['nip'];
$nostat = $data['nostat'];

if (isset($_POST['Edit'])) {
$about = $_POST['about'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$kepala = $_POST['kepala'];
$nip = $_POST['nip'];
$nostat = $_POST['nostat'];
$query = "UPDATE visimisi SET about='$about',nama='$nama',alamat='$alamat',kepala='$kepala'
,nostat='$nostat',nip='$nip'	";
$hasil = mysqli_query($conn, $query);
header("Location: editabout.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tentang Kami</title>
<?php
include "css.php";
?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php
include "sidebar.php";
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tentang Kami
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="container">
		<div class="isi">
		<form action="" method="post" name="input" enctype="multipart/form-data">
		<h4><b> Nama Taman Kanak-kanak </b></h4>
         <input type="text" class="form-control" name="nama" value="<?php echo $nama ?>" required >
		<h4><b> Alamat </b></h4>
		<input type="text" class="form-control" name="alamat" value="<?php echo $alamat ?>" required >
		<h4><b> Tentang Kami </b></h4>
		<textarea name="about" class="textarea" placeholder="Deskripsi" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" >
		<?php echo $about ?>
		</textarea>
		<h4><b> No. Statistik TK </b></h4>
         <input type="text" class="form-control" name="nostat" value="<?php echo $nostat ?>" required >
		<h4><b> Kepala Taman Kanak-kanak</b></h4>
         <input type="text" class="form-control" name="kepala" value="<?php echo $kepala ?>" required >
		<h4><b> NIP </b></h4>
         <input type="text" class="form-control" name="nip" value="<?php echo $nip ?>" required >
		 <br>
		<button type="submit" name="Edit" class="btn btn-primary"> Simpan </button>	
		</form>
		</div>
		</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2016 <a href="http://scripthouse.co.id">Script House</a>.</strong> All rights
    reserved.
  </footer>

</div>
<?php
include "js.php";
?>
</body>
</html>
