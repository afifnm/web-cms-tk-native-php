<?php
session_start();
include "../config.php";
include "cek.php";
?>
<?php
$query = "SELECT*from visimisi";
$hasil = mysqli_query($conn, $query);
$data = mysqli_fetch_array($hasil);
$foto = $data['foto'];


if (isset($_POST['Edit'])) {
	$foto = $_FILES['foto']['name'];
		if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
			move_uploaded_file ($_FILES['foto']['tmp_name'], "../img/logo.png");
		}
header("Location: editlogo.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ganti Logo</title>
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
        Edit Logo
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="container">
		<div class="isi">
		<form action="" method="post" name="input" enctype="multipart/form-data">
		<h5><b> Logo Sebelumnya </b></h5>
		<img class='img-responsive pad' src="../img/<?php echo $foto?>" alt=""  /></a>
		<hr>
		<input type="file" name="foto"/> <?=$foto?>
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
