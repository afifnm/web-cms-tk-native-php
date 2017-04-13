<?php
include "config.php";
?>
<?php 
$query = "SELECT * FROM visimisi";
$hasil = mysqli_query($conn, $query);
$data  = mysqli_fetch_array($hasil);
$foto = $data['foto'];
if (isset($_GET['folder'])) {
	$dir = $_GET['folder'];
} else
{
	header("Location: index.html");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Album Foto</title>
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
								<li class="dropdown active">
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
								 <li class="dropdown">
											<a href="buku-tamu">Buku Tamu</a>
								</li>
							</ul>
						</div>
				</div>
			</header>
				<div id="konten2" class="col-lg-12" style="padding-right: 0px; padding-left: 0px;">
					<div id="konteninfo" class="col-lg-9">
						<div  id="about">
							<?php 
							$sqfoto = "SELECT * FROM albumfoto where folder='$dir'";
							$hasilfoto = mysqli_query($conn, $sqfoto);
							$datafoto  = mysqli_fetch_array($hasilfoto);
							?>						
						<h3 style="color: black;">Album <span class="highlight">Foto</span></h3>
						<h4> <?php echo $datafoto ['judul']?> </h4>
						<p class="text-success"> <?php echo $datafoto ['desk']?></p>
							<div id="grid-container" class="cbp-l-grid-projects">
								<ul>
								<?php  
								$folder = "img/albumfoto/".$dir; //folder tempat gambar disimpan  
								$handle = opendir($folder);  
								$i = 1;  
								while(false !== ($file = readdir($handle))){  
									if($file != '.' && $file != '..'){  
								?> 	
									<li class="cbp-item graphic" style="width: 190px; height: 190px; transform: translate3d(190px, 0px, 0px);">
									<a href="img/albumfoto/<?php echo $dir."/".$file ?>" class="cbp-lightbox">
									<img class="album" src="img/albumfoto/<?php echo $dir."/".$file ?>" alt="" />
									</a>
									</li>
									<?php 	$i++;  
									}  
								}  
								?>
								</ul>
							</div>				
						</div>
						<br><hr class="colorgraph"> </hr>	
						<div class="col-lg-9">
							<h4> Lihat album foto lainnya.. </h4>
								<ul>
									<?php
										$sqlink2 = "SELECT * FROM albumfoto ORDER BY RAND() ASC LIMIT 0, 5";
										$linked2 = mysqli_query($conn, $sqlink2);
										while ($link2 = $linked2->fetch_array()) { ?>
										<li>
											<a class="link" style="color:black" href="albumfoto.php?folder=<?php echo $link2['folder']?>">
											 <?php echo $link2['judul']?></a>
										</li>
									<?php	} ?> 
								</ul>
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