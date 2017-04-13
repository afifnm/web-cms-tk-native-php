<?php
session_start();
include "../config.php";
include "cek.php";
?>
<?php
if(isset($_POST['submit'])){
$folder = date("Ymdhis");
mkdir("../img/albumfoto/".$folder);
    if(count($_FILES['upload']['name']) > 0){
        //Loop through each file
        for($i=0; $i<count($_FILES['upload']['name']); $i++) {
          //Get the temp file path
            $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

            //Make sure we have a filepath
            if($tmpFilePath != ""){
            
                //save the filename
                $shortname = $_FILES['upload']['name'][$i];

                //save the url and the file
                $filePath = "../img/albumfoto/".$folder."/" .$_FILES['upload']['name'][$i];

                //Upload the file into the temp dir
                if(move_uploaded_file($tmpFilePath, $filePath)) {

                    $files[] = $shortname;
					$judul = $_POST['judul'];
					$link = "albumfoto.php?folder=".$folder;
					$desk = $_POST['desk'];
					$query = "INSERT INTO albumfoto VALUES('$judul','$folder','$desk')";
					$hasil = mysqli_query($conn, $query);

                }
              }
        }
    }
	header("Location: albumfoto.php");
}
if (isset($_GET['hapus'])) {
	$folder = $_GET['hapus'];
	$dir = '../img/albumfoto/'.$folder;
	$files = glob($dir.'/*'); // get all file names
	foreach($files as $file){ // iterate files
	  if(is_file($file))
		unlink($file); // delete file
	}
	rmdir('../img/albumfoto/'.$folder);
	$query2 = "delete from albumfoto WHERE folder = '$folder'";
	$hasil2 = mysqli_query($conn, $query2);
	header("Location: albumfoto.php");
}
if(isset($_POST['submit_edit'])){
	$judul = $_POST['judul'];
	$folder = $_POST['folder'];
	$desk = $_POST['desk'];
	$query = "update albumfoto set judul='$judul',desk='$desk' where folder='$folder'";
	$hasil = mysqli_query($conn, $query);
	header("Location: albumfoto.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Album Foto</title>
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
	<script language="javascript">
			function showit()
			{
			loading.style.display="";
			setTimeout('document.form1.submit()',4000);
			}
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
        Daftar Album Foto
        <small>Gunakan pengaturan link untuk menaruh file diberbagai link. </small>
			<div id="loading" class="pull-right" style="display:none;padding:20px;">
				<img src="../img/cbp-loading.gif" border="0">
			</div>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content"> 
		<?php if (isset($_GET['edit'])) { 
			$edit = $_GET['edit'];
			$sqledit = "select*from albumfoto WHERE folder = '$edit'";
			$hasiledit = mysqli_query($conn, $sqledit);
			$dataedit = mysqli_fetch_assoc($hasiledit);
		?>	
			<form action="" method="POST" enctype="multipart/form-data">
			<div class="col-md-4">
				<div class="input-group">
					<input type="text" class="form-control" name="judul" value="<?php echo $dataedit['judul'] ?>" required >
					<input type="text" class="form-control" name="desk" value="<?php echo $dataedit['desk'] ?>" required >
					<input type="hidden" class="form-control" name="folder" value="<?php echo $dataedit['folder'] ?>" required >
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
			    <button type="submit" name="submit_edit" class="btn btn-success"> Simpan</button>
				<a href="albumfoto.php"  class='btn btn-warning btn-md' >&nbsp Batal &nbsp </a>	
				</div>
			</div>
            <div class="col-lg-12">
				<span class="help-block">
					gunakan shift/ctrl untuk menyeleksi file yang diupload secara banyak.
				</span>
			</div>
			</form>
		<?php } else { ?> 
			<form action="" method="POST" enctype="multipart/form-data" name="form1">
			<div class="col-md-3">
				<div class="input-group">
					<label class="input-group-btn">
						<span class="btn btn-info">
							Pilih File <input type="file" name="upload[]" style="display: none;" multiple="multiple">
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
			    <button onClick="showit();" type="submit" name="submit" class="btn btn-success"> &nbsp Upload</button>
				<button type="reset" name="reset" class="btn btn-warning">&nbsp&nbsp Batal &nbsp&nbsp</button>	
				</div>
			</div>
            <div class="col-lg-12">
				<span class="help-block">
					gunakan shift/ctrl untuk menyeleksi file yang diupload secara banyak.
				</span>
			</div>
			</form>
	<?php } ?> 			
	<?php 
		$query = "select*from albumfoto order by judul ASC";
		$hasil = mysqli_query($conn, $query);
		echo "<table class='table table-bordered table-striped table-hover'>";
		echo "<thead><tr class='text-error'>
		<th>Judul Album Foto</th>
		<th>Nama Folder</th>
		<th>Link</th>
		<th>Opsi</th></tr>
		</tr></thead> <tbody>";
		while ($data = mysqli_fetch_assoc($hasil)) {
			echo "<tr class='text-warning'>
			<td>".$data['judul']."</a></td>
			<td>".$data['folder']."</td>
			<td>albumfoto-".$data['folder'].".html</td>
			<td>
			<a class='btn btn-warning btn-xs' href='foto.php?folder=".$data['folder']."'><i class='fa fa-instagram'></i></a> 
			<a target='_blank' class='btn btn-info btn-xs' href='../albumfoto-".$data['folder'].".html'><i class='fa fa-search-plus'></i></a> 
			<a class='btn btn-success btn-xs' href='albumfoto.php?edit=".$data['folder']."'><i class='fa fa-edit'></i></a>			
			<a class='btn btn-danger btn-xs' href='albumfoto.php?hapus=".$data['folder']."'><i class='fa fa-remove'></i></a>
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
