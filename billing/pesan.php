<?php
	include "fungsi.php";
	$formId = getToken();
?>
<div id="<?php echo $formId; ?>" class="peringatan">
<div class="prepend-top append-5 prepend-5 middle">
<div class="prepend-top error height-2">
	<?=$_POST['pesan']?>
	<br/><a onclick="tutup('<?php echo $formId; ?>')">[Tutup]</a>
</div>
</div>
</div>
