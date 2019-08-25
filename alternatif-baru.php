<?php
include_once 'header.php';
include_once 'includes/nasabah.inc.php';
$nas = new Nasabah($db);
if($_POST){ 
	
	include_once 'includes/alternatif.inc.php';
	$eks = new Alternatif($db);

	$eks->kt = $_POST['ns'].'-'.$_POST['jpk'].'-'.$_POST['tgl'];
	$eks->ns = $_POST['ns'];
	$eks->tgl = $_POST['tgl'];
	
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
				<div class="col-md-8 text-left">
		  			<h3>Tambah Aplikasi Pengajuan</h3>
		  		</div>
		  		<div class="col-md-4 text-right">
		  			<h3>
		  				<button type="button" onclick="location.href='alternatif.php'" class="btn btn-success">Kembali</button>
		  			</h3>
		  		</div>
		  	</div>
			
			    <form method="post">
				  <div class="form-group">
				    <label for="ns">Nasabah</label>
				    <select class="form-control" id="ns" name="ns">
				    	<?php
						$stmt3 = $nas->readAll();
						while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
							extract($row3);
							echo "<option value='{$id_nasabah}'>{$nama}</option>";
						}
					    ?>
				    </select>
				  </div>
				  <div class="form-group">
				    <label for="tgl">Tanggal Pengajuan</label>
				    <input type="text" class="form-control" id="tgl" name="tgl" required>
				  </div>
				  <div class="form-group">
				    <label for="jpk">Jenis Pengajuan Kredit</label>
				    <select class="form-control" id="jpk" name="jpk">
				    	<option value='1'>Mikro A</option>
				    	<option value='2'>Mikro B</option>
				    	<option value='3'>Mikro C</option>
				    	<option value='4'>Mikro D</option>
				    </select>
				  </div>
				  <div class="form-group">
				    <label for="kt">Nama Aplikasi</label>
				    <input type="text" class="form-control" id="kt" name="kt" required>
				  </div>
				  <!-- <div class="form-group">
				    <label for="kt">Alternatif</label>
				    <input type="text" class="form-control" id="kt" name="kt" required>
				  </div> -->
				  <button type="submit" class="btn btn-primary">Simpan</button>
				</form>
			  
		  </div></div></div>
		  <div class="col-xs-12 col-sm-12 col-md-2">
		  </div>
		</div>
		<?php
include_once 'footer.php';
?>