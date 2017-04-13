<?php
session_start();
include "../config.php";
include "cek.php";
?>
<?php
if (isset($_GET['folder'])) {
	$folder = $_GET['folder'];
}
if(isset($_POST['submit'])){
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
                $filePath = "../img/albumfoto/".$folder."/".$_FILES['upload']['name'][$i];

                //Upload the file into the temp dir
                if(move_uploaded_file($tmpFilePath, $filePath)) {

                    $files[] = $shortname;
                    //insert into db 
                    //use $shortname for the filename
                    //use $filePath for the relative url to the file

                }
              }
        }
    }
}
$query = "SELECT * FROM albumfoto where folder='$folder'";
$hasil = mysqli_query($conn, $query);
$data  = mysqli_fetch_array($hasil);
if (isset($_GET['file'])) {
	$file = $_GET['file'];
	$folder = $_GET['folder'];
	unlink($file);
	header("Location: foto.php?folder=".$folder);
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> <?php echo $data['judul'] ?></title>
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
        <?php echo $data['judul'] ?> <br>
        <small>maksimal upload foto ukuran 999KB </small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content"> 
			<form action="" method="POST" enctype="multipart/form-data">
			<div class="col-lg-3">
				<div class="input-group">
					<label class="input-group-btn">
						<span class="btn btn-info">
							Pilih File <input type="file" name="upload[]" style="display: none;" multiple="multiple" name="form1">
						</span>
					</label>
					<input type="text" class="form-control" readonly>
				</div>
			</div>
			    <button onClick="showit();" type="submit" name="submit" class="btn btn-success pull-left"> Upload </button>
				<button type="reset" name="reset" class="btn btn-warning pull-left">&nbsp&nbsp Batal &nbsp&nbsp</button>	
            <div class="col-lg-12">
				<span class="help-block">
					gunakan shift/ctrl untuk menyeleksi file yang diupload secara banyak.
				</span>
			</div>
			</form>
				<?php echo $_SERVER['REQUEST_URI']; ?>
	<?php 
	echo "<table style='text-align:center' class='table table-hover'>";
	echo "<tr>
	<td>Foto</td>
	<td>Lokasi File</td>
	<td>Opsi</td></tr>";
		$folderfoto = "../img/albumfoto/".$folder; //folder tempat gambar disimpan  
		$handle = opendir($folderfoto);  
		$i = 1;  
		while(false !== ($file = readdir($handle))){  
			if($file != '.' && $file != '..'){  
		echo "<tr class='text-warning'>
		<td><img class='img-circle' style='width: 160px; height: 160px;'src='../img/albumfoto/".$folder."/".$file."'/></td>
		<td>img/albumfoto/".$folder."/".$file."</td>
		<td>
		<a class='btn btn-info btn-md' target='_blank' href='../img/albumfoto/".$folder."/".$file."'><i class='fa fa-download'></i></a> 
		<a class='btn btn-danger btn-md' href='foto.php?folder=".$folder."&file=../img/albumfoto/".$folder."/".$file."'><i class='fa fa-remove'></i></a>		
		</td></tr>";
		$i++;
	}
		}
	echo "</table>";
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
