<?php
session_start();
include "../config.php";
include "cek.php";
?>
<?php
if (isset($_GET['tgl'])) {
$tgl = $_GET['tgl'];
$file = $_GET['file'];
unlink($file);
$query = "delete from berita WHERE tanggal = '$tgl'";
$hasil = mysqli_query($conn, $query);
header("Location: berita.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Informasi</title>
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
        Informasi
        <small>Tambah informasi terbaru, edit & hapus. </small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
	<small> Gunakan pengaturan link untuk menaruh informasi diberbagai link.</small><br>
	<a href="tambah_berita.php"><i class="fa fa-file"></i> Tambah info</a>
	<?php 
	$sql = "SELECT * FROM berita ORDER BY tanggal DESC";  
	$hasil = mysqli_query($conn, $sql);
	echo "<table id='example1' class='table table-bordered table-striped table-hover'>";
	echo "<thead><tr class='text-error'>
	<th>Judul</th>
	<th>Tanggal</th>
	<th>Gambar</th>
	<th>Link</th>
	<th>Opsi</th></tr>
	</tr></thead> <tbody>";
	while ($data = mysqli_fetch_assoc($hasil)) {
		echo "<tr class='text-warning'>
		<td>".$data['judul']."</td>
		<td>".$data['tanggal']."</td>
		<td><a href='../img/berita/".$data['gambar']."' class='cbp-lightbox'>".$data['gambar']."</a></td>
		<td>informasi-".$data['beritaid'].".html</td>
		<td>
		<a class='btn btn-info btn-xs' target='_blank' href='../informasi-".$data['beritaid'].".html'><i class='fa fa-search-plus'></i></a> 
		<a class='btn btn-success btn-xs' href='ganti_berita.php?beritaid=".$data['beritaid']."'><i class='fa fa-edit'></i></a> 
		<a class='btn btn-danger btn-xs' href='berita.php?tgl=".$data['tanggal']."&file=../img/berita/".$data['gambar']."'><i class='fa fa-remove'></i></a>
		
		</td></tr>";
	}
	echo " </tbody></table>";
?>
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
