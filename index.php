<?php
include "config.php";
?>
<?php 
$query = "SELECT * FROM visimisi";
$hasil = mysqli_query($conn, $query);
$data  = mysqli_fetch_array($hasil);
$foto = $data['foto'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Halaman Utama</title>
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
							<img src="img/<?php echo $foto?>" alt="" width="90" height="60" style="padding-left: 20px;"/>
							</a>
						</div>
						<div class="navbar-collapse collapse ">
							<ul class="nav navbar-nav">
								<li class="dropdown active">
											<a href="index.html">Halaman Awal</a>
								</li>
								 <li>
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
			<div class="mycontainer">
				<div class="row">
					<div class="col-lg-12">
			<!-- Slider -->
				<div id="main-slider" class="main-slider flexslider">
					<ul class="slides">
					
					<?php
					$query2 = "SELECT * FROM slides ORDER BY gambar ASC";
					$hasil2 = mysqli_query($conn, $query2);
					while ($data2 = $hasil2->fetch_array()) { ?>
					  <li>
						<img src="img/slides/<?php echo $data2['gambar']?>" width="600" height="350" alt="" />
						<div class="flex-caption">
							<h3><?php echo $data2['judul'] ?></h3> 
							<p><?php echo $data2['desk'] ?></p> 
						</div>
					  </li>
					<?php } ?>
					</ul>
				</div>
			<!-- end slider -->
					</div>
				</div>
			</div>	
				<div id="konten" class="col-lg-12" style="padding-right: 0px; padding-left: 0px;">
					<div id="konteninfo" class="col-lg-9">
						<div  id="about">
							<h3 style="color: black;">TK <span class="highlight">Aisyah Manggis</span></h3>

							<?php 
							function limit_words($string, $word_limit){
								$words = explode(" ",$string);
								return implode(" ",array_splice($words,0,$word_limit));
							}   
							$query = "SELECT * FROM visimisi";
							$hasil = mysqli_query($conn, $query);
							$data  = mysqli_fetch_array($hasil);
							$limited_string = limit_words($data['about'], 50);
							echo strip_tags($limited_string)."...";
							?>
							<br>
							<a class="pull-right" href='tentangkami'>
								Selengkapnya...
							</a>													
						</div>
						<br><hr class="colorgraph"> </hr>
						<div id="informasi">
							<div class="col-lg-12">
								<div id="grid-container" class="cbp-l-grid-projects">
									<ul>
										<?php
										$batas = 9;  
										if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
										$start_from = ($page-1) * $batas;   
										$sql = "SELECT * FROM berita ORDER BY tanggal DESC LIMIT $start_from, $batas";  
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
												$limited_string = limit_words($data3['desk'], 20);
												?>
											<div class="cbp-l-grid-projects-desc"> <?php echo strip_tags($limited_string) ?>... </div>
										</li>
										<?php } ?>
									</ul>
								</div>
										<?php
										$sql = "SELECT COUNT(judul) FROM berita";  
										$rs_result = mysqli_query($conn,$sql);  
										$row = mysqli_fetch_row($rs_result);  
										$total_records = $row[0];  
										$total_pages = ceil($total_records / $batas); 
										if ($page == 1) { $pageprev = 1; } else {
										$pageprev = $page-1; }
										echo"<div class='pagination pagination-sm no-margin pull-left'>";
										echo"<li><a href='index.html?page=".$pageprev."'>&laquo</a></li>";
										for ($i=1; $i<=$total_pages; $i++) {  
										echo" <li><a href='index.html?page=" .$i. "'>".$i."</a></li> ";           
										}; 
										$pagenext = $page+1;
										if ($pagenext >= $total_pages) { $pagenext = $total_pages; } else {
										$pagenext = $page+1; }
										echo"<li><a href='index.html?page=".$pagenext."'>&raquo</a></li>";
										echo"</div>";
										?>	
							</div>
						</div>	
					</div>
					<?php
					include "sidebar.php";
					?>
					
					<div class="count">
						Total Pengunjung <br>
						<?php
						$namafile = "counter.txt"; 
						$angka = file($namafile);
						$angka = $angka[0] + 1;
						$fp = fopen($namafile, "w");
						fwrite($fp, $angka);
						$digit = strval($angka);
						for ($i = 0; $i < strlen($angka); $i++) {
						echo "<img style='width: 15px;' src='img/digit/$digit[$i].png' >";
						}
						?>	
					</div><br><br>
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
<script src="plugins/flexslider/jquery.flexslider-min.js"></script> 
<script src="plugins/flexslider/flexslider.config.js"></script>
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