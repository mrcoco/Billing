<div id="form_test" class="peringatan">
<div class="pesan">
<div class="span-14 right large">[<a title="Tutup jendela ini" onclick="tutup('form_test')">Tutup</a>]</div>
<h3>Validasi Tarif</h3>
<hr/>
	<div class="span-7 border">
		<div class="span-3 left">Golongan</div>
		<div class="span-3">: <input type="text" size="6" class="hitung" name="gol_kode"/></div>
		<br/></br>
		<div class="span-3 left">Pemakaian Air</div>
		<div class="span-3">: <input type="text" size="6" class="hitung" name="sm_pakai"/></div>
		<br/></br>
		<div class="span-3 left">Bulan Terbit</div>
		<div class="span-3">: <input type="text" size="6" class="hitung" name="bln_rek"/></div>
		<br/></br>
		<div class="span-3 left">Tahun Terbit</div>
		<div class="span-3">: <input type="text" size="6" class="hitung" name="thn_rek"/></div>
		<br/></br>
		<div class="prepend-3 span-3">
			<input type="hidden" class="hitung" name="appl_kode" value="<?php echo _KODE; 		?>"/>
			<input type="hidden" class="hitung" name="appl_name" value="<?php echo _NAME; 		?>"/>
			<input type="hidden" class="hitung" name="appl_file" value="<?php echo _FILE; 		?>"/>
			<input type="hidden" class="hitung" name="appl_proc" value="<?php echo _PROC; 		?>"/>
			<input type="hidden" class="hitung" name="appl_tokn" value="<?php echo _TOKN; 		?>"/>
			<input type="hidden" class="hitung" name="targetUrl" value="<?php echo _PROC; 		?>"/>
			<input type="hidden" class="hitung" name="errorId"   value="<?php echo getToken(); 	?>"/>
			<input type="hidden" class="hitung" name="targetId"  value="hasil"/>
			<input type="hidden" class="hitung" name="proses"    value="hitung"/>
			<input type="button" class="form_button" value="Hitung" onclick="buka('hitung')"/>
		</div>
	</div>
	<div id="hasil" class="span-7"></div>
</div>
</div>