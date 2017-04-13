<?php
session_start();
include "../config.php";
include "cek.php";
?>
<?php
$beritaid = $_GET['beritaid'];
$query = "SELECT * FROM berita WHERE beritaid='$beritaid'";
$hasil = mysqli_query($conn, $query);
$data = mysqli_fetch_array($hasil);
$gambar = $data['gambar'];
$judul = $data['judul'];
$desk = $data['desk'];
$tgl = $data['tanggal'];

if (isset($_POST['Edit'])) {
	$hberitaid = $_POST['hberitaid'];
	$judul = $_POST['judul'];
	$desk = $_POST['desk'];
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
	} 
	if ($namafile ==""){
	$query = "UPDATE berita SET judul='$judul',desk='$desk' WHERE beritaid='$hberitaid'";
	$hasil2 = mysqli_query($conn, $query);		
	} else
	{
	$query = "UPDATE berita SET judul='$judul',desk='$desk', gambar='$namafile' WHERE beritaid='$hberitaid'";
	$hasil2 = mysqli_query($conn, $query);
	}
header("Location: berita.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Edit Informasi</title>
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
        Edit Gambar Slides
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="container">
		<a href="berita.php">
            <i class="fa fa-share"></i> <span>Kembali</span>
          </a> <br>	
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>
              <h3 class="box-title">Edit Berita</h3>
            </div>
			
			<form action="" method="POST" name="input" enctype="multipart/form-data">
            <div class="box-body">
             
                <div class="form-group">
                  Tanggal Post : <?php echo$tgl?>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="judul" value="<?php echo$judul?>" required >
                </div>
                <div>
                  <textarea name="desk" class="textarea" placeholder="Deskripsi" style="width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"  required >
				  <?php echo$desk?>
				  </textarea>
                </div>
				<div class="form-group" required >
                  <input type="file" name="foto">
                </div>
              
            </div>
            <div class="box-footer clearfix">
			<input class="btn btn-info" type="hidden" name="hberitaid" value="<?php echo$beritaid?>">
			<button type="submit" name="Edit" class="btn btn-primary"> Simpan </button>
            </div>
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
