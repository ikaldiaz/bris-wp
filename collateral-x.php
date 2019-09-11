<?php 
//agunan



 ?>

<div class="form-group">
    <label for="nnx">Agunan (C2)</label>
    <select class="form-control" id="nnx" name="nnx">
    	<?php
		// $stmt2 = $pgn2->readAll();
		// while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
		// 	extract($row2);
		// 	echo "<option value='{$id_kriteria}'>{$nama_kriteria}</option>";
		// }
	    ?>

	    <option value="1">BPKB Mobil A</option>
	    <option value="2">BPKB Mobil B</option>
	    <option value="3">Tanah < 1000</option>
	    <option value="4">Tanah > 1000</option>
	    <option value="5">Tanah + Rumah</option>
    </select>
</div>

<script>
	$('#nnx').on('change', function () {
		console.log($(this).val());
		var nilai = $(this).val();
		$('#nn').val(nilai);
		// body...
	})

</script>