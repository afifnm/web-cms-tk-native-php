<?php
session_start();
include "../config.php";
include "cek.php";
?>
<?php
$query = "SELECT*from user";
$hasil = mysqli_query($conn, $query);
$data = mysqli_fetch_array($hasil);
$user = $data['user'];
$nama = $data['nama'];
$email = $data['email'];
$pass = $data['pass'];
$pass_email = $data['pass_email'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin</title>
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
        Administrator
      </h1>
	  <small>Pastikan email dan password sama dengan akun email gmail!</small>
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="container">
		<form action="" method="post" name="input" enctype="multipart/form-data">
		<h4><b> User</b></h4>
         <input type="text" class="form-control" name="user" value="<?php echo $user ?>" required >
		<h4><b> Nama </b></h4>
		<input type="text" class="form-control" name="nama" value="<?php echo $nama ?>" required >
		<h4><b> Email</b></h4>
         <input type="text" class="form-control" name="email" value="<?php echo $email ?>" required >
		<h4><b> Password Email</b></h4>
         <input type="password" class="form-control" name="pass_email" value="<?php echo $pass_email ?>" required >
		<h4><b> Password Lama</b></h4>
         <input type="password" class="form-control" name="passlama"required >
		<h4><b> Password Baru</b></h4>
         <input type="password" class="form-control" name="passbaru" >
		<h4><b> Konfirmasi Password Baru</b></h4>
         <input type="password" class="form-control" name="repass" >
		 <br>
		<button type="submit" name="Edit" class="btn btn-primary"> Simpan </button>	
		</form>
			<?php
				if (isset($_POST['Edit'])) {
				$user = $_POST['user'];
				$nama = $_POST['nama'];
				$email = $_POST['email'];
				$pass_email = $_POST['pass_email'];
				$passlama = md5($_POST['passlama']);
				$passbaru = $_POST['passbaru'];
				$repass = $_POST['repass'];
				if( $passlama==$pass ) {
					if( $passbaru==""){
						$query = "UPDATE user SET user='$user',nama='$nama',email='$email',pass_email='$pass_email'";
						$hasil = mysqli_query($conn, $query);	
						echo "Berhasil diperbarui";
					} else						
					if( $passbaru==$repass ) {
						$pass = md5($passbaru);
						$query = "UPDATE user SET user='$user',nama='$nama',pass='$pass',email='$email',pass_email='$pass_email'";
						$hasil = mysqli_query($conn, $query);						
						echo "Berhasil diperbarui";
						} else {
							echo "Konfirmasi Password tidak cocok";
						}
				} else {
							echo "Password terdahulu salah!";
						}
			}
			?>
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
