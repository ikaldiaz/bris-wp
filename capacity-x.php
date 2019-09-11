<?php 
//Pendapatan Nasabah


?>

<div class="form-group">
    <label for="nnx">Pendapatan (C3)</label>
    <select class="form-control" id="nnx" name="nnx">
    	<?php
		// $stmt2 = $pgn2->readAll();
		// while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
		// 	extract($row2);
		// 	echo "<option value='{$id_kriteria}'>{$nama_kriteria}</option>";
		// }
	    ?>
	    <option value="1">1000000</option>
	    <option value="2">2000000</option>
	    <option value="3">3000000</option>
	    <option value="4">4000000</option>
	    <option value="5">5000000</option>
    </select>
</div>

<script>
	$('#nnx').on('change', function () {
		// console.log($(this).val());
		var nilai = $(this).val();
		$('#nn').val(nilai);
		// body...
	})

</script>