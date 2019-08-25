<?php
include_once 'header.php';
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

include_once 'includes/user.inc.php';
$eks = new User($db);

$eks->id = $id;

$eks->readOne();

if($_POST){

    $eks->nl = $_POST['nl'];
    $eks->un = $_POST['un'];
    $eks->pw = md5($_POST['pw']);
    
    if($eks->update()){
        echo "<script>location.href='user.php'</script>";
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
            <h3>Ubah Pengguna</h3>
          </div>
          <div class="col-md-6 text-right">
            <h3>
              <button type="button" onclick="location.href='user.php'" class="btn btn-success">Kembali</button>
            </h3>
          </div>
        </div>
            
                <form method="post">
                  <div class="form-group">
                    <label for="nl">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nl" name="nl" value="<?php echo $eks->nl; ?>">
                  </div>
                  <div class="form-group">
                    <label for="un">Username</label>
                    <input type="text" class="form-control" id="un" name="un" value="<?php echo $eks->un; ?>">
                  </div>
                  <div class="form-group">
                    <label for="pw">Password</label>
                    <input type="text" class="form-control" id="pw" name="pw" value="<?php echo $eks->pw; ?>">
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