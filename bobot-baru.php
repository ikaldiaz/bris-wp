<?php
include_once 'header.php';
include_once 'includes/nilai.inc.php';
include_once 'includes/kriteria.inc.php';
$pgn = new Nilai($db);
$kri = new Kriteria($db);
if($_POST){
	
	include_once 'includes/bobot.inc.php';
	$eks = new Bobot($db);

	$eks->id = $_POST['id'];
	$eks->kt = $_POST['kt'];
	
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
		  			<h3>Tambah Bobot</h3>
		  		</div>
		  		<div class="col-md-6 text-right">
		  			<h3>
		  				<button type="button" onclick="location.href='bobot.php'" class="btn btn-success">Kembali</button>
		  			</h3>
		  		</div>
		  	</div>
			
			    <form method="post">
				  <div class="form-group">
				    <label for="id">ID Kriteria</label>
				    <select class="form-control" id="id" name="id">
				    	<?php
						$stmt3 = $kri->readAll();
						while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
							extract($row3);
							echo "<option value='{$id_kriteria}'>{$nama_kriteria} ({$id_kriteria})</option>";
						}
					    ?>
				    </select>
				  </div>
				  <div class="form-group">
				    <label for="kt">Nilai Bobot</label>
				    <select class="form-control" id="kt" name="kt">
				    	<?php
						$stmt2 = $pgn->readAll();
						while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
							extract($row2);
							echo "<option value='{$jum_nilai}'>{$jum_nilai} ({$ket_nilai})</option>";
						}
					    ?>
				    </select>
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