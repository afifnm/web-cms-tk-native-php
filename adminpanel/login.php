<?php
session_start();
include "../config.php";

if (isset($_POST['Login'])) {
$user = $_POST['username'];
$pass = md5($_POST['password']);
$query = "SELECT * FROM user WHERE user = '$user'";
$hasil = mysqli_query($conn, $query);
$data  = mysqli_fetch_array($hasil);

if ($pass == $data['pass']){
	$_SESSION['nama'] = $data['nama'];
	$_SESSION['user'] = $user;
	header("Location: index.php");
}
else {
	$email = $_POST['username'];
	$pass_email = $_POST['password'];
	$query = "SELECT * FROM user WHERE email = '$email'";
	$hasil2 = mysqli_query($conn, $query);
	$data2  = mysqli_fetch_array($hasil2);
	if ($pass_email == $data2['pass_email']){
		$_SESSION['nama'] = $data['nama'];
		$_SESSION['user'] = $user;
	header("Location: index.php");
	}
	else {
		header("Location: login.php");
	}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Silahkan login terlebih dahulu</title>
<?php
include "css.php";
?>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Silahkan login terlebih dahulu...</p>

    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group has-feedback">
        <input name="username" type="text" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="password" type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="Login" class="btn btn-primary btn-block btn-flat"> Login </button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>