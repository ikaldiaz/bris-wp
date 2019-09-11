<?php
include_once 'header.php';
include_once 'includes/nasabah.inc.php';
$pro = new Nasabah($db);
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
			<h4>Data Nasabah</h4>
		</div>
		<div class="col-md-6 text-right">
            <!-- <button type="submit" name="hapus-contengan" class="btn btn-danger">Hapus Contengan</button> -->
			<button type="button" onclick="location.href='nasabah-baru.php'" class="btn btn-primary">Tambah Data</button>
		</div>
	</div>
	<br/>

	<table width="100%" class="table table-striped table-bordered" id="tabeldata">
        <thead>
            <tr>
                <th width="10px"><input type="checkbox" name="select-all" id="select-all" /></th>
                <th>Nama Nasabah</th>
                <th>Kontak</th>
                <th>Alamat</th>
                <th width="100px">Aksi</th>
            </tr>
        </thead>

        <tfoot>
            <tr>
                <th><input type="checkbox" name="select-all2" id="select-all2" /></th>
                <th>Nama Nasabah</th>
                <th>Kontak</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </tfoot>

        <tbody>
<?php
$no=1;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
?>
            <tr>
                <td style="vertical-align:middle;"><input type="checkbox" value="<?php echo $row['id_nasabah'] ?>" name="checkbox[]" /></td>
                <td style="vertical-align:middle;"><?php echo $row['nama'] ?></td>
                <td style="vertical-align:middle;"><?php echo $row['phone'] ?></td>
                <td style="vertical-align:middle;"><?php echo $row['alamat'] ?></td>
                <td style="text-align:center;vertical-align:middle;">
					<a href="nasabah-ubah.php?id=<?php echo $row['id_nasabah'] ?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                    <a href="nasabah-detail.php?id=<?php echo $row['id_nasabah'] ?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
					<a href="nasabah-hapus.php?id=<?php echo $row['id_nasabah'] ?>" onclick="return confirm('Yakin ingin menghapus data')" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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