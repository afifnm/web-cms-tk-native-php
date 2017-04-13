<?php
session_start();
include "../config.php";
include "cek.php";
?>
<?php
if (isset($_POST['Input'])) {
	$judul = $_POST['judul'];
	$desk = $_POST['desk'];
	$date = date("Y-m-d h:i:s");
	$judulfoto = date("Ymd his");
	if (($_FILES['foto']['name'])!=="") {
		$pecah = explode('.', $_FILES['foto']['name']);
		$extension = $pecah[1];
		$namafile = $judulfoto . '.' . $extension;
		if (($extension == "jpg") or ($extension == "png")) {
			if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
				move_uploaded_file ($_FILES['foto']['tmp_name'], "../img/berita/".$namafile);
			}
		}
	} else {
		$namafile = "";
	}
	$query = "INSERT INTO berita VALUES('$judul','$date','$desk','$namafile','')";
	$hasil = mysqli_query($conn, $query);
	header("Location: berita.php");
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tambah Informasi</title>
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
        Tambah
        <small>berita baru</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
		<a href="berita.php">
            <i class="fa fa-share"></i> <span>Kembali</span>
          </a> <br>
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>
              <h3 class="box-title">Tambah Berita</h3>
            </div>
			
			<form action="" method="POST" name="input" enctype="multipart/form-data">
            <div class="box-body">
             
                <div class="form-group">
                  <input type="text" class="form-control" name="judul" placeholder="Judul Berita" required >
                </div>
                <div>
                  <textarea name="desk" class="textarea" placeholder="Deskripsi" style="width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required ></textarea>
                </div>
				<div class="form-group" required >
                  <input type="file" name="foto">
                </div>
              
            </div>
            <div class="box-footer clearfix">
			<button type="submit" name="Input" class="btn btn-primary"> Simpan </button>
            </div>
			</form>
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
