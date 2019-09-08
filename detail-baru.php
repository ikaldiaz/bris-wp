<?php
include_once 'header.php';
include_once 'includes/alternatif.inc.php';
$pgn1 = new Alternatif($db);
include_once 'includes/nasabah.inc.php';
$nas = new Nasabah($db); 
include_once 'includes/mikro.inc.php';
$mik = new Pengajuan($db); 
include_once 'includes/kriteria.inc.php';
$pgn2 = new Kriteria($db);
include_once 'includes/nilai.inc.php';
$pgn3 = new Nilai($db);

if($_POST){
	
	include_once 'includes/rangking.inc.php';
	$eks = new rangking($db);

	$eks->ia = $_POST['ia'];
	$eks->ik = $_POST['ik'];
	$eks->nn = $_POST['nn'];
	
	if($eks->insert()){
?>
<script type="text/javascript">
window.onload=function(){
	showStickySuccessToast();
};
</script>
<?php
	}
	
	else{
?>
<script type="text/javascript">
window.onload=function(){
	showStickyErrorToast();
};
</script>
<?php
	}
}




// if ($_GET) {
	if (isset($_GET['id_a'])) {
		// echo "<script>alert('no Data');location.href='alternatif.php'</script>";
		$pgn1->id = $_GET['id_a'];
		$pgn1->readOne();
		// echo $pgn1->kt;
		if(empty($pgn1->ns)){
			echo "<script>alert('No Data Nasabah');location.href='alternatif.php'</script>";

			// echo "<script>alert('".empty($pgn1->ns)."');</script>";
		}
		else{

		}


	}else{
		echo "<script>alert('No Data');location.href='alternatif.php'</script>";

	}
// }
?>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-2"></div>
		  <div class="col-xs-12 col-sm-12 col-md-8">
		  	<div class="panel panel-default">
		<div class="panel-body">
		  	<div class="row">
				<div class="col-md-6 text-left">
		  			<h3>Detail Nasabah</h3>
		  		</div>
		  		<div class="col-md-6 text-right">
		  			<h3>
		  				<button type="button" onclick="location.href='alternatif.php'" class="btn btn-success">Kembali</button>
		  			</h3>
		  		</div>
		  	</div>

			
			    <form method="post">
				  <div class="form-group">
				    <label for="ia">Nama Nasabah</label>
				    	<?php
						$pgn1->id = $_GET['id_a'];
						// $pgn1->id;
						$pgn1->readOne();
						$nas->id = $pgn1->ns;
						$nas->readOne();
						echo "<input type='text' disabled class='form-control' value='$nas->nm'>";
						// echo "<input type='text' disabled class='form-control' value='$nas->id'>";
						// echo "<input type='text' disabled class='form-control' value='$nas->ph'>";
						// echo "<input type='text' disabled class='form-control' value='$nas->ad'>";
						echo "<input type='hidden' class='form-control' name='ia' value='$pgn1->id'>";
						// echo "<input type='text' class='form-control' id='ia' value='$pgn1->kt'>";
					    ?>
				    <!-- <input type="text" class="form-control" id="ia" name="ia" required> -->
				  </div>

					<!-- Button trigger modal -->
				  <div class="form-group">
					<button type="button" class="btn btn-primary " data-toggle="modal" data-target="#detNasabah">
					  Detail Nasabah
					</button>
				  </div>

					<!-- Modal -->
					<div class="modal fade" id="detNasabah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="myModalLabel">Detail Nasabah</h4>
					      </div>
					      <div class="modal-body">
					      	<?php
							echo "Nama <input type='text' disabled class='form-control' value='$nas->nm'>";
							echo "Kontak <input type='text' disabled class='form-control' value='$nas->ph'>";
							echo "Alamat <input type='text' disabled class='form-control' value='$nas->ad'>";
							// echo "<input type='text' class='form-control' name='ia' value='$pgn1->id'>";
							// echo "<input type='text' class='form-control' id='ia' value='$pgn1->kt'>";
						    ?>

					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
					        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
					      </div>
					    </div>
					  </div>
					</div>

				  <div class="form-group">
				    <label for="ia">Jenis Pengajuan</label>
				    	<?php
				    	$mik->id = $pgn1->jpk;
				    	$mik->readOne();
						echo "<input type='text' disabled class='form-control' value='$mik->nm'>";
						// echo "<input type='text' class='form-control' id='ia' value='$pgn1->kt'>";
					    ?>
				    <!-- <input type="text" class="form-control" id="ia" name="ia" required> -->
				  </div>

				  <div class="form-group">
				    <label for="ik">Kriteria Penilaian</label>
				    <select class="form-control" id="ik" name="ik">
						<option value='xxx'>Pilih Kriteria Penilaian</option>
				    	<?php 
						$stmt2 = $pgn2->readAll();
						while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
							extract($row2);
							echo "<option value='{$id_kriteria}'>{$nama_kriteria}</option>";
						}
					    ?>
				    </select>
				  </div>

				  <div id="oeoe">
				  	
				  </div>
				  <!-- 
				  <div class="form-group">
				    <label for="nn">Kriteria Penilaian </label>
				    <input type='hidden' class='form-control' id='ik' name='ik' value='33'>
				    <select class="form-control" id="nn" name="nn">
				    	<option value="1">BPKB Mobil A</option>
				    	<option value="2">BPKB Mobil B</option>
				    	<option value="3">Tanah < 10000</option>
				    	<option value="4">Tanah > 10000</option>
				    	<option value="5">Tanah + Bangunan</option>
				    </select>
				  </div>
				  -->
				  <div class="form-group">
				  <input type="text" class="form-control" id="nn" name="nn" placeholder="nilai" /> 
				  </div>

				  <button type="submit" class="btn btn-primary">Simpan</button>
				</form>
				<br>

				  <div class="row">
					 <ul class="nav nav-tabs" role="tablist">
					 	<li role="presentation" class="active">
					 		<a href="#c1" aria-controls="c1" role="tab" data-toggle="tab">Agunan</a>
					 	</li>
					 	<li role="presentation">
					 		<a href="#c3" aria-controls="c3" role="tab" data-toggle="tab">Pendapatan</a>
					 	</li>
					 	<li role="presentation">
					 		<a href="#c4" aria-controls="c4" role="tab" data-toggle="tab">Kondisi</a>
					 	</li>
					 	<li role="presentation">
					 		<a href="#c5" aria-controls="c5" role="tab" data-toggle="tab">Karakter</a>
					 	</li>
					 </ul>

					 <div class="tab-content">
					 	<div role="tabpanel" class="tab-pane active" id="c1">
					 		<div class="row">
								<div class="col-md-12 text-left">
									<h4>Agunan</h4>
								</div>
							</div>
							<br/>

					 	</div>
					 	<div role="tabpanel" class="tab-pane" id="c3">
					 		<div class="row">
								<div class="col-md-12 text-left">
									<h4>Pendapatan</h4>
								</div>
							</div>
							<br/>

							<div>
								
							</div>

					 	</div>
					 	<div role="tabpanel" class="tab-pane" id="c4">
					 		<div class="row">
								<div class="col-md-12 text-left">
									<h4>Kondisi</h4>
								</div>
							</div>
							<br/>

					 	</div>
					 	<div role="tabpanel" class="tab-pane" id="c5">
					 		<div class="row">
								<div class="col-md-12 text-left">
									<h4>Karakter</h4>
								</div>
							</div>
							<br/>

					 	</div>
					 </div>	
				  </div>
			  
		  </div></div></div>
		  <div class="col-xs-12 col-sm-12 col-md-2">
		  </div>
		</div>
<?php
include_once 'footer.php';
?>