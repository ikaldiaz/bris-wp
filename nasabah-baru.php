<?php
include_once 'header.php'; 
// include_once 'includes/nilai.inc.php';
// $pgn = new Nilai($db);
if($_POST){
	
	include_once 'includes/nasabah.inc.php';
	$eks = new Nasabah($db);

	$eks->nm = $_POST['nm'];
	$eks->ph = $_POST['ph'];
	$eks->ad = $_POST['ad'];
	
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
		  			<h3>Tambah Nasabah</h3>
		  		</div>
		  		<div class="col-md-6 text-right">
		  			<h3>
		  				<button type="button" onclick="location.href='nasabah.php'" class="btn btn-success">Kembali</button>
		  			</h3>
		  		</div>
		  	</div>
			
			    <form method="post">
				  <div class="form-group">
				    <label for="nm">Nama Nasabah</label>
				    <input type="text" class="form-control" id="nm" name="nm" required>
				  </div>
				  <div class="form-group">
				    <label for="ph">Kontak Nasabah</label>
				    <input type="text" class="form-control" id="ph" name="ph" required>
				  </div>
				  <div class="form-group">
				    <label for="ad">Alamat Nasabah</label>
				    <input type="text" class="form-control" id="ad" name="ad" required>
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