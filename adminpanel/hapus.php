<?php
session_start();
include "../config.php";
include "cek.php";
?>
<?php
if (isset($_GET['tgl'])) {
	$tgl = $_GET['tgl'];
} else {
	die (header("Location: beranda.php"));	
}
$tgl = $_GET['tgl'];
$query = "delete from bukutamu WHERE tanggal_submit = '$tgl'";
$hasil = mysqli_query($conn, $query);
header("Location: bukutamu.php");

?>