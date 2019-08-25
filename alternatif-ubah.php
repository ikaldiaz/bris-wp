<?php
include_once 'header.php';
$id = isset($_GET['id_a']) ? $_GET['id_a'] : die('ERROR: missing ID Aplikasi Pengajuan.');

include_once 'includes/nasabah.inc.php';
$nas = new Nasabah($db);
include_once 'includes/alternatif.inc.php';
$eks = new Alternatif($db);

$eks->id = $id;

$eks->readOne();
$nas->id = $eks->ns;

$nas->readOne();

if($_POST){

	$eks->kt = $_POST['kt'];
	
	if($eks->update()){
		echo "<script>location.href='alternatif.php'</script>";
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
		  			<h3>Ubah Aplikasi Pengajuan</h3>
		  		</div>
		  		<div class="col-md-6 text-right">
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
				    	echo "<option value='{$nas->id}'>{$nas->nm}</option>";
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
				    <input type="text" class="form-control" id="tgl" name="tgl" required value="<?php echo $eks->tgl; ?>">
				  </div>
				  <div class="form-group">
				    <label for="jpk">Jenis Pengajuan Kredit</label>
				    <select class="form-control" id="jpk" name="jpk">
				    	<option value='1' >Mikro A</option>
				    	<option value='2' >Mikro B</option>
				    	<option value='3' >Mikro C</option>
				    	<option value='4' >Mikro D</option>
				    </select>
				  </div>
				  <div class="form-group">
				    <label for="kt">Nama Aplikasi</label>
				    <input type="text" class="form-control" id="kt" name="kt" value="<?php echo $eks->kt; ?>">
				  </div>
				  <button type="submit" class="btn btn-primary">Ubah</button>
				</form>
			  
		  </div></div></div>
		  <div class="col-xs-12 col-sm-12 col-md-2">
		  </div>
		</div>
		<?php
include_once 'footer.php';
?>