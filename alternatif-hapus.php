<?php
include_once "includes/config.php";
$database = new Config();
$db = $database->getConnection();

include_once 'includes/alternatif.inc.php';
$pro = new Alternatif($db);
$id = isset($_GET['id_a']) ? $_GET['id_a'] : die('ERROR: missing ID.');
$pro->id = $id;
	
if($pro->delete()){
	echo "<script>location.href='alternatif.php';</script>";
} else{
	echo "<script>alert('Gagal Hapus Data Pengajuan Aplikasi');location.href='alternatif.php';</script>";
		
}
?>
