<?php
include "config.php";
?>
<?php 
$query = "SELECT * FROM visimisi";
$hasil = mysqli_query($conn, $query);
$data  = mysqli_fetch_array($hasil);
$foto = $data['foto'];

if (isset($_POST['Input'])) {
date_default_timezone_set("Asia/Jakarta");
$date = date("Y-m-d h:i:s");
$nama = $_POST['gname'];
$alamat = $_POST['galamat'];
$email = $_POST['gemail'];
$komen = $_POST['gkomen'];
	$query = "INSERT INTO bukutamu 
			VALUES ('$nama', '$alamat', '$email', '$komen', '$date')";  
	$hasil = mysqli_query($conn, $query);
header("Location: index.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Buku tamu</title>
<?php
include "css.php";
?>
</head>
<body>
	<div id="sb-search" class="sb-search">
		<form>
			<input class="sb-search-input" placeholder="Enter your search term..." type="hidden" value="" name="search" id="search">
		</form>
	</div>
	<div class="mycontent">
		<div id="wrapper">
			<!-- start header -->
			<header>			
				<div class="navbar navbar-default navbar-static-top">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="index.html"><img src="img/<?php echo $foto?>" alt="" width="90" height="60" style="padding-left: 20px;"/></a>
						</div>
						<div class="navbar-collapse collapse ">
							<ul class="nav navbar-nav">
								<li>
											<a href="index.html">Halaman Awal</a>
								</li>
								 <li>
											<a href="tentangkami">Visi & Misi</a>
								</li>

								<li class="dropdown">
									<a href="#" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">Informasi <i class="fa fa-angle-down"></i></a>
									<ul class="dropdown-menu">
										<?php
											$sqlink = "SELECT * FROM link where kategori='header'";
											$link = mysqli_query($conn, $sqlink);
											while ($datalink = $link->fetch_array()) { ?>
										<li><a href="<?php echo $datalink['link'] ?>"><?php echo $datalink['judul'] ?></a></li>
										<?php } ?>
									</ul>
								</li>
								<li class="dropdown">
									<a href="" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">Album Foto <i class="fa fa-angle-down"></i></a>
									<ul class="dropdown-menu">
										<?php
											$sqlink = "SELECT * FROM albumfoto";
											$linked = mysqli_query($conn, $sqlink);
											while ($link = $linked->fetch_array()) { ?>
											<li>
												<a href="albumfoto-<?php echo $link['folder']?>.html">
												 <?php echo $link['judul']?></a>
											</li>
										<?php	} ?> 
									</ul>
								</li>
								 <li class="dropdown active">
											<a href="buku-tamu">Buku Tamu</a>
								</li>
							</ul>
						</div>
				</div>
			</header>

				<div id="konten2" class="col-lg-12" style="padding-right: 0px; padding-left: 0px;">
					<div id="konteninfo" class="col-lg-9">
						<div  id="about">
						<h3 style="color: black;">Buku <span class="highlight">Tamu</span></h3>
						<p class="text-success"> Silahkan tamu mengisi data di form ini! </p>
						<br>
						<form action="" method="post" enctype="multipart/form-data">
							<label>Nama</label><br>
							<input type="text" name="gname" class="form-control" required /> <br>
							<label>Alamat</label><br>
							<input type="text" name="galamat" class="form-control" required /> <br>
							<label>Email</label><br>
							<input type="text" name="gemail" class="form-control" required /> <br>
							<label style="padding-right:350px;">Komentar</label><br>
							<textarea name="gkomen" rows="4" cols="50" class="form-control" required/></textarea> </br>
							<button class="btn btn-info" name="Input" type="Submit">&nbsp Submit &nbsp </button>
							&nbsp&nbsp
							<button class="btn btn-info" type="Reset">&nbsp Reset &nbsp </button>
						</form>
													
						</div>
						<br><hr class="colorgraph"> </hr>	
					</div>
					<?php
					include "sidebar.php";
					?>
				</div>
		<?php
		include "footer.php";
		?>	
		</div>
	</div>	
<a href="#" class="scrollup"><img style='width: 75px;' src='img/rocket.png' ></a>

<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.appear.js"></script>
<script src="js/stellar.js"></script>
<script src="js/classie.js"></script>
<script src="js/uisearch.js"></script>
<script src="js/jquery.cubeportfolio.min.js"></script>
<script src="js/google-code-prettify/prettify.js"></script>
<script src="js/animate.js"></script>
<script src="js/custom.js"></script>

	
</body>
</html>