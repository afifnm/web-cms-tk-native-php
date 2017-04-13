					<div class="col-lg-3" id="sidebar">
						<div class="widget" style="margin-top: 30px;">
							<h4 class="widgetheading"><span class="highlight">Info Penting</span></h4>
							<ul class="cat">
										<?php
											$sqlink = "SELECT * FROM link where kategori='sidebar'";
											$link = mysqli_query($conn, $sqlink);
											while ($datalink = $link->fetch_array()) { ?>
										<li style="margin: 0px;"><h5 style="margin: 0 0 8px 0;">
										<a href="<?php echo $datalink['link'] ?>">> <?php echo $datalink['judul'] ?></a>
										</h5>
										</li>
										<?php } ?>
							</ul>
						</div> <br>
						<div class="widget">
							<h4 class="widgetheading"><span class="highlight">Info Lainnya</span></h4>
							<ul class="cat">
										<?php
										$sql = "SELECT * FROM berita ORDER BY tanggal DESC LIMIT 9, 10";  
										$hasil = mysqli_query($conn, $sql);
										while ($data3 = $hasil->fetch_array()) { ?>
										<li style="margin: 0 0 0px 0;"><h5 style="margin: 0 0 10px 0;">
										<?php 
										$url_link = "informasi-".$data3['beritaid'].".html";
										echo "<a href=\"".$url_link."\">> ".$data3['judul']."</a>"; ?>
										</h5>
										</li>
										<?php } ?>
							</ul>
							<br><br>
						</div>
					</div>