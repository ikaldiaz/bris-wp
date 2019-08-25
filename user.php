<?php  
include "header.php";
include_once 'includes/user.inc.php';
$pro = new User($db);
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
            <h4>Data Pengguna</h4>
        </div>
        <div class="col-md-6 text-right">
            <button type="submit" name="hapus-contengan" class="btn btn-danger">Hapus Contengan</button>
            <button type="button" onclick="location.href='user-baru.php'" class="btn btn-primary">Tambah Data</button>
        </div>
    </div>
    <br/>
    <table width="100%" class="table table-striped table-bordered" id="tabeldata">
        <thead>
            <tr>
                <th width="10px"><input type="checkbox" name="select-all" id="select-all" /></th>
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody>
    <?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    ?>
            <tr>
                <td style="vertical-align:middle;"><input type="checkbox" value="<?php echo $row['id_pengguna'] ?>" name="checkbox[]" /></td>
    	    <td style="vertical-align:middle;"><?php echo $row['nama_lengkap'] ?></td>
    	    <td style="vertical-align:middle;"><?php echo $row['username'] ?></td>
            <td class="text-center" style="vertical-align:middle;">
    		  <a href="user-ubah.php?id=<?php echo $row['id_pengguna'] ?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
    		  <a href="user-hapus.php?id=<?php echo $row['id_pengguna'] ?>" onclick="return confirm('Yakin ingin menghapus data')" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
    	    </td>
            </tr>
    <?php
    }
    ?>
        </tbody>
    </table>
    </form> 
<?php include "footer.php"; ?>
