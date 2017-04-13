<?php 
	$sql22 = "SELECT * FROM sosmed";
	$sosmed = mysqli_query($conn, $sql22);
	$sosial = mysqli_fetch_array($sosmed);
?>
<div class="col-lg-12" style="padding-right: 0px; padding-left: 0px;">
	<footer>
	<div class="container" style="width: 100%; padding-left: 5%;">
		<div style="padding: 0px 0px 0px 0px;">
			<div class="col-sm-3 col-lg-3">
				<div class="widget">
					<h4><?php echo $data['nama'] ?></h4>
					<i class="fa fa-home"></i> <?php echo $data['alamat'] ?><br>
					<a target="_blank" href="<?php echo $sosial['fb'] ?>" data-placement="top" title="Facebook"><i class="fa fa-facebook-square"></i> Facebook</a><br>
					<a target="_blank" href="<?php echo $sosial['twitter'] ?>" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i> Twitter</a><br>
					<a target="_blank" href="<?php echo $sosial['insta'] ?>" data-placement="top" title="Instagram"><i class="fa fa-instagram"></i> Instagram</a><br>
					<i class="fa fa-phone-square"></i> <?php echo $sosial['wa'] ?>

				</div>
			</div>
			<div class="col-sm-3 col-lg-3">
				<div class="widget">
					<h4>Recent Post</h4>
					<ul class="linkfoot">
										<?php
										$sql33 = "SELECT * FROM berita ORDER BY RAND() ASC LIMIT 0, 5";  
										$hasil33 = mysqli_query($conn, $sql33);
										while ($data333 = $hasil33->fetch_array()) { ?>
										<a href="informasi-<?php echo $data333['beritaid']?>.html">
										<li>
										 <?php echo $data333['judul'] ?>
										</li>
										</a>
										<?php } ?>
					</ul>
				</div>
				
			</div>
			<div class="col-sm-3 col-lg-3">
				<div class="widget">
					<h4>Informasi</h4>
					<ul class="linkfoot">
						<?php
							$sqlink = "SELECT * FROM link where kategori='footer'";
							$link = mysqli_query($conn, $sqlink);
							while ($datalink = $link->fetch_array()) { ?>
						<a href="<?php echo $datalink['link'] ?>">
						<li>
						<?php echo $datalink['judul'] ?></li>
						</a>
						<?php } ?>
					</ul>
				</div>
			</div>
			<div class="col-sm-3 col-lg-3">
				<div class="widget">
					<h4>Temukan kami &dArr;</h4>
					<a href="lokasi-kami">
						<img class="find" src="img/copa.png" alt="" width="110" height="120" />
					</a>
				</div>
			</div>
		</div>
	</div>
	<div id="sub-footer" style="background: white;">
		<div class="container">
			<div class="row">
				<div class="col-lg-5">
					<div class="copyright">
						<p>
							&copy; <a href="http://scripthouse.co.id/" title="Script House">Script House </a>2016 All right reserved. 					
						</p>
					</div>
				</div>
				<div class="col-lg-6">
					<ul class="social-network">
						<li><a href="<?php echo $sosial['fb'] ?>" data-placement="top" title="Facebook"><i class="fa fa-facebook-square"></i></a></li>
						<li><a href="<?php echo $sosial['twitter'] ?>" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a></li>
						<li><a href="<?php echo $sosial['insta'] ?>" data-placement="top" title="Instagram"><i class="fa fa-instagram"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	</footer>
</div>