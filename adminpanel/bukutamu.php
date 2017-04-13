<?php
session_start();
include "../config.php";
include "cek.php";
if (isset($_GET['tgl'])) {
		$tgl = $_GET['tgl'];
		$sqlpesan = "SELECT * FROM bukutamu WHERE tanggal_submit='$tgl'";
		$hasilpesan = mysqli_query($conn, $sqlpesan);
		$datapesan = mysqli_fetch_array($hasilpesan);
		$email = $datapesan['email'];
} else
{
$tgl = " ";	
}
$query = "SELECT*from user";
$hasil86 = mysqli_query($conn, $query);
$data86 = mysqli_fetch_array($hasil86);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Buku Tamu</title>
  <script src="../js/jquery.min.js"></script>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
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
        Daftar
        <small>Buku Tamu</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
	<?php if (isset($_GET['tgl'])) { ?>
	<form action="kirim_email.php" method="POST" enctype="multipart/form-data">
	      <div class="panel col-md-6  col-offset-4 pull-right">
			  <div class="box box-primary">
				<div class="box-header with-border">
				  <h5 class="box-title">Balas Pesan</h5>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				  <div class="form-group">
					<input class="form-control" disabled="" value="<?php echo$email?>">
					<input name="email" class="form-control" type="hidden" value="<?php echo$email?>">
					<input name="myemail" class="form-control" type="hidden" value="<?php echo$data86['email']?>">
					<input name="pass_email" class="form-control" type="hidden" value="<?php echo$data86['pass_email']?>">
				  </div>
				  <div class="form-group">
					<input name="subject" class="form-control" placeholder="Subject:">
				  </div>
				  <div class="form-group">
						<textarea id="compose-textarea" name="pesan" class="form-control" style="height: 300px"></textarea>
				  </div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
				  <div class="pull-right">
					<button type="submit" name="kirim" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Kirim</button>
				  </div>
				  <a href="bukutamu.php?page=<?php echo $_GET['page'] ?>"  class='btn btn-warning btn-md' >
				  <i class="fa fa-remove"></i>&nbsp Batal &nbsp </a>	
				</div>
				<!-- /.box-footer -->
			  </div>
          <!-- /. box -->
        </div>
	</form>
		<?php
	}	
		$batas = 4;  
		if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
		$start_from = ($page-1) * $batas;   
		$sql = "SELECT COUNT(nama) FROM bukutamu";  
		$rs_result = mysqli_query($conn,$sql);  
		$row = mysqli_fetch_row($rs_result);  
		$total_records = $row[0];  
		$total_pages = ceil($total_records / $batas); 
		$sql = "SELECT * FROM bukutamu ORDER BY tanggal_submit DESC LIMIT $start_from, $batas";  
		$hasil2 = mysqli_query ($conn, $sql); 
	while ($data = mysqli_fetch_assoc($hasil2)) {
		echo "<table>
		<tr> <td> Nama </td><td> : ".$data['nama']."</td></tr>
		<tr> <td> Alamat </td><td> : ".$data['alamat']."</td></tr>
		<tr> <td> Email </td><td> : ".$data['email']."</td></tr>
		<tr> <td style='vertical-align: top;'> Pesan &nbsp&nbsp</td><td> : ".$data['pesan']."</td></tr>
		<tr> <td style='width:60px;'> Tanggal </td> <td> : ".$data['tanggal_submit']."
		<a class='btn btn-danger btn-xs' href='hapus.php?tgl=".$data['tanggal_submit']."'> <i class='fa fa-remove'> </i></a>
		<a class='btn btn-success btn-xs'href='?page=".$page."&tgl=".$data['tanggal_submit']."#'> <i class='fa fa-envelope-o'> </i></a></td></tr>";
		echo "</table> ";	
		echo "<br>";	
	}


		if ($page == 1) { $pageprev = 1; } else {
		$pageprev = $page-1; }
		echo"<div class='pagination pagination-sm no-margin pull-left'>";
		echo"<li><a href='bukutamu.php?page=".$pageprev."'>&laquo</a></li>";
		for ($i=1; $i<=$total_pages; $i++) {  
		echo" <li><a href='bukutamu.php?page=" .$i. "'>".$i."</a></li> ";           
		}; 
		$pagenext = $page+1;
		if ($pagenext >= $total_pages) { $pagenext = $total_pages; } else {
		$pagenext = $page+1; }
		echo"<li><a href='bukutamu.php?page=".$pagenext."'>&raquo</a></li>";
		echo"</div>";
		echo"<br><hr> <a href='hapus.php'>Hapus semua data buku tamu!</a><br>"; 
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
<!-- ./wrapper -->
<?php
include "js.php";
?>
</body>
</html>
