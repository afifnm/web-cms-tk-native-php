<?php
include "../config.php";
if (!isset($_SESSION['user'])){
	header("Location: login.php");
}
?>