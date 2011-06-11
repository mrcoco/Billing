<?php
	if($erno) die();
?>
<div class="prepend-top span-3 left">Golongan Tarif</div>
<div class="prepend-top span-4 left">:
	<input type="text" class="simpan" name="gol_kode" size="4"/>
</div>
<div class="prepend-top span-3 left">Kuantitas Normal</div>
<div class="prepend-top span-4 left">:
	<input type="text" class="simpan" name="batas_normal" size="4"/>
</div>
<div class="prepend-top span-3 left">Masa Berlaku</div>
<div class="prepend-top span-4 left">:
	<input type="text" class="simpan" name="tar_bln_mulai" size="4"/>
	-
	<input type="text" class="simpan" name="tar_bln_akhir" size="4"/>
</div>
<div class="prepend-top span-3 left">&nbsp;</div>
<div class="prepend-top span-4 left">
	<input type="button" class="form_button" value="Simpan" onclick="buka('simpan')"/>
	<input type="hidden" class="simpan" name="targetId" 	value="form_simpan"/>
	<input type="hidden" class="simpan" name="targetUrl"	value="<?php echo _PROC; ?>"/>
	<input type="hidden" class="simpan" name="proses" 		value="simpan_tarif_industri01"/>
	<input type="hidden" class="simpan" name="dump" 		value="0"/>
</div>