<?php
include_once "includes/config.php";
$database = new Config();
$db = $database->getConnection();

include_once 'includes/nasabah.inc.php';
$pro = new Nasabah($db);
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
$pro->id = $id;
	
if($pro->delete()){
	echo "<script>location.href='nasabah.php';</script>";
} else{
	echo "<script>alert('Gagal Hapus Data Nasabah');location.href='nasabah.php';</script>";
		
}
?>
