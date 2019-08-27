<?php
include_once 'header.php';
include_once 'includes/alternatif.inc.php';
$pro = new Alternatif($db);
include_once 'includes/mikro.inc.php';
$mik = new Pengajuan($db);
include_once 'includes/nasabah.inc.php';
$nas = new Nasabah($db);
$stmt = $pro->readAll();
$count = $pro->countAll();

if(isset($_POST['hapus-contengan'])){
    $imp = "('".implode("','",array_values($_POST['checkbox']))."')";
    $result = $pro->hapusell($imp);
    if($result){
            ?>
            <script type="text/javascript">
            window.onload=function(){
                showSuccessToast();
                setTimeout(function(){
                    window.location.reload(1);
                    history.go(0)
                    location.href = location.href
                }, 5000);
            };
            </script>
            <?php
    } else{
            ?>
            <script type="text/javascript">
            window.onload=function(){
                showErrorToast();
                setTimeout(function(){
                    window.location.reload(1);
                    history.go(0)
                    location.href = location.href
                }, 5000);
            };
            </script>
            <?php
    }
}
?>
<form method="post">
	<div class="row">
		<div class="col-md-6 text-left">
			<h4>Data Aplikasi Pengajuan</h4>
		</div>
		<div class="col-md-6 text-right">
            <!-- <button type="submit" name="hapus-contengan" class="btn btn-danger">Hapus Contengan</button> -->
			<button type="button" onclick="location.href='alternatif-baru.php'" class="btn btn-primary">Tambah Data</button>
		</div>
	</div>
	<br/>

	<table width="100%" class="table table-striped table-bordered" id="tabeldata">
        <thead>
            <tr>
                <th width="10px"><input type="checkbox" name="select-all" id="select-all" /></th>
                <th>Aplikasi</th>
                <th>Nama Nasabah</th>
                <th>Jenis Pengajuan</th>
                <th>Tanggal Pengajuan</th>
                <th>Vektor S</th>
                <th>Vektor V</th>
                <th width="150px">Aksi</th>
            </tr>
        </thead>

        <tfoot>
            <tr>
                <th><input type="checkbox" name="select-all2" id="select-all2" /></th>
                <th>Aplikasi</th>
                <th>Nama Nasabah</th>
                <th>Jenis Pengajuan</th>
                <th>Tanggal Pengajuan</th>
                <th>Vektor S</th>
                <th>Vektor V</th>
                <th>Aksi</th>
            </tr>
        </tfoot>

        <tbody>
<?php
$no=1;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $mik->id = $row['id_pengajuan'];
    $mik->readOne();
    $nas->id = $row['id_nasabah'];

    $nas->readOne();


?>
            <tr>
                <td style="vertical-align:middle;"><input type="checkbox" value="<?php echo $row['id_alternatif'] ?>" name="checkbox[]" /></td>
                <td style="vertical-align:middle;"><?php echo $row['nama_alternatif'] ?></td>
                <td style="vertical-align:middle;"><?php echo $nas->nm ?></td>
                <td style="vertical-align:middle;"><?php echo $mik->nm ?></td>
                <td style="vertical-align:middle;"><?php echo $row['tgl'] ?></td>
                <td style="vertical-align:middle;"><?php echo $row['vektor_s'] ?></td>
                <td style="vertical-align:middle;"><?php echo $row['vektor_v'] ?></td>
                <td class="text-center" style="vertical-align:middle;">
					<a href="alternatif-ubah.php?id_a=<?php echo $row['id_alternatif'] ?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                    <a href="detail-baru.php?id_a=<?php echo $row['id_alternatif'] ?>" class="btn btn-info"><span class="glyphicon glyphicon-book" aria-hidden="true"></span></a>
					<a href="alternatif-hapus.php?id_a=<?php echo $row['id_alternatif'] ?>" onclick="return confirm('Yakin ingin menghapus data')" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
			    </td>
            </tr>
<?php
}
?>
        </tbody>

    </table>
</form>		
<?php
include_once 'footer.php';
?>