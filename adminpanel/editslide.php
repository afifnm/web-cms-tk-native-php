<?php
session_start();
include "../config.php";
include "cek.php";
?>
<?php
if (isset($_POST['submit'])) {
	$judul = $_POST['judul'];
	$desk = $_POST['desk'];
	$judulfoto = date("Ymd his");
	if (($_FILES['foto']['name'])!=="") {
		$pecah = explode('.', $_FILES['foto']['name']);
		$extension = $pecah[1];
		$namafile = $judulfoto . '.' . $extension;
			if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
				move_uploaded_file ($_FILES['foto']['tmp_name'], "../img/slides/".$namafile);
			}
	}
	$query = "INSERT INTO slides VALUES('$judul','$desk','$namafile')";
	$hasil = mysqli_query($conn, $query);
	header("Location: editslide.php");
}
if (isset($_GET['hapus'])) {
$hapus = $_GET['hapus'];
unlink('../img/slides/'.$hapus);
$query = "delete from slides WHERE gambar = '$hapus'";
$hasil = mysqli_query($conn, $query);
header("Location: editslide.php");
}
if(isset($_POST['submit_edit'])){
	$judul = $_POST['judul'];
	$gambar = $_POST['gambar'];
	$desk = $_POST['desk'];
	if (($_FILES['foto']['name'])!=="") {
		$pecah = explode('.', $_FILES['foto']['name']);
		$extension = $pecah[1];
		if (($extension == "jpg") or ($extension == "png")) {
			if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
				move_uploaded_file ($_FILES['foto']['tmp_name'], "../img/slides/".$gambar);
			}
		}
	} 
	
	$query = "update slides set judul='$judul',desk='$desk' where gambar='$gambar'";
	$hasil = mysqli_query($conn, $query);
	header("Location: editslide.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Slides Foto</title>
<?php
include "css.php";
?>
<script>
$(function() {

  // We can attach the `fileselect` event to all file inputs on the page
  $(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });

  // We can watch for our custom `fileselect` event like this
  $(document).ready( function() {
      $(':file').on('fileselect', function(event, numFiles, label) {

          var input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' files selected' : label;

          if( input.length ) {
              input.val(log);
          } else {
              if( log ) alert(log);
          }

      });
  });
  
});
</script>
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
		<?php if (isset($_GET['edit'])) { 
			$edit = $_GET['edit'];
			$sqledit = "select*from slides WHERE gambar = '$edit'";
			$hasiledit = mysqli_query($conn, $sqledit);
			$dataedit = mysqli_fetch_assoc($hasiledit);
		?>	
			<form action="" method="POST" enctype="multipart/form-data">
			<div class="col-md-3">
				<div class="input-group">
					<label class="input-group-btn">
						<span class="btn btn-info">
							Pilih File <input type="file" name="foto" style="display: none;" multiple="multiple">
						</span>
					</label>
					<input type="text" value="<?php echo $dataedit['gambar'] ?>" class="form-control" readonly>
				</div>
			</div>
			<div class="col-md-4">
				<div class="input-group">
					<input type="text" class="form-control" name="judul" value="<?php echo $dataedit['judul'] ?>" required >
					<input type="text" class="form-control" name="desk" value="<?php echo $dataedit['desk'] ?>" required >
					<input type="hidden" name="gambar" class="form-control" value="<?php echo $dataedit['gambar'] ?>" required >
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
			    <button type="submit" name="submit_edit" class="btn btn-success"> Simpan</button>
				<a href="editslide.php"  class='btn btn-warning btn-md' >&nbsp Batal &nbsp </a>	
				</div>
			</div>
            <div class="col-lg-12">
				<span class="help-block">
					Foto untuk slide halaman awal diusahakan ukuran landscape 3:9.
				</span>
			</div>
			</form>
		<?php } else { ?> 
			<form action="" method="POST" enctype="multipart/form-data">
			<div class="col-md-2">
				<div class="input-group">
					<label class="input-group-btn">
						<span class="btn btn-info">
							Pilih File <input type="file" name="foto" style="display: none;" multiple="multiple">
						</span>
					</label>
					<input type="text" class="form-control" readonly>
				</div>
			</div>
			<div class="col-md-4">
				<div class="input-group">
					<input type="text" class="form-control" name="judul" placeholder="Judul Album Foto" required >
					<input type="text" class="form-control" name="desk" placeholder="Deskripsi" required >
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
			    <button type="submit" name="submit" class="btn btn-success"> &nbsp Upload</button>
				<button type="reset" name="reset" class="btn btn-warning">&nbsp&nbsp Batal &nbsp&nbsp</button>	
				</div>
			</div>
            <div class="col-lg-12">
				<span class="help-block">
					Foto untuk slide halaman awal diusahakan ukuran landscape 3:9.
				</span>
			</div>
			</form>
	<?php } ?> 			
	<?php 
		$query = "select*from slides order by judul ASC";
		$hasil = mysqli_query($conn, $query);
		echo "<table class='table table-bordered table-striped table-hover'>";
		echo "<thead><tr class='text-error'>
		<th>Judul</th>
		<th>Deskripsi</th>
		<th>Gambar</th>
		<th>Opsi</th></tr>
		</tr></thead> <tbody>";
		while ($data = mysqli_fetch_assoc($hasil)) {
			echo "<tr class='text-warning'>
			<td>".$data['judul']."</a></td>
			<td>".$data['desk']."</td>
			<td>".$data['gambar']."</td>
			<td>
			<a class='btn btn-success btn-xs' href='editslide.php?edit=".$data['gambar']."'><i class='fa fa-edit'></i></a>			
			<a class='btn btn-danger btn-xs' href='editslide.php?hapus=".$data['gambar']."'><i class='fa fa-remove'></i></a>
			</td></tr>";
		}
		echo " </tbody></table>";
	?>
			    <img class="img-responsive pad pull-right" src="../img/slides/<?php echo $dataedit['gambar'] ?>" style="width: 30%;"> 
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2016 <a href="http://scripthouse.co.id">Script House</a>.</strong> All rights
    reserved.
  </footer>

</div>
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
</body>
</html>
