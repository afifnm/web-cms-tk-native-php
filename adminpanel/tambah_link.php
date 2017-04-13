<?php
session_start();
include "../config.php";
include "cek.php";
?>
<?php
if (isset($_POST['Input'])) {
	$judul = $_POST['judul'];
	$link = $_POST['link'];
	$kategori = $_POST['kategori'];

	$query = "INSERT INTO link VALUES('$judul','$link','$kategori','')";
	$hasil = mysqli_query($conn, $query);
	header("Location: informasi_link.php");
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tambah Link</title>
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
        <small>link baru</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
		<a href="informasi_link.php">
            <i class="fa fa-share"></i> <span>Kembali</span>
          </a> <br>
          <div class="box box-info">
			
			<form action="" method="POST" name="input" enctype="multipart/form-data">
            <div class="box-body">
             
                <div class="form-group">
                  <input type="text" class="form-control" name="judul" placeholder="Judul Halaman" required >
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="link" placeholder="Link Halaman" required >
                </div>
                <div class="form-group">
                  <label>Kategori</label>
                  <select name="kategori" class="form-control">
                    <option value="header">Header</option>
                    <option value="sidebar">Sidebar</option>
                    <option value="footer">Footer</option>

                  </select>
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
