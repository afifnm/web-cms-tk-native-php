<?php
session_start();
include "../config.php";
include "cek.php";
?>
<?php
$query = "SELECT*from sosmed";
$hasil = mysqli_query($conn, $query);
$data = mysqli_fetch_array($hasil);

if (isset($_POST['Edit'])) {
$facebook = $_POST['facebook'];
$twitter = $_POST['twitter'];
$insta = $_POST['insta'];
$wa = $_POST['wa'];
$query = "UPDATE sosmed SET fb='$facebook', twitter='$twitter', insta='$insta', wa='$wa' ";
$hasil = mysqli_query($conn, $query);
header("Location: linksosmed.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sosial Media</title>
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
        Edit Sosial Media
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="container">
		<div class="isi">
		<form action="" method="post" name="input" enctype="multipart/form-data">
		<h4><b> Masukan link sosial disini... </b></h4>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-facebook-square"></i>
                  </div>
                  <input type="text" class="form-control" name="facebook" value="<?php echo $data['fb'] ?>" required >
                </div>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-twitter"></i>
                  </div>
                  <input type="text" class="form-control" name="twitter" value="<?php echo $data['twitter'] ?>" required >
                </div>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-instagram"></i>
                  </div>
                  <input type="text" class="form-control" name="insta" value="<?php echo $data['insta'] ?>" required >
                </div>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-whatsapp"></i>
                  </div>
                  <input type="text" class="form-control" name="wa" value="<?php echo $data['wa'] ?>" required >
                </div> <br>
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
