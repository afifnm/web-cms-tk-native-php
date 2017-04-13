<?php
include "config.php";
?>
<?php 
$query = "SELECT * FROM visimisi";
$hasil = mysqli_query($conn, $query);
$data  = mysqli_fetch_array($hasil);
$foto = $data['foto'];
$id = $_GET['id'];
$queryberita = "SELECT * FROM berita WHERE beritaid='$id'";
$hasilberita = mysqli_query($conn, $queryberita);
$datainfo = mysqli_fetch_array($hasilberita);
$gambar = $datainfo['gambar'];
$judul = $datainfo['judul'];
$desk = $datainfo['desk'];
$tgl = $datainfo['tanggal'];

function limit_words($string, $word_limit){
	$words = explode(" ",$string);
	return implode(" ",array_splice($words,0,$word_limit));
}   
$query = "SELECT * FROM visimisi";
$hasil = mysqli_query($conn, $query);
$data  = mysqli_fetch_array($hasil);
$limited_string = limit_words($data['about'], 50);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $judul; ?></title>
<?php
include "css.php";
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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
							<a class="navbar-brand" href="index.html"><img src="img/<?php echo $foto?>" alt="" width="90" height="60" style="padding-left: 20px;"/>
							</a>
						</div>
						<div class="navbar-collapse collapse ">
							<ul class="nav navbar-nav">
								<li>
											<a href="index.html">Halaman Awal</a>
								</li>
								 <li>
											<a href="tentangkami">Visi & Misi</a>
								</li>

								<li class="dropdown active">
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
								 <li>
											<a href="buku-tamu">Buku Tamu</a>
								</li>
							</ul>
						</div>
				</div>
			</header>
			<!-- end header -->
				<div id="konten2" class="col-lg-12" style="padding-right: 0px; padding-left: 0px;">
					<div id="konteninfo" class="col-lg-9">
						<div  id="about">
							<div class="col-lg-11">	
							<h3 class="text-info"><?php echo $judul; ?></h3>
							<span class="pullquote-left">  Diterbitkan : <?php echo $tgl; ?> </span>
							<img class="foto" src="img/berita/<?php echo $gambar?>" alt="" />
							<p> <?php echo $desk; ?>	</p>
							</div>												
						</div>
						<br>
						<?php
						echo"<div class=\"fb-comments\"
						data-href=\"http://alamatwebsite.com/informasi-$id.html\"
						data-num-posts=\"5\" data-width=\"450\"></div>";
						?>
						<div id="informasi">
							<div class="col-lg-12">
							<hr class="colorgraph"> </hr>
								<div id="grid-container" class="cbp-l-grid-projects">
									<ul>
										<?php
										$sql = "SELECT * FROM berita ORDER BY tanggal DESC LIMIT 1, 3";  
										$hasil = mysqli_query($conn, $sql);
										while ($data3 = $hasil->fetch_array()) { ?>
										<li class="cbp-item graphic">
											<div class="cbp-caption" style="margin-bottom:0px;">
												<div class="cbp-caption-defaultWrap">
													<img class="img-responsive" src="img/berita/<?php echo $data3['gambar']?>" width="270" height="265" />
												</div>
												<div class="cbp-caption-activeWrap">
													<div class="cbp-l-caption-alignCenter">
														<div class="cbp-l-caption-body">
															<?php 
															$url_link = "informasi-".$data3['beritaid'].".html";
															echo "<a class='cbp-l-caption-buttonRight' style='padding: 5px 15px 7px 11px;' href=\"".$url_link."\">"; 
															?>
															Baca...</a>
														</div>
													</div>
												</div>
											</div>
											<div style="text-align:center;" class="cbp-l-grid-projects-title"><?php echo $data3['judul'] ?></div>
												<?php 
												$limited_string = limit_words($data3['desk'], 15);
												?>
											<div class="cbp-l-grid-projects-desc"> <?php echo strip_tags($limited_string) ?>... </div>
										</li>
										<?php } ?>
									</ul>
								</div>
							</div>
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