 <?php $url= $_SERVER['REQUEST_URI']; 
 function like_match($pattern, $subject)
{
    $pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
    return (bool) preg_match("/^{$pattern}$/i", $subject);
}

?>
 
  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Halaman </b>Admin</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <a href="user.php">
	  <div class="user-panel" style="padding:5px">
        <div class="pull-left image">
          <img src="../img/logo.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Administrator</p>
          <i class="fa fa-circle text-success"></i> Online
        </div>
      </div>
	  </a>
	  <ul class="sidebar-menu">
        <li class="header">Main Navigasi</li>
        <li class="<?php if (like_match('%index%',$url)==TRUE){ echo"active"; }?> treeview">
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Home</span>
          </a>
        </li>
        <li class="<?php if (like_match('%berita%',$url)==TRUE){ echo"active"; }?> treeview">
          <a href="berita.php">
            <i class="fa fa-info-circle"></i> <span>Informasi</span>
			</a>
        </li>
		<?php
		$sqlink = "SELECT * FROM albumfoto";
		$linked = mysqli_query($conn, $sqlink);
		?>
        <li class="<?php if (like_match('%foto%',$url)==TRUE){
		echo"active"; }?> treeview">
          <a href="#">
            <i class="fa fa-instagram"></i>
            <span>Album Foto</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<li class="<?php if (like_match('%albumfoto%',$url)==TRUE){ echo"active"; }?> treeview">
			<a href="albumfoto.php"><i class="fa fa-circle-o"></i> Daftar Album Foto</a></li>
			<?php	while ($link = $linked->fetch_array()) { ?>
				<li class="<?php if (like_match('%'.$link['folder'].'%',$url)==TRUE){
		echo"active"; }?> treeview">
					<a href="foto.php?folder=<?php echo $link['folder']?>">
					<i class="fa fa-circle-o text-warning"></i> <?php echo $link['judul']?></a>
				</li>
			<?php	} ?> 
		  </ul>
        </li>
        <li class="<?php if (like_match('%pendaftaran%',$url)==TRUE){ echo"active"; }?> treeview">
          <a href="pendaftaran.php">
            <i class="fa fa-file-text-o"></i> <span>Pendaftaran</span>
			</a>
        </li>
        <li class="<?php if (like_match('%file%',$url)==TRUE){ echo"active"; }?> treeview">
          <a href="file.php">
            <i class="fa fa-file"></i> <span>Upload File</span>
			</a>
        </li>
        <li class="<?php if (like_match('%bukutamu%',$url)==TRUE){ echo"active"; }?> treeview">
          <a href="bukutamu.php">
            <i class="fa fa-book"></i>
            <span>Lihat Buku Tamu</span>
          </a>
        </li>
		<li class="header">Pengaturan</li>
        <li class="<?php if (like_match('%edit%',$url)==TRUE){
		echo"active"; }?> treeview">
          <a href="#">
            <i class="fa fa-tv"></i>
            <span>Pengaturan Tampilan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
        <li class="<?php if (like_match('%logo%',$url)==TRUE){ echo"active"; }?> treeview">
		<a href="editlogo.php"><i class="fa fa-circle-o"></i> Logo</a></li>
            <li class="<?php if (like_match('%visimisi%',$url)==TRUE){ echo"active"; }?> treeview">
			<a href="editvisimisi.php"><i class="fa fa-circle-o"></i> Visi & Misi</a></li>
            <li class="<?php if (like_match('%about%',$url)==TRUE){ echo"active"; }?> treeview">
			<a href="editabout.php"><i class="fa fa-circle-o"></i> Tentang Kami</a></li>
            <li class="<?php if (like_match('%slide%',$url)==TRUE){ echo"active"; }?> treeview">
			<a href="editslide.php"><i class="fa fa-circle-o"></i> Gambar Slide</a></li>
			<li class="<?php if (like_match('%back%',$url)==TRUE){ echo"active"; }?> treeview">
			<a href="editbackground.php"><i class="fa fa-circle-o"></i> Background Halaman</a></li>
          </ul>
        </li>
        <li class="<?php if (like_match('%link%',$url)==TRUE){ echo"active"; }?> treeview">
          <a href="#">
            <i class="fa fa-link"></i>
            <span>Pengaturan Link</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<li class="<?php if (like_match('%linksosmed%',$url)==TRUE){ echo"active"; }?> treeview">
			<a href="linksosmed.php"><i class="fa fa-circle-o"></i> Sosial Media</a></li>
            <li class="<?php if (like_match('%_link%',$url)==TRUE){ echo"active"; }?> treeview">
			<a href="informasi_link.php"><i class="fa fa-circle-o"></i> Informasi Link</a></li>
          </ul>
        </li>

		<li class="treeview">
          <a href="../" target="_blank">
            <i class="fa fa-home"></i> <span>Halaman Awal</span>
			</a>
        </li>
        <li class="treeview">
          <a href="keluar.php">
            <i class="fa fa-share"></i> <span>Keluar</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>