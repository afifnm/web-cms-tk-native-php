<?php
session_start();
include "../config.php";
include "cek.php";
?>
<?php
if (isset($_GET['id'])) {
$tgl = $_GET['id'];
$query2 = "delete from link WHERE id = '$tgl'";
$hasil2 = mysqli_query($conn, $query2);
header("Location: informasi_link.php");
}
if (isset($_GET['tampil'])) {
$kategori = $_GET['kategori'];
	if ($kategori=='all'){
		$query = "select*from link order by kategori ASC";
		$hasil = mysqli_query($conn, $query);
	} else 
{
		$query = "select*from link WHERE kategori = '$kategori'";
		$hasil = mysqli_query($conn, $query);
	}
} else
{
	$query = "select*from link order by kategori ASC";
	$hasil = mysqli_query($conn, $query);
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Informasi Link</title>
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
        <small>atur link untuk halaman web</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content"> 
	<form action="" method="gets" enctype="multipart/form-data">
		<div class="form-group">
		<div class="col-xs-12 col-md-1" style="margin: 0px; padding: 0px;">
			<select name="kategori" class="form-control input-md">
			<option value="all">Semua</option>
			<option value="header">Header (Atas)</option>
			<option value="sidebar">Sidebar (Samping)</option>
			<option value="footer">Footer (Bawah)</option>
			</select>
		</div>	
			<button type="submit" name="tampil" class="btn btn-primary"> OK! </button>	
		</div>
	</form>
	<a href="tambah_link.php"><i class="fa fa-file"></i> Tambah Link</a>
	<?php 
		echo "<table class='table table-bordered table-striped table-hover'>";
		echo "<thead><tr class='text-error'>
		<th>Judul</th>
		<th>Kategori</th>
		<th>Link</th>
		<th>Opsi</th></tr>
		</tr></thead> <tbody>";
		while ($data = mysqli_fetch_assoc($hasil)) {
			echo "<tr class='text-warning'>
			<td>".$data['judul']."</a></td>
			<td>".$data['kategori']."</td>
			<td><a target='_blank' href='../".$data['link']."'>".$data['link']."</a></td>
			<td>
			<a class='btn btn-info btn-xs' target='_blank' href='../".$data['link']."'><i class='fa fa-search-plus'></i></a> 
			<a class='btn btn-danger btn-xs' href='informasi_link.php?id=".$data['id']."'><i class='fa fa-remove'></i></a>		
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
