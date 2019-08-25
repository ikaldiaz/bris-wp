<?php
include_once 'header.php';
include_once 'includes/nilai.inc.php';
$pgn = new Nilai($db);
include_once 'includes/kriteria.inc.php';
$kri = new Kriteria($db);

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

include_once 'includes/bobot.inc.php';
$eks = new Bobot($db);

$eks->id = $id;

$eks->readOne();

if($_POST){

	$eks->id = $_POST['id'];
	$eks->kt = $_POST['kt'];
	
	if($eks->update()){
		echo "<script>location.href='bobot.php'</script>";
	} else{
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
		  			<h3>Ubah Bobot</h3>
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
				    	<option value='<?php echo $eks->id ?>'><?php echo $eks->id ?></option>
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
				    	<option value='<?php echo $eks->kt ?>'><?php echo $eks->kt ?></option>
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