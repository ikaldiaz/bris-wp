<?php
include "includes/config.php";
$config = new Config();
$db = $config->getConnection();

include_once 'includes/alternatif.inc.php';
$pro1 = new Alternatif($db);
$stmt1 = $pro1->readAll();
include_once 'includes/kriteria.inc.php';
$pro2 = new Kriteria($db);
$stmt2 = $pro2->readAll();
include_once 'includes/rangking.inc.php';
$pro = new Rangking($db);
$stmt = $pro->readKhusus();
$count = $pro->countAll();

$wpx = array();

$wpa = array();
$wpb = array();
$wpc = array();
$wpd = array();




while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
	// echo $row1['nama_alternatif'];
	$wpa[] = $row1['nama_alternatif'];
	$wpx['nama'] = $wpa;

	$a= $row1['id_alternatif'];
	$stmtr = $pro->readR($a);
	while ($rowr = $stmtr->fetch(PDO::FETCH_ASSOC)){
		$b = $rowr['id_kriteria'];
		$tipe = $rowr['tipe_kriteria'];
		$bobot = $rowr['hasil_bobot'];


		if($tipe=='benefit'){
			$nor = pow($rowr['nilai_rangking'],$bobot);
		} else{
			$nor = pow($rowr['nilai_rangking'],-$bobot);
		}
		// echo number_format($nor, 5, '.', ',');
		$wpb[] = number_format($nor, 5, '.', ',');
		$wpa[] = $wpb;
		// $wpx['nor'] = $wpb;




		$pro->ia = $a;
		$pro->ik = $b;
		$pro->nn4 = $nor;
		$pro->normalisasi1();

	}

	$stmthasil = $pro->readHasil1($a);
	$hasil = $stmthasil->fetch(PDO::FETCH_ASSOC);
	$wpc[] = number_format($hasil['bbn'], 5, '.', ',');  $wpa[] = $wpc;//echo number_format($hasil['bbn'], 5, '.', ',');
	$pro->has1 = $hasil['bbn'];
	$pro->hasil1();

	$stmtmax = $pro->readMax();
	$maxnr = $stmtmax->fetch(PDO::FETCH_ASSOC);
	$wpd[] = number_format($hasil['bbn']/$maxnr['mnr1'], 5, '.', ','); $wpx['v'] = $wpd; //echo number_format($hasil['bbn']/$maxnr['mnr1'], 5, '.', ',');
	$pro->has2 = $hasil['bbn']/$maxnr['mnr1'];
	$pro->hasil2();

}



echo json_encode($wpx);
?>