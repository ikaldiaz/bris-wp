<?php
include_once 'header.php';
include_once 'includes/alternatif.inc.php';
$pgn1 = new Alternatif($db);
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
?>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-2"></div>
		  <div class="col-xs-12 col-sm-12 col-md-8">
		  	<div class="panel panel-default">
		<div class="panel-body">
		  	<div class="row">
				<div class="col-md-6 text-left">
		  			<h3>Tambah Rangking</h3>
		  		</div>
		  		<div class="col-md-6 text-right">
		  			<h3>
		  				<button type="button" onclick="location.href='rangking.php'" class="btn btn-success">Kembali</button>
		  			</h3>
		  		</div>
		  	</div>
			
			    <form method="post">
				  <div class="form-group">
				    <label for="ia">Aplikasi Pengajuan</label>
				    <select class="form-control" id="ia" name="ia">
				    	<?php
						$stmt3 = $pgn1->readAll();
						while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
							extract($row3);
							echo "<option value='{$id_alternatif}'>{$nama_alternatif}</option>";
						}
					    ?>
				    </select>
				  </div>
				  <div class="form-group">
				    <label for="ik">Kriteria</label>
				    <select class="form-control" id="ik" name="ik">
				    	<?php
						$stmt2 = $pgn2->readAll();
						while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
							extract($row2);
							echo "<option value='{$id_kriteria}'>{$nama_kriteria}</option>";
						}
					    ?>
				    </select>
				  </div>
				  
				  <div class="form-group">
				    <label for="nn">Nilai</label>
				    <input type="text" class="form-control" id="nn" name="nn"/>
				  </div>

				  <button type="submit" class="btn btn-primary">Simpan</button>
				</form>
			  
		  </div></div></div>
		  <div class="col-xs-12 col-sm-12 col-md-2">
		  </div>
		</div>
		<?php
include_once 'footer.php';
?>