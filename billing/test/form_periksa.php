<?php
	if($erno) die();
	$mess = false;
	$mess = "Tiket : ".substr(_TOKN,-4)."<br/>Proses : ".$appl_name;
?>
<h2><?php echo _NAME?></h2>
<input type="hidden" id="<?php echo $errorId; ?>" value="<?php echo $mess; ?>"/>
<!-- kebutuhan tracking untuk aplikasi billing : appl_kode,appl_name,appl_file,appl_proc,appl_tokn -->
<input type="hidden" class="periksa" 	name="appl_kode"	value="<?php echo _KODE; ?>"/>
<input type="hidden" class="periksa" 	name="appl_name"	value="<?php echo _NAME; ?>"/>
<input type="hidden" class="periksa" 	name="appl_file"	value="<?php echo _FILE; ?>"/>
<input type="hidden" class="periksa" 	name="appl_proc"	value="<?php echo _PROC; ?>"/>
<input type="hidden" class="periksa" 	name="appl_tokn" 	value="<?php echo _TOKN; ?>"/>
<fieldset>
	<div class="span-4"></div>
	<div class="span-5 border">
		<input type="text" class="periksa" name="pel_no" maxlength="6" value="00012"/>
		<input type="button" value=">>" onclick="periksa('periksa')"/>
		<input type="hidden" class="periksa" name="targetUrl"	value="test/proses_buka.php"/>
		<input type="hidden" class="periksa" name="targetId" 	value="tujuan"/>
		<input type="hidden" class="periksa" name="errorId" 	value="errbuka"/>
		<input type="hidden" class="periksa" name="cekUrl" 		value="test/proses_periksa.php"/>
		<input type="hidden" class="periksa" name="cekId" 		value="tujuan"/>
		<input type="hidden" class="periksa" name="cekMess" 	value="errperiksa"/>
	</div>
	<div class="span-1"></div>
	<div id="tujuan" class="span-8"></div>
</fieldset>