<?php
include "config.php";
?>
<?php 
$query = "SELECT * FROM visimisi";
$hasil = mysqli_query($conn, $query);
$data  = mysqli_fetch_array($hasil);
$foto = $data['foto'];

// $query2 = "SELECT * FROM slides";
// $hasil2 = mysqli_query($conn, $query2);
// $data2  = mysqli_fetch_array($hasil2);
// $urlfoto = $data2['foto'];
// $judul = $data2['judul'];
// $desk = $data2['desk'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Visi, Misi & Tujuan</title>
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
							<a class="navbar-brand" href="index.html">
							<img src="img/<?php echo $foto?>" alt="" width="90" height="60" style="padding-left: 20px;"/></a>
						</div>
						<div class="navbar-collapse collapse ">
							<ul class="nav navbar-nav">
								<li>
											<a href="index.html">Halaman Awal</a>
								</li>
								 <li class="dropdown active">
											<a href="tentangkami">Visi & Misi</a>
								</li>

								<li class="dropdown">
									<a href="" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">Informasi <i class="fa fa-angle-down"></i></a>
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
								 <li>
											<a href="buku-tamu">Buku Tamu</a>
								</li>
							</ul>
						</div>
				</div>
			</header>
			<!-- end header -->
					<?php 
					$query = "SELECT * FROM visimisi";
					$hasil = mysqli_query($conn, $query);
					$data  = mysqli_fetch_array($hasil);
					?>	
				<div id="konten2" class="col-lg-12" style="padding-right: 0px; padding-left: 0px;">
					<div id="konteninfo" class="col-lg-9">
						<div  id="about">
							<h3 style="color: black;"><?php echo $data['nama'] ?></h3>
							<h4 style="color: black; margin-bottom: 5px;"><span class="highlight"> Visi Pendidikan </span></h4>
							<?php 
							echo $data['visi'];
							?>	
							<hr class="colorgraph"> </hr>
							<h4 style="color: black; margin-bottom: 5px;"><span class="highlight"> Misi Pendidikan </span></h4>
							<?php 
							echo $data['misi'];
							?>	
							<hr class="colorgraph"> </hr>
							<h4 style="color: black; margin-bottom: 5px;"><span class="highlight"> Tujuan Pendidikan </span></h4>
							<?php 
							echo $data['tujuan'];
							?>	
							<hr class="colorgraph"> </hr>
							<h4 style="color: black; margin-bottom: 5px;"><span class="highlight"> Tentang Kami </span></h4>
							<?php 
							echo $data['about'];
							?>	
						</div>
						

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