<?php
include_once 'header.php';
include_once 'includes/alternatif.inc.php';
$pro1 = new Alternatif($db);
$stmt1 = $pro1->readAll();
$rank = new Alternatif($db);
$stmtx = $rank->getAllRank();
include_once 'includes/mikro.inc.php';
$mik = new Pengajuan($db);
include_once 'includes/nasabah.inc.php';
$nas = new Nasabah($db);

include_once 'includes/kriteria.inc.php';
$pro2 = new Kriteria($db);
$stmt2 = $pro2->readAll();
include_once 'includes/rangking.inc.php';
$pro = new Rangking($db);
$stmt = $pro->readKhusus();
$count = $pro->countAll();

$number = 1234.56;
setlocale(LC_MONETARY,"de_DE");
// setlocale (LC_MONETARY, 'INDONESIA');
// echo money_format("The price is %i", $number);


?>
	<div class="row">
		<div class="col-md-6 text-left">
			<h4>Hasil Perangkingan</h4>
		</div>
	</div>
	<br/>
	<div style="display:none">
	  <!-- Nav tabs -->
	  <ul class="nav nav-tabs" role="tablist">
	    <li role="presentation" class="active"><a href="#lihat" aria-controls="lihat" role="tab" data-toggle="tab">Lihat Semua Data</a></li>
	    <li role="presentation"><a href="#rangking" aria-controls="rangking" role="tab" data-toggle="tab">Perangkingan</a></li>
	    <!-- <li role="presentation"><a href="rangking-baru.php" role="tab">Tambah Data</a></li> -->
	  </ul>
	
	  <!-- Tab panes -->
	  <div class="tab-content">
	    <div role="tabpanel" class="tab-pane active" id="lihat">
	    	<div class="row">
				<div class="col-md-6 text-left">
					<h4>Hasil Ranking Aplikasi Pengajuan</h4>
				</div>
			</div>
			<br/>


	    	<br/>
	    	<form method="post">
			<div class="row">
				<div class="col-md-6 text-left">
					<h4>Data Rangking</h4>
				</div>
				<div class="col-md-6 text-right">
		            <!-- <button type="button" onclick="location.href='rangking-baru.php'" class="btn btn-primary">Tambah Data</button> -->
		            <?php 
		            if($count>0){
		            ?>
		            <button type="button" onclick="location.href='laporan.php'" class="btn btn-primary">Laporan</button>
		            <?php
		            }
		            ?>
				</div>
			</div>
			<br/>
			<table width="100%" class="table table-striped table-bordered" id="tabeldata">
		        <thead>
		            <tr>
		                <th>Aplikasi Pengajuan</th>
		                <th>Kriteria</th>
		                <th>Nilai</th>
		                <!-- <th width="100px">Aksi</th> -->
		            </tr>
		        </thead>
		
		        <tfoot>
		            <tr>
		                <th>Aplikasi Pengajuan</th>
		                <th>Kriteria</th>
		                <th>Nilai</th>
		                <!-- <th>Aksi</th> -->
		            </tr>
		        </tfoot>
		
		        <tbody>
		<?php
		$no=1;
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		?>
		            <tr>
		                <td style="vertical-align:middle;"><?php echo $row['nama_alternatif'] ?></td>
		                <td style="vertical-align:middle;"><?php echo $row['nama_kriteria'] ?></td>
		                <td style="vertical-align:middle;"><?php echo $row['nilai_rangking'] ?></td>
		                <!-- <td class="text-center" style="vertical-align:middle;">
							<a href="rangking-ubah.php?ia=<?php echo $row['id_alternatif'] ?>&ik=<?php echo $row['id_kriteria'] ?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
							<a href="rangking-hapus.php?ia=<?php echo $row['id_alternatif'] ?>&ik=<?php echo $row['id_kriteria'] ?>" onclick="return confirm('Yakin ingin menghapus data')" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
					    </td> -->
		            </tr>
		<?php
		}
		?>
		        </tbody>
		
		    </table>
		    	</form>	
	    </div>

	    <div role="tabpanel" class="tab-pane" id="rangking">
	    	<br/>
	    	<h4>Perangkingan</h4>
			<table width="100%" class="table table-striped table-bordered">
		        <thead>
		            <tr>
		                <th rowspan="2" style="vertical-align: middle" class="text-center">Aplikasi Pengajuan</th>
		                <th colspan="<?php echo $stmt2->rowCount(); ?>" class="text-center">Kriteria</th>
		                <th rowspan="2" style="vertical-align: middle" class="text-center">Vektor S</th>
		                <th rowspan="2" style="vertical-align: middle" class="text-center">Vektor V</th>
		            </tr>
		            <tr>
		            <?php
					while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
					?>
		                <th><?php echo $row2['nama_kriteria'] ?></th>
		            <?php
					}
					?>
		            </tr>
		        </thead>
		
		        <tbody>
		<?php
		while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
		?>
		            <tr>
		                <th><?php echo $row1['nama_alternatif'] ?></th>
		                <?php
		                $a= $row1['id_alternatif'];
						$stmtr = $pro->readR($a);
						while ($rowr = $stmtr->fetch(PDO::FETCH_ASSOC)){
							$b = $rowr['id_kriteria'];
							$tipe = $rowr['tipe_kriteria'];
							$bobot = $rowr['hasil_bobot'];
						?>
		                <td>
		                	<?php 
		                	if($tipe=='benefit'){
		                		$nor = pow($rowr['nilai_rangking'],$bobot);
							} else{
								$nor = pow($rowr['nilai_rangking'],-$bobot);
							}
							echo number_format($nor, 5, '.', ',');

							$pro->ia = $a;
							$pro->ik = $b;
							$pro->nn4 = $nor;
							$pro->normalisasi1();
		                	?>
		                </td>
		                <?php
		                }
						?>
						<td>
							<?php 
							$stmthasil = $pro->readHasil1($a);
							$hasil = $stmthasil->fetch(PDO::FETCH_ASSOC);
							echo number_format($hasil['bbn'], 5, '.', ',');
							$pro->has1 = $hasil['bbn'];
							$pro->hasil1();
							?>
						</td>
						<td>
							<?php
							$stmtmax = $pro->readMax();
							$maxnr = $stmtmax->fetch(PDO::FETCH_ASSOC);
							echo number_format($hasil['bbn']/$maxnr['mnr1'], 5, '.', ',');
							$pro->has2 = $hasil['bbn']/$maxnr['mnr1'];
							$pro->hasil2();
							?>
						</td>
		            </tr>
		<?php
		}
		?>
		        </tbody>
		
		    </table>
		    	
	    </div>
	  </div>
	


	</div>

	<div>

				<table width="100%" class="table table-striped table-bordered" id="tabeldatay">
		        <thead>
		            <tr>
		                <th width="10px">Rank</th>
		                <th>Aplikasi</th>
		                <th>Nama Nasabah</th>
		                <th>Jenis Pengajuan</th>
		                <th>Tanggal Pengajuan</th>
		                <th>Nilai Akhir</th>
		            </tr>
		        </thead>

		        <tfoot>
		            <tr>
		                <th>Rank</th>
		                <th>Aplikasi</th>
		                <th>Nama Nasabah</th>
		                <th>Jenis Pengajuan</th>
		                <th>Tanggal Pengajuan</th>
		                <th>Nilai Akhir</th>
		            </tr>
		        </tfoot>

		        <tbody>
		<?php
		$no=1;
		while ($rowx = $stmtx->fetch(PDO::FETCH_ASSOC)){
		$mik->id = $rowx['id_pengajuan'];
		$mik->readOne();
		$nas->id = $rowx['id_nasabah'];
		$nas->readOne();
		?>
		        <tr>
		            <td style="vertical-align:middle;"><?php echo $no ?></td>
		            <td style="vertical-align:middle;"><?php echo $rowx['nama_alternatif'] ?></td>
		            <td style="vertical-align:middle;"><?php echo $nas->nm ?></td>
		            <td style="vertical-align:middle;"><?php echo $mik->nm ?></td>
		            <td style="vertical-align:middle;"><?php echo $rowx['tgl'] ?></td>
		            <td style="vertical-align:middle;"><?php echo $rowx['vektor_v'] ?></td>
		        </tr>
		<?php
		$no++;
		}
		?>
		    	</tbody>
			</table>

			</div>


<?php
include_once 'footer.php';
?>