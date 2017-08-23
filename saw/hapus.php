<?php 
	include 'koneksi.php';
	$nik = $_GET['nik'];
	mysql_query("DELETE FROM tbl_matrik WHERE nik='$nik'")or die(mysql_error());

	header("location:view.php");
?>
