<?php
	if($erno) die();
	$formId = getToken();
?>
<div id="<?php echo $formId; ?>" class="peringatan">
<div class="pesan">
<div class="span-14 right large">[<a title="Tutup jendela ini" onclick="tutup('<?php echo $formId; ?>')">Tutup</a>]</div>
<h3>Form Tambah Golongan Tarif</h3>
<hr/>
	<div class="span-14">
		<div class="span-3 left">Model Tarif</div>
		<div class="span-3 left">:
			<select class="pilih" name="targetUrl" onchange="buka('pilih')">
				<option value="form_tarif_industri01.php">-</option>
				<option value="form_tarif_industri01.php">Industri</option>
			</select>
		</div>
		<input type="hidden" class="pilih" name="targetId" 	value="form_model"/>
	</div>
	<div id="form_model" class="span-8"></div>
	<div id="form_simpan" class="span-6"></div>
</div>
</div>