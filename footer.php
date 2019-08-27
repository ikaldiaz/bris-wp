<footer class="text-center">&copy; 2019</footer>
	</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.3.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="lib/datepicker/dist/datepicker.min.js"></script>
    <script type="text/javascript" src="js/jquery.toastmessage.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script> -->
    <script>
    $(document).ready(function() {

        $('#tabeldata').DataTable();
    	$('#tabeldatay').DataTable();


        $('#ik').on('change', function (e) {
                // alert('woe');

                // $('#oeoe').load('opo.php');
                $('#nn').val(1);

                console.log($(this).val());

                var cr = $(this).val();

                if (cr==1) {
                    $('#oeoe').load('capital-x.php');

                }if (cr==2){
                    $('#oeoe').load('collateral-x.php');

                } if (cr==3){
                    $('#oeoe').load('capacity-x.php');

                }if (cr==4){
                    $('#oeoe').load('condition-x.php');

                }if (cr==5){
                    $('#oeoe').load('character-x.php');

                }else {
                    $('#oeoe').html('');
                }

            });

            $('#tgl').datepicker({
              format: 'yyyy-mm-dd'
            });

            $('#tgl').on('change', function (e) {
                // body...
                $('#kt').val($('#tgl').val());
            });




	});


    function showSuccessToast() {
        $().toastmessage('showSuccessToast', "Data telah dihapus");
    }
    function showStickySuccessToast() {
        $().toastmessage('showToast', {
            text     : 'Sukses, Tambah lagi',
            sticky   : true,
            position : 'top-right',
            type     : 'success',
            closeText: '',
            close    : function () {
                console.log("toast is closed ...");
            }
        });

    }
    function showNoticeToast() {
        $().toastmessage('showNoticeToast', "Kami telah menentukan nilai yang boleh diinput");
    }
    function showStickyNoticeToast() {
        $().toastmessage('showToast', {
             text     : 'Kami telah menentukan nilai yang boleh diinput',
             sticky   : true,
             position : 'top-right',
             type     : 'notice',
             closeText: '',
             close    : function () {console.log("toast is closed ...");}
        });
    }
    function showWarningToast() {
        $().toastmessage('showWarningToast', "Peringatan, password anda masukkan salah");
    }
    function showStickyWarningToast() {
        $().toastmessage('showToast', {
            text     : 'Peringatan, password anda masukkan salah',
            sticky   : true,
            position : 'top-right',
            type     : 'warning',
            closeText: '',
            close    : function () {
                console.log("toast is closed ...");
            }
        });
    }
    function showErrorToast() {
        $().toastmessage('showErrorToast', "Data gagal dihapus, (hapus dulu data yang terkait pada menu lainnya)");
    }
    function showStickyErrorToast() {
        $().toastmessage('showToast', {
            text     : 'Gagal total! Coba lagi',
            sticky   : true,
            position : 'top-right',
            type     : 'error',
            closeText: '',
            close    : function () {
                console.log("toast is closed ...");
            }
        });
    }
    $('#select-all').click(function(event) {   
        if(this.checked) {
            // Iterate each checkbox
            $(':checkbox').each(function() {
                this.checked = true;                        
            });
        } else{
            $(':checkbox').each(function() {
                this.checked = false;                        
            });
        }
    });
    $('#select-all2').click(function(event) {   
        if(this.checked) {
            // Iterate each checkbox
            $(':checkbox').each(function() {
                this.checked = true;                        
            });
        } else{
            $(':checkbox').each(function() {
                this.checked = false;                        
            });
        }
    });
    </script>
  </body>
</html>