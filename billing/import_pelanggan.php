<?php
	if(!$form) die();
	
	$title 		= "Form Import Data Pelanggan";
	$show_form 	= true;
?>
<div id="form_import_pelanggan" class="peringatan">
<div id="pesan" class="pesan">
<?php if($show_form){ ?>
	<h3><?php echo $title; ?></h3>
	<hr/>
	<input type="button" value="Batal" onclick="tutup('form_import_pelanggan')"/>
<?php } ?>
</div>
</div>