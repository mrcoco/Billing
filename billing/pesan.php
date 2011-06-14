<?php
	include "fungsi.php";
	$formId = getToken();
?>
<div id="<?php echo $formId; ?>" class="peringatan">
<div class="pesan">
	<?=$_POST['pesan']?>
	<br/><input type="button" value="Tutup" onclick="tutup('<?php echo $formId; ?>')"/>
</div>
</div>
