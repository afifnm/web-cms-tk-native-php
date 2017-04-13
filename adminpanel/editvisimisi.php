<?php
session_start();
include "../config.php";
include "cek.php";
?>
<?php
$query = "SELECT*from visimisi";
$hasil = mysqli_query($conn, $query);
$data = mysqli_fetch_array($hasil);
$visi = $data['visi'];
$misi = $data['misi'];
$tujuan = $data['tujuan'];

if (isset($_POST['Edit'])) {
$visi = $_POST['visi'];
$misi = $_POST['misi'];
$tujuan = $_POST['tujuan'];
	$query = "UPDATE visimisi SET visi='$visi',misi='$misi',tujuan='$tujuan' ";
	$hasil = mysqli_query($conn, $query);
header("Location: editvisimisi.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Visi & Misi</title>
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
        Edit Visi & Misi
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="container">
		<div class="isi">
		<form action="" method="post" name="input" enctype="multipart/form-data">
		<h4><b> Visi Pendidikan</b></h4>
		<textarea name="visi" class="textarea" placeholder="Deskripsi" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" >
		<?php echo $visi ?>
		</textarea>
		<hr> 
		<h4><b> Misi Pendidikan</b></h4>
		<textarea name="misi" class="textarea" placeholder="Deskripsi" style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" >
		<?php echo $misi ?>
		</textarea>
		<hr> 
		<h4><b> Tujuan Pendidikan</b></h4>
		<textarea name="tujuan" class="textarea" placeholder="Deskripsi" style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" >
		<?php echo $tujuan ?>
		</textarea>
		<hr> 
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
