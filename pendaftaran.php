<?php
include "config.php";
$query = "SELECT * FROM visimisi";
$hasil = mysqli_query($conn, $query);
$data  = mysqli_fetch_array($hasil);
$foto = $data['foto'];
?>
<?php 
if (isset($_POST['Input'])) {
date_default_timezone_set("Asia/Jakarta");
$date = date("Y-m-d h:i:s");
$nik = $_POST['nik'];
$namalengkap = $_POST['namalengkap'];
$namapanggilan = $_POST['namapanggilan'];
$jenkel = $_POST['jenkel'];
$agama = $_POST['agama'];
$ttl = $_POST['tempat'].", ".$_POST['tgl']." ".$_POST['bln']." ".$_POST['thn'];
$anakke = $_POST['anakke'];
$saudara = $_POST['saudara'];
$alamat = $_POST['alamat'].", ".$_POST['kodepos'];
$no_hp_ayah = $_POST['no_hp_ayah'];
$no_hp_ibu = $_POST['no_hp_ibu'];
$kelas = $_POST['kelas'];

$sek_asal = $_POST['sek_asal'];
$alamat_sek_asal = $_POST['alamat_sek_asal'];
$gol = $_POST['gol'];
$bahasa = $_POST['bahasa'];
$tinggi = $_POST['tinggi'];
$berat = $_POST['berat'];
$nama_ayah = $_POST['nama_ayah'];
$pekerjaan_ayah = $_POST['pekerjaan_ayah'];
$pendidikan_ayah = $_POST['pendidikan_ayah'];
$gaji_ayah = $_POST['gaji_ayah'];
$nama_ibu = $_POST['nama_ibu'];
$pekerjaan_ibu = $_POST['pekerjaan_ibu'];
$pendidikan_ibu = $_POST['pendidikan_ibu'];
$gaji_ibu = $_POST['gaji_ibu'];
$thn_ajaran = date("Y")."-".(date("Y")+1);
$query = "INSERT INTO pendaftaran 
VALUES ('$nik','$namalengkap','$namapanggilan','$jenkel','$agama','$ttl','$anakke','$saudara','$alamat','$no_hp_ayah','$no_hp_ibu','$kelas'
		,'$sek_asal','$alamat_sek_asal','$gol','$bahasa','$tinggi','$berat'
		,'$nama_ayah','$pekerjaan_ayah','$pendidikan_ayah','$gaji_ayah'
		,'$nama_ibu','$pekerjaan_ibu','$pendidikan_ibu','$gaji_ibu'
		,'$thn_ajaran')";  
	$hasil = mysqli_query($conn, $query);
header("Location: index.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Formulir Pendaftaran</title>
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

				<div id="konten2" class="col-lg-12" style="padding-right: 0px; padding-left: 0px;">
					<div id="konteninfo" class="col-lg-9">
						<h3 style="color: black; margin-bottom: 5px;">Formulir <span class="highlight">Pendaftaran</span></h3>
						<p class="text-success"> Tahun Ajaran <?php echo date("Y") ?>-<?php echo date("Y")+1 ?></p>
							<div class="col-xs-12 col-sm-11 col-md-11">
								<form action="" method="post" name="input" enctype="multipart/form-data">
									NIK
									<div class="form-group">
										<input type="text" name="nik" class="form-control input-md" placeholder="Sesuai dengan KK" required >
									</div>
									Nama
									<div class="row">
										<div class="col-xs-12 col-sm-6 col-md-6">
											<div class="form-group">
												<input type="text" name="namalengkap" class="form-control input-md" placeholder="Nama Lengkap" required >
											</div>
										</div>
										<div class="col-xs-12 col-sm-6 col-md-6">
											<div class="form-group">
												<input type="text" name="namapanggilan" class="form-control input-md" placeholder="Nama Panggilan" required >
											</div>
										</div>
									</div>
									Jenis Kelamin
									<div class="row">
										<div class="col-xs-12 col-sm-6 col-md-6">
											<div class="form-group">
												<select name="jenkel" class="form-control input-md">
												<option value="Laki-laki">Laki-laki</option>
												<option value="Perempuan">Perempuan</option>
												</select>
											</div>
										</div>									
									</div>
									Agama
									<div class="row">
										<div class="col-xs-12 col-sm-6 col-md-6">
											<div class="form-group">
												<select name="agama" class="form-control input-md">
												<option value="Islam">Islam</option>
												<option value="Kristen">Kristen</option>
												<option value="Katolik">Katolik</option>
												<option value="Budha">Budha</option>
												<option value="Hindu">Hindu</option>
												</select>
											</div>
										</div>									
									</div>
									Tempat, Tanggal Lahir
									<div class="row">
										<div class="col-xs-12 col-sm-6 col-md-6">
											<div class="form-group">
												<input type="text" name="tempat" class="form-control input-md" placeholder="Tempat Lahir" required >
											</div>
										</div>
										<div class="col-xs-12 col-sm-6 col-md-6">
											<select name="tgl" class="form-control input-md" style="width: 20%;float: left;"required> 
											<?php
												for ($i=1; $i<=31; $i++) {
													$tg = ($i<10) ? "0$i" : $i;
													echo "<option value='$tg'>$tg</option>";	
												}
											?>
											</select> 
											<select name="bln" class="form-control input-md" style="width: 40%;float: left;" required>
											<?php
												for ($i=1; $i<=12; $i++) {
													$bl = ($i<10) ? "0$i" : $i;
													if($bl==1){ $bln="Januari"; }if($bl==2){ $bln="Februari"; }if($bl==3){ $bln="Maret"; }
													if($bl==4){ $bln="April"; }if($bl==5){ $bln="Mei"; }if($bl==6){ $bln="Juni"; }
													if($bl==7){ $bln="Juli"; }if($bl==8){ $bln="Agustus"; }if($bl==9){ $bln="September"; }
													if($bl==10){ $bln="Oktober"; }if($bl==11){ $bln="November"; }if($bl==12){ $bln="Desember"; }
													echo "<option value='$bln'>$bln</option>";	
												}
											?>
											</select> 
											<select name="thn" class="form-control input-md" style="width: 30%;float: left;" required>
											<?php
												for ($i=2005; $i<=2030; $i++) {
													echo "<option value='$i'>$i</option>";	
												}
											?>
											</select>
										</div>
									</div>	
									Anak ke-
									<div class="row">
										<div class="col-xs-12 col-sm-2 col-md-2">
											<div class="form-group">
												<p class="pull-right"> Dari </p>
												<input type="text" style="width: 60%;" name="anakke" class="form-control input-md" required >
											</div>
										</div>
										<div class="col-xs-12 col-sm-3 col-md-3">
											<div class="form-group">
												<p class="pull-right"> Bersaudara </p>
												<input type="text" style="width: 40%;" name="saudara" class="form-control input-md" required >
											</div>
										</div>	
									</div>
									Alamat Rumah
									<div class="row">
										<div class="col-xs-12 col-sm-8 col-md-8">
											<div class="form-group">
												<input type="text" name="alamat" class="form-control input-md" placeholder="Alamat Lengkap" required >
											</div>
										</div>
										<div class="col-xs-12 col-sm-4 col-md-4">
											<div class="form-group">
												<input type="text" name="kodepos" class="form-control input-md" placeholder="Kode Pos" required >
											</div>
										</div>
									</div>
									No. Handphone
									<div class="row">
										<div class="col-xs-12 col-sm-6 col-md-6">
											<div class="form-group">
												<input type="text" name="no_hp_ayah" class="form-control input-md" placeholder="Nomor HP Ayah">
											</div>
										</div>
										<div class="col-xs-12 col-sm-6 col-md-6">
											<div class="form-group">
												<input type="text" name="no_hp_ibu" class="form-control input-md" placeholder="Nomor HP Ibu">
											</div>
										</div>
									</div>	
									Kelas
									<div class="row">
										<div class="col-xs-12 col-sm-6 col-md-6">
											<div class="form-group">
												<select name="kelas" class="form-control input-md">
												<option value="A">A</option>
												<option value="B">B</option>
												</select>
											</div>
										</div>									
									</div>
									Nama Sekolah Asal
									<div class="form-group">
										<input type="text" name="sek_asal" class="form-control input-md" placeholder="Nama Sekolah asal(playgroup)">
									</div>
									Alamat Sekolah Asal
									<div class="form-group">
										<input type="text" name="alamat_sek_asal" class="form-control input-md" placeholder="Alamat Sekolah asal(playgroup)">
									</div>
									Golongan Darah
									<div class="row">
										<div class="col-xs-12 col-sm-6 col-md-6">
											<div class="form-group">
												<select name="gol" class="form-control input-md">
												<option value="belum">Belum Ada</option>
												<option value="A">A</option>
												<option value="B">B</option>
												<option value="O">O</option>
												</select>
											</div>
										</div>									
									</div>
									Bahasa Sehari-hari
									<div class="row">
										<div class="col-xs-12 col-sm-6 col-md-6">
											<div class="form-group">
												<select name="bahasa" class="form-control input-md">
												<option value="Bahasa Jawa">Bahasa Jawa</option>
												<option value="Bahasa Indonesia">Bahasa Indonesia</option>
												<option value="Bahasa Inggris<">Bahasa Inggris</option>
												</select>
											</div>
										</div>									
									</div>
									Tinggi & Berat Badan
									<div class="row">
										<div class="col-xs-12 col-sm-3 col-md-3">
											<div class="form-group">
												<input type="text" name="tinggi" class="form-control input-md" placeholder="Tinggi (cm)">
											</div>
										</div>
										<div class="col-xs-12 col-sm-3 col-md-3">
											<div class="form-group">
												<input type="text" name="berat" class="form-control input-md" placeholder="Berat (kg)">
											</div>
										</div>
									</div>	
									Data Orang Tua
									<div class="row">
										<div class="col-xs-12 col-sm-6 col-md-6">
											<div class="form-group">
												<input type="text" name="nama_ayah" class="form-control input-md" placeholder="Nama Ayah" required >
											</div>
											<div class="form-group">
												<input type="text" name="pekerjaan_ayah" class="form-control input-md" placeholder="Pekerjaan" required >
											</div>
											<div class="form-group">
												<input type="text" name="pendidikan_ayah" class="form-control input-md" placeholder="Pendidikan Terakhir" required >
											</div>
											<div class="form-group">
												<select name="gaji_ayah" class="form-control input-md">
												<option value="Tidak Bekerja">Tidak Bekerja</option>
												<option value="0 - 2 Juta">0 - 2 Juta</option>
												<option value="2 Juta - 5 Juta">2 Juta - 5 Juta</option>
												<option value="5 Juta Keatas">5 Juta Keatas</option>
												</select>
											</div>
										</div>
										<div class="col-xs-12 col-sm-6 col-md-6">
											<div class="form-group">
												<input type="text" name="nama_ibu" class="form-control input-md" placeholder="Nama Ibu" required >
											</div>
											<div class="form-group">
												<input type="text" name="pekerjaan_ibu" class="form-control input-md" placeholder="Pekerjaan" required >
											</div>
											<div class="form-group">
												<input type="text" name="pendidikan_ibu" class="form-control input-md" placeholder="Pendidikan Terakhir" required >
											</div>
											<div class="form-group">
												<select name="gaji_ibu" class="form-control input-md">
												<option value="Tidak Bekerja">Tidak Bekerja</option>
												<option value="0 - 2 Juta">0 - 2 Juta</option>
												<option value="2 Juta - 5 Juta">2 Juta - 5 Juta</option>
												<option value="5 Juta Keatas">5 Juta Keatas</option>
												</select>
											</div>
										</div>
									</div>	
									<div class="row">
										<div class="col-xs-12 col-md-3">
										<input name="Input" type="submit" value="Simpan" class="btn btn-theme btn-block btn-md">
										</div>
										<div class="col-xs-12 col-md-3">
										<input type="reset" value="Reset" class="btn btn-theme btn-block btn-md">
										</div>
									</div>
								</form>
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