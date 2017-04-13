<?php
session_start();
include "cek.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Halaman Admin</title>
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
        Selamat Datang
        <small>di Halaman Admin</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">


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
